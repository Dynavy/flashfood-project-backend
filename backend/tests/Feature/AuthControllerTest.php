<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    // Guardar el token del password que se genera al registrar.y
    protected $token;

    /** @test */
    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'testunit@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->postJson('/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ],
                'token'
            ]);
    }


    /** @test */
    public function test_user_cannot_register_with_invalid_data()
    {
        $response = $this->postJson('/register', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function test_user_can_login()
    {

        $response = $this->postJson('/login', [
            'email' => 'testunit@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user',
                'token'
            ]);
    }

    /** @test */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/login', [
            'email' => 'wrong@email.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function test_user_can_logout()
    {
        // Primero, realizar el login
        $loginResponse = $this->postJson('/login', [
            'email' => 'testunit@example.com',
            'password' => 'password123'
        ]);

        // Almacenar el token de la respuesta de login
        $this->token = Str::after($loginResponse->json('token'), '|');

        // Paso 3: Realizar la solicitud de cierre de sesión utilizando el token del login
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->postJson('/logout');

            //dd($this->token);

        // Paso 4: Verificar la respuesta
        $response->assertStatus(200)
            ->assertJson(['message' => 'User logged out successfully.']);
    }


    /** @test */
    public function test_unauthenticated_user_cannot_logout()
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }
}