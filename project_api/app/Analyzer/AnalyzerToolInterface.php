<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 10:11
 */

namespace App\Analyzer;


interface AnalyzerToolInterface
{
    /**
     * You need to follow this structure
     *
     * [
     *      'your-command' => [
     *          'arg1',
     *          'arg2',
     *      ]
     * ]
     *
     * @return array
     */

    public function getCommand(): array;

    /**
     * @param string $output Set the plain output from command execution
     * @return mixed
     */
    public function setOutput(string $output);

    /**
     * Return all formated lines as array
     *
     * @return array
     */
    public function getLines(): array;

    /**
     * Return if command is success or not
     *
     * @return bool
     */
    public function isSuccess(): bool;
}