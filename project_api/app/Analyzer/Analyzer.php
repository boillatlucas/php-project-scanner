<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 10:10
 */

namespace App\Analyzer;


use App\Services\EnvironmentService;

class Analyzer
{
    /**
     * @var EnvironmentService
     */
    private $environment;

    /**
     * @var array|null
     */
    private $context;

    /**
     * Analyzer constructor.
     */
    public function __construct()
    {
        $this->environment = new EnvironmentService();
    }

    /**
     * @param string $name
     * @param string $repository
     * @param AnalyzerToolInterface[] $classes
     */
    public function run(string $name, string $repository, array $classes)
    {
        if ($this->context === null) {
            $this->createContext($name, $repository);
        }

        foreach ($classes as $class) {
            if (!$class instanceof AnalyzerToolInterface) {
                throw new \LogicException('Class "'.get_class($class).'" must implement "'.AnalyzerToolInterface::class.'"');
            }

            foreach ($class->getCommand() as $bin => $args) {
                array_unshift($args, $bin);

                $class->setOutput($this->executeCommand($args));
            }
        }

        $this->rmContainer();
    }

    /**
     * @param string $name
     * @param string $repository
     */
    private function createContext(string $name, string $repository)
    {
        $json = \GuzzleHttp\json_decode($this->environment->createContainer($name, 'abdev/php-sec_php-analyzer'));

        $this->context['containerId'] = $json->Id;

        $this->environment->startContainer($this->context['containerId']);
        $this->executeCommand([
            'git',
            'clone',
            '--depth=1',
            $repository,
            'project',
        ]);
    }

    /**
     * @param array $command
     * @return null|string
     */
    private function executeCommand(array $command): ?string
    {
        $cmd = \GuzzleHttp\json_decode($this->environment->createCommand($this->context['containerId'], $command));

        return $this->environment->startCommand($cmd->Id);
    }

    private function rmContainer(): ?string
    {
        $this->environment->stopContainer($this->context['containerId']);

        return $this->environment->rmContainer($this->context['containerId']);
    }
}