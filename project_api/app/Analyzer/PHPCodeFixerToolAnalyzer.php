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
                    $this->final_output = "No depreciation was found in the project.";
                } else if (preg_match('/PHP\s+\|\s+Type\s+\|\s+File:Line\s+\|\s+Issue/', $this->prec_line) || ($this->nb_depreciations_founded > 0 && !preg_match('/^Peak memory usage:/', $line_without_tab))) {
                    $this->nb_depreciations_founded++;;
                } else if (preg_match('/^Peak memory usage:/', $line_without_tab)) {
                    $this->success = self::STATUS_WARNING;
                    if ($this->nb_depreciations_founded > 1) {
                        $this->final_output = $this->nb_depreciations_founded . " depreciations founded in the project.";
                    } else {
                        $this->final_output = $this->nb_depreciations_founded . " depreciation founded in the project.";
                    }
                } else {
                    $this->final_output = "Error during the execution of the tool : " . $this->getName();
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