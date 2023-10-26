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
        $response = $this->get('/api/fib?n=1');

        $response->assertStatus(200);
        $response->assertJson(['result' => "1"]);
    }

    /** @test */
    public function ok_2ndIndex_returns1(): void
    {
        $response = $this->get('/api/fib?n=2');

        $response->assertStatus(200);
        $response->assertJson(['result' => "1"]);
    }

    /** @test */
    public function ok_3rdIndex_returns2(): void
    {
        $response = $this->get('/api/fib?n=3');

        $response->assertStatus(200);
        $response->assertJson(['result' => "2"]);
    }

    /** @test */
    public function badRequest_zeroIndex_returns400(): void
    {
        $response = $this->get('/api/fib?n=0');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_negativeIndex_returns400(): void
    {
        $response = $this->get('/api/fib?n=-1');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_stringsIndex_returns400(): void
    {
        $response = $this->get('/api/fib?n=abc');

        $response->assertStatus(400);
    }

    /** @test */
    public function badRequest_missingParam_returns400(): void
    {
        $response = $this->get('/api/fib');

        $response->assertStatus(400);
    }


    /** @test */
    public function badRequest_wrongParamName_returns400(): void
    {
        $response = $this->get('/api/fib?extra=1');

        $response->assertStatus(400);
    }


}
