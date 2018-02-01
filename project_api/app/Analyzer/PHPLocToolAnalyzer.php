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
        $line_without_tab = trim(str_replace("\r", '', $line));
        if($this->success == "ERROR") {
            if (preg_match('/^\s+/', $line_without_tab) || preg_match('/^\.+/', $line_without_tab) || $line_without_tab == "") {
                $line_without_tab = "";
            } else {
                if (preg_match('/Class Constants/', $line_without_tab)) {
                    $this->success = "STATS";
                    $this->final_output = "Statistiques sur les fichiers de votre projet";
                } else {
                    $this->final_output = "Erreur lors de l'exécution de l'outil " . $this->getName();
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