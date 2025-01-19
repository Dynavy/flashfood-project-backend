<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    // Execute the migrations to the testing database before each test.
    use RefreshDatabase;

    // This token will be used for the auth tests.
    protected $token;

    // TESTS IF REGISTER WORKS.
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

        // Sending a POST request to the registration endpoint with 'auth-test' prefix.
        $response = $this->postJson('/auth-test/register', $userData);

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

    // TESTS IF REGISTER DOESN'T WORK.
    #[Test]
    public function test_user_cannot_register_with_invalid_data()
    {
        // Sending a POST request with empty data to the registration endpoint.
        $response = $this->postJson('/auth-test/register', []);

        // Asserting the response status and validation errors.
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    // TEST IF LOGIN WORKS.
    #[Test]
    public function test_user_can_login()
    {

        // Sending a POST request to the login endpoint with 'auth-test' prefix.
        $response = $this->postJson('/auth-test/login', [
            'email' => 'admin@example.com',
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

    // TEST IF DOESN'T LOGIN WORK.
    #[Test]
    public function test_user_cannot_login_with_invalid_credentials()
    {

        // Sending a POST request with invalid credentials to the login endpoint.
        $response = $this->postJson('/auth-test/login', [
            'email' => 'wrong@email.com',
            'password' => 'wrongpassword'
        ]);

        // Attempting to extract the token (should not be present).
        $this->token = Str::after($response->json('token'), '|');

        // Asserting the response status for invalid login.
        $response->assertStatus(422);
    }

    // TEST IF LOGOUT WORKS.
    #[Test]
    public function test_user_can_logout()
    {
        // Create a test user.
        $user = User::factory()->create([
            'email' => 'admin1@example.com',
            'password' => 'password123'
        ]);

        // Generate a persistent token for the user.
        $userToken = $user->createToken('default')->plainTextToken;

        // Send logout request with the persistent token.
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $userToken,
            'Content-Type' => 'application/json'
        ])
            ->postJson('/auth-test/logout');

        // Verify the logout response.
        $response->assertStatus(200)
            ->assertJson(['message' => 'User logged out successfully.']);
    }

    // TEST IF AN UNAUTHENTHICATEED USER CAN'T LOGOUT.
    #[Test]
    public function test_unauthenticated_user_cannot_logout()
    {
        // Sending a logout request without authentication.
        $response = $this->postJson('/auth-test/logout');

        // Asserting the response status for unauthenticated logout.
        $response->assertStatus(401);
    }
}
