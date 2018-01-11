<?php

namespace Expression;

class StackObj
{

    const MAX_SIZE = 100;
    private $data = [];
    private $top = -1;

    public function __construct()
    {
    }


    public function push($data)
    {

        if ($this->top + 1 == self::MAX_SIZE) {
            return '栈已经满了';
        }
        $this->top++;
        $this->data[$this->top] = $data;

        return 'Ok';

    }

    public function pop()
    {
        if ($this->top == -1) {
            return null;
        }
        $p = $this->data[$this->top];
        unset($this->data[$this->top]);
        $this->top--;
        return $p;
    }

    public function getStack()
    {
        return $this->data;
    }

    public function getTop()
    {
        return $this->top;
    }

    public function getTopData()
    {
        return $this->data[$this->top];
    }

    public function __toString()
    {
        return '';
    }
}