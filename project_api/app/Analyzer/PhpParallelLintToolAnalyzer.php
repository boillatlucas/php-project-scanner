<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 11:12
 */

namespace App\Analyzer;


class PhpParallelLintToolAnalyzer implements AnalyzerToolInterface
{
    /**
     * @var string|null
     */
    private $output;

    /**
     * @var array|null
     */
    private $lines;

    /**
     * You need to follow this structure
     *
     * [
     *      'you-command' => [
     *          'arg1',
     *          'arg2',
     *      ]
     * ]
     *
     * @return array
     */
    function getCommand(): array
    {
        return [
            '/var/www/vendor/bin/parallel-lint' => [
                '/var/www'
            ]
        ];
    }

    /**
     * @param string $output Set the plain output from command execution
     * @return mixed
     */
    function setOutput(string $output)
    {
        $this->output = $output;
    }

    /**
     * Return all formated lines as array
     *
     * @return array
     */
    function getLines(): array
    {
        if ($this->lines === null) {
            $this->formatLines();
        }
        return $this->lines;
    }

    public function formatLines()
    {
        $this->lines = explode(PHP_EOL, $this->output);
    }

    /**
     * Return if command is success or not
     *
     * @return bool
     */
    function isSuccess(): bool
    {
        $lines = $this->getLines();
        foreach ($lines as $line){
            return $line == "No syntax error found";
        }
    }
}