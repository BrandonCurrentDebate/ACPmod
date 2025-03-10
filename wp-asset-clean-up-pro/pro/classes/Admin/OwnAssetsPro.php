<?php
namespace WpAssetCleanUpPro\Admin;

use WpAssetCleanUp\Menu;
use WpAssetCleanUp\OwnAssets;

/**
 *
 */
class OwnAssetsPro
{
    /**
	 * This code is called from class: "OwnAssets" - method: "_enqueueAdminScripts"
	 *
	 * @return void
	 */
	public static function sweetAlertNotifications()
	{
		/*
		* [START] SweetAlert (Pro features)
		*/
        $allowedTagsInJsAlert = array(
            'br'     => array(),
            'strong' => array()
        );

		$wpacuSiteUrl = site_url();

        $wpacuSubPage = (isset($_GET['wpacu_sub_page']) && $_GET['wpacu_sub_page']) ? $_GET['wpacu_sub_page'] : false;

        // Default for "Plugins Manager" area
        if ( Menu::isPluginPage() === 'plugins_manager' && ! $wpacuSubPage ) {
            $wpacuSubPage = 'manage_plugins_front';
        }

		$textMediaQuery = sprintf(
			esc_js(__('You have added @media in the input box which has been removed. It is not needed here as it not included within a CSS STYLE/LINK tag. For instance, if the CSS media query you had in mind is %s, then you can just input %s.', 'wp-asset-clean-up-pro')),
			'<strong>@media (min-width: 768px)</strong>', '<strong>(min-width: 768px)</strong>'
		);

		$textRegExHasSiteUrlTitle = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textRegExHasSiteUrlMsg   = sprintf(
			esc_js(__( 'You have added the website URL in the input box which has been removed. It is not needed here as only the request URI is required. For instance, if you want the following URL to match %s then you can just use %s as a rule. Also, being relative, it would look cleaner and still work as it should whenever you move from staging to live or vice-versa.', 'wp-asset-clean-up-pro')),
			$wpacuSiteUrl . '<strong>/contact</strong>',
			'<strong>#/contact#</strong>'
		);

		$textRegExHasUrlTitle = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textRegExHasUrlMsg   = sprintf(
			esc_js(__( 'Your RegEx should not start with a URL. Only the request URI is required. For instance, if you want the following URL to match %s then you can just use %s as a rule. Also, being relative, it would look cleaner and still work as it should whenever you move from staging to live or vice-versa.', 'wp-asset-clean-up-pro')),
			$wpacuSiteUrl . '<strong>/contact</strong>',
			'<strong>#/contact#</strong>'
		);

		$textRegExPluginsFrontEndViewTitle   = esc_js(__('Heads up! You might be in the wrong tab', 'wp-asset-clean-up-pro'));
		$textRegExPluginsFrontEndViewConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textRegExPluginsFrontEndViewMsg     = sprintf(
            wp_kses(__('You have added a RegEx rule that contains <strong>wp-admin</strong> to the input box and you are in the area where rules for the frontend view should be added (current tab: \'%s\').<br /><br />If your intention is to apply the rule for an admin page, then you have to access the \'%s /wp-admin/\' tab.', 'wp-asset-clean-up-pro'), $allowedTagsInJsAlert),
			esc_js(__('IN FRONTEND VIEW (your visitors)', 'wp-asset-clean-up')),
			esc_js(__('IN THE DASHBOARD', 'wp-asset-clean-up'))
		);

		$textRegExHasSameValuesForLoadUnloadConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textRegExHasSameValuesForLoadUnloadMsg     = sprintf(
			esc_js( __( 'You have added the same RegEx values for both the %sunload%s &amp; %sload exception%s rule. Thus, the rules would not take effect, as they would cancel each other. Consider editing the values to avoid this behaviour!', 'wp-asset-clean-up-pro') ),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$textPluginLoadUnloadLoggedInConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textPluginLoadUnloadLoggedInMsg = sprintf(
			esc_js(__('You have marked both %sunload the plugin if the user is logged in%s and to %salways load it if the user is logged in%s which cancel each other. The load exception rules, that are below the unload rules, always have priority. The checkboxes have been ticked off. Please review the unload and load exceptions rules again to avoid any confusion.', 'wp-asset-clean-up-pro')),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$textPluginLoadUnloadHomepageConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textPluginLoadUnloadHomepageMsg     = sprintf(
			esc_js(__('You have marked both %sunload on the homepage%s and %salways load it on the homepage%s which cancel each other. The load exception rules, that are below the unload rules, always have priority. The checkboxes have been ticked off. Please review the unload and load exceptions rules again to avoid any confusion.', 'wp-asset-clean-up-pro')),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$textPluginManageOnPostTypePageConflictConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textPluginManageOnPostTypePageConflictMsg     = sprintf(
			esc_js(__('You have chosen the same values for %sunload pages of these post types%s and %salways load pages of these post types%s which cancel each other. The load exception rules, that are below the unload rules, always have priority. The checkboxes have been ticked off. Please review the unload and load exceptions rules again to avoid any confusion.', 'wp-asset-clean-up-pro')),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$textPluginManageOnTaxPageConflictConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textPluginManageOnTaxPageConflictMsg     = sprintf(
			esc_js(__('You have chosen the same values for %sunload on these taxonomy pages%s and %salways load it on these taxonomy pages%s which cancel each other. The load exception rules, that are below the unload rules, always have priority. The checkboxes have been ticked off. Please review the unload and load exceptions rules again to avoid any confusion.', 'wp-asset-clean-up-pro')),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$textPluginManageOnArchivePageConflictConfirm = esc_js(__('I understand', 'wp-asset-clean-up-pro'));
		$textPluginManageOnArchivePageConflictMsg     = sprintf(
			esc_js(__('You have chosen the same values for %sunload on these page archive (page list) pages%s and %salways load it on these page archive (page list) pages%s which cancel each other. The load exception rules, that are below the unload rules, always have priority. The checkboxes have been ticked off. Please review the unload and load exceptions rules again to avoid any confusion.', 'wp-asset-clean-up-pro')),
			'<strong style=\'color: #c00;\'>', '</strong>',
			'<strong style=\'color: green;\'>', '</strong>'
		);

		$sweetAlertTwoScriptInline = <<<JS
jQuery(document).ready(function($) {
    $(document).on('change focusout blur', '.wpacu-handle-media-queries-load-field-input', function() {
        if ($(this).val().toLowerCase().indexOf('@media') > -1) {
            $(this).val($(this).val().toLowerCase().replace('@media', ''));
            wpacuSwal.fire({
                icon: "info",
                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textRegExHasSiteUrlTitle}",
                html: "{$textMediaQuery}"
            });
         }
    });
    
    $(document).on('change focusout blur', '.wpacu_regex_rule_textarea', function() {
        var wpacuSiteUrl = '{$wpacuSiteUrl}';
        
        /*
         * This will show an alert if the website URL is added to a RegEx rule
         * for either a handle in the "CSS/JS Manager or a plugin within "Plugins Manager"
         * alerting the user that the relative path - the URI - should be used, not the whole URL
         */
        if ($(this).val().toLowerCase().indexOf(wpacuSiteUrl) > -1) {
            $(this).val($(this).val().toLowerCase().replace(wpacuSiteUrl, ''));
            
            if ($(this).val() === '/') {
                $(this).val(''); // if only a forward slash was left, remove it as it's not relevant
            }

            wpacuSwal.fire({
                width: 600,
                icon: "info",
                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textRegExHasSiteUrlTitle}",
                html: "{$textRegExHasSiteUrlMsg}"
            });
        }
        /*
         * This will show an alert if a URL is added to a RegEx rule
         * for either a handle in the "CSS/JS Manager or a plugin within "Plugins Manager"
         * alerting the user that the relative path - the URI - should be used, not the whole URL
         */
        else if ($(this).val().toLowerCase().indexOf('http://') > -1 || $(this).val().toLowerCase().indexOf('https://') > -1) {
            $(this).val($(this).val().toLowerCase().replace('http://', '').replace('https://', ''));
            
            wpacuSwal.fire({
                width: 600,
                icon: "info",
                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textRegExHasUrlTitle}",
                html: "{$textRegExHasUrlMsg}"
            });
        }
        
        var wpacuSubPage = '{$wpacuSubPage}';
        
        /*
         * If the user is within "IN FRONTEND VIEW (your visitors)" and adds "wp-admin" as part of the RegEx
         * alert him/her that it's most likely a mistake and he/she could be in the wrong tab, since " IN THE DASHBOARD /wp-admin/"
         * is the right tab for unloading plugins within the Dashboard
         */
        if (wpacuSubPage === 'manage_plugins_front' && $(this).val().toLowerCase().indexOf('wp-admin') > -1) {
            wpacuSwal.fire({
                width: 650,
                icon: "warning",
                title: "{$textRegExPluginsFrontEndViewTitle}",
                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textRegExPluginsFrontEndViewConfirm}",
                html: "{$textRegExPluginsFrontEndViewMsg}"
            });
        }
        
        /*
         * This will show an alert if the same textarea value is added for both the unload and load exception rules
         * as the rules won't make sense because they cancel each other (e.g. user makes a mistake when adding the rules)
         */
         
        let wpacuPluginPath 		     = $(this).parent().attr('data-wpacu-plugin-path');
        let _targetedArea  		         = $('div[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        let wpacuUnloadViaRegExCheckbox = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_unload_regex_option';
        let wpacuLoadViaRegExCheckbox   = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_load_exception_regex_option';
        
        if ($(wpacuUnloadViaRegExCheckbox).prop('checked') && $(wpacuLoadViaRegExCheckbox).prop('checked')) {
            let _wpacuUnloadViaRegExTextareaEl  = _targetedArea.find('.wpacu_regex_unload_rule_textarea');
            let _wpacuLoadViaRegExTextareaEl 	= _targetedArea.find('.wpacu_regex_load_rule_textarea');
            
            //console.log(_wpacuUnloadViaRegExTextareaEl);
            //console.log(_wpacuLoadViaRegExTextareaEl);
            
            let wpacuUnloadViaRegExTextareValue = _wpacuUnloadViaRegExTextareaEl.val();
            let wpacuLoadViaRegExTextareValue   = _wpacuLoadViaRegExTextareaEl.val();
            
            //console.log(wpacuUnloadViaRegExTextareValue);
            //console.log(wpacuLoadViaRegExTextareValue);
            
            // Both textareas need to have values and both with the same values
            if (wpacuUnloadViaRegExTextareValue &&
            	wpacuLoadViaRegExTextareValue   &&
            	wpacuUnloadViaRegExTextareValue === wpacuLoadViaRegExTextareValue) {
	            wpacuSwal.fire({
	                width: 650,
	                icon: "warning",
	                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textRegExHasSameValuesForLoadUnloadConfirm}",
	                html: "{$textRegExHasSameValuesForLoadUnloadMsg}"
	            }).then(function() {
                    _wpacuUnloadViaRegExTextareaEl . addClass('wpacu-shake-horizontal');
                    _wpacuLoadViaRegExTextareaEl   . addClass('wpacu-shake-horizontal');
                    
                    setTimeout(function() {
	                    _wpacuUnloadViaRegExTextareaEl . removeClass('wpacu-shake-horizontal');
	                    _wpacuLoadViaRegExTextareaEl   . removeClass('wpacu-shake-horizontal');
                    }, 500);
	            });
            }
        }
    });

    var wpacuPluginPath, wpacuUnloadLoggedInTarget, wpacuLoadLoggedInTarget, wpacuUnloadHomePageTarget, wpacuLoadHomePageTarget;
    
    $(document).on('change focusout blur', '.wpacu_plugin_unload_logged_in, .wpacu_plugin_load_exception_logged_in', function() {
        wpacuPluginPath = $(this).attr('data-wpacu-plugin-path');
        wpacuUnloadLoggedInTarget = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_unload_logged_in';
        wpacuLoadLoggedInTarget = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_load_exception_logged_in';
 
        if ($(wpacuUnloadLoggedInTarget).prop('checked') && $(wpacuLoadLoggedInTarget).prop('checked')) {
           $(wpacuUnloadLoggedInTarget).prop('checked', false).parent().removeClass('wpacu_plugin_unload_rule_input_checked');
           $(wpacuLoadLoggedInTarget).prop('checked', false).parent().removeClass('wpacu_plugin_load_rule_input_checked');
           
           wpacuSwal.fire({
				width: 600,
				icon: "info",
				confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textPluginLoadUnloadLoggedInConfirm}",
				html: "{$textPluginLoadUnloadLoggedInMsg}"
           });

           return false;
         }
    });
    
    $(document).on('change focusout blur', '.wpacu_plugin_unload_home_page, .wpacu_plugin_load_home_page', function() {
        wpacuPluginPath = $(this).attr('data-wpacu-plugin-path');
        wpacuUnloadHomePageTarget = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_unload_home_page';
        wpacuLoadHomePageTarget = 'input[data-wpacu-plugin-path="'+ wpacuPluginPath +'"].wpacu_plugin_load_home_page';
 
        if ($(wpacuUnloadHomePageTarget).prop('checked') && $(wpacuLoadHomePageTarget).prop('checked')) {
           $(wpacuUnloadHomePageTarget).prop('checked', false).parent().removeClass('wpacu_plugin_unload_rule_input_checked');
           $(wpacuLoadHomePageTarget).prop('checked', false).parent().removeClass('wpacu_plugin_unload_rule_input_checked');
               
           wpacuSwal.fire({
                width: 600,
                icon: "info",
                confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textPluginLoadUnloadHomepageConfirm}",
                html: "{$textPluginLoadUnloadHomepageMsg}"
            });

           return false;
         }
    });
    
    // [Manage via post type]
    $('.wpacu_plugin_manage_via_post_type_dd').on('change focusout blur', function (event, params) {
        let wpacuPluginPath 		     = $(this).parent().attr('data-wpacu-plugin-path');
        let _targetedArea  		         = $('div[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        let _ddManageViaPostTypeUnload   = _targetedArea.find('select.wpacu_plugin_manage_unload_via_post_type');
        let _ddManageViaPostTypeLoad     = _targetedArea.find('select.wpacu_plugin_manage_load_via_post_type');
        
        let valuesFromUnloadViaPostType  = _ddManageViaPostTypeUnload.val();
        let valuesFromLoadViaPostType    = _ddManageViaPostTypeLoad.val();
        
        let _inputCheckboxPostTypeUnload = $('input.wpacu_plugin_unload_via_post_type[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        let _inputCheckboxPostTypeLoad   = $('input.wpacu_plugin_load_via_post_type[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        if (valuesFromUnloadViaPostType.length > 0 && valuesFromLoadViaPostType.length > 0) {
            valuesFromUnloadViaPostType.sort();
              valuesFromLoadViaPostType.sort();
            
            let valuesListFromUnloadViaPostType = valuesFromUnloadViaPostType.join(',');
            let valuesListFromLoadViaPostType   = valuesFromLoadViaPostType.join(',');
            
            if (valuesListFromUnloadViaPostType === valuesListFromLoadViaPostType) {
                _inputCheckboxPostTypeUnload.parent().removeClass('wpacu_plugin_unload_rule_input_checked');
                _inputCheckboxPostTypeUnload.prop('checked', false) . trigger('change') ;
        		  _ddManageViaPostTypeUnload.find('option:selected').removeAttr('selected');
				  _ddManageViaPostTypeUnload.trigger('chosen:updated');
                
                  _inputCheckboxPostTypeLoad.parent().removeClass('wpacu_plugin_load_rule_input_checked');
                  _inputCheckboxPostTypeLoad.prop('checked', false) . trigger('change');
        		    _ddManageViaPostTypeLoad.find('option:selected').removeAttr('selected');
				    _ddManageViaPostTypeLoad.trigger('chosen:updated');

				wpacuSwal.fire({
				    width: 600,
				    icon: "info",
				    confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textPluginManageOnPostTypePageConflictConfirm}",
				    html: "{$textPluginManageOnPostTypePageConflictMsg}"
				});

				return false;
	         }
        }
	});
    // [/Manage via post type]
    
     $('.wpacu_plugin_manage_via_tax_dd').on('change focusout blur', function (event, params) {
        let wpacuPluginPath 		= $(this).parent().attr('data-wpacu-plugin-path');
        let _targetedArea  		    = $('div[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        let _ddManageViaTaxUnload   = _targetedArea.find('select.wpacu_plugin_manage_unload_via_tax');
        let _ddManageViaTaxLoad     = _targetedArea.find('select.wpacu_plugin_manage_load_via_tax');
        
        let valuesFromUnloadViaTax  = _ddManageViaTaxUnload.val();
        let valuesFromLoadViaTax    = _ddManageViaTaxLoad.val();
        
        let _inputCheckboxTaxUnload = $('input.wpacu_plugin_unload_via_tax[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        let _inputCheckboxTaxLoad   = $('input.wpacu_plugin_load_via_tax[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        if (valuesFromUnloadViaTax.length > 0 && valuesFromLoadViaTax.length > 0) {
            valuesFromUnloadViaTax.sort();
              valuesFromLoadViaTax.sort();
            
            let valuesListFromUnloadViaTax = valuesFromUnloadViaTax.join(',');
            let valuesListFromLoadViaTax   = valuesFromLoadViaTax.join(',');
            
            if (valuesListFromUnloadViaTax === valuesListFromLoadViaTax) {
                _inputCheckboxTaxUnload.parent().removeClass('wpacu_plugin_unload_rule_input_checked');
                _inputCheckboxTaxUnload.prop('checked', false) . trigger('change') ;
        		  _ddManageViaTaxUnload.find('option:selected').removeAttr('selected');
				  _ddManageViaTaxUnload.trigger('chosen:updated');
                
                  _inputCheckboxTaxLoad.parent().removeClass('wpacu_plugin_load_rule_input_checked');
                  _inputCheckboxTaxLoad.prop('checked', false) . trigger('change');
        		    _ddManageViaTaxLoad.find('option:selected').removeAttr('selected');
				    _ddManageViaTaxLoad.trigger('chosen:updated');

				wpacuSwal.fire({
				    width: 600,
				    icon: "info",
				    confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textPluginManageOnTaxPageConflictConfirm}",
				    html: "{$textPluginManageOnTaxPageConflictMsg}"
				});

				return false;
	         }
        }
	});

    $('.wpacu_plugin_manage_via_archive_dd').on('change focusout blur', function (event, params) {
        let wpacuPluginPath 			= $(this).parent().attr('data-wpacu-plugin-path');
        let _targetedArea  				= $('div[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        let _ddManageViaArchiveUnload   = _targetedArea.find('select.wpacu_plugin_manage_unload_via_archive');
        let _ddManageViaArchiveLoad 	= _targetedArea.find('select.wpacu_plugin_manage_load_via_archive');
        
        let valuesFromUnloadViaArchive  = _ddManageViaArchiveUnload.val();
        let valuesFromLoadViaArchive    = _ddManageViaArchiveLoad.val();
        
        let _inputCheckboxArchiveUnload = $('input.wpacu_plugin_unload_via_archive[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        let _inputCheckboxArchiveLoad   = $('input.wpacu_plugin_load_via_archive[data-wpacu-plugin-path="'+ wpacuPluginPath +'"]');
        
        if (valuesFromUnloadViaArchive.length > 0 && valuesFromLoadViaArchive.length > 0) {
            valuesFromUnloadViaArchive.sort();
              valuesFromLoadViaArchive.sort();
            
            let valuesListFromUnloadViaArchive = valuesFromUnloadViaArchive.join(',');
            let valuesListFromLoadViaArchive   = valuesFromLoadViaArchive.join(',');
            
            if (valuesListFromUnloadViaArchive === valuesListFromLoadViaArchive) {
                _inputCheckboxArchiveUnload.parent().removeClass('wpacu_plugin_unload_rule_input_checked');
                _inputCheckboxArchiveUnload . prop('checked', false) . trigger('change');
        		_ddManageViaArchiveUnload.find('option:selected').removeAttr('selected');
				_ddManageViaArchiveUnload.trigger('chosen:updated');
                
                _inputCheckboxArchiveLoad.parent().removeClass('wpacu_plugin_load_rule_input_checked');
                _inputCheckboxArchiveLoad . prop('checked', false)  . trigger('change');
        		_ddManageViaArchiveLoad.find('option:selected').removeAttr('selected');
				_ddManageViaArchiveLoad.trigger('chosen:updated');

				wpacuSwal.fire({
				    width: 600,
				    icon: "info",
				    confirmButtonText: "<span class='dashicons dashicons-thumbs-up'></span> {$textPluginManageOnArchivePageConflictConfirm}",
				    html: "{$textPluginManageOnArchivePageConflictMsg}"
				});

				return false;
	         }
        }
	});
});
JS;
		wp_add_inline_script(OwnAssets::$ownAssets['scripts']['sweetalert2']['handle'], $sweetAlertTwoScriptInline);
		/*
		 * [END] SweetAlert (Pro features)
		 */
	}
}
