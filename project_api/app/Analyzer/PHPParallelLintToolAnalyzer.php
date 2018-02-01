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
        $line_without_tab = trim(str_replace("\r", '', $line));
        if($this->success == "ERROR") {
            if (preg_match('/^\s+/', $line_without_tab) || preg_match('/^\.+/', $line_without_tab) || $line_without_tab == "") {
                $line_without_tab = "";
            } else {
                if (preg_match("/^Syntax error found in (\d+) file$/", $line_without_tab, $matches)) {
                    $this->success = "ERROR";
                    $this->final_output = "Des erreurs de syntax ont été trouvés dans " . $matches[1] . " fichier(s).";
                } else if (preg_match("/^No syntax error found$/", $line_without_tab)) {
                    $this->success = "SUCCESS";
                    $this->final_output = "Aucunes erreurs de syntax ont été trouvées dans le projet.";
                } else {
                    $this->final_output = "Erreur lors de l'exécution de l'outil " . $this->getName();
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