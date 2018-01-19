<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 13:30
 */

namespace App\Analyzer;


abstract class BaseAnalyzer implements AnalyzerToolInterface
{
    /**
     * @var string|null
     */
    protected $output;

    /**
     * @var array
     */
    protected $lines = [];

    /**
     * @var bool
     */
    protected $isSuccess = false;

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
    abstract function getCommand(): array;

    /**
     * @return $this|mixed
     */
    public function formatOutput()
    {
        foreach (explode(PHP_EOL, $this->output) as $line) {
            $this->lines[] = $this->formatLine($line);
        }

        return $this;
    }

    /**
     * @param string $line
     * @return string
     */
    abstract protected function formatLine(string $line): string;

    /**
     * @param string $output
     * @return $this|mixed
     */
    public function setOutput(string $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Return all formated lines as array
     *
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Return if command is success or not
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}