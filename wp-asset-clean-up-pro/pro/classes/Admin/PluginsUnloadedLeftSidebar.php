<?php
namespace WpAssetCleanUpPro\Admin;

use WpAssetCleanUp\Main;

/**
 *
 */
class PluginsUnloadedLeftSidebar
{
    /**
     * @var array|bool
     */
    public $loadingType;

    /**
     * @var
     */
    public $showOverlay;

    /**
     *
     */
    public function __construct()
    {
        // [Vars Set]
        $this->loadingType = isset(Main::instance()->settings['plugins_manage_dash_restore_left_sidebar_options']['loading_type']) &&
                             Main::instance()->settings['plugins_manage_dash_restore_left_sidebar_options']['loading_type']
            ? Main::instance()->settings['plugins_manage_dash_restore_left_sidebar_options']['loading_type']
            : '';

        if ( ! $this->loadingType ) {
            return '';
        }

        $this->showOverlay = in_array($this->loadingType, array('overlay', 'overlay_loader'));

        // [/Vars Set]

        add_action('admin_head',   array($this, 'adminHead'));
        add_action('admin_footer', array($this, 'adminFooter'));
    }

    /**
     * @return void
     */
    public function adminHead()
    {
        if ($this->showOverlay) {
        ?>
        <style>
            /* Positioning the sidebar wrapper for relative positioning */
            #adminmenuwrap {
                position: relative; /* Ensure the overlay is positioned correctly */
                overflow: hidden; /* Prevent scrollbars from affecting the overlay */
            }

            /* Container for the loader and overlay */
            #wpacu-left-sidebar-overlay {
                position: fixed; /* Fixed to remain centered regardless of scroll */
                top: 0;
                left: 0;
                width: 160px; /* Match the sidebar width */
                height: 100vh; /* Full viewport height */
                background: rgba(255, 255, 255, 0.6); /* Semi-transparent white */
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999; /* Above the sidebar but below submenus */
                pointer-events: none; /* Allow interactions if needed */
                opacity: 0; /* Start fully transparent */
                transition: opacity 0.3s ease; /* Smooth transition */
            }

            @media (max-width: 960px) {
                #wpacu-left-sidebar-overlay {
                    width: 36px;
                }
            }

            /* Show Overlay */
            #wpacu-left-sidebar-overlay.wpacu-show {
                opacity: 1; /* Fully visible */
                pointer-events: all; /* Prevent interactions beneath the overlay */
            }

            /* Hide Overlay */
            #wpacu-left-sidebar-overlay.wpacu-hide {
                opacity: 0; /* Fully transparent */
                pointer-events: none; /* Allow interactions if needed */
            }
        </style>
        <?php
        }

        if ($this->loadingType === 'overlay_loader') {
        ?>
            <style>
                /* Loader Spinner */
                #wpacu-left-sidebar-loader {
                    border: 8px solid #f3f3f3; /* Light grey */
                    border-top: 8px solid #3498db; /* Blue */
                    border-radius: 50%;
                    width: 60px;
                    height: 60px;
                    animation: wpacu-left-sidebar-spin 1s linear infinite;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
                }

                @media (max-width: 960px) {
                    #wpacu-left-sidebar-loader {
                        border: 2px solid #f3f3f3; /* Light grey */
                        border-top: 2px solid #3498db; /* Blue */
                        width: 20px; /* Reduced width */
                        height: 20px; /* Reduced height */
                    }
                }

                /* Spin Animation */
                @keyframes wpacu-left-sidebar-spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>
        <?php
        }
    }

    /**
     * @return void
     */
    public function adminFooter()
    {
        ?>
        <script>
            <?php
            if ($this->showOverlay) {
            ?>
                var wpacuLetSidebarOverlayId = 'wpacu-left-sidebar-overlay';

                /**
                 * Initialize Overlay and Loader
                 */
                function wpacuInitializeLeftSidebarOverlay() {
                    // Check if overlay already exists
                    if (jQuery('#' + wpacuLetSidebarOverlayId).length === 0) {
                        // Create the overlay DIV
                        var wpacuOverlay = jQuery('<div id="'+ wpacuLetSidebarOverlayId +'" aria-live="polite" aria-busy="true"></div>');

                        <?php
                        if ($this->loadingType === 'overlay_loader') {
                        ?>
                            // Create the loader DIV
                            var wpacuLoader = jQuery('<div id="wpacu-left-sidebar-loader" role="status" aria-label="Loading"></div>');

                            // Append loader to overlay
                            wpacuOverlay.append(wpacuLoader);
                        <?php
                        }
                        ?>

                        // Append overlay to the sidebar
                        jQuery('#adminmenuwrap').append(wpacuOverlay);
                    }
                }

                /**
                 * Show Overlay and Loader by adding the 'wpacu-show' class
                 */
                function wpacuShowLeftSidebarOverlay() {
                    jQuery('#' + wpacuLetSidebarOverlayId)
                        .css({'width': jQuery('#adminmenuwrap').width() + 'px'})
                        .removeClass('wpacu-hide').addClass('wpacu-show').attr('aria-busy', 'true');
                }

                /**
                 * Hide Overlay and Loader by adding the 'wpacu-hide' class
                 */
                function wpacuHideLeftSidebarOverlay() {
                    jQuery('#' + wpacuLetSidebarOverlayId).removeClass('wpacu-show').addClass('wpacu-hide').attr('aria-busy', 'false');
                }
            <?php
            }
            ?>

            jQuery(document).ready(function($) {
                var wpacuCurrentUrl = window.location.href;

                if (wpacuCurrentUrl.includes('?')) {
                    wpacuCurrentUrl += '&wpacu_no_plugin_unload';
                } else {
                    wpacuCurrentUrl += '?wpacu_no_plugin_unload'
                }

                <?php if ($this->showOverlay) { ?>
                    // Initialize Overlay and Loader
                    wpacuInitializeLeftSidebarOverlay();

                    // Show Overlay and Loader
                    wpacuShowLeftSidebarOverlay();
                <?php } ?>
                var wpacuAdminMenuId = 'adminmenu';

                $.ajax({
                    url: wpacuCurrentUrl,
                    success: function (htmlSource) {
                        var $wpacuHtmlSourceParsed = $($.parseHTML(htmlSource));

                        // No '#admimenu' found? Something's funny! Let's stop here!
                        if ( $wpacuHtmlSourceParsed.find('#' + wpacuAdminMenuId).length === 0 ) {
                            <?php if ($this->showOverlay) { ?>
                                wpacuHideLeftSidebarOverlay();
                            <?php } ?>

                            console.log('#' + wpacuAdminMenuId + ' was not found in the requested URL: '+ wpacuCurrentUrl);
                            return;
                        }

                        var wpacuAllPluginsLoadedAdminMenu = $wpacuHtmlSourceParsed.find('#' + wpacuAdminMenuId).html();

                        $('#' + wpacuAdminMenuId).html(wpacuAllPluginsLoadedAdminMenu);

                        <?php if ($this->showOverlay) { ?>
                            wpacuHideLeftSidebarOverlay();
                        <?php } ?>

                        // Make sure submenus are shown on hover
                        $('#adminmenuwrap').css({'overflow': 'visible'});

                        $( '#screen-meta-links' ).find( '.show-settings' ).off( 'click', window.screenMeta.toggleEvent );

                        <?php
                        // Reload this script to make sure the submenus are working fine
                        if ($wpacuUrlToCommonJs = self::getScriptUrlWithVer('common')) {
                        ?>
                            $.getScript('<?php echo $wpacuUrlToCommonJs; ?>');
                        <?php
                        }
                        ?>

                        setTimeout(function() {
                            // Force reflow
                            $('#adminmenu')[0].offsetHeight;
                            $(window).resize();
                        }, 1000);
                    }
                });
            });
        </script>
        <?php
    }

    /**
     * @param $handle
     *
     * @return string
     */
    public static function getScriptUrlWithVer( $handle )
    {
        // Get the global scripts object
        global $wp_scripts;

        // Ensure the handle exists and has a source
        if ( isset( $wp_scripts->registered[ $handle ] ) && ! empty( $wp_scripts->registered[ $handle ]->src ) ) {
            // Default ver in case none is set for this handle
            global $wp_version;

            // Get the base URL for the script
            $script_url = $wp_scripts->base_url . $wp_scripts->registered[ $handle ]->src;

            // Get the version if set, or default to null
            $version = isset( $wp_scripts->registered[ $handle ]->ver ) && $wp_scripts->registered[ $handle ]->ver
                ? $wp_scripts->registered[ $handle ]->ver
                : $wp_version;

            // Append the version as a query string if it's available
            if ( $version ) {
                $script_url = add_query_arg( 'ver', $version, $script_url );
            }

            return $script_url;
        }

        return ''; // Return an empty string if the handle is not found or invalid
    }
}
