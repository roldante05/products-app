<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class CrudTest extends TestCase
{
    public function testStoreProduct()
    {
        $response = $this->post('/products/store', [
            'title' => 'Test Product',
            'price' => 100
        ]);
    
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Producto creado con éxito']);
    }
    
    public function testUpdateProduct()
    {
        $response = $this->post('/products/update/1', [
            'title' => 'Updated Product',
            'price' => 150
        ]);
    
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Producto actualizado con éxito']);
    }
    
    public function testDestroyProduct()
    {
        $response = $this->post('/products/destroy/1');
    
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Producto eliminado con éxito']);
    }
    
} 