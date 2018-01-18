<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 18/01/18
 * Time: 11:51
 */

namespace App\Analyzer;


class PHPCodeFixerToolAnalyzer extends BaseAnalyzer
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
            'composer' => [
                'global',
                'require',
                'wapmorgan/php-code-fixer',
            ],
            '/root/.composer/vendor/bin/phpcf' => [
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
        return $line;
    }
}