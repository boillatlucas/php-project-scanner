<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 10:10
 */

namespace App\Analyzer;
use Illuminate\Support\Facades\Log as Logger;

class Analyzer
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $name
     * @param string $repository
     * @param AnalyzerToolInterface[] $classes
     */
    public function run(string $name, string $repository, array $classes)
    {
        $path = '/tmp/'.$name;

        $this->execute([
            'git',
            'clone',
            '--depth=1',
            $repository,
            $path,
        ]);

        foreach ($classes as $class) {
            if (!$class instanceof AnalyzerToolInterface) {
                throw new \LogicException('Class "'.get_class($class).'" must implement "'.AnalyzerToolInterface::class.'"');
            }

            $args = [];
            $args[] = '/usr/local/bin/php';
            $args[] = implode(' ', $class->getCommand());
            $args[] = $path;
            $args[] = '2>&1';
            $output = (string) $this->execute($args);

            Logger::info('[Output] '.$output);
            $class->setOutput($output);
        }

        $this->execute(['rm', '-Rf', $path]);
    }

    /**
     * @param array $command
     * @return null|string
     */
    private function execute(array $command): ?string
    {
        Logger::info('[Execute command] '.implode(' ', $command));

        return shell_exec(implode(' ', $command));
    }
}