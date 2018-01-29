<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 12:22
 */

namespace App\Services;

use Http\Client\Socket\Client as Client;
use Illuminate\Support\Facades\Log;

class EnvironmentService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var bool
     */
    private $isDebug;

    /**
     * @var array
     */
    private $debug = [];

    /**
     * EnvironmentService constructor.
     */
    public function __construct(bool $isDebug = false)
    {
        $this->client = new Client(null, [
            'remote_socket' => 'unix:///run/docker.sock',
            'ssl' => false,
        ]);

        $this->isDebug = $isDebug;
    }

    /**
     * @param string $name
     * @param string $image
     * @param array $parameters
     * @return null|string
     */
    public function createContainer(string $name, string $image, array $parameters = []): ?string
    {
        $endpoint = 'containers/create?name='.$name;
        $parameters['Image'] = $image;

        return $this->execute('POST', $endpoint, $parameters);
    }

    /**
     * @param string $id
     * @return null|string
     */
    public function startContainer(string $id)
    {
        return $this->execute('POST', 'containers/'.$id.'/start');
    }

    /**
     * @param string $id
     * @param array $command
     * @return null|string
     */
    public function createCommand(string $id, array $command): ?string
    {
        $parameters = [
            'Cmd' => $command,
            'AttachStdout' => true,
            'Tty' => true,
        ];

        return $this->execute('POST', 'containers/'.$id.'/exec', $parameters);
    }

    /**
     * @param string $id
     * @return null|string
     */
    public function startCommand(string $id): ?string
    {
        return $this->execute('POST', 'exec/'.$id.'/start', ['Detach' => false, 'Tty' => true]);
    }

    /**
     * Stop a container, kill after $timeout
     * @param string $id
     * @param int $timeout (seconds)
     * @param bool $waitUntilStop
     * @return null|string
     */
    public function stopContainer(string $id, int $timeout = 8, bool $waitUntilStop = true): ?string
    {
        $shell = $this->execute('POST', '/containers/'.$id.'/stop?t='.$timeout);

        if ($waitUntilStop) {
            $this->execute('POST', '/containers/'.$id.'/wait');
        }

        return $shell;
    }


    public function rmContainer(string $id): ?string
    {
        return $this->execute('DELETE', '/containers/'.$id.'?force=true');
    }

    /**
     * @param string $id
     * @return null|string
     */
    public function inspectCommand(string $id)
    {
        return $this->execute('GET', 'exec/'.$id.'/json');

    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $parameters
     * @return string
     */
    private function execute(string $method, string $endpoint, array $parameters = []): ?string
    {
        $exec = 'curl --unix-socket /run/docker.sock -H "Content-Type: application/json"';

        if (!empty($parameters)) {
            $exec .= ' -d \''.\GuzzleHttp\json_encode($parameters).'\'';
        }

        $exec .= ' -X '.strtoupper($method).' http:/'.ltrim($endpoint, '/');
        $shell = shell_exec($exec);

        Log::info('['.self::class.'::execute]', ['command' => $exec, 'output' => $shell]);

        if ($this->isDebug) {
            $this->debug['command'][] = $exec;
            $this->debug['logs'][] = $shell;
        }

        return $shell;
    }

    public function getDebug(): array
    {
        return $this->debug;
    }
}
