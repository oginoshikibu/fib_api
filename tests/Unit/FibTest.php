<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use RangeException;
use InvalidArgumentException;
use App\Models\NumSeq;

class FibTest extends TestCase
{
    /** @test */
    public function ok_1stIndex_return1(): void
    {
        $this->assertSame("1", NumSeq::fib(1));
    }

    /** @test */
    public function ok_2ndIndex_return1(): void
    {
        $this->assertSame("1", NumSeq::fib(2));
    }

    /** @test */
    public function ok_3rdIndex_return2(): void
    {
        $this->assertSame("2", NumSeq::fib(3));
    }

    /** @test */
    public function ok_largeIndex_returnNotOverFlow(): void
    {
        $this->assertSame("218922995834555169026", NumSeq::fib(99));
    }

    /** @test */
    public function ng_zeroIndex_returnRangeException(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(0);
    }
    
    /** @test */
    public function ng_minus1Index_returnRangeException(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(-1);
    }
  
    /** @test */
    public function ng_stringIndex_returnInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        NumSeq::fib("UnitTest");
    }
    
}
