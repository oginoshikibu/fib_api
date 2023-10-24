<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumSeq extends Model
{
    use HasFactory;

    public static function fib($num): int
    {
        if ($num==1 || $num==2){
            return 1;
        } else {
            return NumSeq::fib($num-1) + NumSeq::fib($num-2);
        }

    }
}
