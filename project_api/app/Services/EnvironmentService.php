<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 12:22
 */

namespace App\Services;

use GuzzleHttp\Psr7\Request;
use Http\Client\Socket\Client as Client;

class EnvironmentService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * EnvironmentService constructor.
     */
    public function __construct()
    {
        $this->client = new Client(null, [
            'remote_socket' => 'unix:///run/docker.sock',
            'ssl' => false,
        ]);
    }

    public function create(string $name)
    {
//        $a = $this->client->sendRequest(new Request('GET', 'http:/version',[
//            'Content-Type' => 'application/json',
//            'Host' => '0.0.0.0',
//        ]))->getBody()->getContents();



        $post = '{"Image": "alpine", "Cmd": ["echo", "hello world"]}';
        $a = $this->client->sendRequest(new Request('POST', 'http:/v1.24/containers/create?name=test',
            [
                'Content-Type' => 'application/json',
                'Host' => '0.0.0.0',
                'body' => ['Image' => 'alpine'],
            ]
        ))->getBody()->getContents();

        dump($a);die;
    }
}
