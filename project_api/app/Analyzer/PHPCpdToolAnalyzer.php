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
            'composer' => [
                'global',
                'require',
                'sebastian/phpcpd',
            ],
            '/root/.composer/vendor/bin/phpcpd' => [
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
        $line_without_tab = str_replace("\r", '', $line);
        if(preg_match('/^Time:\s\d+(?:\.\d+)?\s\w+,\sMemory:\s\d+(?:\.\d+)?\w+$/', $line_without_tab)){
            $this->isSuccess = true;
        }
        return $line_without_tab;
    }

    public static function getName(): string
    {
        return 'PHPCPD';
    }

    public static function getType(): string
    {
        return 'stats';
    }
}