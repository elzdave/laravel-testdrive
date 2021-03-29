<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drive Test</title>
  </head>
  <body>
    <a href="{{ route('drives.create') }}">Goto create page</a>
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Folder</th>
          <th>MIME-type</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($files as $file)
          <tr>
            <td><a href="{{ route('drives.show', ['drive' => $file['name']])}}" target="_blank">{{ $file['name'] }}</a></td>
            <td>{{ $file['dirname'] }}</td>
            <td>{{ $file['mimetype'] }}</td>
            <td>
              <form action="{{ route('drives.destroy', ['drive' => $file['name']])}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Hapus">
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @if (session()->get('filename'))
      <div>
        <p>File uploaded : {{ session()->get('filename') }}</p><br>
        Link : <a href="{{ session()->get('filelink') }}" target="_blank">{{ session()->get('filelink') }}</a><br>
        <p>Path : {{ session()->get('path') }}</p>
      </div>
    @endif
    @if (session()->get('message'))
      <p>{{ session()->get('message') }}</p>
    @endif
  </body>
</html>