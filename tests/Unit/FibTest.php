<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use RangeException;
use InvalidArgumentException;
use App\Models\NumSeq;

class FibTest extends TestCase
{
    /** @test */
    public function GiveOneReturnOne(): void
    {
        $this->assertSame(1, NumSeq::fib(1));
    }

    /** @test */
    public function GiveTwoReturnTwo(): void
    {
        $this->assertSame(1, NumSeq::fib(2));
    }

    /** @test */
    public function GiveThreeReturnTwo(): void
    {
        $this->assertSame(2, NumSeq::fib(3));
    }

    /** @test */
    public function GiveZeroReturnRangeException(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(0);
    }
    
    /** @test */
    public function GiveMinusOneReturnRangeException(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(-1);
    }

    /** @test */
    public function GiveMinusTenReturnRangeException(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(-10);
    }
    
    /** @test */
    public function GiveStringsReturnInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        NumSeq::fib("UnitTest");
    }
    
}
