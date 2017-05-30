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
            margin: 0 1em 0 -1em;
            border-right: 1px solid;
            text-align: right;
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
        }
        .file-selector {
            padding: 10px 10px 10px 0;
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
            <input type="text" placeholder="/path/to/file" value="{{ $defaultFile }}">
            <input type="button" value="View">
        </div>

        <pre><code>{{ $logs }} </code></pre>

        <div class="paging">
            <input type="button" value="|<">
            <input type="button" value="<">
            <input type="button" value=">">
            <input type="button" value=">|">
        </div>
    </div>
</div>
<script>
    (function () {
        var pre = document.getElementsByTagName('pre'),
                pl = pre.length;
        for (var i = 0; i < pl; i++) {
            pre[i].innerHTML = '<span class="line-number"></span>' + pre[i].innerHTML + '<span class="cl"></span>';
            var num = pre[i].innerHTML.split(/\n/).length;
            for (var j = 0; j < num; j++) {
                var line_num = pre[i].getElementsByTagName('span')[0];
                line_num.innerHTML += '<span>' + (j + 1) + '</span>';
            }
        }
    })();
</script>
</body>
</html>
