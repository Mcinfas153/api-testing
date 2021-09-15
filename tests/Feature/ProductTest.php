<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    function setUp():void 
    {

        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

    }

    public function test_can_list_products()
    {

        $products = Product::factory()->count(3)->make();

        $this->get(route('products.index'))
           //->assertJson($products)
            ->assertStatus(200);
    }

    public function test_can_create_product()
    {

        $product = [
            'name' => 'Test product',
            'description' => 'Test product description',
            'price' => 1200,
            'qty' => 12
        ];

        $this->post(route('product.store'), $product)
            ->assertStatus(201)
        ;
    }

    public function test_can_show_product()
    {
        $product = Product::factory()->make();

        $this->get(route('product.show', $product->id))->assertStatus(200);
    }

    public function test_can_update_product()
    {
        $product = Product::factory()->make();

        $this->put(route('product.update', $product->id))->assertStatus(200);
    }

    public function test_can_delete_product()
    {
        $product = Product::factory()->make();

        $this->delete(route('product.delete', $product->id))->assertStatus(200);
    }
}
