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
            // overflow対策: stringの配列A_nで計算する
            $A_prev    = ["1"];
            $tmp_id    = 2;
            $A_tmp     = ["1"];
            $MAX_DIGIT_LENGTH = strlen((string)PHP_INT_MAX) - 2; // 桁数制限
            $MAX_DIGIT_ORDER  = 10 ** $MAX_DIGIT_LENGTH;

            // 3からindexまで計算
            while ($tmp_id !== $index) {
                $A_nxt = [];    // 次の配列
                $add   = 0;   // 繰り上がり
                for ($i = 0; $i < count($A_tmp); $i++) {
                    $tmp = (int) $A_prev[$i] + (int) $A_tmp[$i] + $add;
                    if (strlen($tmp) >= $MAX_DIGIT_LENGTH) {
                        $A_nxt[] = (string)($tmp % $MAX_DIGIT_ORDER);
                        $add     = intdiv($tmp, $MAX_DIGIT_ORDER);
                    } else {
                        $A_nxt[] = (string)$tmp;
                        $add     = 0;
                    }
                }
                if ($add !== 0) {   // 最後の繰り上がり
                    $A_nxt[] = (string)$add;
                    $A_tmp[] = "0";
                }
                assert(count($A_prev) === count($A_tmp));
                $A_prev = $A_tmp;
                $A_tmp  = $A_nxt;
                $tmp_id++;
            }
            // 0埋め
            for ($i = 0; $i < count($A_tmp) - 1; $i++) {
                $A_tmp[$i] = str_pad($A_tmp[$i], $MAX_DIGIT_LENGTH, "0", STR_PAD_LEFT);
            }
            return implode("", array_reverse($A_tmp));
        }
    }
}
