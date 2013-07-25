<?php
/**
 * 二叉树实现
 * @author joe
 * @version 1.0
 * @date 2013-06-25
 */

set_time_limit(0);

// 节点
class NODE {
    public $data = null;
    public $left = null;
    public $right = null;
}


class Tree {
    public $root = null;
    private $data = array();

    public function __CONSTRUCT($data) {
        $this->data = $data;
    }

    public function creatTree() {
        while ($this->data) {
            $value = array_pop($this->data);
            insertNode($value);

        }
    }

    public function insertNode($data) {
        $node = new NODE;
        $node->data = $data;
        return $node;
    }

    public function deleteNode() {

    }

}
