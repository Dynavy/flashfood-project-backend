<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set up the application.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Seed the database with necessary data.
        $this->artisan('db:seed');

        // Load the test routes on a test environment. 
        if ($this->app->environment('testing')) {
            include base_path('routes/auth-test-routes.php');
            require base_path('routes/error-test-routes.php');
        }
    }
}
