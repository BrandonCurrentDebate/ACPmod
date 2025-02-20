<?php
if (! isset($data)) {
    exit;
}
?>
<div class="wpacu-warning" style="font-size: inherit; padding: 12px; line-height: 22px; margin: 0 0 30px;">
    <span style="font-size: 18px;">💡️</span>&nbsp; By default, all the plugin unload rules, for your visitors and the Dashboard <em>/wp-admin/</em>, are taking effect. For debugging purposes (e.g. you believe that you unloaded a specific plugin somewhere and this is causing problems), you can prevent the plugin unload rules from taking effect, by disabling the options below.
</div>

<fieldset class="wpacu-options-grouped-in-settings" style="margin: 0 0 30px;">
    <legend><?php echo __('IN FRONTEND VIEW (your visitors)', 'wp-asset-clean-up'); ?></legend>

    <?php
    $pluginsManagerFrontDisable = isset($data['plugins_manager_front_disable']) ? (int)$data['plugins_manager_front_disable'] === 1 : false;
    ?>

    <table id="wpacu-settings-announcements" class="wpacu-form-table">
        <tr valign="top">
            <th scope="row">
                <label for="wpacu_plugins_manager_front_disable_checkbox"><?php _e('Keep all rules enabled', 'wp-asset-clean-up'); ?></label>
            </th>
            <td>
                <label class="wpacu_switch">
                    <!-- Default -->
                    <input type="hidden" name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manager_front_disable]" value="1">

                    <input id="wpacu_plugins_manager_front_disable_checkbox"
                           type="checkbox"
                           data-target-opacity="wpacu-plugins-manager-front-options"
                        <?php echo ( ! $pluginsManagerFrontDisable ) ? 'checked="checked"' : ''; ?>
                           name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manager_front_disable]"
                           value="0" /> <span class="wpacu_slider wpacu_round"></span> </label>
                &nbsp; This option can also be turned on and off in "Plugins Manager" -- "IN FRONTEND VIEW (your visitors)"
            </td>
        </tr>
    </table>

    <div <?php if ( $pluginsManagerFrontDisable ) { echo 'style="opacity: 0.4;"'; } ?> id="wpacu-plugins-manager-front-options">
        <div style="color: #23282d; font-weight: 600; font-size: 14px; margin: 0 0 10px;">Additional Query Strings to Ignore for Homepage Detection</div>
        <p style="line-height: 22px;">By default, Asset CleanUp Pro detects the homepage (very early in the WordPress loading process, before known functions like <code>is_front_page()</code> or <code>is_home()</code> are available) when no query string is present or when it includes a known query string from the <a href="#">predefined list</a> (e.g. the common <code>utm_source</code> parameter belongs to Google Analytics and can be ignored when it comes to homepage detection).</p>
        <p style="line-height: 22px;">Adding new query strings here ensures they are also ignored, allowing the homepage to be correctly identified (e.g., <code>/?custom_analytics_param</code>). Be cautious when adding dynamic parameters used for AJAX requests or other actions, as this may cause issues (e.g. <code>www.yoursite.com/?db_action=process_data&amp;param_value=for_specific_db_table</code>: this is likely an URL that performs an action and adding "db_action" to the list of ignored strings, will make Asset CleanUp Pro that it's the homepage, and broken functionality could arise from unloaded plugins). <span class="dashicons dashicons-info"></span> <a target="_blank" href="https://www.assetcleanup.com/docs/?p=2130">Read more</a></p>
        <hr />
        <p>In this textarea, you can append query strings that you believe they should be ignored whe detecting the homepage, apart from the <a href="https://www.assetcleanup.com/docs/?p=2130">already popular ignored ones</a> (one line per row):</p>
        <textarea style="min-width: 500px; min-height: 100px;"
                  name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manager_front_homepage_detect_extra_ignore_query_string_list]"
                  data-wpacu-adapt-height="1"><?php echo esc_textarea($data['plugins_manager_front_homepage_detect_extra_ignore_query_string_list']); ?></textarea>
    </div>
</fieldset>

<fieldset class="wpacu-options-grouped-in-settings" style="margin: 0 0 30px;">
    <legend><?php echo __('IN THE DASHBOARD /wp-admin/', 'wp-asset-clean-up'); ?></legend>

    <?php
    $wpacuIsDashConstantSetToTrue = wpacuIsDefinedConstant('WPACU_ALLOW_DASH_PLUGIN_FILTER');

    if ( ! $wpacuIsDashConstantSetToTrue ) {
        ?>
        <div style="line-height: 24px; margin: 0 0 20px; padding: 10px; border: 1px solid #fdd5c9; border-radius: 5px;"><span style="font-size: 18px;">⚠️</span> Due to the fact that unloading plugins within the Dashboard, on specific pages, is a sensitive feature that could break up the Dashboard, a code snippet (PHP constant) has to be enabled in the root file <strong>wp-config.php</strong> (this can be done either by you, or by a person that usually has full access to the website, if he/she can edit this file). Once this is set, the options below will take effect and this notice will dissapear. <span class="dashicons dashicons-info"></span> <a target="_blank" href="https://www.assetcleanup.com/docs/?p=1128">Read more</a></div>
        <?php
    }

    $pluginsManagerDashDisable = isset($data['plugins_manager_dash_disable']) ? (int)$data['plugins_manager_dash_disable'] === 1 : false;
    ?>

    <table <?php if ( ! $wpacuIsDashConstantSetToTrue ) { echo 'style="opacity: 0.4;"'; } ?> id="wpacu-settings-announcements" class="wpacu-form-table">
        <tr valign="top">
            <th scope="row">
                <label for="wpacu_plugins_manager_dash_enable_checkbox"><?php _e('Keep all rules enabled', 'wp-asset-clean-up'); ?></label>
            </th>
            <td>
                <label class="wpacu_switch">
                    <!-- Default -->
                    <input type="hidden" name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manager_dash_disable]" value="1">

                    <input id="wpacu_plugins_manager_dash_enable_checkbox"
                           data-target-opacity="wpacu-plugins-manager-left-sidebar-options"
                           type="checkbox"
                        <?php echo ( ! $pluginsManagerDashDisable ) ? 'checked="checked"' : ''; ?>
                           name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manager_dash_disable]"
                           value="0" /> <span class="wpacu_slider wpacu_round"></span> </label>
                &nbsp; This option can also be turned on and off in "Plugins Manager" -- "IN THE DASHBOARD /wp-admin/"

                <div id="wpacu-plugins-manager-left-sidebar-options"
                     style="<?php if ($pluginsManagerDashDisable) { echo ' opacity: 0.4; '; } ?> margin: 20px 0 0;">
                    <label style="cursor: pointer;" for="<?php echo WPACU_PLUGIN_ID . '_plugins_manager_left_sidebar_restore'; ?>">
                        <input type="checkbox"
                               data-target-opacity="wpacu-left-sidebar-loading-options-area"
                               name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manage_dash_restore_left_sidebar]"
                            <?php
                            if ($data['plugins_manage_dash_restore_left_sidebar']) {
                                echo ' checked="checked" ';
                            }
                            ?>
                               id="<?php echo WPACU_PLUGIN_ID . '_plugins_manager_left_sidebar_restore'; ?>" />
                        Restore the left sidebar area as it was, if plugins are unloaded on admin pages</label> <span class="dashicons dashicons-info"></span>&nbsp;<a target="_blank" href="https://www.assetcleanup.com/docs/?p=1923">Read more</a>

                    <div <?php if ( ! $data['plugins_manage_dash_restore_left_sidebar'] ) { echo ' style="opacity: 0.4;" '; } ?> id="wpacu-left-sidebar-loading-options-area"
                         class="wpacu_radio_inline_wrap_area">
                        <div class="wpacu_radio_area">
                            <input type="radio"
                                   id="plugins_manage_dash_restore_left_sidebar_options_loading_type_no_overlay"
                                   name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manage_dash_restore_left_sidebar_options][loading_type]"
                                <?php
                                if ( $data['plugins_manage_dash_restore_left_sidebar_options']['loading_type'] === 'no_overlay' ) {
                                    echo 'checked="checked"';
                                }
                                ?>
                                   value="no_overlay" />
                            <label for="plugins_manage_dash_restore_left_sidebar_options_loading_type_no_overlay" class="radio-label">No overlay</label>
                        </div>

                        <div class="wpacu_radio_area">
                            <input type="radio"
                                   id="plugins_manage_dash_restore_left_sidebar_options_loading_type_overlay"
                                   name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manage_dash_restore_left_sidebar_options][loading_type]"
                                <?php
                                if ( $data['plugins_manage_dash_restore_left_sidebar_options']['loading_type'] === 'overlay' ) {
                                    echo 'checked="checked"';
                                }
                                ?>
                                   value="overlay" />
                            <label for="plugins_manage_dash_restore_left_sidebar_options_loading_type_overlay" class="radio-label">Show overlay</label>
                        </div>

                        <div class="wpacu_radio_area">
                            <input type="radio"
                                   id="plugins_manage_dash_restore_left_sidebar_options_loading_type_overlay_loader"
                                   name="<?php echo WPACU_PLUGIN_ID . '_settings'; ?>[plugins_manage_dash_restore_left_sidebar_options][loading_type]"
                                <?php
                                if ( $data['plugins_manage_dash_restore_left_sidebar_options']['loading_type'] === 'overlay_loader' ) {
                                    echo ' checked="checked" ';
                                }
                                ?>
                                   value="overlay_loader" />
                            <label for="plugins_manage_dash_restore_left_sidebar_options_loading_type_overlay_loader" class="radio-label">Show overlay &amp; loading spinner</label>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    </table>
</fieldset>
