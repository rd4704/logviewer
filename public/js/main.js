/**
 * Created by Rahul on 03/06/2017.
 */

(function () {
    beautifyLogViewer(0);
})();

function loadLines(seek) {
    var filename = document.getElementById('filePath').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var jsonResponse = JSON.parse(this.responseText);
            document.getElementById("logContainer").innerHTML = jsonResponse.log;
            updatePaging(jsonResponse.logPos, jsonResponse.isEOF);
            beautifyLogViewer(parseInt(jsonResponse.logPos));
        }
    };
    xmlhttp.open("GET", "/fetchlog/?file=" + filename + "&seek=" + seek, true);
    xmlhttp.send();
}

function beautifyLogViewer(logPos) {
    var pre = document.getElementsByTagName('pre'),
        pl = pre.length;
    for (var i = 0; i < pl; i++) {
        pre[i].innerHTML = '<span class="line-number"></span>' + pre[i].innerHTML + '<span class="cl"></span>';
        var num = pre[i].innerHTML.split(/\n/).length;
        for (var j = 0; j < num; j++) {
            var line_num = pre[i].getElementsByTagName('span')[0];
            line_num.innerHTML += '<span>' + (logPos + j + 1) + '</span>';
        }
    }
}

function updatePaging(logPos, isEOF) {
    document.getElementById('first').disabled = logPos <= 0;
    document.getElementById('prev').disabled = logPos <= 0;
    document.getElementById('next').disabled = isEOF;
    document.getElementById('last').disabled = isEOF;
}

function loadFile() {
    loadLines('first');
}
