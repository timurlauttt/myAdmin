<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Print File</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body onload="window.print()">
    <iframe src="{{ asset('storage/' . $file->path) }}"></iframe>
</body>
</html>
