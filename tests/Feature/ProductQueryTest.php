<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->artisan('db:seed --class=CategorySeeder');

    Product::factory()->createMany([
        [
            'name' => 'Product 1',
            'price' => 100,
            'in_stock' => true,
            'rating' => 4.5,
            'created_at' => '2026-01-15 10:00:00'
        ],
        [
            'name' => 'Product 2',
            'price' => 50,
            'in_stock' => true,
            'rating' => 3.0,
            'created_at' => '2026-01-15 11:00:00'
        ],
        [
            'name' => 'Product 3',
            'price' => 150,
            'in_stock' => false,
            'rating' => 4.9,
            'created_at' => '2026-01-15 12:00:00'
        ],
        [
            'name' => 'Product 4',
            'price' => 200,
            'in_stock' => true,
            'rating' => 4.8,
            'created_at' => '2026-01-15 13:00:00'
        ],
        [
            'name' => 'Product 5',
            'price' => 20,
            'in_stock' => true,
            'rating' => 2.5,
            'created_at' => '2026-01-15 14:00:00'
        ],
        [
            'name' => 'Product 6',
            'price' => 300,
            'in_stock' => false,
            'rating' => 4.0,
            'created_at' => '2026-01-15 15:00:00'
        ],
        [
            'name' => 'Product 7',
            'price' => 75,
            'in_stock' => true,
            'rating' => 3.5,
            'created_at' => '2026-01-15 16:00:00'
        ],
        [
            'name' => 'Product 8',
            'price' => 120,
            'in_stock' => true,
            'rating' => 4.2,
            'created_at' => '2026-01-15 17:00:00'
        ],
        [
            'name' => 'Product 9',
            'price' => 10,
            'in_stock' => false,
            'rating' => 1.0,
            'created_at' => '2026-01-15 18:00:00'
        ],
        [
            'name' => 'Product 10',
            'price' => 500,
            'in_stock' => true,
            'rating' => 4.9,
            'created_at' => '2026-01-15 19:00:00'
        ],
    ]);
});

test('basic test', function () {
    $response = $this->get(route('products.index'));

    $response->assertStatus(200);
});

test('test filter by name', function () {
    $query_params = ['name' => '1'];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    $response->assertJsonCount(2, 'data');
    $response->assertJsonFragments([['name' => 'Product 1'], ['name' => 'Product 10']]);
});

test('test filter by price', function () {
    $query_params = ['price_from' => 100, 'price_to' => 200];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    $response->assertJsonCount(4, 'data');
});

test('test filter by stock availability', function () {
    $query_params = ['in_stock' => 1];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    $response->assertJsonCount(7, 'data');
});

test('test filter by rating', function () {
    $query_params = ['rating_from' => 4.5];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    $response->assertJsonCount(4, 'data');
});

test('test filter by all', function () {
    $query_params = [
        'name' => '1',
        'price_from' => 100,
        'price_to' => 200,
        'in_stock' => true,
        'rating_from' => 4.0
    ];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
    $response->assertJsonFragment(['name' => 'Product 1']);
});

test('test sort by price', function () {
    $query_params = ['sort' => 'price_desc'];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    expect($response['data'][0]['price'])->toBe(500);
});

test('test sort by rating', function () {
    $query_params = ['sort' => 'rating_desc'];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    expect($response['data'][0]['rating'])->toBe(4.9);
});

test('test sort by newest', function () {
    $query_params = ['sort' => 'newest'];
    $response = $this->getJson(route('products.index', $query_params));

    $response->assertStatus(200);
    expect($response['data'][0]['name'])->toBe('Product 10');
});
