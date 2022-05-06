<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEditProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品を編集()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create([
            'category_id' => 4,
            'maker' => '池屋',
            'name' => 'あめ',
            'price' => 100,
        ]);

        Product::factory()->create([
            'category_id' => 4,
            'maker' => 'おやつ王国',
            'name' => 'ポテトチップス',
            'price' => 30,
        ]);
        $data = [
            'category_id' => 1,
            'maker' => '池屋',
            'name' => 'チョコ',
            'price' => 150,
        ];

        $response = $this->patch('/products/'.$product->id,$data);

        $this->assertDatabaseHas('products',[
            'category_id' => 1,
            'maker' => '池屋',
            'name' => 'チョコ',
            'price' => 100,
        ]);
    }
}
