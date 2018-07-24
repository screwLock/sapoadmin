<?php

/**
 * The file that defines the user registration ajax functionality.
 *
 * A class definition that includes ajax functionality
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * All Ajax code for the user registration page should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class UserRegistrationAjax {

    public function is_a_bot(){
    
        $honeypot = FALSE;
        if (!empty($_REQUEST['website']) && (bool) $_REQUEST['website'] == TRUE) {
            $honeypot = TRUE;
            log_spambot($_REQUEST);
            # treat as spambot
        } else {
            # process as normal
        }
    }
}
?>