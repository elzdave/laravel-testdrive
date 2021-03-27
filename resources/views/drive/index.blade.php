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
  @isset($filename)
    <div>
      <p>File uploaded : {{ $filename }}</p><br>
      Link : <a href="{{ $filelink }}" target="_blank">{{ $filelink }}</a>
    </div>
  @endisset
</body>
</html>