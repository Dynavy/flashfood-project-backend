<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseEnvironmentTest extends TestCase
{
    // Execute the migrations to the testing database before each test.
    use RefreshDatabase;

    #[Test]
    public function test_using_test_database()
    {
        // Get the current environment
        $environment = app()->environment();

        // Check if we're in testing environment
        $this->assertEquals('testing', $environment, 'Application is not in testing environment');

        // Check the configured database connection
        $configuredConnection = config('database.default');
        $this->assertEquals('sqlite', $configuredConnection, 'Database connection is not configured as sqlite');

        // Check if the connection exists in the configuration
        $connectionConfig = config("database.connections.{$configuredConnection}");
        $this->assertNotNull($connectionConfig, 'Database connection configuration not found');

        // Verify the actual database connection being used
        $actualConnection = DB::connection()->getName();
        $this->assertEquals('sqlite', $actualConnection, 'Application is not using sqlite connection');

        // Get the database path
        $databasePath = DB::connection()->getDatabaseName();

        // Check if we're using an in-memory database
        $this->assertEquals(':memory:', $databasePath, 'Application is not using an in-memory database for testing');
    }

    #[Test]
    public function test_database_has_required_tables()
    {
        $tables = DB::select('SELECT name FROM sqlite_master WHERE type="table"');
        $tableNames = array_map(function ($table) {
            return $table->name;
        }, $tables);

        // Check if all required tables exist
        $this->assertContains('categories', $tableNames);
        $this->assertContains('favorites', $tableNames);
        $this->assertContains('offers', $tableNames);
        $this->assertContains('restaurants', $tableNames);
        $this->assertContains('reviews', $tableNames);
        $this->assertContains('users', $tableNames);
        $this->assertContains('personal_access_tokens', $tableNames);
        $this->assertContains('password_reset_tokens', $tableNames);
    }

    private function assertTableHasColumns(string $table, array $expectedColumns)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        foreach ($expectedColumns as $column) {
            $this->assertContains($column, $columns, "Column {$column} missing in {$table} table");
        }
    }

    #[Test]
    public function test_tables_structure()
    {
        $this->assertTableHasColumns('categories', ['id', 'name', 'created_at', 'updated_at']);
        $this->assertTableHasColumns('favorites', ['id', 'created_at', 'updated_at', 'user_id', 'restaurant_id']);
        $this->assertTableHasColumns('offers', ['id', 'name', 'description', 'popularity', 'status', 'valid_from', 'valid_until', 'created_at']);
        $this->assertTableHasColumns('reviews', ['id', 'restaurant_id', 'user_id', 'comment', 'likes', 'created_at']);
        $this->assertTableHasColumns('users', ['id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at']);
        $this->assertTableHasColumns('restaurants', ['id', 'name', 'address', 'latitude', 'longitude', 'google_place_id', 'phone', 'website', 'rating', 'created_at']);
        $this->assertTableHasColumns('personal_access_tokens', ['id', 'tokenable_type', 'tokenable_id', 'name', 'token', 'abilities', 'last_used_at', 'expires_at', 'created_at', 'updated_at']); // New columns validation
        $this->assertTableHasColumns('password_reset_tokens', ['email', 'token', 'created_at']);
    }

    #[Test]
    public function test_table_is_not_empty()
    {
        $this->assertGreaterThan(0, DB::table('categories')->count(), 'Categories table is empty');
        $this->assertGreaterThan(0, DB::table('favorites')->count(), 'Favorites table is empty');
        $this->assertGreaterThan(0, DB::table('offers')->count(), 'Offers table is empty');
        $this->assertGreaterThan(0, DB::table('restaurants')->count(), 'Restaurants table is empty');
        $this->assertGreaterThan(0, DB::table('reviews')->count(), 'Reviews table is empty');
        $this->assertGreaterThan(0, DB::table('users')->count(), 'Users table is empty');
    }
}
