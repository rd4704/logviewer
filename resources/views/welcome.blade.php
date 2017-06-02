<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log Viewer</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .title {
            font-size: 48px;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        body {
            background-color: white;
            padding: 50px 15%
        }
        pre {
            background-color: #eee;
            overflow: auto;
            margin: 0 0 1em;
            padding: .5em 1em;
        }
        pre code,
        pre .line-number {
            font: normal normal 12px/14px "Courier New", Courier, Monospace;
            color: black;
            display: block;
        }
        pre .line-number {
            float: left;
            margin: 2px 1em 0 -1em;
            border-right: 1px solid;
            text-align: right;
            line-height: 1.25em;
        }
        pre .line-number span {
            display: block;
            padding: 0 .5em 0 1em;
        }
        pre .cl {
            display: block;
            clear: both;
        }
        input {
            font-size: 16px;
            font-family: 'Raleway', sans-serif;
        }
        input[type='text'] {
            width: 75%;
        }
        input[type='button'] {
            width: 20%;
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
            font-weight: 700;
        }
        input[type='button']:disabled {
            background: #ccc;
            border-color: #ccc;
        }
        .file-selector {
            padding: 10px 10px 10px 0;
        }
        .hints{
            padding-top: 50px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Log Viewer
        </div>

        <div class="file-selector">
            <input id="filePath" type="text" placeholder="/path/to/file" value="{{ $defaultFile }}">
            <input type="button" onclick="loadFile()" value="View">
        </div>

        <pre id="logContainer">{{ $logs }}</pre>

        <div class="paging">
            <input id="first" type="button" onclick="loadLines(this.getAttribute('id'))" value="|<" disabled>
            <input id="prev" type="button" onclick="loadLines(this.getAttribute('id'))" value="<" disabled>
            <input id="next" type="button" onclick="loadLines(this.getAttribute('id'))" value=">">
            <input id="last" type="button" onclick="loadLines(this.getAttribute('id'))" value=">|">
        </div>

        <div class="hints">
            Server log files available :
            <ul>
                <li>/logs/access_log</li>
                <li>/logs/laravel.log</li>
            </ul>

            <br/>
            Copy and paste any of the above to read the log.
        </div>
    </div>
</div>
<script src="/js/main.js"></script>
</body>
</html>
