<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品を追加()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/products/store',[
            'category_id' => 1,
            'maker' => 'おやつ王国',
            'name' => 'チョコ',
            'price' => '100',
        ]);

        $this->assertDatabaseHas('products',[
            'category_id' => 1,
            'maker' => 'おやつ王国',
            'name' => 'チョコ',
            'price' => '100',
        ]);

        $response->assertRedirect('/home');
    }
}
