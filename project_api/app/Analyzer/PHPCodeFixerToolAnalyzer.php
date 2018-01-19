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
            '/root/.composer/vendor/bin/phpcs' => [
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
        if($line_without_tab == "No syntax error found"){
            $this->isSuccess = true;
        }
        if($line_without_tab == "Scanning project ..."){
            $line_without_tab = "";
        }
        return $line_without_tab;
    }

    public static function getName(): string
    {
        return 'PHPCodeFixer';
    }

    public static function getType(): string
    {
        return 'stats';
    }
}