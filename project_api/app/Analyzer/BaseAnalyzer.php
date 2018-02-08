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

    const STATUS_SUCCESS = "SUCCESS";
    const STATUS_ERROR = "ERROR";
    const STATUS_WARNING = "WARNING";
    const STATUS_STATS = "STATS";

    /**
     * @var string|null
     */
    protected $output;

    /**
     * @var array
     */
    protected $lines = [];

    /**
     * @var string
     */
    protected $success = "ERROR";

    /**
     * @var string
     */
    protected $final_output = "";

    /**
     * @var string
     */
    protected $path_container = "";

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
            if($this->formatLine($line) != ""){
                $this->lines[] = $this->formatLine($line);
            }
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
     * @return string
     */
    public function success(): string
    {
        return $this->success;
    }

    /**
     * Return final output of the log
     *
     * @return string
     */
    public function finalOutput(): string
    {
        return $this->final_output;
    }

    /**
     * @param string $path_container
     * @return $this|mixed
     */
    public function setPathContainer(string $path_container)
    {
        $this->path_container = $path_container;
        return $this;
    }
}