<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use RangeException;
use InvalidArgumentException;

class NumSeq extends Model
{
    use HasFactory;

    public static function fib($index): string
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException("Not an integer");
        }
        if ($index < 1) {
            throw new RangeException("Not a positive integer");
        }
        if ($index === 1 || $index === 2) {
            return "1";
        } else {
            // overflow対策で、stringで計算する
            $a_1    = ["1"];
            $a_tmp  = ["1"];
            $tmp_id = 2;
            $MAX_DIGIT_LENGTH = strlen((string)PHP_INT_MAX)-2; // 桁数制限
            $MAX_DIGIT_ORDER  = 10**$MAX_DIGIT_LENGTH;
            
            // 3からindexまで計算
            while ($tmp_id !== $index) {
                $a_nxt = [];
                $add = 0;
                for ($i = 0; $i < count($a_tmp); $i++) {
                    $tmp = (int) $a_1[$i] + (int) $a_tmp[$i] + $add;
                    
                    if (strlen($tmp) >= $MAX_DIGIT_LENGTH) {
                        $a_nxt[] = (string)($tmp % $MAX_DIGIT_ORDER);
                        $add     = intdiv($tmp, $MAX_DIGIT_ORDER); // 繰り上がり
                    } else {
                        $a_nxt[] = (string)$tmp;
                        $add     = 0;
                    }
                }
                if ($add !== 0) {   // 最後の繰り上がり
                    $a_nxt[] = (string)$add;
                    $a_tmp[] = "0";
                }
                assert(count($a_1) === count($a_tmp));
                $a_1   = $a_tmp;
                $a_tmp = $a_nxt;
                $tmp_id++;
            }
            // 0埋め
            for ($i = 0; $i < count($a_tmp)-1; $i++) {
                $a_tmp[$i] = str_pad($a_tmp[$i], $MAX_DIGIT_LENGTH, "0", STR_PAD_LEFT);
            }
            return implode("", array_reverse($a_tmp));
        }
    }
}
