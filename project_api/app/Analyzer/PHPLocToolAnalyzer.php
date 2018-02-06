<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 19/01/18
 * Time: 11:32
 */

namespace App\Analyzer;

class PHPLocToolAnalyzer extends BaseAnalyzer
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
            '/root/.composer/vendor/bin/phploc' => [
                'project',
            ],
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
                if (preg_match('/Class Constants/', $line_without_tab)) {
                    $this->success = self::STATUS_STATS;
                    $this->final_output = "Statistics files of the project";
                } else {
                    $this->final_output = "Error during the execution of the tool : " . $this->getName();
                }
            }
        }
        return $line_without_tab;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'PHPLOC';
    }

    /**
     * @return string
     */
    public static function getType(): string
    {
        return 'STATS';
    }
}