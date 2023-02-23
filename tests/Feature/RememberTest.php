<?php

namespace Tests\Feature;


use Tests\TestCase;

use App\Models\Remember;

use App\Http\Controllers\RememberController;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\TestResponse;


use Illuminate\Validation\ValidationException;


class RememberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_list_of_all_remembers()
    {
        
    Remember::factory()->count(3)->create();

    
    $remembers = Remember::all();

    
    $response = $this->call('GET', '/api/remembers');
    $response->assertStatus(201);
    $response->assertJsonCount($remembers->count());
    }


    public function testStoreMethodCreatesNewRemember()
    {
        $requestData = [
            'title' => 'Test title',
            'description' => 'Test description',
        ];

        $request = Request::create('/remembers', 'POST', $requestData);

        $controller = new RememberController();

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());

        $this->assertDatabaseHas('remembers', $requestData);
    }


    public function test_store_fails_validation()
    {
        $requestData = [
            'description' => 'Test description',
        ];

        $request = new Request($requestData);

        $rememberMock = $this->createMock(Remember::class);

        $controller = new RememberController($rememberMock);

        $this->expectException(ValidationException::class);

        $controller->store($request);
    }

    public function testShow()
{
    
    $remember = Remember::factory()->create();

    
    $response = $this->get("/remembers/{$remember->id}");

    
    $response->assertStatus(200);

    
    $response->assertJsonFragment($remember->toArray());
}



}
