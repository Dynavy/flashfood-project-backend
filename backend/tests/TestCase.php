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

        // Load the test routes on a test environment. 
        if ($this->app->environment('testing')) {
            require base_path('routes/error-auth.php');
            require base_path('routes/error-test-routes.php');
        }
    }
}
