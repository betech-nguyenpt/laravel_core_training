<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of HtmlHandler
 *
 * @author nguye
 */
class HtmlHandler {
    /**
     * Create random value of switch class
     * @return string Switch class
     */
    public static function randomSwitch() {
        $arrValue = [
            'switch-primary',
            'switch-secondary',
//            'switch-success',
            'switch-warning',
            'switch-info',
            'switch-danger',
        ];
        return CommonProcess::randArray($arrValue);
    }
}
