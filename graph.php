<?php
set_time_limit(0);
class Graph {
    private $map = array();
    private $start = null;
    private $end = null;

    private $width = 11;
    private $length = 11;
    private $wall = array();

    private $openList = array();
    private $closeList = array();

    public function createMap() {
        for ($x = 0; $x <= $this->width; $x++) {
            $this->map[$x] = array();
            for ($l = 0; $l <= $this->length; $l++) {
                $this->map[$x][$l] = array(1);
            }
        }
    }

    public function displayMap() {
        $html = '<style type="text/css">ul li{ list-style:none;} span{ display: inline-block; background-color: red;border: 1px solid green; width:40px; height:40px;}</style>';
        if ($this->map) {
            $html .= '<ul>';
            foreach ($this->map as $key => $value) {
                $html .= '<li>';
                foreach ($value as $index => $item) {
                    $html .= '<span></span>';
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }
}
$graph = new Graph();
$graph->createMap();
