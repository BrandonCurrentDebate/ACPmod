<?php
/*
 * No direct access to this file
 */
if (! isset($data)) {
	exit;
}

use WpAssetCleanUp\Admin\MiscAdmin;
use WpAssetCleanUp\Main;
use WpAssetCleanUp\Misc;
use WpAssetCleanUp\OptimiseAssets\OptimizeCommon;

// [wpacu_pro]
use WpAssetCleanUpPro\Admin\PluginsManagerProAdmin;
// [/wpacu_pro]

$wpacuTopAreaLinks = array(
	'admin.php?page=wpassetcleanup_settings' => array(
		'icon' => '<span class="dashicons dashicons-admin-generic"></span>',
		'title' => esc_html__('Settings', 'wp-asset-clean-up'),
		'page' => 'wpassetcleanup_settings'
	),

	'admin.php?page=wpassetcleanup_assets_manager' => array(
		'icon' => '<span class="dashicons dashicons-media-code"></span>',
		'title' => esc_html__('CSS &amp; JS Manager', 'wp-asset-clean-up'),
		'page'  => 'wpassetcleanup_assets_manager',
	),

	'admin.php?page=wpassetcleanup_plugins_manager' => array(
		'icon' => '<span class="dashicons dashicons-admin-plugins"></span>',
		'title' => esc_html__('Plugins Manager', 'wp-asset-clean-up'),
		'page'  => 'wpassetcleanup_plugins_manager',
	),

	'admin.php?page=wpassetcleanup_bulk_unloads' => array(
		'icon' => '<span class="dashicons dashicons-networking"></span>',
		'title' => esc_html__('Bulk Changes', 'wp-asset-clean-up'),
		'page'  => 'wpassetcleanup_bulk_unloads'
	),

	'admin.php?page=wpassetcleanup_overview' => array(
		'icon' => '<span class="dashicons dashicons-media-text"></span>',
		'title' => esc_html__('Overview', 'wp-asset-clean-up'),
		'page'  => 'wpassetcleanup_overview'
	),

	'admin.php?page=wpassetcleanup_tools' => array(
		'icon' => '<span class="dashicons dashicons-admin-tools"></span>',
		'title' => esc_html__('Tools', 'wp-asset-clean-up'),
		'page' => 'wpassetcleanup_tools'
	),
	'admin.php?page=wpassetcleanup_license' => array(
		'icon' => '<span class="dashicons dashicons-awards"></span>',
		'title' => esc_html__('License', 'wp-asset-clean-up'),
		'page' => 'wpassetcleanup_license'
	),
	'admin.php?page=wpassetcleanup_get_help' => array(
		'icon' => '<span class="dashicons dashicons-sos"></span>',
		'title' => esc_html__('Help', 'wp-asset-clean-up'),
		'page' => 'wpassetcleanup_get_help'
	)
);

global $current_screen;

// [wpacu_pro]
$wpacuValidLicense = false; // default

$licenseKeyValue     = get_option(WPACU_PLUGIN_ID . '_pro_license_key');
$licenseStatus       = get_option(WPACU_PLUGIN_ID . '_pro_license_status');

$isLicenseInDb       = ($licenseKeyValue !== '' && strlen($licenseKeyValue) === 32);
$isLicenseWithStatus = in_array($licenseStatus, array('valid', 'expired', 'site_inactive', 'invalid', 'disabled'));

$wpacuExpiredLicense  = (strtolower($licenseStatus) === 'expired');
$wpacuValidLicense    = (strtolower($licenseStatus) === 'valid');
$wpacuInvalidLicense  = (strtolower($licenseStatus) === 'invalid');
$wpacuDisabledLicense = (strtolower($licenseStatus) === 'disabled');

$wpacuNoStatusLicense = (! $wpacuExpiredLicense && ! $wpacuValidLicense);
// [wpacu_pro]

$wpacuCurrentPage = isset($data['page']) ? $data['page'] : false;

if (! $wpacuCurrentPage) {
	$wpacuCurrentPage = str_replace(
		array(str_replace(' ', '-', strtolower(WPACU_PLUGIN_TITLE)) . '_page_', 'toplevel_page_', 'admin_page_'),
		'',
		$current_screen->base
	);
}

$wpacuDefaultPageUrl = esc_url(admin_url(Misc::arrayKeyFirst($wpacuTopAreaLinks)));

$goBackToCurrentUrl = '&_wp_http_referer=' . urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) );

$isSettingsCurrentPage = ($wpacuCurrentPage !== WPACU_PLUGIN_ID . '_settings');

// [wpacu_pro]
$data['plugins_manager_front_enable'] = ! PluginsManagerProAdmin::isPluginsManagerDisabled();
$data['plugins_manager_dash_enable']  = ! PluginsManagerProAdmin::isPluginsManagerDisabled('dash');
// [/wpacu_pro]
?>
<div id="wpacu-top-area">
    <div id="wpacu-logo-wrap">
        <a href="<?php echo esc_url($wpacuDefaultPageUrl); ?>">
            <img alt="" src="<?php echo WPACU_PLUGIN_URL; ?>/assets/images/asset-cleanup-logo.png" />
            <div class="wpacu-version-sign wpacu-pro">
                <div>
                    PRO<div class="wpacu-version-text">v<?php echo WPACU_PRO_PLUGIN_VERSION; ?></div>
                </div>
            </div>
        </a>
    </div>

    <div id="wpacu-quick-actions">
        <span class="wpacu-actions-title"><?php _e('QUICK ACTIONS', 'wp-asset-clean-up'); ?>:</span>
        <a class="wpacu-clear-cache-link" href="<?php echo esc_url(OptimizeCommon::generateClearCachingUrl()); ?>">
            <span class="dashicons dashicons-update"></span> <?php _e('Clear CSS/JS Files Cache', 'wp-asset-clean-up'); ?>
        </a>
        |
        <?php
        if ($isSettingsCurrentPage) {
        ?>
        <a style="text-decoration: none; color: #74777b;" href="<?php echo esc_url(admin_url('admin.php?page=wpassetcleanup_settings&wpacu_selected_tab_area=wpacu-setting-test-mode')); ?>">
        <?php
        }

        echo esc_html__('TEST MODE', 'wp-asset-clean-up').': ';

        if (Main::instance()->settings['test_mode']) {
            echo '<strong style="color: green;">ON</strong> ';
            echo '<span style="font-weight: 300; font-style: italic;">* settings only apply to you (logged-in admin)</span>';
        } else {
            echo 'OFF ';
	        echo '<span style="font-weight: 300; font-style: italic;">* settings apply to any visitor</span>';
        }

        if ($isSettingsCurrentPage) {
        ?>
        </a>
        <?php
        }
        ?>
    </div>

    <div class="wpacu_clearfix"></div>
</div>

<div class="wpacu-tabs wpacu-tabs-style-topline">
    <nav>
        <ul>
			<?php
            foreach ($wpacuTopAreaLinks as $wpacuLink => $wpacuInfo) {
                $wpacuIsCurrentPage            = ($wpacuCurrentPage  === $wpacuInfo['page']);
	            $wpacuIsAssetsManagerPageLink  = ($wpacuInfo['page'] === 'wpassetcleanup_assets_manager');
	            $wpacuIsPluginsManagerPageLink = ($wpacuInfo['page'] === 'wpassetcleanup_plugins_manager');
	            $wpacuIsBulkUnloadsPageLink    = ($wpacuInfo['page'] === 'wpassetcleanup_bulk_unloads');
                $wpacuIsLicensePageLink        = ($wpacuInfo['page'] === 'wpassetcleanup_license');

                // [wpacu_pro]
                // [/wpacu_pro]
                ?>
                <li data-wpacu-top-menu-tab-item="<?php echo $wpacuInfo['page']; ?>"
                    class="<?php if ($wpacuIsCurrentPage) { echo ' wpacu-tab-current '; }
                    // [wpacu_pro]
                    // [/wpacu_pro]
                    ?>">
                    <?php
                    // [wpacu_pro]
                    if ($wpacuIsLicensePageLink && $wpacuValidLicense) {
                        ?>
                        <span class="extra-info license-status active">active</span>
                        <?php
                    } elseif ($wpacuIsLicensePageLink && $wpacuDisabledLicense) {
	                    ?>
	                    <span class="extra-info license-status inactive">disabled</span>
	                    <?php
                    } elseif ($wpacuIsLicensePageLink && $wpacuExpiredLicense) {
                    ?>
	                <span class="extra-info license-status inactive">expired</span>
	                <?php
                    } elseif ($wpacuIsLicensePageLink && $wpacuNoStatusLicense) {
	                    ?>
                        <span class="extra-info license-status inactive">inactive</span>
	                    <?php
                    }
                    // [/wpacu_pro]

                    if ($wpacuIsAssetsManagerPageLink) {
                        $totalUnloadedAssets = MiscAdmin::getTotalUnloadedAssets('per_page');

                        if ($totalUnloadedAssets === 0) {
	                        ?>
                            <span class="extra-info assets-unloaded-false"><span class="dashicons dashicons-warning"></span> No unloads per page</span>
	                        <?php
                        } elseif ($totalUnloadedAssets > 0) {
                            ?>
                            <span class="extra-info assets-unloaded-true"><strong><?php echo (int)$totalUnloadedAssets; ?></strong> page unloads</span>
                            <?php
                        }
                    }

                    if ($wpacuIsPluginsManagerPageLink) {
                        // [wpacu_pro]
                        $pluginRulesFiltered = PluginsManagerProAdmin::getPluginRulesFiltered(true, true);

                        $pluginsManagerFrontDisabled = PluginsManagerProAdmin::isPluginsManagerDisabled();
                        $pluginsManagerDashDisabled  = PluginsManagerProAdmin::isPluginsManagerDisabled('dash');

                        $totalFront = isset($pluginRulesFiltered['plugins'])      ? count($pluginRulesFiltered['plugins']) : 0;
	                    $totalDash  = isset($pluginRulesFiltered['plugins_dash']) ? count($pluginRulesFiltered['plugins_dash']) : 0;

	                    $totalPluginRules = ($totalFront + $totalDash);

	                    if ($totalPluginRules === 0) {
		                    ?>
		                    <span class="extra-info assets-unloaded-false"><span class="dashicons dashicons-warning"></span> No active rules</span>
		                    <?php
	                    } elseif ($totalPluginRules > 0) {
                            $opacityLevel = '';

                            if ($pluginsManagerFrontDisabled && $pluginsManagerDashDisabled) {
                                $opacityLevel = '0.5';
                            } elseif ( ! $pluginsManagerFrontDisabled || ! $pluginsManagerDashDisabled ) {
                                $opacityLevel = '0.75';
                            }
		                    ?>
		                    <span class="extra-info assets-unloaded-true"
                                <?php if ($opacityLevel) { echo 'style="opacity: '.$opacityLevel.'"'; } ?>>
			                    <strong><?php echo (int)$totalPluginRules; ?></strong> unload rule<?php echo ($totalPluginRules > 1) ? 's' : ''; ?>
		                    </span>
		                    <?php
	                    }
                        // [/wpacu_pro]
                    }

                    if ($wpacuIsBulkUnloadsPageLink) {
                        $totalBulkUnloadRules = MiscAdmin::getTotalBulkUnloadsFor('all');

                        if ($totalBulkUnloadRules === 0) {
                            ?>
                            <span class="extra-info no-bulk-unloads assets-unloaded-false"><span class="dashicons dashicons-warning"></span> No bulk unloads</span>
	                        <?php
                        } elseif ($totalBulkUnloadRules > 0) {
                            ?>
                            <span class="extra-info has-bulk-unloads assets-unloaded-true"><strong><?php echo $totalBulkUnloadRules; ?></strong> bulk unload<?php echo ($totalBulkUnloadRules > 1) ? 's' : ''; ?></span>
	                        <?php
                        }
                    }
                    ?>
                    <a <?php if (isset($wpacuInfo['target']) && $wpacuInfo['target'] === '_blank') { ?> target="_blank" <?php } ?>
                            href="<?php echo esc_url(admin_url($wpacuLink)); ?>">
                        <?php echo wp_kses($wpacuInfo['icon'], array('span' => array('class' => array()))); ?> <span><?php echo esc_html($wpacuInfo['title']); ?></span>
                    </a>
                </li>
			<?php } ?>
        </ul>
    </nav>
</div><!-- /tabs -->
