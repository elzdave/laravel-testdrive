<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestDriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::all();
        return view('drive.index')->with(['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        // store newly uploaded file to Google Drive
        $uploaded = $request->file('file')->store('/', 'google');

        // get file information from Google Drive
        $file = $this->getCloudFileData($uploaded);

        // create local database entry
        $newFile = File::create([
            'name' => $file['name'],
            'filename' => $file['filename'],
            'extension' => $file['extension'],
            'dirname' => $file['dirname'],
            'path' => $file['path'],
            'mimetype' => $file['mimetype']
        ]);

        return redirect()->route('drives.index')->with([
            'filename' => $newFile->name,
            'filelink' => route('drives.show', ['drive' => $newFile->name]),
            'path' => $newFile->path,
            'message' => 'Sukses menggunggah file'
        ]);
    }

    private function getCloudFileData($filename)
    {
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        
        $file = $contents->where('type', '=', 'file')
                         ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
                         ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
                         ->first();
        return $file;
    }

    /**
     * Display the specified resource.
     *
     * @param  String $filename
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        try {
            $file = File::where('name', $filename)->first();

            $rawData = Storage::cloud()->get($file->path);

            return response($rawData, 200)->header('Content-Type', $file->mimetype);
        } catch (\Throwable $th) {
            abort(404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String $filename
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        $file = File::where('name', $filename)->first();

        try {
            Storage::cloud()->delete($file->path);
            $file->delete();

            return redirect()->route('drives.index')->with([
                'message' => 'Sukses menghapus file'
            ]);
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
