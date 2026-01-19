<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xendit_Api_GDA
 * @subpackage Xendit_Api_GDA/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">
    <h1>GDA Status Settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields('xendit_api_gda'); ?>

        <table class="form-table">
            <tr>
                <th>Xendit Merchant ID</th>
                <td>
                    <input type="text"
                            name="xendit_api_gda_merchant_id"
                            value="<?= esc_attr(get_option('xendit_api_gda_merchant_id')) ?>"
                            class="regular-text">
                </td>
            </tr>
        </table>
        <?php settings_fields('xendit_api_gda'); ?>

        <table class="form-table">
            <tr>
                <th>Xendit Server Key</th>
                <td>
                    <input type="text"
                            name="xendit_api_gda_server_key"
                            value="<?= esc_attr(get_option('xendit_api_gda_server_key')) ?>"
                            class="regular-text">
                </td>
            </tr>
        </table>
        <?php settings_fields('xendit_api_gda') ?>
        <table class="form-table">
            <tr>
                <th>Xendit Client Key</th>
                <td>
                    <input type="text"
                            name="xendit_api_gda_client_key"
                            value="<?= esc_attr(get_option('xendit_api_gda_client_key')) ?>"
                            class="regular-text">
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
</div>