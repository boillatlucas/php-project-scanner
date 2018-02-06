<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 11:12
 */

namespace App\Analyzer;

class PHPParallelLintToolAnalyzer extends BaseAnalyzer
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
    public function getCommand(): array
    {
        return [
            '/root/.composer/vendor/bin/parallel-lint' => [
                'project'
            ]
        ];
    }

    /**
     * @param string $line
     * @return string
     */
    protected function formatLine(string $line): string
    {
        $line_without_tab = trim(str_replace("\r", '', $line));
        if($this->success == self::STATUS_ERROR) {
            if (preg_match('/^\s+/', $line_without_tab) || preg_match('/^\.+/', $line_without_tab) || $line_without_tab == "") {
                $line_without_tab = "";
            } else {
                if (preg_match("/^Syntax error found in (\d+) file$/", $line_without_tab, $matches)) {
                    $this->success = self::STATUS_ERROR;
                    $this->final_output = "Syntax errors founded in " . $matches[1] . " file(s).";
                } else if (preg_match("/^No syntax error found$/", $line_without_tab)) {
                    $this->success = self::STATUS_SUCCESS;
                    $this->final_output = "No syntax errors were found in the project.";
                } else {
                    $this->final_output = "Error during the execution of the tool : " . $this->getName();
                }
            }
        }
        return $line_without_tab;
    }

    public static function getName(): string
    {
        return 'PHP Parallel Lint';
    }

    public static function getType(): string
    {
        return 'ERROR';
    }

}