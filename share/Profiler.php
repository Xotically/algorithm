<?php
class Profiler {
    public static function enable() {
        //xhprof_enable();//开始

        //xhprof_enable(XHPROF_FLAGS_NO_BUILTINS);
        //xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
        xhprof_enable(XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU);
    }

    public static function close() {
        $xhprof_data = xhprof_disable();//结束，然后写入文件，注意目录
        return $xhprof_data;
    }

    public static function end() {
        $xhprof_data = self::close();
        $XHPROF_ROOT = realpath(dirname(__FILE__).'/xhprof');
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
        include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

        // save raw data for this profiler run using default
        // implementation of iXHProfRuns.
        $xhprof_runs = new XHProfRuns_Default();

        // save the run under a namespace "xhprof_foo"
        $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
        echo "<a href='http://lab.me/share/xhprof/xhprof_html/?run=$run_id&source=xhprof_foo' target='_blank'>analysis</a>";
    }
}
