<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FibApiTest extends TestCase
{

    /** @test */
    public function ok_1stIndex_returns1(): void
    {
        $response = $this->get('/fib?n=1');

        $response->assertStatus(200);
        $response->assertJson(['result' => "1"]);
    }

    /** @test */
    public function ok_2ndIndex_returns1(): void
    {
        $response = $this->get('/fib?n=2');

        $response->assertStatus(200);
        $response->assertJson(['result' => "1"]);
    }

    /** @test */
    public function ok_3rdIndex_returns2(): void
    {
        $response = $this->get('/fib?n=3');

        $response->assertStatus(200);
        $response->assertJson(['result' => "2"]);
    }

    /** @test */
    public function ok_99thIndex_returnsNotOverFlow(): void
    {
        $response = $this->get('/fib?n=99');

        $response->assertStatus(200);
        $response->assertJson(['result' => "218922995834555169026"]);
    }

    /** @test */
    public function ok_1007thIndex_returns211Digits(): void
    {
        $response = $this->get('/fib?n=1007');

        $response->assertStatus(200);
        $response->assertJson(['result' => "1262027241743996257169366534803711153432873792011637768873717598849301425880152551659880282149947993889708136584785538962348100239436771893992147449837835103812540911951967569050060912009607003831549523998076513"]);
    }


    /** @test */
    public function badRequest_zeroIndex_returns400(): void
    {
        $response = $this->get('/fib?n=0');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_negativeIndex_returns400(): void
    {
        $response = $this->get('/fib?n=-1');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_stringsIndex_returns400(): void
    {
        $response = $this->get('/fib?n=abc');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_missingParam_returns400(): void
    {
        $response = $this->get('/fib');

        $response->assertStatus(400);
    }


    /** @test */
    public function badRequest_wrongParamName_returns400(): void
    {
        $response = $this->get('/fib?extra=1');

        $response->assertStatus(400);
    }
}
