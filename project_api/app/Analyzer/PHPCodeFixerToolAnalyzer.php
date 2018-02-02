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

    private $prec_line = '';
    private $nb_depreciations_founded = 0;

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
        $line_without_tab = trim(str_replace("\r", '', $line));
        if($this->success == self::STATUS_ERROR) {
            if (preg_match('/^\s+/', $line_without_tab) || preg_match('/^\.+/', $line_without_tab) || $line_without_tab == ""){
                $line_without_tab = "";
            }else {
                if (preg_match('/PHP\s+\|\s+Type\s+\|\s+File:Line\s+\|\s+Issue/', $this->prec_line) && preg_match('/^Peak memory usage:/', $line_without_tab)) {
                    $this->success = self::STATUS_SUCCESS;
                    $this->final_output = "Aucune dépréciation n'a été trouvé dans le projet.";
                } else if (preg_match('/PHP\s+\|\s+Type\s+\|\s+File:Line\s+\|\s+Issue/', $this->prec_line) || ($this->nb_depreciations_founded > 0 && !preg_match('/^Peak memory usage:/', $line_without_tab))) {
                    $this->nb_depreciations_founded++;;
                } else if (preg_match('/^Peak memory usage:/', $line_without_tab)) {
                    $this->success = self::STATUS_WARNING;
                    if ($this->nb_depreciations_founded > 1) {
                        $this->final_output = $this->nb_depreciations_founded . " dépréciations ont été trouvées dans le projet.";
                    } else {
                        $this->final_output = $this->nb_depreciations_founded . " dépréciation a été trouvée dans le projet.";
                    }
                } else {
                    $this->final_output = "Erreur lors de l'exécution de l'outil " . $this->getName();
                }
            }
        }
        $this->prec_line = $line_without_tab;
        return $line_without_tab;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'PHPCodeFixer';
    }

    /**
     * @return string
     */
    public static function getType(): string
    {
        return 'WARNING';
    }
}