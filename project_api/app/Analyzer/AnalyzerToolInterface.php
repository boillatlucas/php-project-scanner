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
     *      'you-command' => [
     *          'arg1',
     *          'arg2',
     *      ]
     * ]
     *
     * @return array
     */
    function getCommand(): array;

    /**
     * @param string $output Set the plain output from command execution
     * @return mixed
     */
    function setOutput(string $output);

    /**
     * Return all formated lines as array
     *
     * @return array
     */
    function getLines(): array;

    /**
     * Return if command is success or not
     *
     * @return bool
     */
    function isSuccess(): bool ;
}