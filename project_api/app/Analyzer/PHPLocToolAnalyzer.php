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
            'composer' => [
                'global',
                'require',
                'phploc/phploc',
            ],
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
        $line_without_tab = str_replace("\r", '', $line);
        if(preg_match('/Class Constants/', $line_without_tab)){
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