<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * A webpage test.
     *
     * @return void
     */
    public function test_web_index()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * API get test.
     *
     * @return void
     */
    public function test_api_get()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * API post test.
     *
     * @return void
     */
    public function test_api_post()
    {
        $response = $this->post('api/load', ['title' => 'Кукуруза', "weight" => '10 t.', "from" => 'Kyiv', "to" => 'Moscow']);

        $response->assertStatus(201);
    }
}
