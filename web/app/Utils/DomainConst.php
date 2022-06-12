<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of DomainConst
 *
 * @author nguye
 */
class DomainConst {
    //-----------------------------------------------------
    // Domain constants
    //-----------------------------------------------------
    /** String value "0" */
    const NUMBER_ZERO_VALUE                             = '0';
    /** String value "1" */
    const NUMBER_ONE_VALUE                              = '1';
    /** Constant of Status: Active */
    const DEFAULT_STATUS_ACTIVE                         = DomainConst::NUMBER_ONE_VALUE;
    /** Constant of Status: Inactive */
    const DEFAULT_STATUS_INACTIVE                       = DomainConst::NUMBER_ZERO_VALUE;
    /** Constant of Access status: Allow */
    const DEFAULT_ACCESS_ALLOW                          = DomainConst::NUMBER_ONE_VALUE;  
    /** Constant of Access status: Deny */
    const DEFAULT_ACCESS_DENY                           = DomainConst::NUMBER_ZERO_VALUE;
    /** Constant of Checkbox status: CHECKED */
    const CHECKBOX_STATUS_CHECKED                       = DomainConst::NUMBER_ONE_VALUE;
    /** Constant of Checkbox status: UNCHECKED */
    const CHECKBOX_STATUS_UNCHECKED                     = DomainConst::NUMBER_ZERO_VALUE;
    /** Default value of parent id: 0 */
    const DEFAULT_PARENT_VALUE                          = DomainConst::NUMBER_ZERO_VALUE;
    
    /** Constant of splitter */
    const SPLITTER_TYPE_1                               = ', ';
    const SPLITTER_TYPE_2                               = ',';
    const SPLITTER_TYPE_3                               = '-';
    const SPLITTER_TYPE_4                               = '.';
    const SPLITTER_TYPE_5                               = '_';
    const SPLITTER_TYPE_MONEY                           = self::SPLITTER_TYPE_2;
    /** Html space */
    const SPACE                                         = '&nbsp;';
    /** API Response status: Failed */
    const API_RESPONSE_STATUS_FAILED                    = 0;
    /** API Response status: Success */
    const API_RESPONSE_STATUS_SUCCESS                   = 1;
    /** API Response code: Bad request */
    const API_RESPONSE_CODE_BAD_REQUEST                 = 400;
    /** API Response code: Success */
    const API_RESPONSE_CODE_SUCCESS                     = 200;
    /** API Response code: Unauthorized */
    const API_RESPONSE_CODE_UNAUTHORIZED                = 401;
    
    /** Platform flag */
    const PLATFORM_IOS                                  = 0;
    const PLATFORM_ANDROID                              = 1;
    const PLATFORM_WINDOW                               = 2;
    const PLATFORM_WEB                                  = 3;
}
