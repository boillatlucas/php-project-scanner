<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 19/01/18
 * Time: 14:33
 */

namespace App\Analyzer;

class PHPCpdToolAnalyzer extends BaseAnalyzer
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
    function getCommand(): array
    {
        return [
            '/root/.composer/vendor/bin/phpcpd',
        ];
    }

    /**
     * @param string $line
     * @return string
     */
    protected function formatLine(string $line): string
    {
        $line_without_tab = trim(str_replace("\r", '', $line));
        if($this->success == self::STATUS_ERROR){
            if (preg_match('/^\s+/', $line_without_tab) || preg_match('/^\.+/', $line_without_tab) || $line_without_tab == ""){
                $line_without_tab = "";
            }else {
                if (preg_match('/^(\d+.\d+%)\s+duplicated lines out of (\d+)\s+total lines of code./', $line_without_tab, $matches)) {
                    if ($matches[1] == '0.00%') {
                        $this->success = self::STATUS_SUCCESS;
                        $this->final_output = "No duplicated lines were found in the project.";
                    } else {
                        $this->success = self::STATUS_WARNING;
                        $this->final_output = $matches[1] . " duplicated lines founded, out of " . $matches[2] . " lines of project code.";
                    }
                } else {
                    $this->final_output = "Error during the execution of the tool : " . $this->getName();
                }
            }
        }
        return $line_without_tab;
    }

    public static function getName(): string
    {
        return 'PHPCPD';
    }

    public static function getType(): string
    {
        return 'WARNING';
    }
}