<?php

class ChainLink
{
    private $left;
    private $right;

    const SIDE_NONE  = 0;
    const SIDE_LEFT  = 1;
    const SIDE_RIGHT = 2;

    public function append(ChainLink $link) : void
    {
        $this->right = $link;
        $link->left  = $this;
    }

    public function longerSide() : int
    {
        $count_right = 0;
        $count_left  = 0;
        $link= $this->left;
        while ($link) {
            $count_left=+1;
            if ($link->left===$this) break;
            $link=$link->left;
        }

        $link=$this->right;
        while ($link) {
            $count_right=+1;
            if ($link->right===$this) break;
            $link=$link->right;
        }
        if ($count_left>$count_right) return ChainLink::SIDE_LEFT;
        if ($count_left<$count_right) return ChainLink::SIDE_RIGHT;
        return ChainLink::SIDE_NONE;
    }

    private function builder(): ChainLink {
        return new ChainLink();
    }
}

$left   = new ChainLink();
$middle = new ChainLink();
$right  = new ChainLink();
$left->append($middle);
$middle->append($right);
var_dump($left->longerSide() == ChainLink::SIDE_RIGHT);

?>