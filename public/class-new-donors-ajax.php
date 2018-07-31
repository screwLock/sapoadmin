<?php

/**
 * The file that defines the ajax functionality for creating new donors.
 *
 * A class definition for registering new donors
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * All Donor Registration code for the sapo site should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
require_once( '/path/to/wp-includes/class-phpass.php' );

class NewDonorsAjax
{

    /**
     * Handles registration of a new donor
     *
     *
     **/
    public function register_donor()
    {
        global $wpdb;
        $donors_table = $wpdb->prefix . "sapo_donors";
        $new_donor = $_POST['new_donor'];
        $email = $new_donor['email'];
        $orgID = $new_donor['orgID'];
        // Email address is used as both username and email. It is also the only
        // parameter we need to validate/*
        $count = $wpdb->get_var( $wpdb->prepare(
            "
            SELECT COUNT(*) FROM $donors_table
            WHERE email IN (%s)
            AND organization_id = %d
            ", $email, $orgID
            )
        );

        if ($count > 0) {
            wp_send_json_error(new WP_Error( 'email', __( "Email exists", "email" )));
        }
 
        $donor_data = array(
            'email' => $new_donor['email'],
            'donor_password' => $new_donor['password'],
            'first_name' => $new_donor['firstName'],
            'last_name' => $new_donor['lastName'],
            'organization_id' => $new_donor['orgID'],
            'login_method' => $new_donor['login']
        );

        $status = $wpdb->insert($donors_table, $donor_data, array('%s','%s','%s','%s','%d','%d'));
        //wp_new_user_notification($user_id, $password);
        wp_send_json_success(); 
    } 

    private function hash_password($password){
        $wp_hasher = new PasswordHash( 8, TRUE );
        $hashed_password = $wp_hasher->HashPassword( $password );
        return $hashed_password;
    }

    private function validate_password($password, $stored ) {
        $hasher = new PasswordHash(8, TRUE);    
        return $hasher->CheckPassword( $password, $stored );
    }
}