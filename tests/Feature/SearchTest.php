<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testJsonListPokemonOk()
    {
        $response = $this->json('GET','/pokemon');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([['name','url']])
        ;

    }
    public function testJsonSearchPokemonOk()
    {
        $response = $this->json('GET','/pokemon/nido');
        $response
            ->assertStatus(200)
            ->assertJsonCount(7)//
        ;

    }
}
