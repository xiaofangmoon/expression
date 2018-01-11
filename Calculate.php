<?php

namespace Expression;
class Calculate
{

    const CAL_RULE = [

        '*' => 4,
        '/' => 4,
        '-' => 2,
        '+' => 1,
        '(' => 1,
    ];
    private $stack;

    public function __construct()
    {
        $this->stack = new StackObj();
    }


    // $exp = '9 + ( 3 - 1 ) * 3 + 10 / 2';
    public function exchangeCal($exp)
    {
        $exp_arr = explode(' ', $exp);
        $stack = new StackObj();

        $result = [];
        for ($i = 0; $i < count($exp_arr); $i++) {
            $element = $exp_arr[$i];
            if (is_numeric($element)) {
                $result [] = $element;
                continue;
            }
            if ($element == ")") {
                $p = $stack->pop();
                while ($p != "(" && $p != null) {
                    $result[] = $p;
                    $p = $stack->pop();
                }

            } elseif ($element == "(") {
                $stack->push($element);
            } else {

                $stack_sybol = $stack->getTopData();

                if (!empty($stack_sybol)) {
                    $n1 = self::CAL_RULE[$element];
                    $n2 = self::CAL_RULE[$stack_sybol];
                    while ($n1 <= $n2) {
                        $p = $stack->pop();
                        if ($element != "(") {
                            $result [] = $p;
                        }
                        $st = $stack->getTopData();
                        if ($st) {
                            $n2 = self::CAL_RULE[$st];
                        } else {
                            break;
                        }

                    }
                    $stack->push($element);
                } else {
                    $stack->push($element);
                }


            }

        }

        $st = $stack->getTopData();
        while ($st) {
            $result[] = $stack->pop();
            $st = $stack->getTopData();
        }

        return $result;
    }


    public function exchangeCal1($exp)
    {
        $exp_arr = explode(' ', $exp);
        $stack = new StackObj();

        $result = [];
        for ($i = 0; $i < count($exp_arr); $i++) {
            $element = $exp_arr[$i];

            // a) 是数字， 直接输出
            if (is_numeric($element)) {
                $result [] = $element;
                continue;
            }

            // b） 是运算符
            // i : “(” 直接入栈
            if ($element == "(") {
                $stack->push($element);
                continue;
            }


            // ii : “)” 将符号栈中的元素依次出栈并输出, 直到 “(“, “(“只出栈, 不输出
            if ($element == ")") {
                $st = $stack->pop();
                while ($st && $st != '(') {
                    $result[] = $st;
                    $st = $stack->pop();
                }
                continue;
            }

            // iii: 其他符号, 将符号栈中的元素依次出栈并输出, 直到 遇到比当前符号优先级更低的符号或者”(“。 将当前符号入栈。
            $n1 = self::CAL_RULE[$element];
            $st = $stack->getTopData();
            if (empty($st)) {
                $stack->push($element);
            } else {
                $n2 = self::CAL_RULE[$st];
                while ($n2 >= $n1) {
                    if ($st == '(') {
                        break;
                    } else {
                        $result[] = $stack->pop();
                        $n2 = empty($stack->getTopData()) ? 0 : self::CAL_RULE[$stack->getTopData()];

                    }
                }

                $stack->push($element);
            }

        }

        $st = $stack->getTopData();
        while ($st) {
            $result[] = $stack->pop();
            $st = $stack->getTopData();
        }

        return $result;
    }


    public function com($n1, $n2, $stack)
    {


    }

    public function excute($exp)
    {
        $exp_arr = explode(' ', $exp);
        $stack = new StackObj();


        $result = 0;
        for ($i = 0; $i < count($exp_arr); $i++) {
            $char = $exp_arr[$i];
            if (is_numeric($char)) {
                $stack->push((int)$char);
            } else {
                $p1 = $stack->pop();
                $p2 = $stack->pop();
                $result = $this->cal($p2, $p1, $char);
                if ($i != count($exp_arr) - 1) {
                    $stack->push($result);
                }

            }


        }

        return $result;
    }

    public function cal($p1, $p2, $cal)
    {
        $result = 0;
        switch ($cal) {
            case "+" :
                $result = $p1 + $p2;
                break;
            case "-" :
                $result = $p1 - $p2;
                break;
            case "*" :
                $result = $p1 * $p2;
                break;
            case "/" :
                $result = $p1 / $p2;
                break;
        }

        return $result;
    }

}