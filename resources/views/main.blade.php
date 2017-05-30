<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs viewer</title>
    <meta name="description" content="PHP Script that presents your Server Logs in an easy to use layout.">
    <meta name="author" content="pixeline.be">
    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">
    <style type="text/css" media="screen">
        body {
            color: #777;
        }
        pre {
            font-size:14px;font-family:monospace;color:black;line-height: 1;
            white-space:pre-wrap;
        }
        /*
        Add transition to containers so they can push in and out.
        */
        #layout,
        #menu,
        .menu-link {
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            -ms-transition: all 0.2s ease-out;
            -o-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;
        }
        /*
        This is the parent `<div>` that contains the menu and the content area.
        */
        #layout {
            position: relative;
            padding-left: 0;
        }
        #layout.active {
            position: relative;
            left: 200px;
        }
        #layout.active #menu {
            left: 200px;
            width: 200px;
        }
        #layout.active .menu-link {
            left: 200px;
        }
        /*
        The content `<div>` is where all your content goes.
        */
        .content {
            margin: 0 auto;
            padding: 0 2em;
            max-width: 800px;
            margin-bottom: 50px;
            line-height: 1.6em;
        }
        .header {
            margin: 0;
            color: #333;
            text-align: center;
            padding: 2.5em 2em;
            border-bottom: 1px solid #eee;
        }
        .header h1 {
            margin: 0.2em 0;
            font-size: 3em;
            font-weight: 300;
        }
        .header h2 {
            font-weight: 300;
            color: #ccc;
            padding: 0;
            margin-top: 0;
        }
        .content-subhead {
            margin: 50px 0 20px 0;
            font-weight: 300;
            color: #888;
        }
        /*
        The `#menu` `<div>` is the parent `<div>` that contains the `.pure-menu` that
        appears on the left side of the page.
        */
        #menu {
            margin-left: -200px; /* "#menu" width */
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000; /* so the menu or its navicon stays above all content */
            background: #191818;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        /*
        All anchors inside the menu should be styled like this.
        */
        #menu a {
            color: #999;
            border: none;
            font-size:.8rem;
            line-height: 1rem;
        }
        /*
        Remove all background/borders, since we are applying them to #menu.
        */
        #menu .pure-menu,
        #menu .pure-menu ul {
            border: none;
            background: transparent;
        }
        /*
        Add that light border to separate items into groups.
        */
        #menu .pure-menu ul,
        #menu .pure-menu .menu-item-divided {
            border-top: 1px solid #333;
        }
        /*
        Change color of the anchor links on hover/focus.
        */
        #menu .pure-menu li a:hover,
        #menu .pure-menu li a:focus {
            background: #333;
            color: #FFF;
        }
        /*
        This styles the selected menu item `<li>`.
        */
        #menu .pure-menu-selected,
        #menu .pure-menu-heading {
            background: #1f8dd6;
        }
        /*
        This styles a link within a selected menu item `<li>`.
        */
        #menu .pure-menu-selected a{
            color: #ffffff;
        }
        /*
        This styles the menu heading.
        */
        #menu .pure-menu-heading {
            font-size: 110%;
            font-weight: 300;
            letter-spacing: 0.1em;
            color: #fff;
            margin-top: 0;
            padding: 0.5em 0.8em;
            background:transparent;
        }
        .credits{border-top:1px solid #DDD; color:#CCC;font-size:.8rem;text-align: center;margin-top:50px}
        .credits a {color:#CCC;}
        /* -- Dynamic Button For Responsive Menu -------------------------------------*/
        .menu-link {
            position: fixed;
            display: block; /* show this only on small screens */
            top: 0;
            left: 0; /* "#menu width" */
            background: #000;
            background: rgba(0,0,0,0.7);
            font-size: 10px; /* change this value to increase/decrease button size */
            z-index: 10;
            width: 2em;
            height: auto;
            padding: 2.1em 1.6em;
        }
        .menu-link:hover,
        .menu-link:focus {
            background: #000;
        }
        .menu-link span {
            position: relative;
            display: block;
        }
        .menu-link span,
        .menu-link span:before,
        .menu-link span:after {
            background-color: #fff;
            width: 100%;
            height: 0.2em;
        }
        .menu-link span:before,
        .menu-link span:after {
            position: absolute;
            margin-top: -0.6em;
            content: " ";
        }
        .menu-link span:after {
            margin-top: 0.6em;
        }
        /* -- Responsive Styles (Media Queries) ------------------------------------- */
        /*
        Hides the menu at `48em`, but modify this based on your app's needs.
        */
        @media (min-width: 48em) {
            .header,
            .content {
                padding-left: 2em;
                padding-right: 2em;
            }
            #layout {
                padding-left: 200px; /* left col width "#menu" */
                left: 0;
            }
            #menu {
                left: 200px;
            }
            .menu-link {
                position: fixed;
                left: 200px;
                display: none;
            }
            #layout.active .menu-link {
                left: 200px;
            }
        }
        .truncate {
            width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        ol{
            list-style: decimal-leading-zero;
            list-style-position: outside;
        }
        ol li{
            border-bottom:1px solid #DDD;
            color:#CCC;
            font-weight: 100;
            font-size:12px;
        }
        ol li:last-child{
            border-bottom:0px solid #DDD;
        }
        ol li pre{
            height:auto;
            overflow: visible;
        }
    </style>
</head>

<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="pure-menu-heading">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a href="<?php echo $_SERVER['PHP_SELF']?>" class="pure-menu-heading">Server Logs</a>
            <ul>
                <?php show_list_of_files($files, $lines); ?>

            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <h1><?php echo $title;?></h1>
            <?= (!empty($filename)) ? '<h2>The last '. $lines. ' lines of <span class="truncate">'. basename($filename) . '</span></h2>': ''; ?>

            <form action="" method="get" class="pure-form pure-form-aligned">
                <input type="hidden" name="p" value="<?php echo $log ?>">
                <label>How many lines to display?
                    <select name="lines" onchange="this.form.submit()">
                        <option value="10" <?php echo ($lines=='10') ? 'selected':'' ?>>10</option>
                        <option value="50" <?php echo ($lines=='50') ? 'selected':'' ?>>50</option>
                        <option value="100" <?php echo ($lines=='100') ? 'selected':'' ?>>100</option>
                        <option value="500" <?php echo ($lines=='500') ? 'selected':'' ?>>500</option>
                        <option value="1000" <?php echo ($lines=='1000') ? 'selected':'' ?>>1000</option>
                    </select>
                </label>
            </form>
        </div>

        <div class="content">

            <ol reversed>
                <?php
                $output = tail($filename, $lines);
                if ($output){
                    $output = explode("\n", $output);
                    if(DISPLAY_REVERSE){
                        // Latest first
                        $output = array_reverse($output);
                    }
                    $output = implode('</pre><li><pre>', $output);
                    echo $output;
                } else{
                ?>
                <ul>

                    <?php show_list_of_files($files, $lines); ?>


                </ul>
                <?php
                }
                ?>
            </ol>

            <footer>
                <p class="credits"><a href="//pixeline.be">Script by pixeline</a>, thanks to <a href="//purecss.io/">purecss.io</a></p>
            </footer>
        </div>
    </div>
</div>
<script>
    (function (window, document) {
        var layout   = document.getElementById('layout'),
                menu     = document.getElementById('menu'),
                menuLink = document.getElementById('menuLink');
        function toggleClass(element, className) {
            var classes = element.className.split(/\s+/),
                    length = classes.length,
                    i = 0;
            for(; i < length; i++) {
                if (classes[i] === className) {
                    classes.splice(i, 1);
                    break;
                }
            }
            // The className is not found
            if (length === classes.length) {
                classes.push(className);
            }
            element.className = classes.join(' ');
        }
        menuLink.onclick = function (e) {
            var active = 'active';
            e.preventDefault();
            toggleClass(layout, active);
            toggleClass(menu, active);
            toggleClass(menuLink, active);
        };
    }(this, this.document));
</script>
</body>
</html>
