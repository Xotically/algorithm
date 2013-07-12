<?php
set_time_limit(0);
class Base {
    public function setOptions($options) {
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }
}

class Node extends Base {
    private $x = null;
    private $y = null;
    private $parent = null;
    private $f = null;
    private $h = null;
    private $g = null;

    public function __construct($options) {
        $this->setOptions($options);
    }

    public function getX() {
        return $this->x;
    }
    public function setX($x) {
        $this->x = $x;
        return $this;
    }

    public function getY() {
        return $this->y;
    }
    public function setY($y) {
        $this->y = $y;
        return $this;
    }

    public function getParent() {
        return $this->parent;
    }
    public function setParent($node) {
        $this->parent = $node;
        return $this;
    }

    public function getF() {
        return $this->f;
    }
    public function setF($f) {
        $this->f = $f;
        return $this;
    }

    public function getG() {
        return $this->g;
    }
    public function setG($g) {
        $this->g = $g;
        return $this;
    }
    public function getH() {
        return $this->h;
    }

    public function setH($h) {
        $this->h = $h;
        return $this;
    }

    /**
     * 取得自身坐标
     * @return string
     */
    public function getCoord() {
        return $this->x . '-' . $this->y;
    }

    /**
     * 取得邻居节点
     * @return array
     */
    public function getNeighbors() {
        $result = array();
        $coords =  array(
            ($this->x - 1) . '-' . $this->y, // 上
            $this->x . '-' . ($this->y + 1), // 右
            ($this->x + 1) . '-' . $this->y, // 下
            $this->x . '-' . ($this->y - 1), // 左
        );
        foreach ($coords as $coord) {
            list($x, $y) = explode('-', $coord);
            $data = array('x' => $x, 'y' => $y, 'parent' => $this);
            array_push($result, new __CLASS__($data));
        }
        return $result;
    }
}

class Graph extends Base {
    private $map = array();
    private $start = null;
    private $end = null;

    private $row = 10;
    private $column = 10;
    private $barrier = array();

    private $openList = array();
    private $closeList = array();

    public function __construct($options) {
        $this->setOptions($options);
    }

    public function createMap() {
        for ($x = 0; $x <= $this->row; $x++) {
            $this->map[$x] = array();
            for ($y = 0; $y <= $this->column; $y++) {
                $coord = $x . '-' . $y;
                if (in_array($coord, $this->barrier)) {
                    $this->map[$x][$y] = 1;
                } else {
                    $this->map[$x][$y] = 0;
                }
            }
        }

        return $this;
    }

    /**
     * 创建节点
     * @param $data
     * @return object instanceof Node
     */
    public function createNode($data) {
        list($x, $y) = explode('-', $data);
        $param = array('x' => $x, 'y' => $y);
        if (isset($data['parent'])) {
            $param['parent'] = $data['parent'];
        }
        return new Node($param);
    }

    public function setStart($data) {
        $this->start = $this->createNode($data);
        return $this;
    }

    public function setEnd($data) {
        $this->end = $this->createNode($end);
        return $this;
    }

    public function setBarrier($data) {
        $this->barrier = $data;
        return $this;
    }

    /**
     * 将节点加入openlist
     * @param $data
     * @return object
     */
    public function addOpenList($data) {
        list($x, $y) = explode('-', $data);
        $node = new Node();
        $node->setX($x);
        $node->setY($y);
        $this->openList[$node->getCoord()] = $node;
        return $this;
    }

    /**
     * 用于对openList及closeList排序
     * @return
     */
    public function sortList(&$arr) {

    }

    public function checkValid($node) {
        // 必须在地图内
        if ($this->x < 0 || $this->x > $this->row ||
            $this->y < 0 || $this->y > $this->column) {
            return false;
        }

        // 必须能通过
        if (0 == $this->map[$this->x][$this->y]) {
            return true;
        }
        return false;
    }

    /**
     * 找路
     * @return
     */
    public function find() {
        // 将开始节点加入openlist中
        $this->addOpenList($this->start);
        while ($this->openList) {
            $currentNode = $this->openList[0];
            if ($currentNode->getCoord() == $this->end) {
                // 求路径
                return $path;
            }

            // 判断当前节点的邻居节点
            $neighbors = $currentNode->getNeighbors();
            foreach ($neighbors as $neighbor) {
                if ($this->checkValid($neighbor)) {
                    $existsOpenList = array_key_exists($neighbor, $this->openList) ? true : false;
                    $existsCloseList = array_key_exists($neighbor, $this->closeList) ? true : false;
                    if (!$existsOpenList && !$existsCloseList) {
                        $this->countF($neighbor);
                        $this->addOpenList($neighbor);
                    } else if ($existsOpenList) {
                        $openNode = $this->openNode[$neighbor->getCoord()];
                        if ($openNode->f < $neighbor->f) {
                            $openNode->g = neighbor->g;
                            $openNode->h = neighbor->h;
                            $openNode->f = neighbor->f;
                            $openNode->parent = neighbor->parent;
                        }
                    } else {  // 在 closeList中
                        $coord = $neighbor->getCoord();
                        $closeNode = $this->closeList[$coord];
                        if ($openNode->f > $neighbor->f) {
                            this->addOpenList($closeNode);
                            unset($this->closeList[$coord]);
                        }
                    }
                }
            }

            // 将当前节点加入closeList
            $this->addOpenList($currentNode);

            // 对openList排序
            $this->sortList($this->openList);
        }
    }

    //计算G值
    public function countG($node, $cost = 1) {
        if ($node->getParentNode() == null) {
            $node->setG($cost);
        } else {
            $node->setG($node->getParentNode()->getG() + $cost);
        }
    }

    //计算H值
    public function countH($node, $eNode) {
        $node->setF(abs($node->getX() - $eNode->getX()) + abs($node->getY() - $eNode->getY()));
    }

    //计算F值
    public function countF($node) {
        $node->setF($node->getG() + $node->getF());
    }

    public function displayMap() {
        $html = <<<EOF
            <style type="text/css">
                ul li{ list-style:none;}
                span { display: inline-block; background-color: red;border: 1px solid green; width:45px; height:45px;}
                span.barrier {background-color: green;}
                span.start {background-color: yellow;}
                span.end {background-color: black;}
            </style>
EOF;
        if ($this->map) {
            $html .= '<ul>';
            foreach ($this->map as $key => $value) {
                $html .= '<li>';
                foreach ($value as $index => $item) {
                    $coord = $key . '-' . $index;
                    if (in_array($coord, $this->barrier)) {
                        $html .= '<span class="barrier">' . $coord . '(' . $item . ')' . '</span>';
                    } else {
                        if ($this->start == $coord) {
                            $html .= '<span class="start">' . $coord . '(' . $item . ')' . '</span>';
                        } else if ($this->end == $coord) {
                            $html .= '<span class="end">' . $coord . '(' . $item . ')' . '</span>';
                        } else {
                            $html .= '<span>' . $coord . '(' . $item . ')' . '</span>';
                        }
                    }
                }
                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }
}
$options = array(
    'barrier' => array('2-5', '3-5', '4-5', '5-5', '6-5', '7-5', '8-5', '9-5',),
    'start' => '5-3',
    'end' => '5-9',
);
$graph = new Graph($options);
$graph->createMap();
echo $graph->displayMap();
