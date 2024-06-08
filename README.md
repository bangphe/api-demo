# Simple Laravel API with Job Queue, Database, and Event Handling

## Setup Instructions

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Copy `.env.example` to `.env` and configure your database settings.
4. Run `php artisan migrate` to set up the database.
5. Run `php artisan serve` to start the development server.

## Testing the API

1. Use a tool like Postman to send a POST request to `/submit` with the following JSON payload:
    ```json
    {
        "name": "John Doe",
        "email": "john.doe@example.com",
        "message": "This is a test message."
    }
    ```

2. Check the response to ensure it returns a success message.

3. Check your logs to see the event log indicating that the submission was saved.

## Unit Test

A simple unit test for the `/submit` endpoint:

```php
// tests/Feature/SubmissionTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function testSubmission()
    {
        $response = $this->postJson('/submit', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Submission received. It will be processed shortly.'
                 ]);
    }

    public function testSubmissionValidation()
    {
        $response = $this->postJson('/submit', [
            'name' => '',
            'email' => '',
            'message' => ''
        ]);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'error' => [
                         'name',
                         'email',
                         'message'
                     ]
                 ]);
    }
}
