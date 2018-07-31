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
class NewDonorsAjax
{

    /**
     * A shortcode for rendering the new donor registration form.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     *
    public function render_register_form($attributes, $content = null)
    {
        // Parse shortcode attributes
        $default_attributes = array('show_title' => false);
        $attributes = shortcode_atts($default_attributes, $attributes);

        if (is_user_logged_in()) {
            return __('You are already signed in.', 'personalize-login');
        } elseif (!get_option('users_can_register')) {
            return __('Registering new users is currently not allowed.', 'personalize-login');
        } else {
            return $this->get_template_html('register_form', $attributes);
        }
    } //end of render_register_form() 
    **/
    /**
     * Validates and then completes the new user signup process if all went well.
     *
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     **/
    private function register_donor()
    {
        $donors_table = $wpdb->prefix . "sapo_donors";
        $new_donor = $_POST['new_donor'];
        $email = $new_donor['email'];
        $orgID = $new_donor['orgID'];
        $errors = new WP_Error();
 
        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        $wpdb->get_results( 
            "
            SELECT email
            FROM $donors_table
            WHERE email in ($email)
                AND organization_id = $orgID
            "
        );

        if ($wpdb->num_rows != 0) {
            $errors->add('email', $this->get_error_message('email'));
            return $errors;
        }
 
        $donor_data = array(
            'user_email' => $$new_donor['email'],
            'user_pass' => $new_donor['password'],
            'first_name' => $new_donor['firstName'],
            'last_name' => $new_donor['lastName'],
            'organization_id' => $new_donor['orgID'],
            'login_method' => $new_donor['login']
        );

        $status = $wpdb->insert($donors_table, $donor_data, array('%s','%s','%s','%s','%d','%d'));
        //wp_new_user_notification($user_id, $password);
        wp_send_json_success($status); 
    }  //register_user()
    
    /**
     * Handles the registration of a new user.
     *
     * Used through the action hook "login_form_register" activated on wp-login.php
     * when accessed through the registration action.
     *
    public function do_register_user()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $redirect_url = home_url('member-register');

            if (!get_option('users_can_register')) {
            // Registration closed, display error
                $redirect_url = add_query_arg('register-errors', 'closed', $redirect_url);
            } else {
                $email = $_POST['email'];
                $first_name = sanitize_text_field($_POST['first_name']);
                $last_name = sanitize_text_field($_POST['last_name']);

                $result = $this->register_user($email, $first_name, $last_name);

                if (is_wp_error($result)) {
                // Parse errors into a string and append as parameter to redirect
                    $errors = join(',', $result->get_error_codes());
                    $redirect_url = add_query_arg('register-errors', $errors, $redirect_url);
                } else {
                // Success, redirect to login page.
                    $redirect_url = home_url('member-login');
                    $redirect_url = add_query_arg('registered', $email, $redirect_url);
                }
            }

            wp_redirect($redirect_url);
            exit;
        }
    } // end of do_register_user() function
    */
}
