<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use RangeException;
use InvalidArgumentException;

class NumSeq extends Model
{
    use HasFactory;

    public static function fib($index): int
    {
        if (!is_int($index)){
            throw new InvalidArgumentException("Not an integer");
        }
        if ($index < 1){
            throw new RangeException("Not a positive integer");
        }
        if ($index === 1 || $index === 2){
            return 1;
        } else {
            $a_1    = 1;
            $a_tmp  = 1;
            $tmp_id = 2;
            while ($tmp_id !== $index){
                $a_tmp  = $a_1 + $a_tmp;
                $a_1    = $a_tmp - $a_1;
                $tmp_id++;
            }
            return $a_tmp;
        }
    }
}
