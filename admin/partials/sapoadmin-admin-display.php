<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/screwLock
 * @since      1.0.0
 *
 * @package    Sapoadmin
 * @subpackage Sapoadmin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <!--Tabbed Pages-->
        <h3 class "nav-tab-wrapper">
            <a href="<?php echo admin_url() ?>/options-general.php?page=sapoadmin" class="nav-tab nav-tab-active">Pickups</a>
            <a href="<?php echo admin_url() ?>/options-general.php?page=sapoadmin" class="nav-tab">Zipcodes</a>

        </h3>

    <

</div>