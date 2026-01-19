<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Status_WP
 * @subpackage Status_WP/admin/partials
 */

?>
<div class="wrap">
    <h1>GDA Status Settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields('options'); ?>

        <table class="form-table">
            <tr>
                <th>WP API Key</th>
                <td>
                    <input type="text"
                            name="gda_status_wp_api_key"
                            value="<?= esc_attr(get_option('gda_status_wp_api_key')) ?>"
                            class="regular-text">
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>