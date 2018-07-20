
<?php

/**
 * The file that defines the trucks ajax functionality.
 *
 * A class definition for registering new users
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 */

/**
 * All User Registration code for the sapo site should be
 * set here.
 *
 * @since      1.0.0
 * @package    Sapoadmin
 * @subpackage Sapoadmin/public
 * @author     Travus Helmly <helmlyw@gmail.com>
 */
class NewUser
{

    /**
     * A shortcode for rendering the new user registration form.
     *
     * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
     *
     * @return string  The shortcode output
     */
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

    /**
     * Validates and then completes the new user signup process if all went well.
     *
     * @param string $email         The new user's email address
     * @param string $first_name    The new user's first name
     * @param string $last_name     The new user's last name
     *
     * @return int|WP_Error         The id of the user that was created, or error if failed.
     */
    private function register_user($email, $first_name, $last_name)
    {
        $errors = new WP_Error();
 
        // Email address is used as both username and email. It is also the only
        // parameter we need to validate
        if (!is_email($email)) {
            $errors->add('email', $this->get_error_message('email'));
            return $errors;
        }

        if (username_exists($email) || email_exists($email)) {
            $errors->add('email_exists', $this->get_error_message('email_exists'));
            return $errors;
        }
 
        // Generate the password so that the subscriber will have to check email...
        $password = wp_generate_password(12, false);

        $user_data = array(
            'user_login' => $email,
            'user_email' => $email,
            'user_pass' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'nickname' => $first_name,
        );

        $user_id = wp_insert_user($user_data);
        wp_new_user_notification($user_id, $password);

        return $user_id;
    }  //register_user()

    /**
     * Handles the registration of a new user.
     *
     * Used through the action hook "login_form_register" activated on wp-login.php
     * when accessed through the registration action.
     */
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
}