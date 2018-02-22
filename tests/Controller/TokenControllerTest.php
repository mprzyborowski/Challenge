<?php
/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 2/17/18
 * Time: 3:28 PM
 */

namespace Tests\Controller;

use Tests\ApiTestCase;

class TokenControllerTest extends ApiTestCase
{

    public function testPOSTCreateToken()
    {
        $this->createUser('mprzyborowski', 'mprzyborowski');

        $response = $this->client->post('/api/tokens', [
            'auth' => ['mprzyborowski', 'mprzyborowski']
        ]);


        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyExists(
            $response,
            'token'
        );
    }

}