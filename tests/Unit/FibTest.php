<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Models\NumSeq;

class FibTest extends TestCase
{
    /** @test */
    public function GiveOne(): void
    {
        $this->assertSame(1, NumSeq::fib(1));
    }

    public function GiveTwo(): void
    {
        $this->assertSame(1, NumSeq::fib(2));
    }
    public function GiveThree(): void
    {
        $this->assertSame(2, NumSeq::fib(3));
    }

    public function Givezero(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(0);
    }
    
    public function GiveMinusOne(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(-1);
    }

    public function GiveMinusTen(): void
    {
        $this->expectException(RangeException::class);
        NumSeq::fib(-10);
    }
    
    public function GiveStrings(): void
    {
        $this->expectException(InvalidArgumentException::class);
        NumSeq::fib("UnitTest");
    }
    
}
