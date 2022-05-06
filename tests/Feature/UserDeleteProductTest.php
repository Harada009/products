<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserDeleteProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_商品を削除()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();

        $response = $this->delete('/products/'.$product->id);

        $this->assertDatabaseMissing('products',[
            'id' => $product->id,
        ]);

        $response->assertRedirect('/home');
    }
}
