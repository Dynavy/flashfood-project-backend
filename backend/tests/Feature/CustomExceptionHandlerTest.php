<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomExceptionHandlerTest extends TestCase
{
    // Execute the migrations to the testing database before each test.
    use RefreshDatabase;

    #[Test]
    public function it_returns_custom_message_for_authentication_exception()
    {
        $response = $this->get('/handler-testing/401');

        $response->assertStatus(401);
        $response->assertJson([
            'status' => 'error',
            'code' => 401,
            'message' => 'Unauthorized.',
            'error' => [
                'type' => 'AuthenticationException',
                'details' => 'The provided username or password is incorrect.',
            ],
        ]);
    }

    #[Test]
    public function it_returns_custom_message_for_authorization_exception()
    {
        $response = $this->get('/handler-testing/403');

        $response->assertStatus(403);
        $response->assertJson([
            'status' => 'error',
            'code' => 403,
            'message' => 'Forbidden.',
            'error' => [
                'type' => 'AuthorizationException',
                'details' => 'You do not have permission to access this resource.',
            ],
        ]);
    }

    #[Test]
    public function it_returns_custom_message_for_model_not_found_exception()
    {
        $response = $this->get('/handler-testing/404');

        $response->assertStatus(404);
        $response->assertJson([
            'status' => 'error',
            'code' => 404,
            'message' => 'Resource not found.',
            'error' => [
                'type' => 'ModelNotFoundException',
                'details' => 'The resource you requested could not be found in the database.',
            ],
        ]);
    }

    #[Test]
    public function it_returns_custom_message_for_too_many_requests_exception()
    {
        $response = $this->get('/handler-testing/429');

        $response->assertStatus(429);
        $response->assertJson([
            'status' => 'error',
            'code' => 429,
            'message' => 'Too many requests.',
            'error' => [
                'type' => 'TooManyRequestsHttpException',
                'details' => 'You have exceeded the rate limit. Please try again later.',
            ],
        ]);
    }

    #[Test]
    public function it_returns_custom_message_for_query_exception()
    {
        $response = $this->get('/handler-testing/database-error');

        $response->assertStatus(500);
        $response->assertJson([
            'status' => 'error',
            'code' => 500,
            'message' => 'Database query error.',
            'error' => [
                'type' => 'QueryException',
                'details' => 'An issue occurred with the database query. Please try again later.',
            ],
        ]);
    }
}
