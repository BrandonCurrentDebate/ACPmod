<?php
/*
 * No direct access to this file
 */
if (! isset($data)) {
    exit;
}
?>
<div class="wpacu-wrap">
    <div class="about-wrap wpacu-about-wrap">
        <h1><?php echo sprintf(__('Welcome to %s %s', 'wp-asset-clean-up'), WPACU_PLUGIN_TITLE, WPACU_PRO_PLUGIN_VERSION); ?></h1>
        <p class="about-text wpacu-about-text">
            Thank you for installing this premium page speed booster plugin! Prepare to make your WordPress website faster &amp; lighter by removing the useless CSS &amp; JavaScript files from your pages. For maximum performance, <?php echo WPACU_PLUGIN_TITLE; ?> works best when used with either a caching plugin, an in-built hosting caching (e.g. <a style="text-decoration: none; color: #555d66;" href="https://www.gabelivan.com/visit/wp-engine">WPEngine</a>, Kinsta have it) or something like Varnish.
            <img src="<?php echo esc_url(WPACU_PLUGIN_URL); ?>/assets/images/wpacu-logo-transparent-bg-v1.png" alt="" />
        </p>

        <h2 class="wpacu-nav-tab-wrapper wpacu-getting-started wp-clearfix">
            <a href="<?php echo esc_url(admin_url('admin.php?page=wpassetcleanup_getting_started&wpacu_for=how-it-works')); ?>" class="wpacu-nav-tab <?php if ($data['for'] === 'how-it-works') { ?>wpacu-nav-tab-active<?php } ?>"><?php _e('How it works', 'wp-asset-clean-up'); ?></a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=wpassetcleanup_getting_started&wpacu_for=benefits-fast-pages')); ?>" class="wpacu-nav-tab <?php if ($data['for'] === 'benefits-fast-pages') { ?>wpacu-nav-tab-active<?php } ?>"><?php _e('Benefits of a Fast Website', 'wp-asset-clean-up'); ?></a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=wpassetcleanup_getting_started&wpacu_for=start-optimization')); ?>" class="wpacu-nav-tab <?php if ($data['for'] === 'start-optimization') { ?>wpacu-nav-tab-active<?php } ?>"><?php _e('Start Optimization', 'wp-asset-clean-up'); ?></a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=wpassetcleanup_getting_started&wpacu_for=video-tutorials')); ?>" class="wpacu-nav-tab <?php if ($data['for'] === 'video-tutorials') { ?>wpacu-nav-tab-active<?php } ?>"><span class="dashicons dashicons-video-alt3" style="color: #ff0000;"></span> <?php _e('Video Tutorials', 'wp-asset-clean-up'); ?></a>
        </h2>

        <div class="about-wrap-content">
	        <?php
	        if ($data['for'] === 'how-it-works') {
		        include_once __DIR__ .  '/_admin-page-getting-started-areas/_how-it-works.php';
	        } elseif ($data['for'] === 'benefits-fast-pages') {
		        include_once __DIR__ .  '/_admin-page-getting-started-areas/_benefits-fast-pages.php';
	        } elseif ($data['for'] === 'start-optimization') {
		        include_once __DIR__ .  '/_admin-page-getting-started-areas/_start-optimization.php';
	        } elseif ($data['for'] === 'video-tutorials') {
		        include_once __DIR__ .  '/_admin-page-getting-started-areas/_video-tutorials.php';
	        }
            ?>
        </div>
    </div>
</div>