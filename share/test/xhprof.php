<?php
$path = 'D:\source\lab.me\share';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require "Profiler.php";

Profiler::enable();
function diplay() {
    paint();
}

function paint() {
    for ($i = 1; $i < 10; $i++) {
        echo $i;
        sleep(1);
    }
}
diplay();

Profiler::end();
