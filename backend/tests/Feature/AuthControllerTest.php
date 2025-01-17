<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class AuthControllerTest extends TestCase
{
    // Store the password token generated upon registration.
    protected $token;

    #[Test]
    public function test_user_can_register()
    {
        // User data for registration.
        $userData = [
            'name' => 'Test User',
            'email' => 'testunit@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        // Sending a POST request to the registration endpoint.
        $response = $this->postJson('/register', $userData);

        // Asserting the response status and structure.
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

    #[Test]
    public function test_user_cannot_register_with_invalid_data()
    {
        // Sending a POST request with empty data to the registration endpoint.
        $response = $this->postJson('/register', []);

        // Asserting the response status and validation errors.
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    #[Test]
    public function test_user_can_login()
    {
        
        // Sending a POST request to the login endpoint.
        $response = $this->postJson('/login', [
            'email' => 'testunit@example.com',
            'password' => 'password123'
        ]);

        // Asserting the response status and structure.
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user',
                'token'
            ]);

        // Extracting the token from the response.
        $this->token = Str::after($response->json('token'), '|');
    }

    #[Test]
    public function test_user_cannot_login_with_invalid_credentials()
    {

        // Sending a POST request with invalid credentials to the login endpoint.
        $response = $this->postJson('/login', [
            'email' => 'wrong@email.com',
            'password' => 'wrongpassword'
        ]);

        // Attempting to extract the token (should not be present).
        $this->token = Str::after($response->json('token'), '|');

        // Asserting the response status for invalid login.
        $response->assertStatus(422);
    }

    #[Test]
    public function test_user_can_logout()
    {
        // Login to store the token later on.
        $loginResponse = $this->postJson('/login', [
            'email' => 'testunit@example.com',
            'password' => 'password123'
        ]);

        // Store the token from the login response.
        $this->token = Str::after($loginResponse->json('token'), '|');

        // Prepare the email data for logout.
        $mail = [
            'email' => 'testunit@example.com'
        ];

        // Send a logout request using the login token.
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->postJson('/logout', $mail);

        // Verify the response.
        $response->assertStatus(200)
            ->assertJson(['message' => 'User logged out successfully.']);
    }

    #[Test]
    public function test_unauthenticated_user_cannot_logout()
    {
        // Sending a logout request without authentication.
        $response = $this->postJson('/logout');

        // Asserting the response status for unauthenticated logout.
        $response->assertStatus(401);
    }
}
