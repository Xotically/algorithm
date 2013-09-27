$path = 'D:\source\lab.me\share';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require "Profiler.php";
Profiler::enable();



// your application



Profiler::end();

