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
            'composer' => [
                'global',
                'require',
                'jakub-onderka/php-parallel-lint',
            ],
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
        $line_without_tab = str_replace("\r", '', $line);
        if($line_without_tab == "No syntax error found"){
            $this->isSuccess = true;
        }
        if(preg_match('/^[.]*+[[:space:]]*[\d]*+\/+[\d]*+[[:space:]]\([\d]*[[:space:]]%\)$/', $line_without_tab)){
            $line_without_tab = "";
        }
        return $line_without_tab;
    }

}