=== Asset CleanUp Pro: Page Speed Booster ===
Contributors: gabelivan
Tags: minify css, minify javascript, defer css javascript, page speed, dequeue, performance
Requires at least: 4.6
Tested up to: 6.7.1
Stable tag: 1.2.6.4
License: Commercial

There are often times when you are using a theme and a number of plugins which are enabled and run on the same page. However, you don't need to use all of them and to improve the speed of your website and make the HTML source code cleaner (convenient for debugging purposes), it's better to prevent those styles and scripts from loading.

== Changelog ==
= <strong>1.2.6.4</strong> - 4 Feb 2025
* New Feature For The Admin: "Settings" -- "Plugin Usage Preferences" -- "Announcements" / The admin would be notified within the Dashboard (if he/she prefers) of critical updates, new features, usage tips, special offers / read more: https://www.assetcleanup.com/docs/?p=1946
* Make sure plugin generated STYLE/SCRIPT inline tags (e.g. from features such as "Inline CSS/JS") have the "type" attribute (unless the theme supports HTML5) / read more: https://www.assetcleanup.com/docs/?p=2086
* New Option in "Settings" -- "Plugin Usage Preferences" - "Plugins Manager" - "IN FRONTEND VIEW (your visitors)": "Additional Query Strings to Ignore for Homepage Detection" (new option to add extra query strings to be ignored for early homepage detection) / read more: https://www.assetcleanup.com/docs/?p=2130
* Added "Plugins Manager" tab to "Settings" -- "Plugin Usage Preferences": Configure settings related to the plugins loaded in both the front-end and the /wp-admin/ area; Tthe same settings were already added in the "Plugins Manager" main area; URI: /wp-admin/admin.php?page=wpassetcleanup_plugins_manager
* Moved "CSS/JS Cache" tab into the "CSS/JS Manager" one and grouped options within the 'CSS/JS Manager' (for better readability)
* Fix / Notice: "Function _load_textdomain_just_in_time was called incorrectly. Translation loading for the 'wp-asset-clean-up' domain was triggered too early."

= <strong>1.2.6.3</strong> - 30 Jan 2025
* Improvement: Plugin Updater / When using /?wpacu_force_plugin_updater in the Dashboard (e.g. in the "Plugins" page), the cache related to the latest detected version is cleared (e.g. in case the admin has problems updating the plugin, the query string can be used, before re-trying the plugin update)
* Improvement: "Plugins Manager" - Added the "currency" query string to the list of common strings that are ignored when an early detection is made for the homepage (e.g. www.yoursite.com/?currency=EUR is considered the homepage)
* Fix: "Plugins Manager" - "IN FRONTEND VIEW (your visitors)" / "Enable all the rules below" option / Make sure it always updates on click as there were issues with it in the previous release
* Fix: "Plugins Manager" - Sometimes, while being in the "IN FRONTEND VIEW (your visitors)" tab, errors were showing for the "IN THE DASHBOARD /wp-admin/", thus, confusing the admin

= <strong>1.2.6.2</strong> - 14 Jan 2025
* New option for unloading whole plugins within the Dashboard (/wp-admin/): on admin pages with at least one plugin unloaded (depending on the rules set in "Plugins Manager" -- " IN THE DASHBOARD /wp-admin/"), restore the sidebar as it used to be when there were no plugins unloaded, in case there are missing menu links from the unloaded plugins (for a better user experience) / more: https://www.assetcleanup.com/docs/?p=1923

= <strong>1.2.6.1</strong> - 22 Dec 2024
* Fix - Error message: Uncaught TypeError: in_array(): Argument #2 ($haystack) must be of type array, string given in [...]/templates/_admin-page-settings-plugin-areas/_plugin-usage-settings/_access.php:43
* Fix - PHP Deprecated: trim(): Passing null to parameter #1 ($string) of type string is deprecated in [...]/classes/OptimiseAssets/OptimizeCommon.php on line 994
* Fix - PHP Warning: Undefined global variable $wpassetcleanup_external_srcs_ref
* Fix - PHP Warning: preg_match(): Compilation failed: regular expression is too large at offset [...] / Location: /classes/OptimiseAssets/OptimizeJs.php on line 985
* Fix for "Media Query Load": Avoid any errors in case the targeted attribute is not found and the rule cannot be applied (e.g. another optimisation plugin altered the LINK/SCRIPT tag) / Example: "Uncaught TypeError: Cannot read properties of undefined (reading 'getAttribute')"
* Updated the external links to the help pages

= <strong>1.2.6.0</strong> - 2 Dec 2024
* Fix: Server Side Request Forgery (SSRF) has been discovered on an AJAX call within the CSS/JS manager; New parameters were added to the call to avoid any unsanitized input

= <strong>1.2.5.9</strong> - 19 Nov 2024
* Fix: Avoid deprecated PHP notice if PHP version >= 8.1; A "null" parameter was passed to the native WordPress function add_submenu_page(), instead of an empty string ''
* Fix: The jQuery Chosen drop-down wasn't applied for "On these taxonomy pages:"
* Fix: "Warning Undefined array key" in case a hardcoded handle is not in the list of handles information
* Fix: When using Query Monitor, the "Update" button from the CSS/JS manager was showing up on top of the bottom Query Monitor data

= <strong>1.2.5.8</strong> - 31 Aug 2024
* Reduce the total number of SQL queries used to obtain information
* Stop triggering PHP code and SQL queries on pages where they are not relevant
* Cache SQL queries that are time consuming, which is ideal for websites with a very large database (e.g. tens / hundred of thousands of users)

= <strong>1.2.5.7</strong> - 22 Aug 2024
* Fix: The "usermeta" table is populated with duplicate entries, leading to a larger database, and sometimes, leading to a high CPU usage

= <strong>1.2.5.6</strong> - 17 Aug 2024
* New Option: "Settings" -- "Plugin Usage Preferences" -- "Plugin Access" / Choose user roles or particular users, apart from administrators, that could have access to the plugin area * e.g. the admin could give Asset CleanUp Pro access within the Dashboard to a developer that is optimizing the website, but the developer does not have the "administrator" role for security reasons
* "wpacu_access_role" filter is no longer active (related to the option mentioned above), as it wasn't 100% effective into changing who accesses the Asset CleanUp Pro area
* "Nextend Social Login and Register" plugin compatibility / Make sure the homepage is still detected if the following query string is in the URI: "nsl_bypass_cache"

= <strong>1.2.5.5</strong> - 5 Aug 2024
* Improvement: When using specific themes, the navigation sub-tabs from the "CSS & JS Manager" were overwritten by the theme's style (added unique references to the HTML classes)
* Improvement: Clear cache after "Plugin Manager" form is submitted (some plugins might load specific assets, and a cache clearing is recommended)

= <strong>1.2.5.4</strong> - 27 Jul 2024
* Fix: After a theme is switched, there's sometimes a browser error showing up related to multiple failed redirects
* Fix: Sometimes, the verification of a valid URL fails (e.g. fonts.googleapis.com), and its size is not show in the CSS/JS manager
* Fix: PHP Warning - Undefined array key "within_conditional_comments" in [...]/wp-content/plugins/wp-asset-clean-up-pro/pro/classes/PositionsPro.php on line 245

= <strong>1.2.5.3</strong> - 15 Jul 2024
* Added the option to load an asset as an exception on all taxonomy / author pages / e.g. when a site-wide unloading rule is set, you can make a load exception and load the asset on all "category" taxonomy pages
* Make sure the red background is kept whenever a load exception is unchecked if there was already an unloading rule set (this is more for aesthetics reasons)
* Prevent possible is_file() errors whenever minify CSS/JS is enabled
* Whenever the following option is enabled, the META generator tags are stripped faster after being cached: 'HTML Source CleanUp' -- 'Remove All "generator" meta tags?'
* If the menu from the sidebar is not showing up, make sure that "Asset CleanUp Pro" from "Settings" (Dashboard sidebar) is always highlighted, whenever a plugin page is visited
* Change the way the plugin submenu is created to avoid, in some environments, errors such as the following one: "NOTICE: PHP message: PHP Warning: Undefined array key 2 in /wordpress/wp-admin/includes/plugin.php on line 2012"
* Hardcoded assets: When altering any hardcoded asset, make sure that prior to this, only the assets that are needed are fetched to save resources (e.g. if only LINK tags have to be altered, do not fetch at all any SCRIPT tags)
* Fix: Sometimes errors were showing up related to bulk unloads whenever the CSS/JS manager was updated

= <strong>1.2.5.2</strong> - 19 Jun 2024
* CSS Minifier Improvement: Specific "var()" statements were minified incorrectly in Bootstrap / more: https://github.com/matthiasmullie/minify/issues/422
* Fix: When CSS files about to be optimised (e.g. minified) contain "@import", make sure the fetching and the combining of the imported CSS files is done properly (e.g. instead of loading five CSS files, only one will load, as the other four will be merged into the main one that had the @import in the first place)
* Fix: In some environments that have PHP 8+ installed, when non-admin users were logging-in an error was showing up: Uncaught TypeError: in_array(): Argument #2 ($haystack) must be of type array, string given
* Fix: When using WP CLI (or something similar) and PHP 8.1+ is installed, a harmless error is showing up due to the fact that the global $_SERVER variable had missing keys / e.g. $_SERVER['REQUEST_URI'] is not detected, leading to an error such as "rtrim(): Passing null to parameter #1 ($string) of type string is deprecated"

= <strong>1.2.5.1</strong> - 15 Jun 2024
* Backend Speed Improvement: The plugin processes its PHP code faster, thus reducing the total processing time by ~40 milliseconds for non-cached pages (e.g. backend speed testing plugins such as "Query Monitor" and "Code Profiler" were used to optimize the PHP code)
* "Overview" area: Added the option to clear any rules set for plugins that are deactivated / deleted
* Fix: Sometimes rules were applied to hardcoded assets incorrectly as different tags without content were considered to be the same
* Fix: Make sure the "Update" button is disabled when submitting the form from the CSS/JS manager
* Fix in the "CSS/JS manager" area: If an attribute is set (e.g. "defer') to show "everywhere", make sure that "On this page" is not checked
* Fixes in "Overview" area: If an attribute is set (e.g. "defer") to show "everywhere", it shows multiple times (instead of just once) when WPML plugin is enabled; If the path to the site URL was e.g. domain.com/blog, the "href" value from "Overview" was not including the "blog" path, causing "404 Not Found" errors and confusing the administrator

= <strong>1.2.5.0</strong> - 11 April 2024
* Added "wp wpacu update" CLI command to be used in updating the plugin, in case the most recent version doesn't show yet in the list from "wp plugin list" (basically, it attempts a "force" download of the latest version)
* Fix: "JavaScript" was shown instead of "stylesheet" when specific unload rules were applied
* Fix: Make sure the right message is shown to the popup that has a loading spinner (e.g. when the rules from "Plugins Manager" were all turned off, the message from clearing the cache was shown instead)

= <strong>1.2.4.9</strong> - 27 February 2024
* "Plugins Manager": Allow the option to unload a plugin depending on the logged-in user role (e.g. for a "subscriber" that has access to the Dashboard, specific plugins that you know are useless for this type of user, could be unloaded to make the Dashboard load faster)
* CSS/JS manager: When the "src" of a SCRIPT tag or "href" of a LINK tag starts with "data:text/javascript;base64," and "data:text/css;base64," respectively, a note will be shown with the option to view the decoded CSS/JS code
* Improvement: Added the option to change the way the assets are retrieved ("Direct" as if the admin is visiting the page /  "WP Remote POST" as if a guest is visiting the page) from the CSS & JS manager within the Dashboard (for convenience, to avoid going through the "Settings" as it was the case so far)
* Fix: In some environments, the tags with "as" attribute were not properly detected (e.g. when "DOMDocument" is not enabled by default in the PHP configuration)

= <strong>1.2.4.8</strong> - 31 January 2024
* Improvement: Apply "font-display:" CSS property for Google Fonts when they are loaded via Web Font Loader (source: https://github.com/typekit/webfontloader)
* Plugin's "License" page: When the information is fetched, make sure the AJAX call is never cached to make sure the latest information is always shown
* Higher accuracy in detecting the "type" and "data-alt-type" attribute before determining if an inline SCRIPT tag has to be minified
* Fix: Make sure "WP Super Cache" & "W3 Total Cache" plugins are working fine when caching pages if "Smart Slider 3" plugin is enabled

= <strong>1.2.4.7</strong> - 9 November 2023
* Rank Math & other SEO plugins compatibility: Prevent Asset CleanUp Pro from triggering, thus saving extra resources, whenever URIs such as /sitemap_index.xml are loaded to avoid altering the XML structure or generate 404 not found errors
* Plugins Manager: Make sure the user roles from "If the logged-in user has any of these roles:" are translated into the language chosen for the current admin to avoid any confusion (e.g. if the language chosen in the admin's profile is German, then show "Abonnent" instead of "Subscriber")
* CSS/JS Minifier: Prevent calling @is_file() when it's not the case to avoid on specific environments errors such as: "is_file(): open_basedir restriction in effect"

= <strong>1.2.4.6</strong> - 28 October 2023
* Preload CSS feature: When a .css file is preloaded (Basic), the "media" attribute is preserved if it's not missing and different than "all"
* "Rank Math SEO" & "Premmerce" plugin compatibility: Prevent Asset CleanUp Pro's "Plugins Manager" rules from triggering when the permalinks are updated
* Combine CSS Fix / The preload and stylesheet LINK tags had the same "id" attribute which shouldn't be like that as the "id" should be unique for each HTML element
* Fix / In rare cases, the following error is printed: 'Fatal error: Uncaught ValueError: DOMDocument::loadHTML(): Argument #1 ($source) must not be empty within the method "cleanerHtmlSource" inside the "OptimizeCommon" class'

= <strong>1.2.4.5</strong> - 13 October 2023
* Fix: On some environments, the following error would show up when WP CLI is used: "PHP Fatal error: Uncaught Error: Call to a member function getScriptAttributesToApplyOnCurrentPage() on null"
* Fix: When the CSS/JS is managed in the front-end, the styling for the hardcoded assets was broken when the list was sorted via location
* Fix: Specific HTML code (unique signatures belonging to Asset CleanUp Pro) that was no longer relevant after optimizing the HTML source was not completely removed as it should be (in order to leave a cleaner HTML source code and not confuse the admin)
* Hardcoded assets: When an asset was moved from HEAD to BODY or vice-versa, make sure a notice is placed there in the hardcoded row (when managing the assets) that it had its position changed just like it's done for the enqueued assets
* Improvement: Removed unused PHP code from specific files

= <strong>1.2.4.4</strong> - 7 October 2023
* Hardcoded assets: They can be moved from <HEAD> to <BODY> and vice-versa just like the enqueued assets
* Hardcoded assets: Can be preloaded, loaded based on the media query, deferred/asynched just like the enqueued assets (for <SCRIPT> tags with the "src" attribute & <LINK> tags with the "href" attribute)
* Hardcoded assets' sorting: The assets are now sorted based on the option chosen in "Assets List Layout:" (e.g. if you sort them by their size, you can view the hardcoded assets from the largest one to the the smallest)
* Styling Improvement: Anything from "Settings" related to removal of something (e.g. Google Fonts) has a new style of the switcher (the styled checkbox), now showing a dark red background; This looks the same as the one from the CSS/JS manager for "Unload on this page".
* Fix: If the following option is set to "Standard" (from "Settings" -- "Plugin Usage Preferences" -- "Accessibility"), make sure that the rule applies to any form field from the plugin, including the <SELECT> one
* Fix: Error message: Uncaught TypeError: strpos(): Argument #1 ($haystack) must be of type string, array given in [...]/wpacu.php:185 / This triggered whenever the "page" query string was used as an array / e.g. /wp-admin/admin.php?page[]=value

= <strong>1.2.4.3</strong> - 21 September 2023
* "WPML Multilingual CMS" plugin compatibility: Whenever CSS/JS are managed within a category/tag (taxonomy type) or a custom one such as "product_cat" from WooCommerce, the changes made on a page level (e.g. unloading a CSS file on a specific category) will also reflect on any of its associated translated taxonomies / e.g. changes for English - /product-category/clothing/ - will also apply for Spanish: /es/product-category/ropa/
* "GTranslate" plugin compatibility: The JavaScript handle starting from "gt_widget_script_" and having a random number on each page reload gets an alias ("gt_widget_script_gtranslate") to avoid misinterpretation that the asset is a different one on each page reload (this way it could be unloaded, preloaded, etc.)
* More options (in order to be prevented from loading on specific pages, if necessary) were added to the drop-down here: "Settings" -- "Plugin Usage Preferences" -- "Do not load on specific pages" -- "Prevent features of Asset CleanUp Pro from triggering on specific pages"
* Fix: Sometimes the "src" value was detected incorrectly on hardcoded assets due to the fact that the string "src=" was inside document.write() within the <SCRIPT> tags (which had no "src" attribute at all) / e.g. <script type="text/javascript">console.log('test'); document.write('<scri' + 'pt src="//path-to-specific-file.js"></sc' + 'ript>');</script>

= <strong>1.2.4.2</strong> - 16 September 2023
* New Option: "Settings" -- "Plugin Usage Preferences" - "Do not load on specific pages" -- "Prevent features of Asset CleanUp Pro from triggering on specific pages"; This allows you to stop triggering specific plugin features on certain pages (e.g. you might want to prevent combining JavaScript files on all /product/ (WooCommerce) pages due to some broken functionality on those specific pages)
* Combined CSS/JS improvements: Whenever a file from a plugin or a theme is updated by the developer/admin, there's no need to clear the cache afterwards, as sometimes, users forget about this; the plugin automatically recognizes the change and a new combined CSS/JS is created and re-cached
* Improvement: Fallback for clearing CSS/JS cache when using the top admin bar link; it will just trigger by reloading the page if, for any reason, Asset CleanUp Pro functions fail to load there (e.g. in rare cases, plugin/theme developers prevent 3rd party assets to load on their admin pages for various reasons); this fallback is triggering on admin pages unrelated Asset CleanUp Pro's plugin pages (e.g. a settings page of a different plugin)

= <strong>1.2.4.1</strong> - 9 September 2023
* "Plugins Manager" - A new option was added to both "IN FRONTEND VIEW (your visitors)" and "IN THE DASHBOARD /wp-admin/" (in case it's activated, as it's a special feature) to disregard all rules from taking effect in case there are issues with any plugin rules for debugging purposes (any rules placed there will be kept as they are; this feature will just instruct Asset CleanUp Pro to not take them into consideration)
* Cache Clearing: Whenever the caching is cleared within any plugin page through the available links (from the top admin bar and the top right side of the plugin's area) a notification about the action is shown with a preloader until the cache is cleared (the page doesn't reload as the cache clearing is made in the background)
* If "Input Fields Style:" is set to "Standard" (for people having difficulties accessing the fancy input fields) within "Settings" -- "Plugin Usage Preferences" -- "Accessibility", the setting will also apply to jQuery Chosen drop-downs, turning them into regular HTML drop-downs (with either one or multiple options to choose from)
* "Settings" -- "Plugin Usage Preferences": Re-organised the tab contents from into multiple sub-tabs for easier access and understanding the options

= <strong>1.2.4.0</strong> - 4 September 2023
* Added the option to make the browser download the file only if its current media query is matched (in case the "media" attribute is different from "all") / read more: https://www.assetcleanup.com/docs/?p=1023#case-two

= <strong>1.2.3.9.1</strong> - 22 August 2023
* Improvement: In very rare cases in the "options" table, if "page_on_front" has a value and "show_on_front" is set to "posts" (this happens when there's an incomplete update of the settings in the database), it will confuse Asset CleanUp Pro and consider that "Your homepage displays" is actually set to "A static page" which is wrong
* Fix: An error was showing when the admin accessed the "License" page

= <strong>1.2.3.9</strong> - 18 August 2023
* Improvement: The plugin is optimised to load fewer functions then before (e.g. PHP classes that aren't required on the targeted page) in order to reduce the total front-end optimization time
* "WooCommerce" plugin compatibility: Avoid using extra resources in Asset CleanUp Pro to process specific CSS files (they are loading after the latest WooCommerce plugin release) that are already minified
* Fix: In specific environments that loaded similar code to the one from Asset CleanUp Pro, errors were showing up, thus more uniqueness had to be added to avoid conflicts such as unique PHP namespaces

= <strong>1.2.3.8.1</strong> - 10 August 2023
* "SiteGround Optimizer" plugin compatibility: When enabled, on some environments, errors are triggering if Asset CleanUp Pro's JavaScript minify option is turned on
* Fix: When "WP Remote Post" was used as a fetch method of the CSS/JS assets within the Dashboard, information about the targeted URL was showing up twice (e.g. the admin could be confused of viewing redundant text printing out)

= <strong>1.2.3.8</strong> - 6 August 2023
* "Plugins Manager": Added option to unload or load as an exception plugins if the current logged-in user has a specific role (e.g. administrator, subscriber, editor, shop manager, etc.) / read more: https://assetcleanup.com/docs/?p=1688
* "GiveWP" plugin compatibility: Prevent Asset CleanUp Pro from loading whenever the URI is like /give/donation-form?giveDonationFormInIframe=1 as the page loaded within the iFrame is already optimized and there are users that had problems when Asset CleanUp Pro was triggering its rules there
* "GiveWP" plugin compatibility: Prevent CSS/JS minification as the files are already optimized and there's no point in wasting extra resources
* Dashboard: Whenever the clear caching link is used, after the clearance, a notice is shown to the admin about this and the clearance date and time
* Fix: Make sure 'post__in' is never empty when called within a WP_Query whenever a post search is made within "CSS & JS Manager" -- "Manage CSS/JS"
* Plugin Settings: Replaced text that sometimes caused confusion (e.g. some people didn't notice the small "if" and thought their caching directory is not writable)

= <strong>1.2.3.7.1</strong> - 31 July 2023
* Fix: On some environments, FS_CHMOD_DIR and FS_CHMOD_FILE weren't defined, triggering errors such as: Uncaught Error: Undefined constant "WpAssetCleanUp\FS_CHMOD_DIR"

= <strong>1.2.3.7</strong> - 30 July 2023
* WordPress 6.3 compatibility: Updated the code to avoid the following notice: "Function WP_Scripts::print_inline_script is deprecated since version 6.3.0"
* "WPML Multilingual CMS" plugin compatibility: Whenever "Unload on the homepage" is used in "Plugins Manager" (or a load exception rule), the rule will apply for any language that is set (e.g. www.mydomain.com/es, www.mydomain.com/de, www.mydomain.com/fr)
* "Site Kit by Google" plugin compatibility: JavaScript files from this plugin are added to the ignore list to avoid minifying as they are already minified (with just a few extra comments) and minifying them again, due to their particular structure, resulted in JS errors in the browser's console
* Improvement: Changed the name of the cached files to make them more unique as sometimes, handles that had UNIX timestamps and random strings (developers use them for various reason, including debugging), were causing lots of redundant files to be generated in the assets' caching directory
* Added jQuery Migrate script to the ignore list to avoid minifying it (along with jQuery leave it as it is, if the developer decided to load the large versions of the files, for debugging purposes)
* "Plugins Manager": Added extra queries to the ignoring list when unloading (or loading as an exception) the homepage (e.g. www.mysite.com/?utm_source=...&ref=... will be treated like www.mysite.com); If there's a query that is not within the ignore list, the URL won't be considered a homepage: www.mysite.com/?ajax-action=value-here&nocache=... (even if "nocache" is in the ignore list, "ajax-action" isn't and this suggests that an action is taking place and the URL is not actually the regular homepage that is visited)
* Fix: Use the same "chmod" values from FS_CHMOD_DIR and FS_CHMOD_FILE (WordPress constants) for all the files and directories from the assets' caching directory when attempting to create a file/directory to avoid permission errors on specific environments

= <strong>1.2.3.6</strong> - 26 July 2023
* "WPML Multilingual CMS" compatibility: Syncing post changes on all its associated translated posts / e.g. if you unload an asset on a page level in /contact/ (English) page, it will also be unloaded (synced) in /contacto/ (Spanish) and /kontakt/ (German) pages
* "WP Rocket" compatibility: "Settings" -- "Optimize JavaScript" -- "Combine loaded JS (JavaScript) into fewer files" is automatically disabled when the following option is turned on in "WP Rocket": "File Optimization" -- "JavaScript Files" -- "Delay JavaScript execution"
* "WP Rocket" compatibility: "Settings" -- "Optimize CSS" -- "Defer CSS Loaded in the <BODY> (Footer)" is automatically set to "No" whenever the following option is turned on in "WP Rocket": "File Optimization" -- "Optimize CSS delivery" -- "Remove Unused CSS".
* "Hide My WP Ghost – Security Plugin" compatibility: Asset CleanUp Pro's HTML alteration is done before the one of the security plugin so minify/combine CSS/JS will work fine
* Front-end view: In the "Asset CleanUp Pro" top admin bar menu, a new link is added that goes directly to the manage CSS/JS area for the current visited page for convenience
* Remove the usage of "/wp-content/cache/storage/_recent_items" directory from the CSS/JS caching directory as it was redundant to the caching functionality

= <strong>1.2.3.5</strong> - 18 July 2023
* "Plugins Manager": Option to unload & load plugins as an exception (from any unload rule) on the following built-in WordPress pages: Search, Author & Date / read more: https://assetcleanup.com/docs/?p=1647
* "Plugins Manager": Option to contract / expand the plugins for easier management, which could be effective when having lots of plugins activated (the contract/expand state is remembered after the click)
* Fix: When plugins are unloaded via "Plugins Manager" and flush_rewrite_rules() is called in plugins/themes (which is a rare thing and an expensive operation), the rewrite rules from "wp_options" ('rewrite_rules' option) could be re-updated incompletely (since some plugins that had rules weren't loaded at the time); This sometimes led the website's administrator to go to "Settings" -- "Permalinks" and manually re-update the settings

= <strong>1.2.3.4</strong> - 9 July 2023
* "Plugins Manager": Ability to unload plugins (and load them as an exception from any unload rule) on all other taxonomy pages that are detected from other plugins/themes, apart from the default WordPress ones ("category", "post_tag") and some popular ones from WooCommerce: "product_cat" & "product_tag"
* Option to skip "Cache Enabler" cache clearing via using the "WPACU_DO_NOT_ALSO_CLEAR_CACHE_ENABLER_CACHE" constant (e.g. set to 'true' in wp-config.php) - read more: https://www.assetcleanup.com/docs/?p=1502#wpacu-cache-enabler
* "Knowledge Base for Documents and FAQs" plugin: Do not show the CSS/JS manager at the bottom of the page when "Edit KB Article Page" is ON
* New "Brizy - Page Builder" setup: Prevent Asset CleanUp Pro from triggering when the editor is ON
* Fix: "Do not load Asset CleanUp Pro on this page (this will disable any functionality of the plugin)" - if turned ON, make sure the hardcoded list loads fine in the front-end view (Manage CSS/JS)

= <strong>1.2.3.3</strong> - 1 July 2023
* "Overview" area: Added notifications about deleted posts, post types, taxonomies and users, making the admin aware that some rules might not be relevant anymore (e.g. the admin uninstalled WooCommerce, but unload rules about "product" post types or a specific product page remained in the database)
* Stopped using the "error" class (e.g. on HTML DIV elements) and renamed it to "wpacu-error" as some plugins/themes sometimes interfere with it (e.g. not showing the error at all, thus confusing the admin)
* Keep the same strict standard for the values within the following HTML attributes: "id", "for" to prevent any errors by avoiding any interferences with other plugins
* Fix: Some rules were not fully exported & imported (e.g. the rules from "termmeta" and "usermeta" tables)
* PHP 8.2.7 compatibility

= <strong>1.2.3.2</strong> - 11 May 2023
* New Option: Contract / Expand All Assets within an area (e.g. from a plugin)
* Improvement: Offer a fallback method to fetch the author's information on the author archive page (when unload rules are set within author archive pages)
* Improvement: Only print the notice (as an HTML comment) about the "photoswipe" unload to the administrator (it's a special case where the HTML has to be hidden in case the CSS file gets unloaded)
* Fix: In specific WordPress environments, when rules in "Plugins Manager" are used related to the page type (e.g. unload on all pages belonging to a specific post), the permalinks are not working as expected and they have to be resaved within the Dashboard
* Fix: 'PHP Deprecated: str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated in [...]/pro/early-triggers-pro.php'

= <strong>1.2.3.1</strong> - 2 March 2023
* Improvement: Avoid deprecated errors related to PHP 8+ (although harmless, they are annoying to notice in the error_log files)
* Improvement: When using plugins such as "Learndash", the post types weren't detected in the permalinks structure when plugin unload rules had to be applied
* Fix / PHP Warning: Undefined array key "script_src_or_inline_and_noscript_inline_tags" in [...]/templates/meta-box-loaded-assets/view-hardcoded-default.php / Sometimes, if there are no STYLES OR SCRIPTS to be detected on a specific page (it rarely happens), the list of assets will not be fetched in PHP 8+
* Fix: Plugin unload & load exception rules weren't working on specific environments within "Plugins Manager"
* In case a RegEx rule is invalid (e.g. set incorrectly by the admin in "Plugins Manager"), it will be recorded as an error and should be visible in the error_log files for debugging (e.g. good when using a plugin such as "Error Log Monitor")

= <strong>1.2.3.0</strong> - 6 February 2023
* Improvement: Make sure the plugin unload rules by page type are always triggering in any WordPress setup, disregarding the post status (if the page is only for administrators, the rule will take effect)
* WPML Fix: Prevent Asset CleanUp Pro from triggering whenever /?wpml-app=ate-widget is loaded (in some environments, the content returned was empty and the automatic translation area was not loading)
* PHP 8+ Fix / Sometimes when "Manage in the Front-end view" is enabled, the following error shows up when managing assets: Uncaught Error: json_decode(): Argument #1 ($json) must be of type string, array given in [...]/classes/Main.php
* PHP 8+ Fix / The following notice triggers when WP_DEBUG is enabled - Deprecated: strlen(): Passing null to parameter #1 ($string) of type string is deprecated in [...]/classes/OptimiseAssets/OptimizeCommon.php

= <strong>1.2.2.9</strong> - 18 December 2022
* Sometimes, when "Preview Changes" is used (e.g. when DIVI theme is enabled) from an edit page area, the preview doesn't trigger because of a JS error from script(.min).js
* Fix: Prevent undefined errors from the newly added "tag_output" object within the hardcoded assets list

= <strong>1.2.2.8</strong> - 4 December 2022
* Added NOSCRIPT tags (usually added after SCRIPT tags) to the hardcoded list of assets (e.g. if you unload a tracking script on a page, you can also unload its NOSCRIPT tag as well, if any was added)
* Elementor Templates: Hide "Manage CSS & JS" whenever hovering over a template title as managing the assets is meant for public pages (not templates added to pages)
* Fix: Hardcoded assets / When an inline SCRIPT was detected, it was erroneously detected as a SCRIPT with the "src" attribute, if the inline content contained the "src" string (e.g. <script>j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;</script>)
* Fix: If a plugin's option from "options" table had an empty value (e.g. edited manually by a developer for debugging purposes), the plugin was using add_option() to update it instead of update_option() which is the right function to use in this situation

= <strong>1.2.2.7</strong> - 22 November 2022
* Preload CSS/JS: If a tag (LINK/SCRIPT) is wrapped by Internet Explorer comments, make sure the wrapping is preserved when the asset is preloaded, otherwise, the preloading would occur in all browsers when its meant to be loaded only by Internet Explorer
* CSS/JS manager via "Manage in the front-end view": Make sure to notify the admin about hardcoded assets wrapped by Internet Explorer comments
* Hardcoded assets improvement: Use fewer resources when the unloading is triggered
* Fix: In rare cases when an option value remained empty in the database (e.g. edited directly through phpMyAdmin), add_option() was used instead of update_option()

= <strong>1.2.2.6</strong> - 17 November 2022
* Improvement: Whenever you mark a hardcoded tag as unloaded, it will stay unloaded (the rule will be kept in place) as long as its content or the relative source value will stay the same (e.g. if you unload <style type="text/css">div.custom-name { color: green; }</style> will be considered the same as <style data-custom-attribute="name-here">div.custom-name { color: green; }</style>)
* Improvement: Better detection of the tags (including the hardcoded ones) when the source of a tag (e.g. "src" or "href") is not wrapped around quotes or even has spaces added after or before the equal sign / e.g. <script src=/path/to/file.js></script> OR <link rel=stylesheet href = /path/to/file.css>
* New Option: Added the load exception (if any unload rule is applied) based on the post type for hardcoded assets (e.g. 'On all WooCommerce "Product" pages')
* Whenever XML-RPC is completely disabled in 'Settings' -- 'Disable XML-RPC', make sure the following option is automatically turned ON: 'Settings" --- 'HTML Source CleanUp' -- 'Remove "Really Simple Discovery (RSD)" link tag?'
* Fix: 'SweetAlert 2' files were missing when 'SCRIPT_DEBUG' was turned OFF (most cases) which sometimes prevented the modal to show with specific information regarding the plugin rules that were used
* Fix: The size of an asset loaded locally was not shown when the path to the file was relative and starting with the URI of the WordPress site URL / Example: The WordPress site URL was "https://yoursite.com/blog" and the tag was "<script src='/blog/wp-content/path/to/file.js'></script>"
* Fix: "Deprecated: strpos(): Non-string needles will be interpreted as strings in the future. Use an explicit chr() call to preserve the current behavior in "/wp-content/plugins/wp-asset-clean-up-pro/classes/OptimiseAssets/(OptimizeCss.php and OptimizeJs.php)"
* Fix: Exclude from optimisation JS files that contain "/*@cc_on" and "@*/" as they are meant to be loaded by Internet Explorer and not stripped if they only contain commented code

= <strong>1.2.2.5</strong> - 6 November 2022
* "CSS/JS Manager": If a handle has inline code associated with it, mention the size (e.g. bytes, KB) of that inlined LINK or SCRIPT (just like it's mentioned for the LINK tags with the "href" attribute and SCRIPT tags with the "src" attribute)
* Higher accuracy in detecting (for optimization) the LINK tags that are loading CSS/JS files
* Improvement: In case a WordPress installation has a subdirectory (e.g. www.mysite.com/blog), make sure any assets that have relative URIs (e.g. /blog/wp-content/style.css) are all optimized properly

= <strong>1.2.2.4</strong> - 30 October 2022
* Improvement: If an asset is an unloaded through the CSS/JS manager and a preload (via LINK tag) was already set through another plugin (e.g. "Pre* Party Resource Hints") or within the theme, for instance in functions.php, make sure to strip the preloading as it's useless if the actual asset is not loaded in the first place
* "Plugins Manager" improvement: Compatibility with "Premmerce Permalink Manager for WooCommerce" plugin (if the URL of the product is changed, make sure the rules based on the "product" post type are still applied)
* If "SCRIPT_DEBUG" is set to "true", load the non-minified versions of the plugin's assets / read more: https://wordpress.org/support/article/debugging-in-wordpress/#script_debug
* Fix: Make sure none of the plugin's assets are included within any combined CSS/JS files (if the options are enabled in "Settings")
* Fix: Make sure to offer fallback to "wp_json_file_decode" in case the WordPress version is below 5.9.0 (as compatibility with older WP versions is promised)

= <strong>1.2.2.3</strong> - 6 October 2022
* By default, the front-end optimization is not triggered for URIs with query strings (as they are usually not cacheable); Make more exceptions and trigger the optimization when there are common query strings (the page is cacheable) in the URI such as the ones starting with "utm_", "mtm_", "fb_", etc.
* Better detection of the homepage in early checks for rules set in "Plugins Manager" by ignoring more common query strings such as the ones starting with "utm_", "mtm_", "fb_", etc.
* Higher accuracy in detecting WordPress core files (some of the undetected WP core files used to be shown in the "External 3rd Party" area)
* Higher accuracy in detecting a DIVI page builder: Asset CleanUp doesn't load any rules when /wp-admin/admin.php?page=et_theme_builder is loaded unless you want to -- read more: https://www.assetcleanup.com/docs/?p=1260
* Cache Enabler Compatibility: Avoid the deprecated error related to "cache_enabler_before_store" by checking the version of Cache Enabler and using the right filter
* Improvement: Make sure all the unload rules from "Overview" are marked with red font as all load exceptions are marked with green font
* Fix: PHP 8.1 - Make sure substr() doesn't have any null parameters to avoid any errors
* Fix: When editing a post/page and "Classic Editor" plugin is activated (basically when the page looks the same as it used to before Gutenberg editor was implemented in WordPress), the "Preview Changes" button from the top right side box does not work if the CSS/JS manager is loaded

= <strong>1.2.2.2</strong> - 30 September 2022
* "CSS & JS Manager" -- ("Posts" | "Pages") -- Notify the admin if there aren't any posts/pages where assets could be managed - e.g. in fresh WordPress installations or when a website just doesn't have articles ("posts")
* Make sure Asset CleanUp Pro is not loading by default when DIVI builder previews are triggered (e.g. when the "et_pb_preview" query string is in the URI)
* Fix: Make sure the hardcoded assets are printed when managing the assets in the front-end view ("Settings" -- "Plugin Usage Preferences" -- "Manage in the Front-end")
* Fix: Added missing link to the special settings documentation post

= <strong>1.2.2.1</strong> - 26 September 2022
* Show any special settings in "Overview" -- read more: https://www.assetcleanup.com/docs/?p=1495
* Make sure the plugin unload rules for REST API calls (read more: https://www.assetcleanup.com/docs/?p=1469) apply on AJAX calls as well (e.g. when a plugin uses jQuery AJAX code to fetch information from a REST API call)
* Notify the admin when the tracking notice is shown that he/she can manage this option in the "Settings" area (e.g. in case closing the notice box doesn't work because of some JavaScript errors on that page, coming from a different plugin or the theme)
* Make sure the user is redirected only once to the "Getting Started" page after the plugin is activated the first time (not after every re-activation as many developers are doing debugging)
* Reduce the number of DB calls when visiting the "Plugins" page within the Dashboard and the "License" page from Asset CleanUp Pro's menu

= <strong>1.2.2.0</strong> - 17 September 2022
* Option to unload plugins via "Plugins Manager" when REST API calls are made via define('WPACU_LOAD_ON_REST_CALLS', true); that can be set in wp-config.php / read more: https://www.assetcleanup.com/docs/?p=1469
* "Test Mode" now applies within the Dashboard as well (if there are unloading rules in 'PLUGINS MANAGER' -- 'IN THE DASHBOARD /wp-admin/') in case the logged-in user is NOT an administrator
* Do extra checks to avoid calling get_transient() when it's not needed on specific pages (to reduce the number of DB calls)
* Code that triggered anywhere now gets triggered on the front-end view as it's only needed there
* DB calls related only to the "Overview" page were triggered on all plugin's pages (avoid that)

= <strong>1.2.1.9</strong> - 10 September 2022
* On pages without any unloading rules, do not make any DB calls or trigger extra PHP code to retrieve any load exceptions as they are irrelevant in this situation since the assets are loaded anyway
* Optimised the code to avoid triggering DB calls to the "options" table to check specific transient values
* Remove extra DB queries related to "post_format" as this taxonomy is irrelevant for managing in Asset CleanUp Pro
* When Asset CleanUp Pro is prevented from loading via the rules from "Settings" -- "Plugin Usage Preferences" -- "Do not load the plugin on certain pages" OR from "Do not load Asset CleanUp Pro on this page (this will disable any functionality of the plugin)" within "Page Options" area (when managing assets for a specific page), make sure the checking is done earlier to avoid an extra DB query that would become irrelevant if the plugin would not be loaded on that page

= <strong>1.2.1.8</strong> - 5 September 2022
* Optimisation: Reduce the number of queries made to the database & trigger fewer code during early code loaded in Asset CleanUp Pro's MU plugin (e.g. to determine if the URI is a homepage, to determine the page type based on the URI)
* "Plugins Manager": Make sure the green font shows for any load exception rule that is chosen
* "Plugins Manager" Fix: When non-Latin characters were used in the URI, some plugin unload/load exception rules were not working such as the ones based on the post type (e.g. post, page, product, tag) and taxonomy (e.g. category, tag, product category, product tag)
* "Plugins Manager" Fix: The load exception rule was not applied for plugins on taxonomy pages ('category', 'post_tag', 'product_cat', 'product_tag') when set using the following option: "On the following taxonomy pages:"

= <strong>1.2.1.7</strong> - 2 September 2022
* Bricks builder edit mode: Allow Asset CleanUp Pro to trigger plugin & CSS/JS unload rules when the page editor is in use to make the editor load faster via define('WPACU_LOAD_ON_BRICKS_BUILDER', true); that can be set in wp-config.php / read more: https://www.assetcleanup.com/docs/?p=1450
* Compatibility with the "WordPress Popular Posts" plugin & other plugins (when optimizing the JavaScript code) that change the type of inline script tags to "application/json" (having a JSON string that is later read by the plugin's script)
* Fix: "Plugins Manager" -- The unload rule wasn't working for built-in "category" pages

= <strong>1.2.1.6</strong> - 19 August 2022
* Updated T-Regx PHP library (for handling specific regular expressions) to v0.34.2
* Escaped PHP-echoed variables/constants by using functions such as esc_attr() or esc_html_e()
* Minify CSS Fix: If there are new lines within calc(), the content minified ends up without spaces between the operators (e.g. the plus sign), which breaks the CSS code
* Fix: On some servers, PHP warning are shown on all taxonomy pages (e.g. 'Undefined array key "unload_via_tax"', 'Uncaught TypeError: in_array(): Argument #2 ($haystack) must be of type array, null given')

= <strong>1.2.1.5</strong> - 4 August 2022
* Flush "W3 Total Cache" (if the plugin is activated) object cache whenever the list of CSS/JS files is fetched by Asset CleanUp Pro to avoid retrieving the previous configuration after changes are made to the CSS/JS manager
* Improvement: Add more uniqueness to the plugin's JS code deferring the CSS to avoid any conflicts with other similar codes
* Fix: The requested URI was sometimes wrongly detected as the homepage, if some common query strings (e.g. "utm_source") were in the URI

= <strong>1.2.1.4</strong> - 18 June 2022
* "Plugins Manager": Ability to unload plugins (and load them as an exception from any unload rule) on any taxonomy page
* "Bricks – Visual Site Builder for WordPress": Do not trigger Asset CleanUp Pro whenever the page builder is used
* Fix: Better RegEx for detecting "@import" within CSS comments when optimizing the CSS, thus avoiding useless attempts to fetch the information from the @import locations, since they are commented and not needed in the final CSS version

= <strong>1.2.1.3</strong> - 28 May 2022
* "Plugins Manager": Ability to unload plugins (and load them as an exception from any unload rule) on the homepage (no more complex RegEx required) & on all "Category" and "Tag" pages (the default WordPress taxonomies)
* Fix: "Google Fonts" -- "Apply font-display: CSS property value" was not applying for hardcoded LINK tags when the Google fonts were not combined
* Fix: "Plugin Usage Preferences" -- "Manage in the Dashboard" -- "Fetch the assets on a button click": if the user updates a post (when Gutenberg editor is used), the CSS/JS manager loads, when it shouldn't as the admin never used the button to fetch the CSS/JS list in the first place

= <strong>1.2.1.2</strong> - 3 May 2022
* "Plugins Manager": Ability to unload plugins (and load them as an exception from any unload rule) in the front-end view on all pages belonging to specific post types
* New option in the settings' vertical menu: "Disable RSS Feed"
* Fix: Improved the quality of the code behind the snippet for the "wpacu_critical_css" filter; Show all the code without the need to scroll the textarea

= <strong>1.2.1.1</strong> - 20 April 2022
* Fix: 'PHP Warning: Undefined array key "site_url" in [...]/templates/_admin-pages-critical-css/common/_applies-to.php on line 11'
* Fix: Load exceptions via RegEx for CSS/JS weren't always matched in PHP 7.1+

= <strong>1.2.1.0</strong> - 18 April 2022
* PHP (up to) 8.0.17 compatibility: Make sure no deprecated notices are shown when WP_DEBUG is ON due to older PHP code that is still compatible with PHP 5.6
* Make sure the list of unloaded assets/plugins from the top admin bar is not broken due to the theme used that might have CSS interfering with Asset CleanUp Pro's one
* Reduce the total plugin's size by compressing some of its images
* "Transliterator - WordPress Transliteration" compatibility: Avoid breaking the HTML content in Asset CleanUp's admin pages

= <strong>1.2.0.9</strong> - 17 March 2022
* Added "wpacu_print_info_comments_in_cached_assets" filter hook for the option to avoid printing by default of plugin's comments in the CSS/JS files (e.g. the relative path to the file)
* Fix: Make sure that jQuery Chosen (the nice looking drop-down) is loaded and applied to elements (e.g. taxonomies list) within the CSS/JS manager if loaded from the Dashboard via "WP Remote Post"
* Fix: Preloading (basic/async) stopped working in the previous version
* Fix: Premium unload/load exceptions rules were not always applying if there were no basic ("Lite" version related) rules applied (which is irrelevant as the user can only apply premium rules if he/she prefers)
* UI fix: Async/Defer on this page was not taken into consideration as an applied rule when using the following layout: "Grouped by having at least one rule & no rules"

= <strong>1.2.0.8</strong> - 24 February 2022
* Fix: When a static page is set as a homepage in "Settings" - "Reading", any load exceptions set as "On this page" would not take effect for the homepage

= <strong>1.2.0.7</strong> - 23 February 2022
* Reduced the total number of template files (e.g. some were redundant)
* Reduced the size of plugin's images
* Higher accuracy in detecting Zion Page Builder to prevent Asset CleanUp Pro from triggering when the page builder is used
* "Overview" improvement: Make sure the unloaded CSS/JS from inactive themes is highlighted to alert the admin that the rules might never be needed and can be safely removed
* "Overview" fix: The confirmation for clearing rules belonging to inactive CSS/JS wasn't always showing the right handle, thus confusing the admin when confirming the action
* Fix: When CSS content gets cached, make sure to avoid altering incorrectly the "url" value when it starts with # - e.g. clip-path: url(#elementIdHere);
* Fix: Sometimes when a static page was set as the homepage in "Settings" - "Reading" and then unset, the CSS/JS manager was not showing up and the "Page Options" was shown instead

= <strong>1.2.0.6</strong> - 1 February 2022
* Fix: Make sure all load exceptions for any unload rule are included in "Tools" -> "Import & Export"
* Fix: PHP Warning:  in_array() expects parameter 2 to be array, null given in /classes/Main.php on line 931
* Fix: Whenever unloading on all [taxonomy type] pages was enabled the following type of message wasn't showing in the CSS/JS manager: "This stylesheet is unloaded on all category taxonomy pages."
* Avoid notice errors regarding taxonomies that do not exist anymore when having WP_DEBUG turned on by using term_exists()

= <strong>1.2.0.5</strong> - 28 January 2022
* New Feature: Unload (or load as an exception) CSS/JS on all pages of a post type (posts, pages, WooCommerce products, etc.) when specific taxonomies (categories, tags, etc.) are set (read more: https://www.assetcleanup.com/docs/?p=1415)
* Fix: The list "Grouped by loaded or unloaded status" was sometimes showing unloaded assets as "loaded", confusing the admin

= <strong>1.2.0.4</strong> - 11 January 2022
* Improvement: Load jQuery UI files locally, thus removing any unnecessary dependency on another site (e.g. not from "ajax.googleapis.com")
* Improvement: Escape as late as possible all variables when echoed
* Improvement: Replaced json_encode() with wp_json_encode() for better security
* Fix: When a word containing "calc" (e.g. calculation) was included in CSS comments, sometimes, the code following the comment was stripped

= <strong>1.2.0.3</strong> - 30 November 2021
* PHP 8 Fix: 'PHP Warning: Undefined array key "critical_css_disabled"' in /templates/admin-page-overview.php
* Fix: 'Error: The security check has failed.0' when loading the CSS/JS list via the 'Direct' method within the Dashboard

= <strong>1.2.0.2</strong> - 23 November 2021
* Added the "wpacu_settings" filter - add_filter() - so the plugin's "Settings" can be altered via code (e.g. adding if clauses programmatically to alter the value of a certain textarea or have an option disabled on specific pages) when necessary
* Prevent the following option from being accidentally disabled: 'Ignore dependency rule and keep the "children" loaded' (e.g. in rare cases, some CSS/JS have dependencies on certain pages only)
* Fix: Added nonce checks for every WordPress AJAX call to improve security

= <strong>1.2.0.1</strong> - 14 September 2021
* Automatically preload any combined JS files within the BODY tag (that do not have any "defer" or "async" attribute) to improve the Google PageSpeed Insights score for the following: "Preload key requests"
* Reorganised the layout for "Manage in the Dashboard" from "Settings" -> "Plugin Usage Preferences"
* Fix: When minifying CSS content, do not strip the extra calc() when something like the following is used: "calc( 50% - 22px ) calc( 50% - 22px )"
* Fix: When Gutenberg editor is used and the post is updated, sometimes the CSS/JS manager is reloaded BEFORE the changes are saved showing the same state as it used to be confusing the admin that the changes weren't applied

= <strong>1.2.0.0</strong> - 29 August 2021
* If the security nonce is expired or not sent when certain forms are submitted, show an error message about the potential problems and how to fix them without showing the standard "Link has expired" error
* Added the plugin version under the "Pro" text next to the logo
* WPML Fix: Load the combined CSS/JS files from the right domain to avoid any CORS policy issues (in case there are multiple domains for each language)
* Fix: The CSS/JS manager form wasn't submitting when "Do not load Asset CleanUp Pro on this page (this will disable any functionality of the plugin)" was enabled
* Fix: Make sure the loading exception rule if the user is logged-in is saving correctly
* Fix: Do not show the "loading based on screen size" area if there is no SRC attached to the handle (e.g. "woocommerce-inline" handle)
* Fix: Do not print anything whenever a cron job is triggered (this is only for debugging)
* Fix: Assets' position was not shown correctly within the Dashboard (HEAD instead of BODY)
* Fix: Do not trigger any cache clearing and page preloading if the post status is "draft" (after the post is saved)
* Fix: Avoid changing the update plugin link as "Plugin failed" should not be a problem anymore

= <strong>1.1.9.9</strong> - 31 July 2021
* Compatibility with FlyWheel hosting accounts (and other hosting accounts using the same pattern): The WordPress root directory is different than the ABSPATH one in relation to the "wp-content" directory where all or most of the CSS/JS files are located (e.g. the file size wasn't calculated for the static files before this change, which is needed for certain plugin functionality such as calculating small files for inlining)
* Compatibility fix: Whenever the 'active_plugins' option is updated incorrectly by another plugin, it might contain the filtered list done via "option_active_plugins" and not the original list; Put back the missing plugins to avoid ending up with site-wide deactivated plugins (the ones with unloading rules in "Plugins Manager")
* Avoid the same database query to be called more than once within the assetCleanUpHasNoLoadMatches() function
* Limit the number of fields that are submitted whenever CSS/JS manager is used by re-organizing the fields' structure; Disable certain inputs that are at the time irrelevant for submitting (it helps if max_input_vars from php.ini is set to the default 1000 which is a low number for large forms)
* "Overview" page change: Highlight posts that are not "publish" or "private" within the "Page Options" area
* Do not add any CSS/JS manager link to the post's actions if the post is not "publish" or "private" (within "All Posts" page - /wp-admin/edit.php)
* Order in alphabetical order the unloaded plugins from the top admin bar "Asset CleanUp Pro" menu

= <strong>1.1.9.8</strong> - 25 July 2021
* Cached the plugin filtering (in case there are plugin unload rules) to decrease the total page loading time whenever a non-cached page is visited
* Limit the number of fields that are submitted whenever CSS/JS manager is used (it helps if max_input_vars from php.ini is set to the default 1000 which is a low number for large forms): Whenever "+" or "-" is used to change the state of the asset row, the change is done asynchronously via an AJAX call
* Avoid any errors related to parse_str() (e.g. when the string is too long)
* Whenever plugin filtering from the Dashboard is used ("Plugin Manager" -> "IN THE DASHBOARD /wp-admin/"), do not trigger any plugin unload rules in Asset CleanUp's pages (e.g. to avoid showing incomplete custom post types) and in the following admin pages: /plugins.php, /plugin-install.php, /plugin-editor.php, /update-core.php

= <strong>1.1.9.7</strong> - 15 July 2021
* "Plugins Manager" Multisite compatibility: Make sure network-activated plugins are fully manageable (e.g. only plugins activated per site were showing)
* If "Contract All Groups" & "Expand All Groups" buttons are used, make sure the state (contracted or expanded) whenever the admin manages the assets again (the following option is updated in the background: "Settings" -> "Plugin Usage Preferences" -> "On Assets List Layout Load, keep the groups:")
* Fix: "Uncaught ReferenceError: wpacuLoadCSS is not defined" was sometimes showing. It's been fixed by updating the fallback script needed for CSS async preloading (e.g. for browsers that do not support it by default)
* Fix: "Warning: Constant WPACU_PREVENT_ANY_FRONTEND_OPTIMIZATION already defined"

= <strong>1.1.9.6</strong> - 3 July 2021
* The meta box "Asset CleanUp Pro: Page Options" has had its contents moved to the "Page Options" area from the CSS/JS manager in any location the assets are managed
* Added "Page Options" for the homepage as well (e.g. latest posts) besides posts, pages, and any public custom post types (e.g. WooCommerce product pages)
* Prevent the plugin from triggering when WooCommerce API calls are made
* Make no PHP errors are logged due to $allEnabledLocations not being initially declared as an empty array
* When checking if critical CSS is enabled for any custom taxonomy/post type, make sure to ignore the inactive ones (e.g. a taxonomy that is not used anymore)
* Make sure the following option works well when non-Latin characters are in the URI: "Do not load the plugin on certain page"
* Fix: When hovering over the post's title in the Dashboard's posts list (either post, page, or custom post type), make sure "Manage CSS & JS" is only shown to the right admins to avoid any confusion
* Fix: When assets' list is fetched, WP Rocket was disabled which made some plugins/themes that are directly calling WP Rocket functions to generate fatal errors
* Fix: Make sure the handles with the following option always get unloaded: 'Ignore dependency rule and keep the "children" loaded'
* Fix: Fatal error: Cannot redeclare assetCleanUpClearAutoptimizeCache() - if both plugins (Lite & Pro) are activated

= <strong>1.1.9.5</strong> - 26 May 2021
* Make sure the plugin can be updated via WP CLI (so far, the update was visible within the Dashboard in /wp-admin/)
* Option to skip Autoptimize cache clearing via using the "WPACU_DO_NOT_ALSO_CLEAR_AUTOPTIMIZE_CACHE" constant (e.g. set to 'true' in wp-config.php)
* Fix: Make sure that applying to unload on all pages of a certain post type works from "CSS & JS MANAGER" (which is the new place for managing CSS/JS files within the Dashboard, outside the edit post/page area)
* Fix: Manage assets didn't work on "CSS & JS MANAGER" -> "Homepage" tab if the actual page was a static one set in "Settings" -> "Reading"

= <strong>1.1.9.4</strong> - 16 May 2021
* New Option: Manage assets loading for posts, pages, and custom post types within "CSS & JS MANAGER" -> "MANAGE CSS/JS" without the need to go to edit post/page area which is often bulky and could have too many fields from the theme & other plugins leading to a higher number than the one set in php.ini for "max_input_vars"
* Higher accuracy in preventing the plugin from triggering when there are REST requests
* Fix: Make sure RegEx rules for unloading plugins/assets are working well when non-latin characters are in the URI
* Fix: Make sure the plugin works well (e.g. without any PHP errors) if the plugins' directory is changed (e.g. from "plugins" to "plugins-custom-name")
* Fix: Critical CSS was not showing in the front-end view for all page type
* Debugging purposes: Prevent CSS/JS from loading based on the media query via /?wpacu_no_media_query_load_for_css & /?wpacu_no_media_query_load_for_js

= <strong>1.1.9.3</strong> - 25 April 2021
* Option to manage critical CSS (in "CSS & JS Manager" &#187; "Manage Critical CSS") from the Dashboard (add/update/delete), while keeping the option to use the "wpacu_critical_css" hook for custom/singular pages
* Improvement: Make sure "&display=" is added (if enabled) to Google Fonts links if their URL is changed to fit in JSON formats or JavaScript variables
* Fix: Make sure managing CSS/JS for taxonomies from the Dashboard (e.g. when editing a category) works 100%
* Fix: Clearing load exceptions from "Overview" didn't work for all pages of a certain post type

= <strong>1.1.9.2</strong> - 16 April 2021
* Divi builder edit mode: Allow Asset CleanUp Pro to trigger plugin & CSS/JS unload rules when the page editor is on to make the editor load faster via define('WPACU_LOAD_ON_DIVI_BUILDER_EDIT', true); that can be set in wp-config.php / read more: https://www.assetcleanup.com/docs/?p=1260
* Cache Enabler (compatibility with older versions): Make sure the deprecated "cache_enabler_before_store" hook is in use
* Unload "photoswipe" fix: If WooCommerce's PhotoSwipe was unloaded, empty dots were printed at the bottom of the page from unused/unneeded HTML (hide it by marking the DIV with the "pswp" class as hidden)
* Improvement: Only use 'type="text/css"' when it's needed (e.g. an older theme is used that doesn't support HTML5)
* Improvement: Make SweetAlert2 independent (styling, functionality) from other SweetAlert scripts that might be loaded from other plugins/themes (e.g. "WooCommerce Quickbooks Connector" export in an edit product page was not working)
* Fix: Better detection for the homepage (e.g. the latest posts page was mistaken with the homepage in the front-end view of the CSS/JS manager)
* Fix: Better detection for the singular page; Make sure the latest posts page such as the "Blog" one is also checked)
* Fix: Make sure the license deactivation works even if the license is not valid so that it could be replaced with a valid one (e.g. a null version was initially used)

= <strong>1.1.9.1</strong> - 1 April 2021
* Minify CSS/JS improvement: From now on, the minification can be either applied to files, inline JS code, or both (before, the files minification had to be enabled to files first and then to inline JS code; sometimes, users just wanted to minify inline code and leave the files untouched)
* Fix: On some WordPress installations, the plugin's menu icon from the Dashboard's sidebar was not showing properly (the height was too large)
* Fix: If there are too many assets/plugins unloaded, when showing up in the top admin bar menu, the list was not scrollable (e.g. only 20 out of 40 assets were shown because the height of the browser's window wasn't large enough which can not be expanded on smaller devices)
* Fix: If the current theme supports HTML5, the 'type="text/javascript"' attribute is not added any more to altered SCRIPT tags by Asset CleanUp, thus avoiding any errors from W3C validators
* Fix: When "Move All <SCRIPT> tags From HEAD to BODY" was enabled, all SCRIPT tags got moved including those with the "type" attribute having values such as "application/ld+json" (these ones should stay within the HEAD tag)

= <strong>1.1.9.0</strong> - 16 March 2021
* The layout of a CSS/JS area is changed on the make exception area & a new option was added to make an exception from any unload rule on pages belonging to a specific post type (e.g. unload site-wide, but keep the asset loaded on all WooCommerce 'product' pages)
* Oxygen plugin edit mode: Allow Asset CleanUp Pro to trigger plugin & CSS/JS unload rules when the page editor is on to make the editor load faster via define('WPACU_LOAD_ON_OXYGEN_BUILDER_EDIT', true); that can be set in wp-config.php / read more: https://www.assetcleanup.com/docs/?p=1200
* In specific DIVI powered websites, the "PageSpeed" parameter is appended to the URL from the client-side, thus make sure to only check for "et_fb" when detecting if the DIVI builder is on to avoid loading Asset CleanUp Pro there
* Fix: Make sure that for languages such as Arabic where the Dashboard's menu is shown on the right side, the plugin's icon is not misaligned
* Fix: When "Update" button is clicked on edit post/page (Gutenberg mode), while there's no CSS/JS list fetched ("Fetch the assets on a button click" is on), make sure the list is not fetched after the page is saved (it's only refreshed if it was loaded in the first place)

= <strong>1.1.8.9</strong> - 6 March 2021
* Fix: Make sure WP Rocket is fully triggered when the assets are fetched via Asset CleanUp, as the "Uncode" theme is calling get_rocket_option() without checking if the function exists
* Fix: Added nonce checks to AJAX calls made by Asset CleanUp for extra security

= <strong>1.1.8.8</strong> - 4 February 2021
* Improved the caching mechanism: The most recently created files are never deleted in case HTML pages that weren't cleared for weeks or more would still load them successfully; Once "ver" is updated, then the now old file will be cleared in a couple of days (e.g. at least one day + the number of days set in "Settings" -> "Plugin Usage Preferences" -> "Clear previously cached CSS/JS files older than (x) days")
* Set a higher priority of the order in which the plugin's menu shows up in the top admin bar to make room for the notice related to the unloaded assets; Changed the notification icon from the menu (from exclamation to filter sign)
* Make sure the textarea for RegEx rules within CSS/JS Manager is adaptive based on its content (for easier reading of all the rules)
* Cleanup the value (strip any empty extra lines) from the RegEx textarea when it's updated for any unload/load exception rule to avoid invalid RegEx rules & make sure the delimiters are automatically added to the rules in case they were missed
* CSS Minifier Update: Better detection and minification for CSS related to math functions such as min(), max(), calc() and clamp(); Fix broken CSS (rare situations) that uses nested calc()
* Combine JS Update: Make sure the inline "translations" associated with a JS file is appended to the combined JS files, as this would also avoid possible errors such as "Uncaught ReferenceError: wp is not defined"
* Make sure preg_qoute() is used in CleanUp.php when clearing LINK/SCRIPT tags to avoid any errors such as unknown modifier
* Make sure jQuery Chosen is not beautifying the SELECT drop-down if "Input Fields Style" is set to "Standard" in the plugin's settings, so that anyone using a screen reader software (e.g. people with disabilities) will not have any problems using the drop-down
* Fallback: Added Internet Explorer compatibility (11 and below) for the deferred CSS that is loaded from the BODY
* Improved the way the file paths from "Inline CSS" and "Inline JS" areas are matched to make sure regular expressions can also be used for a match, not just the relative path to the file
* The super admin will always be able to access the plugin's settings for security reasons
* Fix: Make sure the unloading feature works for the WooCommerce Shop Page and it's not taken as a product archive page since it's connected to a page ID
* Fix: PHP Warning - array_merge() - Expected parameter 1 to be an array, null given - within the method alterWpStylesScriptsObj()
* Fix: Sometimes, due to the fact there were no line breaks on specific code shown in the hardcoded list, the left-side meta box had its width increased so much that it was hiding or partially showing the right-side meta boxes area that was only visible by using "View" -> "Zoom Out" in Google Chrome
* Fix: Hide the following area from the edit taxonomy page if the user is not an admin to avoid any confusion: "Asset CleanUp Pro: CSS & JavaScript Manager"

= <strong>1.1.8.7</strong> - 15 January 2021
* Improvement: Make it more clear where the admin is applying the plugin unload rules (frontend or /wp-admin/) in "Plugins Manager" by renaming the text related to the rules as well as the submit button
* Improvement: Alert the admin in case he/she might be in the wrong tab for plugin unload in "Plugins Manager" when the "wp-admin" string is added to the RegEx rules and the admin is within the "IN FRONTEND VIEW (your visitors)" tab
* Make sure only Asset CleanUp Pro plugin is loading when its own AJAX calls are made to /wp-admin/admin-ajax.php for faster processing (no point of loading other plugins) except the request when the caching is cleared (e.g. due to WP hooks that are used by other performance plugins)
* For easier debugging, the top admin bar menu now has the list of all the unloaded plugins and CSS/JS files within the current viewed page
* Prevent Asset CleanUp Pro from triggering when REST /wp-json/ calls are made due to conflicts with other plugins (e.g. Thrive Ovation for testimonials)
* Added a note below the textarea where the RegEx rule can be added (for unloading & load exceptions) that multiple RegExes are allowed one per line to make the admin aware of this option
* If an unload exception is chosen (after an existing unload rule has already been chosen), mark it with green font to easily distinguish it when going through the CSS/JS manager
* Cache Enabler: Clear plugin's caching right after Asset CleanUp Pro's caching is cleared to avoid references in the old cached HTML pages to files from Asset CleanUp Pro that might be missing or not relevant anymore
* Cache Enabler: Fix - PHP Deprecated: "cache_enabler_before_store" (the new filter is "cache_enabler_page_contents_before_store")
* Fix: Sometimes, admins are mistakenly moving the CSS/JS manager to the right side of the edit post/page area; It gets moved back where it belongs within the edit post/page area
* Fix: Update for 'Compatibility with "Wordpress Admin Theme - WPShapere" plugin' - make sure it applies to any admin page, not just the options page from WPShapere

= <strong>1.1.8.6</strong> - 4 January 2021
* New Feature: Unload plugins within the Dashboard /wp-admin/ (useful for pages that are too slow and, in rare cases, to fix any conflicts between two plugins loaded on the same admin page)
* Fix: Inline CSS for specified files was not working anymore if the CSS file was cached
* Added option to prevent CSS/JS from being optimized on page load by Asset CleanUp Pro via query string for debugging purposes: (/?wpacu_no_optimize_css /?wpacu_no_inline_css /?wpacu_no_optimize_js)

= <strong>1.1.8.5</strong> - 18 December 2020
* Replaced jQuery deprecated code with a new one (e.g. reported by "Enable jQuery Migrate Helper" plugin)
* Download file based on the browser's screen size feature addition: Show the option also for CSS files that are "parents" and have "children" under them, alerting the admin to be careful when a rule is set for the file as it could affect the way its "children" are loaded
* Debugging option: If the admin uses /?wpacu_only_load_plugins=[list_here_comma_separated] while he/she's logged-in, then Asset CleanUp's MU plugin file will only load the mentioned plugins (all the other active plugins will not load at all on the targeted page)

= <strong>1.1.8.4</strong> - 1 December 2020
* New Setting: Restrict access for administrators on the "CSS & JS Manager" area, thus decluttering the posts/pages whenever they edit them; Very useful if there are admins (e.g. store managers that don't have to mix with Asset CleanUp's assets list for various reasons) that should not view the meta boxes from edit post/page, the CSS/JS list from the front-end view (if enabled), etc. ("Settings" -> "Plugin Usage Preferences" -> "Allow managing assets to:")
* Improvement: Extra checks are made to detect if the page is an AMP one and if it is, no changes would be made to the HTML source (e.g. no SCRIPT tags in the HEAD section of the page)

= <strong>1.1.8.3</strong> - 22 November 2020
* Changed the "Plugins Manager" area to have the same feeling as the "CSS & JS Manager"; Removed the "Always load it (default)" option as it's redundant since all the plugins are loaded by default unless there are unload rules set there; The load exceptions are now showing in green font to stand out in case they overwrite any unload rule.
* Added extra alters to notify the admin in case something is not right with some of the rules set. These include: adding the full URI to the RegEx input areas when only the URI (relative path) is needed; Enabling both "Unload it if the user is logged in" and "Always load it if the user is logged in" which ends up in the cancellation of each other
* Added "Unload it if the user is logged in" option to "Plugins Manager" (e.g. you have a plugin that has Google Analytics and you want to trigger it only for your guests, not for yourself)
* Added debugging option to load all plugins (no filtered list in case there are any rules in "Plugins Manager"): /?wpacu_no_plugin_unload
* Make sure all the "if kept loaded" areas are blurred if any unload rule is chosen as those areas become irrelevant
* New option in "Settings" -> "Combine loaded JS (JavaScript) into fewer files" -> "Wrap each JavaScript file included in the combined group in its own try {} catch(e) {} statement in case it has an error and it would affect the execution of the other included files"
* Clear caching once a day via WP Cron in the case over 24 hours have passed since the last clearance (e.g. in case the admin hasn't cleared the caching in a long time or hasn't touched the Dashboard for days)
* Deactivate the appending of the inline CSS/JS code (extra, before or after) to the combined CSS/JS files if all the files' size is over 700 MB as this often suggest the inline code is not unique (e.g. having WordPress nonces that often change)
* Check if a directory is empty before using rmdir() to avoid certain debugging plugins to report errors (even though they are harmless)
* Make sure the following work fine if the plugin is marked as unloaded site-wide with exceptions: upload file within the front-end, download attachments from the Dashboard
* Fix: Basic preloading was not taking place anymore
* Fix: "PHP Warning: in_array() expects parameter 2 to be array, boolean given" is generating if the current media query load list is empty
* Fix: Make sure /wp-content/cache/asset-cleanup/(css|js) directories are re-created if necessary, in case they were removed (e.g. for being empty or by mistake)
* Fix: The list of the hardcoded assets wasn't wrapped correctly and not contracted properly on request
* Fix: The AJAX call meant for fetching the hardcoded list in the front-end view was also triggering within the Dashboard outside the plugin's pages and used extra resources that were not necessary
* Fix: Prevent the meta boxes from showing up in the edit post/page area (thus, decluttering the edit area) if the user's role is not "administrator" (e.g. it was showing it to editors without any CSS/JS to manage which was often confusing)

= <strong>1.1.8.2</strong> - 16 October 2020
* New Feature: Instruct the browser to download a CSS/JS file only when a certain media query matches (e.g. you might have a certain CSS file that is needed only in the desktop view, but not on mobile view)
* Prevent the plugin from triggering when Lumise plugin is used in edit mode
* Improvement: In the front-end view (when "Manage in the front-end" is enabled), the hardcoded assets are retrieved via an AJAX call for higher accuracy especially when certain plugins are using various techniques to list their assets (e.g. "Smart Slider 3")
* Oxygen Builder Fix: Make sure the file /wp-content/uploads/css/universal.css is taken into consideration for minification as it's among the files that aren't minified by default

= <strong>1.1.8.1</strong> - 29 September 2020
* Combine Google Fonts: The plugin checks if the option is enabled before using specific functions related to it, thus reducing the usage of more resources (on some shared hosting packages, the page returned 503 error)
* Combine JS: Skip adding inline JS with WordPress Nonces as they are not unique and add up to the disk space (better accuracy in detecting them)
* Added notification to the plugin's top right area if "Test Mode" is enabled (for extra awareness)
* Fix: In some environments, the plugin's custom functions to detect if the user is logged-in were triggering errors
* Fix: Do not alter the "ver" value to the default WordPress version (as it used to be) as some scripts should be loaded without query strings especially if "ver" was set to null on purpose

= <strong>1.1.8.0</strong> - 21 September 2020
* Made sure a directory exists before attempting to delete it (for old directories) to avoid any error reports (harmless, but annoying) from plugins such as "Fatal Error Notify Pro"
* Updated notification related to HTTP/2 from Combine CSS/JS tabs within "Settings"
* If the total files from the caching directory generated by the combined CSS/JS files occupy over 1 GB in disk space, deactivate automatically the appending of the inline CSS/JS code associated with the tags to the generated combined CSS/JS files as that's usually the culprit for having so many redundant files in the caching directory, leading to unnecessary disk space
* Older caching files are by default set to be cleared after 4 days (the new default value) instead of 7
* Updated "Help" page
* Show more information about the caching directory in "Tools" -> "Storage Info" (each directory with CSS/JS files is shown along with the total size of the assets within it)
* WP Rocket 3.7+ compatibility fix: "Minify HTML" is removed (read more: https://github.com/wp-media/wp-rocket/issues/2682), thus, make sure this gets verified (for compatibility reasons) as well in Asset CleanUp
* Shorten the file name of the combined CSS/JS to avoid possible duplicates
* Check if Cloudflare is used and notify the user about whether it's needed to enable "CDN: Rewrite assets URLs" (read more: https://assetcleanup.com/docs/?p=957)

= <strong>1.1.7.9</strong> - 5 September 2020
* Improvement: Save resources and do not check anything for optimization when the feed URL (e.g. /feed/) is loaded (the plugin should be inactive for these kinds of requests)
* Improvement: Do not trigger the plugin when WooCommerce makes AJAX calls (no point in using extra resources from Asset CleanUp)
* Improvement: When Google Fonts are marked for removal, nullify other related settings, leading to the usage of fewer resources
* The strings "/cart/" and "/checkout/" are added to the exclusion list where Asset CleanUp Pro is not triggered if the pattern is matched (read more: https://assetcleanup.com/docs/?p=488); These kinds of pages usually do not need optimization and if the admin decides to do some, he/she can remove the exclusion
* Fix (writing files to cache directory): If the handle name contained forward-slash (/), make sure that the final file name gets sanitized (including slash removal) to avoid errors related to file_put_contents() such as trying to write to directories that are non-existent
* Fix (unnecessary cached files): The plugin was caching CSS/JS files that did not need to be cached (e.g. already minified JS), leading to unnecessary extra disk space
* The Pro version won't deactivate the Lite one automatically (if it's enabled) as it can be kept active for full compatibility with plugins such as "WP Cloudflare Super Page Cache"
* "WP-Optimize" minify is not triggering anymore when /?wpacu_clean_load is used for debugging purposes (viewing all files loading from their original location)
* Do not strip inline CSS/JS associated with the handle if the original file is empty as there's a high chance the inline code is needed

= <strong>1.1.7.8</strong> - 27 August 2020
* CSS/JS unloading and other optimization options are now available for `Custom Post Type Archive Pages` (not just the singular pages belonging to the custom post type)
* Fix: Sometimes, "Fatal error: Cannot use object of type WP_Error as array" PHP error is logged when the assets are retrieved via "WP Remote Post"

= <strong>1.1.7.7</strong> - 19 August 2020
* Make the plugin's user aware about jQuery Migrate not loading starting from WordPress 5.5 (a notice is showing in "Settings" -> "Site-Wide Common Unloads" if the WP version >= 5.5)
* Add alerts for WooCommerce assets when the user is about to unload them to make sure he/she is aware of the consequences (e.g. "js-cookie", "wc-cart-fragments")
* Oxygen plugin compatibility: Make sure the page loads fine when "Manage in the front-end view" is enabled and the admin is logged-in (e.g. ob_flush() is used to print missing content)
* Do not unload plugins (any unload rule from the "Plugins Manager" area) on front-end pages if an AJAX request was made (e.g. some plugins such as WooCommerce & Gravity Forms are using index.php?[query_string_here] and we won't want to block these calls as they are obviously made for a reason)
* Added action hooks before ("wpacu_clear_cache_before") & after ("wpacu_clear_cache_after") the plugin's CSS/JS caching is cleared
* Do not deactivate the plugin automatically on Dashboard view if the PHP version is below 5.6 and when the plugin is activated, prevent its activation when the PHP version is below 5.6 printing an error message
* Yoast SEO Compatibility Fix: Prevent the plugin from minifying SCRIPT tags if the type is different than "text/javascript", avoiding errors with plugins such as Yoast SEO (type: application/ld+json)
* WordPress 5.5 & "Enable jQuery Migrate Helper" Fix - /assets/script.min.js: jQuery.fn.load() is deprecated
* When the CSS/JS list is fetched using the "Direct" way of fetching the assets ("Manage in the Dashboard"), there are two calls made; Now the progress is shown for each of the calls for easier debugging in case the assets' list is not retrieved successfully
* Improvement: Do not defer the plugin's own script file as sometimes its functions do not work (e.g. if there are JS errors from other plugins); It's better to have it loaded as render-blocking (small file anyway), as soon as possible
* Improvement: Do not leave extra space in the LINK & SCRIPT tags (it makes things easier when debugging the HTML source that might have been altered by the plugin)
* Fix: Avoid triggering the plugin if the request is an API one starting with "/wp-json/wc/" (excluding the site's base URL), WooCommerce related (REST requests)
* Fix: PHP Notice: Array to string conversion (CombineCss.php on line 503)
* Fix: PHP Notice: Undefined index: is_frontend_view (view-by-location.php on line 311)
* Fix: Fix: When assets are fetched, the list of CSS/JS wasn't showing up (AJAX call error) if the page URL that is called (from which the assets are fetched) is loaded with HTTP protocol while the Dashboard (the URL from which the AJAX call is made) is accessed via the HTTPS protocol - Error: "This request has been blocked; the content must be served over HTTPS."
* Fix: "PHP Warning: Use of undefined constant CURL_HTTP_VERSION_2_0" (triggered only for the admin to check if the server supports the HTTP/2 protocol); Show the verify link for HTTP/2 protocol if the automatic detection is not working
* Fix: "PHP Notice: Undefined variable: pluginListContracted in (...)/templates/meta-box-loaded-assets/view-by-location.php"
* Security Fix: Sanitize values from BulkChanges.php to prevent the execution of arbitrary code (e.g. JavaScript code)

= <strong>1.1.7.6</strong> - 28 July 2020
* Fix: CombineJs.php - PHP Notice: Array to string conversion (it happened when there were more than one inline JS code associated with a handle)
* Fix: CombineJs.php - Prevent PHP notice errors from showing up
* Security Fix: Sanitize value from $_REQUEST['wpacu_selected_sub_tab_area'] to prevent execution of arbitrary code (e.g. JavaScript code)
* Security Fix: Sanitize $postId (make sure it's only an integer) from the "duplicate_post_meta_keys_filter" filter to avoid any SQL injection attack

= <strong>1.1.7.5</strong> - 23 July 2020
* The caching of a file is re-built based on the filemtime() value as developers often forget to update the value of the "ver" (/?ver=) after updating a CSS/JS file's content
* When listing the loaded stylesheets (LINK tags), make sure to print the "media" attribute if it's different than "all" so the admin will be aware if that particular CSS is meant for mobile or other devices (e.g. to save time from going through the HTML source code and check it out there)
* Files loaded from "/wp-content/bs-booster-cache/" are not minified/combined (as they are already minified) to avoid getting a large caching directory (often having lots of GB)
* Prevent certain JavaScript code containing random strings such as nonces (e.g. CDATA one) from being added to the combined JS files to avoid the plugin generating lots of JS combined files that would increase the total disk space by writing to the caching directory
* Fix: "Combine CSS" was not working, unless "Combine JS" was also enabled

= <strong>1.1.7.4</strong> - 21 June 2020
* Update for the feature to check if the asset's content (CSS/JS) is already minified; Limit the number of database entries to 100 in case there are too many assets that might be having dynamic content
* Caching dynamically loaded assets is no longer enabled by default as it seems to be causing issues with some themes/plugins
* Added "Read more" links for some of the handles that have special documentation written about them (e.g. "How to unload Swiper in Elementor" or "How to check if Gutenberg Blocks CSS file is needed or not")
* Autoptimize compatibility: If "Minify HTML" is enabled in Autoptimize, make sure any changes to the HTML source that should be applied by Asset CleanUp, are done before the HTML minification
* Fix: If 'Hide "Asset CleanUp Pro: CSS & JavaScript Manager" meta box' is checked, make sure it also takes effect on taxonomy (e.g. 'category') edit page
* At least PHP 5.6 is now required (anything below that and the plugin won't activate). Official support for PHP 5.6 ended on December 31st, 2018. Unless you really have to use it (e.g. old code that won't work with newer PHP version), it's strongly recommended that you update to PHP 7+ as it's much faster & uses fewer resources than older PHP versions, not to mention the improvement in terms of security vulnerabilities & bugs - Read more about unsupported PHP branches: https://www.php.net/eol.php

= <strong>1.1.7.3</strong> - 1 June 2020
* Combine CSS/JS "Apply combination only for logged-in administrator (for debugging purposes)" is no longer available and has been replaced with two options: "Apply it only for guest visitors (default)" & "Apply it for all visitors (not recommended)"
* "Overview" new options: 1) Added option to remove all load exceptions for a handle in "Overview" page when the load exceptions are not tied to any bulk unload rule; 2) Clear redundant unload rules if the site-wide rule is already applied
* WP Rocket compatibility: Make sure HTML changes made by Asset CleanUp Pro are always applied (via "rocket_buffer" filter hook) before WP Rocket saves the HTML content to the cached file
* Fix: Make sure the plugin's own style is properly loaded asynchronously in Firefox in any of the plugin's configuration (this was causing the CSS/JS manager to be unstyled in Mozilla Firefox)

= <strong>1.1.7.2</strong> - 18 May 2020
* Critical CSS can be implemented conditionally via "wpacu_critical_css" filter / Read more: https://assetcleanup.com/docs/?p=608 / This is very helpful in completely preventing render-blocking CSS from loading in a page, thus improving the user experience & the page score in tools such as Google PageSpeed Insights
* Compatibility with Ronneby Theme: Alter the style/script tag later (e.g. by appending plugin markers) after plugins such as "Ronneby Core" alter it (in this case it prevents the URLs from the LINK tags to be stripped)
* When listing dependencies in the CSS JS managing list (e.g. the "children" of a "parent"), show the unloaded ones in the red font; Dependency handles are linked as anchors for easier navigation between them
* Fix: When listing plugins in "Plugins" page and Asset CleanUp Pro is eligible for an update, change the "Update" link and explain to the admin that the page will be reloaded to make sure the connection to the remote server is made and no "Plugin update failed" messages are shown anymore as it happened in some hosting environments
* Fix: Prevent any undefined constant "LOGGED_IN_COOKIE" errors (in case it's not set, as it happens in some WordPress setups) in case rules for logged-in users are set in "Plugins Manager"

= <strong>1.1.7.1</strong> - 10 May 2020
* New option: Hide "Asset CleanUp Pro" menu from the Dashboard (left sidebar) for any reason (e.g. have a cleaner sidebar menu area because of too many elements added up or you do not want it to be too obtrusive to the client for which you’ve done some optimization)
* If a script has "children" and it's about to be asynched or deferred, then a confirmation message about potential issues will show up
* If an asset is already minified, then its SHA1 value will be stored in the database for later reference to avoid minifying it (and use extra resources) for comparison in a future minify process
* Fix: Properly verify assets' SRC that are starting with ../ (very rare cases) to avoid errors such as the unreachable one; Higher accuracy in detecting the hostname in case the plugin is used on staging environments such as the SiteGround's one
* Fix: Gave up the inclusion of /wp-includes/pluggable.php everywhere which generated conflicts with other plugins such as "Post SMTP Mailer/Email Log" (wp_mail() overwritten) and went for a custom solution instead
* Fix: In very rare cases get_option('active_plugins', array()) is returning duplicated values (e.g. altered via a hook by a different plugin)
* Fix: Fix: Make sure load exceptions for taxonomy, author, search results, date & 404 pages are properly applied: for guests & the admin in any situation

= <strong>1.1.7.0</strong> - 29 April 2020
* Once a page is updated, the plugin preloads that page for both the admin and the guest visitor, making sure any new changes would take effect, saving the admin's time and making sure any first visitor coming to that page will access it faster, not having to wait for the rebuilding of the cache which would increase the TTFB (time to the first byte)
* If the attribute "data-wpacu-skip" is applied to any CSS/JS, then no alteration (e.g. no minify and no addition to any combine list) will be applied to that file (apart from the actual unload or attributes such as async/defer)
* Combined CSS/JS files are all stored in /wp-content/cache/asset-cleanup/(css|js)/ to avoid duplicated files that used to be stored in "logged-in" directory which is no longer created; This could reduce the total disk space considerably, especially when the same CSS/JS is created for both guests & logged-in users
* If the hardcoded asset was already stripped & the HTML source is updated, then do not proceed with further replacements of alternative values to save resources
* Store the assets info (for later reference in "Overview"/"Bulk changes" page with the relative "src"; In case the data is later imported from Staging to Live, it won't show the staging URLs on the live website as it could be confusing to the admin even though it's not affecting the functionality of the Live website
* Compatibility Fix: When "Minify HTML" is enabled in WP Rocket, some hardcoded assets that have comments and extra space around them are not stripped when marked for stripping
* Notify the admin that unloading 'jquery-migrate' won't unload its 'jquery' "child" as well, as the unloading of jQuery Migrate is done differently than other handles, in order to avoid unloading jQuery library
* Fix: If "Asynchronous via Web Font Loader (webfont.js)" was chosen for "Combine Multiple Requests Into Fewer Ones", the font weights weren't added to the final generated SCRIPT tag
* Fix: Sometimes, the parameter passed to "CleanUp::removeMetaGenerators" is empty and it returns a loadHTML() error for empty input
* Fix: Avoid Array to String Conversion Error in pages such as "Overview"
* Fix: Prevent any notice errors about undefined $GLOBALS for the 'wpacu_filtered_plugins' index
* Fix: Make sure when the handle information is saved, there are no PHP notice errors if the 'src' index is missing as some handles do not have an "src" (e.g. 'woocommerce-inline' handle)

= <strong>1.1.6.9</strong> - 20 April 2020
* 'Remove All "generator" meta tags?' improvement: Higher accuracy in stripping META tag generators if the option is enabled in case some of their attributes have no quotes around them (rare cases)
* If 'Remove "REST API" link tag?' is enabled, the <em>/wp-json/</em> reference is also removed from the "Response headers" when accessing the page via remove_action()
* Compatibility with extra page builders: "X" & "PRO" themes (Theme.co), "WP Page Builder" & "Page Builder: Live Composer" plugins: whenever their editor is ON, no unloads or any other changes to the HTML source (including minification) are performed to make sure the editor is loading its files and works smoothly
* Compatibility with "Redis Object Cache" plugin: The global variable <em>$wp_object_cache</em> is no longer used and it's replaced with a custom solution
* Compatibility with "404page – your smart custom 404 error page" plugin and similar plugins that are making pages as 404 customizable ones
* For debugging purposes, the admin can use /?wpacu_no_cache to view how the website would load without the CSS/JS cache applied
* Fix: Avoid deprecated error notice when a non-static function was called as being static
* Fix: Avoid "Warning: DOMDocument::loadHTML(): Empty string supplied as input" in some situations when the HTML source is parsed
* Fix: "style>" was showing up at the top of the page when Inline CSS was enabled when the fetched file (for inlining) was empty or only had comments in it

= <strong>1.1.6.8</strong> - 15 April 2020
* For maximum compatibility, any inline CSS/JS code associated with a handle (e.g. added via wp_add_inline_style() & wp_add_inline_script()) is automatically appended to any file that is added to a combined CSS/JS file
* Added more elements to the debug area (accessed via /?wpacu_debug to show how much time it takes to load them); Also, the time calculating to dequeue CSS/JS handles wasn't accurate, this has been fixed
* Prevent certain DOMDocument calls (which can be slow on large HTML documents) when they are not necessary (e.g. when preloading CSS stylesheets and the RegEx which is faster can do the same task with the same accuracy)
* If Minify STYLE/SCRIPT (inline) tags are enabled, then make that content larger than 40KB are cached as so far the minify was done on every page load and for very large inline tags, it would have used more resources and time to render the HTML output
* In some cases, the PHP function strtr() has proven to be faster than str_replace() to make replacements, thus it has been applied to some methods that are dealing with the alteration of the HTML source
* Fix: In some situations, the fetching of the CSS/JS list got stuck without loading anything due to a fetching speed filter that disabled all other plugins apart from Asset CleanUp Pro to load on the last AJAX call

= <strong>1.1.6.7</strong> - 7 April 2020
* Added contract / expand asset row for hardcoded assets so the admin could contract them if they take too much space and some of them will likely never be unloaded in any page
* Clear plugin's cache via AJAX after "Settings" is updated within the Dashboard (this is more effective then clearing it when the page reloads as it could take some time to clear the cache if there are lots of files stored there)
* Trigger certain actions (to save database & disk space) when the plugin is deactivated: Clear all its transients from the database & Remove the caching directory if it doesn't have any more CSS/JS; If all the plugin's changes were cleared via "Tools" -> "Reset", then deactivating the plugin will completely clear any of its traces
* The plugin's own files that are needed for the plugin's functionality (they are only loading for the logged-in admin), are loaded asynchronously (CSS) and deferred (JS) to ensure the admin doesn't load them as render-blocking especially when managing the pages in the front-end view
* The combined CSS tags can now be altered for any reason via add_filter() through the 'wpacu_combined_css_tag' tag name, just like the combined JS tags are via 'wpacu_combined_js_tag'
* While the CSS/JS assets are fetched prevent extra performance plugins from triggering their optimisation for CSS/JS/HTML as the action is irrelevant and uses resources during the fetching of the assets for the admin

= <strong>1.1.6.6</strong> - 4 April 2020
* Backend Improvement: Prevent all front-end optimisation code from triggering while the CSS/JS is fetched, thus saving resources (this also leads to a faster fetching of the CSS/JS list)
* Backend Improvement: Optimised the plugin to use less calls (there were redundant ones) to the minify CSS/JS library for hardcoded assets, reducing considerably the resources used and avoiding 500 Internal Errors when fetching the CSS/JS list for management (sometimes timeout errors are generated in hosts with less resources allocated, such as the memory)
* If plugin is updated in the "Plugins" page and the update fails, the admin is alerted by the potential reasons and is advised to take further action (e.g. license is not active for the website or there's a timeout in doing the update for any reason)

= <strong>1.1.6.5</strong> - 1 April 2020
* New Feature in the CSS/JS Manager: The handle rows can be contracted/expanded (their status is saved when the form is submitted); This is useful to make the whole area smaller (less scrolling) as there will likely be CSS/JS file that you know you will never edit for a long time (if ever) and it's better to have them contracted
* Show confirmation message when unloading specific files that are very likely needed such as jQuery, Backbone & Underscore libraries
* Alert the admin when there are unload rules from inactive plugins on pages such as "Bulk Changes" & "Overview"
* Keep Dashicons loaded if the toolbar (top admin bar) is shown
* Do not load own plugin's (Asset CleanUp Pro) CSS/JS files in the front-end when the admin is logged-in and managing assets in the front-end is disabled (keep things tidy: no point in having extra HTTP requests loaded, even if load just for the admin)
* Backend Improvement: When a plugin page (e.g. "Settings") is visited within the Dashboard, trigger a maintenance script that will remove inactive handle data information (from handles without any rule attached to it, often from deleted plugins no longer used) from the "wpassetcleanup_global_data" option value (from `options` table), thus making it lighter
* Backend Improvement: In many hosting environments, the total number of fields submitted is maximum 1000 (set by default in php.ini); The total number of fields that were sent have been reduced (e.g. hardcoded assets information) as they are only enabled via JavaScript whenever they are relevant to make sure there are less fields sent (to void partial submit and missing data as a result in case the admin has difficulties increase the default 1000 in php.ini)
* Backend Improvement: Do not automatically store hardcoded assets info when the CSS/JS manager list is loaded; Instead, store it IF there's a rule attached to it in order to make the contents of the "wpassetcleanup_global_data" option smaller in size (for a lighter database & faster MySQL queries)
* Fix: Added missing load exception rules in the "Overview" page for 404 Not Found, Search Results and Date archive pages
* Fix: When generating combined JS files, local file starting with // (no protocol added to them) were not added to the combined JS content
* Fix: Higher accuracy in stripping 'before' and 'after' associated inline SCRIPT after adding the content to the JS combined file (sometimes, these associated inline tags were left unstripped)

= <strong>1.1.6.4</strong> - 24 March 2020
* In "Settings" page, a check is automatically made (in "Optimize CSS" & "Optimize JavaScript") to determine if the website is delivered through the HTTP/2 network protocol, thus encouraging the admin to avoid combining CSS/JS unless it's really necessary
* Save resources by skipping certain SCRIPT tags if Inline JS is enabled for files below a specific size in KB (a confirmation window was also added up when the option is enabled to remind the admin that using it could break things if not used carefully)
* Fix: Added missing update functions that failed specific things to update from the edit taxonomy page (e.g. a category) within the Dashboard

= <strong>1.1.6.3</strong> - 16 March 2020
* Improved the speed of the generated & printed combined CSS/JS assets by ~30ms (depending on the hosting package and the PHP version used) when the HTML source is altered by avoiding extra useless verifications of the HTML output
* Improved combine CSS/JS feature: If the inline content (CSS/JS) that is associated with a handle (added via wp_add_inline_style() or wp_add_inline_script()) changes and the caching is cleared, make sure a new JS combined file is generated. Before, the caching had to be cleared in the browser as well, leading to old JS loaded in some situations
* When managing the assets, make sure the checkboxes from the load exception area are always disabled if there's no unload rule set, thus avoiding any user error to mistakenly add useless load exceptions to an already loading asset, also avoiding any confusing and get a cleaner list in the "Overview" area
* When managing the assets, make sure to show "before" and "after" content (so the user is aware how is that inline tag generated) associated with a handle too (not just the "data" one added via wp_localize_script())
* "Overview" page update: If there's any "Load it for the logged-in user" exception for a handle, show it
* Fix: Avoid creating redundant CSS files when minify inlined tags is enabled, leading to a large number of files in the caching

= <strong>1.1.6.2</strong> - 8 March 2020
* Caching: Expired CSS/JS files are cleared differently (in time after visiting various pages) to save resources and errors related to the PHP memory (e.g. shared hosting packages often have limitations in terms of the server's CPU & memory usage)
* Make sure the combined CSS/JS file is valid before its tag is generated in the HTML output (in rare cases, the cached CSS/JS files get deleted either by mistake when developers are cleaning up the caching directory OR they weren't properly created in the first place)

= <strong>1.1.6.1</strong> - 3 March 2020
* New ways of sorting the CSS/JS management list: By handles with rules & without rules / By the files size in descending order (from largest to smallest)
* Compatibility with "Smart Slider 3" plugin (and similar plugins that load the assets the same way): STYLE/LINK/SCRIPT are all showing up in the hardcoded assets list
* Higher accuracy in detecting hardcoded scripts that are loaded via output buffering levels
* Compatibility fix to avoid PHP warning error when "Smart Slider 3" & "WP Rocket" are used and the CSS/JS assets are fetched
* Improvement: Strip empty STYLE/SCRIPT tags if, after optimization, their content is empty (e.g. the CSS was minified as it had only comments in it)
* Improvement: In case fetching the assets will result in an error, filter the HTML output from certain tags that could mess the whole Dashboard layout
* Improvement (to save resources): Do not trigger Composer's autoloader while the assets are fetched
* Improvement (to save resources): Do not fetch all the hardcoded assets for the guest visitors if there are no hardcoded assets marked for unload
* Improvement (to save resources): Added disk caching mechanism for inline CSS/JS optimized content to avoid going on every page load through minify and other alterations that could add up to the TTFB (time to the first byte)
* Fix: If 'Ignore dependency rule and keep the "children" loaded' would have been checked for a JavaScript handle, the script would be unloaded on all pages disregarding whether it was marked for unload or not
* Fix: When minification is applied for inlined CSS, do not touch the background URLs as sometimes it leads to issues

= <strong>1.1.6.0</strong> - 25 February 2020
* New Feature: Manage hardcoded CSS/JS (non-enqueued using the WordPress functions)
* Improvement: Save resources and prevent any optimizations from triggering while the assets are fetched (no HTML alteration via "wp_loaded" action hook is needed) for the admin
* Improvement: Do not inline CSS/JS files that are within conditional comments (Internet Explorer)
* Fix: SCRIPT tags within conditional comments (Internet Explorer) were moved from HEAD to BODY (if the option was chosen) without their conditional tags (keep them within the HEAD)

= <strong>1.1.5.9</strong> - 21 February 2020
* Make the admin aware in case a certain CSS/JS asset is loaded within Internet Explorer conditional comments (Read more: https://www.sitepoint.com/internet-explorer-conditional-comments/)
* "display=" is now applied to Google Fonts final URL, generated via WebFontConfig within inline SCRIPT tags
* Licensing: Auto activate site if the license is Unlimited (e.h. for the admin's convenience in case a move from Staging to Live was done and the license wasn't activated on Live)
* Licensing: Show renewal link if the license is expired; If the license is not active, show its status (in red background) near the 'License' text near the sidebar menu
* Allow CSS/JS management for privately published pages
* Fix: Make sure the path to /wp-includes/ (or other internal directories) is the right one when the blog URL is like mysite.com/blog/
* Added "Debugging" tab to "Tools" page
* From now on, "disk" is the default method for storing the cached information of the assets

= <strong>1.1.5.8</strong> - 8 February 2020
* Storage info for cache directory shows the total size/number of all files (not just CSS/JS ones)
* Removed plugin's meta boxes when a block ("oxy_user_library" post type) is edited in Oxygen Builder plugin (as the meta boxes are not relevant there)
* Any plugins that are unloaded in "Plugins Manager" are listed in "Asset CleanUp Pro: CSS & JavaScript Manager" (beginning of the list), reminding the user why none of the plugins' assets (if any) are listed for management
* If the admin edits a page (post, page, taxonomy, homepage) from the Dashboard, notify him/her if the page's URI is matched by any of the rules from "Do not load the plugin on certain pages"
* "License" page update: on page load it automatically retrieves the total number of activations and the total available ones (e.g. if you have 2 active websites and a Plus license, it would show 2/3 activations)
* Proceed with the combine CSS/JS (if enabled) when there are common query strings in the URL (e.g. Google Analytics campaigns, Facebook clicks)
* Compressed images for a lighter plugin
* FileSystem is always using the "direct" method for altering CSS/JS files, thus avoiding (e.g. by mistake via a different plugin using the same WordPress FileSystem class) any reading/writing error for the cached files
* When fetching assets, make sure some plugins such as Fast Velocity Minify (that could interfere with the HTML output) are deactivated
* When updating a post/page/homepage, the caching is now cleared after the page is updated via an AJAX call (asynchronously) thus reducing the memory usage and the time spent until the page reloads
* "Plugin Manager": List plugins with rules first (for easier reading)
* If a plugin that has unload rules is not active (or deleted), do not show it as unloaded in the CSS/JS management list as only active plugins are verified for any unload rules
* On page request (within the Dashboard), /?wpacu_get_cache_dir_size will retrieve information about the cache directory (all its files and their sizes get printed)
* Debugging feature: If /?wpacu_clean_load is used, it will show the unoptimized version of the page (great for locating specific files that were perhaps combined and cached by various plugins)
* Debugging feature: If /?wpacu_debug is used, it will print a list of options to deactivate on page request (for the logged-in admin)
* Debugging feature: If /?wpacu_no_async and/or /?wpacu_no_defer is used, it will prevent any SCRIPTS with "src" to have async/defer attributes applied
* Debugging feature: Allow the option to deactivate any HTML source alteration ("wp_loaded" action hook) via page request: /?wpacu_no_html_changes
* Optimize CSS Improvement: Avoid any errors in case "circular reference" is detected (via @import)
* Fix: CSS/JS URLs starting with // were giving unreachable error when checked if they are valid or not
* Fix: Prevent errors in some BuddyPress pages as $post->post_type is undefined
* Fix (plugin compatibility): Avoid call_user_func_array() PHP error if SiteGround's "Remove Query String From Static Resources" is enabled
* Fix: Make sure "Do not load the plugin on certain pages" takes effect for any "Plugins Manager" rule as well

= <strong>1.1.5.7</strong> - 5 January 2020
* New Feature (located in "Settings" - "Plugin Usage Preferences" - "Do not load the plugin on certain pages"): Useful if you wish to deactivate any Asset CleanUp Pro rules on specific pages (e.g. non-cached pages such as /basket/ or a page where there are any issues if the plugin is activated)
* Improvement: Do not trigger Asset CleanUp Pro if TranslatePress Multilingual plugin is in edit mode (front-end view)
* Improvement: Only trigger Asset CleanUp Pro when plugin related AJAX calls are made via admin-ajax.php for a faster response timing
* Bug Fix: Avoid reporting any DOMDocument errors as they are irrelevant

= <strong>1.1.5.6</strong> - 28 December 2019
* New Feature: Load exception in "Plugins Manager" - "Always load it if the user is logged in" (e.g. you might want a plugin unloaded for guest users, but loaded for the logged in users, such as the administrators)
* Improvement: Sometimes, specific plugins are used to alter the HTML source (e.g. features such as minify HTML); Make sure no META tags are left in the BODY tag as it would give validation errors in https://validator.w3.org/
* Bug Fix: Make sure "Load it on this page" always stays checked after the assets management list is updated
* Bug Fix: When saving plugins' unload/load exception rules, make sure the slashes are stripped from any RegEx in case certain characters are used in the RegEx

= <strong>1.1.5.5</strong> - 17 December 2019
* New Feature: Make exception (from any unload rule) and load an asset if the user is logged in
* Improvement: Updated RegEx verification to avoid printing PHP errors in the front-end view (sometimes messing the layout) if the RegEx input is not valid
* Improvement: RegEx Input is turned into a Textarea making the area expandable (in case the RegEx rule is long) and allows more than one RegEx rule to be added if it's easier (one rule per line)

= <strong>1.1.5.4</strong> - 14 December 2019
* Fix PHP warning errors within the "Overview" admin page (Asset CleanUp Pro's menu) within the Dashboard
* Adjust the text below "CSS & JS Manager", "Plugins Manager", "Bulk Changes" to stay on the same line

= <strong>1.1.5.3</strong> - 13 December 2019
* New Feature: Initial release of "Plugins Manager" which allows unloading the plugins (not just their CSS/JS files) which would be like having the plugin deactivated for the specified rule; This comes with an MU plugin (for early triggering, before all the other plugins) called "Asset CleanUp Pro: Plugin Filtering" which is dependant on Asset CleanUp Pro (if deactivated, its MU plugin will get deleted)
* Improvement: Added the total number of handles for stylesheets and scripts in "Overview" page
* Bug Fix: In rare cases, the version of a CSS/JS could be an array, not just a float/integer number; Prevent notices from showing up when 'ver' is an array and make sure the proper query string is passed to the link/path of the source file

= <strong>1.1.5.2</strong> - 24 November 2019
* Improvement: Added "Overview" page which has the list of all the changes made to a specific CSS/JS file (handle), offering a much easier way to understand the changes made and do any debugging
* UI Improvement: The height of the CSS/JS asset row (when managing the list) is smaller, depending on the settings, making it easier to do scrolling
* UI Improvement: Adjust the total height of the "Note" textarea based on the content added, thus reducing the spacing between assets for easier scrolling/management
* Code Improvement: Split a few large files into multiple ones for easier management
* Backend Performance Improvement: Prevent Asset CleanUp Pro's (own) CSS/JS from loading in edit post/page when the files aren't needed (e.g. no meta boxes are showing up because they were hidden)
* Bug Fix: Do not alter any Google Fonts links if there is no "family=" within it ("Smart Slider 3" fix)
* Bug Fix: When a bulk unload is chosen for a category/date/404 (any page manageable in the Pro version), make sure the load exception area is showing up

= <strong>1.1.5.1</strong> - 18 November 2019
* All "RegEx Load Exceptions" can also be managed in "Bulk Changes" (the same way as "RegEx Unloads")
* Debugging Improvement: When /?wpacu_show_handle_names is used, it will print the handle name as a "data" attribute tag within the LINK/SCRIPT; Great for debugging and to find out if any of the assets are hardcoded
* Added information about the handles (source, version) in "Bulk Changes" for easier management
* Extra compatibility with AMP pages: Do not move from HEAD to BODY any SCRIPT tags containing //cdn.ampproject.org/
* Improvement: Once the Assets List is loaded for management, verifications would be made to check if the files exist or not returning errors (e.g 404 Not Found); any that return errors gets highlighted with a notification (great to spot any deleted files or external resources that are pointing to bad requests)
* Polished plugin's CSS for WP 5.3
* Plugin Compatibility: Make sure Asset CleanUp Pro's combine CSS/JS works if "HTML Minify" is enabled in W3 Total Cache
* Improvement: When saving the RegExes for unload & load exceptions and verifying if a pattern matches the current requested URI, the T-Regx library is used that also fixes any invalid regular expression patterns (e.g. if no delimiters were added, they will be added automatically)
* Bug Fix: When a category is saved, an error was triggering for calling a method in the wrong class
* Bug Fix: Bug Fixes: Make sure the regex load/unloads get saved when applying the changes from an edit taxonomy (e.g. category) page
* Bug Fix: Make sure the load it on this page & regex checkboxes always stay checked (only an issue within the Dashboard)
* PHP 7.4 Compatibility Fix: Removed deprecated errors for "Array and string offset access syntax with curly braces is deprecated"

= <strong>1.1.5.0</strong> - 7 November 2019
* Compatibility with "AMP (Official AMP Plugin for WordPress)" and "AMP for WP – Accelerated Mobile Pages" plugins: If the page is of AMP type, no Asset CleanUp settings/rules will be triggered to avoid validation errors; Moreover, NOSCRIPT tags added by Asset CleanUp are moved to the BODY tag (they are no longer stored in the HEAD tag) to avoid further validation errors in case other AMP plugins/scripts are used and Asset CleanUp Pro doesn't detect them
* Combine CSS Improvement: Stylesheets that are asynchronously loaded are also combined into fewer files (e.g. if 10 CSS files from HEAD are async preloaded, they will be combined into one async preloaded file) to reduce the number of HTTP requests
* New Unload Feature: Unload CSS/JS for URLs with request URI matching a specific RegEx
* New Feature: Skip "Test Mode" on page request for debugging purposes via /?wpacu_skip_test_mode - e.g. useful when you have to check a website and you don't have admin access and "Test Mode" is enabled (you can check if anything is broken there while the page loads fine for other visitors)
* Bug Fix: If "Test Mode" was enabled, "async" and "defer" rules applied per page for JS files weren't ignored
* Improvement: No matter what type of layout to show the assets list is chosen from "Assets List Layout:", it will show the total number of CSS/JS for each group (e.g. total files from the theme, total files from all the active plugins, etc.)
* Improvement: Option to choose how the caching information (asset details including its location in the caching directory) is retrieved in "Plugin Usage Preferences" (useful to reduce database queries in case one has a large database that is slow in retrieving information)

= <strong>1.1.4.9</strong> - 28 October 2019
* New Feature: If in CSS/JS is loaded everywhere (or for instance on a custom post type), you can make an exception and load it if the URL (precisely the request URI) matches a specific RegEx (read more: https://assetcleanup.com/docs/?p=21#wpacu-method-2)
* Improvement: When assets are fetched to show in the load manager, prevent WP Rocket from running as well as Query Monitor from outputting information
* "Duplicate Post" compatibility fix: Make sure Asset CleanUp's meta values are taken into account when a post is cloned
* Bug Fix: Hide any PHP notice errors (reported in the error log in some environments) for cached CSS/JS as the 3rd parameter ("src" as it is) wasn't added to the returned array

= <strong>1.1.4.8</strong> - 20 October 2019
* Improvement: CSS/JS URLs that start with "/" (relative) or "//" (some themes/plugins strip the protocol when enqueuing them) are checked and if they are from the same domain, they will be optimized
* "Smart Slider 3" plugin compatibility: Make sure the plugin's JavaScript files that are not enqueued (but appended to the HTML source via output buffering) get optimized (e.g. combined)
* Added more tutorials to "Getting Started" -> "Video Tutorials"
* Changed default value for "Move Scripts to BODY" exceptions for AMP pages compatibility

= <strong>1.1.4.7</strong> - 14 October 2019
* New Feature in "Optimize JavaScript": Move All SCRIPT tags from HEAD to BODY
* New Feature in "Optimize JavaScript": Move jQuery inline code after the jQuery library is called
* Combine Google Fonts Requests Improvement: If the LINKs already have extra commas in the font weights, they will be stripped properly and all the font weights arranged in alphabetical order in the resulting LINK tag
* Improvement: Prevent irrelevant notice errors from being recorded in some error log server files to avoid confusion about the functionality

= <strong>1.1.4.6</strong> - 6 October 2019
* Compatibility with "Cache Enabler" plugin: Make sure the saved HTML files have all the changes made by Asset CleanUp Pro
* Inline JS automatically is no longer enabled by default; Added a notice about what it means to inline JS files to reminder the user to be extra careful
* Make "Update" button area (for assets management) sticky on certain pages (to avoid scrolling too much before deciding to perform the update)
* Optimize hardcoded assets that are starting with a relative path (e.g. /wp-content/ without the site URL)
* Cache Dynamic Assets Improvement (also checks for www.domain.com?query without /)
* Improvement: If 'Ignore dependency rule and keep the "children" loaded' is used and the the tag (LINK or SCRIPT) has inline code (e.g. before/after the tag) associated with it (e.g. added via wp_add_inline_script() or wp_add_inline_style()), make sure that code is also stripped along with the tag
* Bug Fix: If 'Ignore dependency rule and keep the "children" loaded' was checked, it would have stripped the tag from the HTML source even if no unload rule was set (e.g. forgotten to be set by the admin)
* Bug Fix: If Combine CSS is enabled, make sure that moved CSS from HEAD to BODY is combined and deferred separately from other CSS from the BODY

= <strong>1.1.4.5</strong> - 27 September 2019
* Inline automatically CSS/JS smaller then (specific size) KB (if option is enabled)
* Inline CSS/JS Improvement: Inline dynamic loaded CSS/JS (if option is enabled)
* Improvement for "Google Font Remove": Added more patterns to detect Web Font Loader CDN requests
* WP Rocket Compatibility Fix: If the CSS/JS files' path get changed by "WP Rocket" (path contains "/wp-content/cache/busting/"), make sure they are getting unloaded by Asset CleanUp Pro if 'Ignore dependency rule and keep the "children" loaded' option is checked along with the unload rule

= <strong>1.1.4.4</strong> - 25 September 2019
* New Feature: Rewrite cached static assets URLs with the CDN ones if necessary (located in "Settings" -> "CDN: Rewrite assets URLs")
* Improvements: Strip Google Fonts references from JavaScript (.js) files (if the option is active)
* Append "display" parameter to Google Font URLs within JavaScript files (if any option for "font-display:" is chosen)
* Bug Fix: Make sure all values from "Site-Wide Common Unloads" show the correct status (enabled/disabled) in "System Info" from "Tools"

= <strong>1.1.4.3</strong> - 16 September 2019
* New Assets Management Feature: Until now, the list was loaded automatically on edit post, page, custom post type, and taxonomy. You can choose to fetch the list when clicking on a button. This is good when you rarely manage loaded CSS/JS and want to declutter the edit page on load and also save resources as AJAX calls to the front-end won't be made to retrieve the assets' list.
* New Feature: Cache Dynamic Loaded CSS & JavaScript to avoid loading the whole WP environment and save resources on each request (e.g. /?custom-css=value_here or /wp-content/plugins/plugin-name-here/js/generate-script-output.php?ver=1)
* Reduced the number of database queries to fetch cached information making the pages preload faster (when the caching is rebuilt) thus reducing the loading time especially if PHP 5.6 is still used (which is slower than PHP 7+ when it deals with database connections).
* Combine JS files improvement: If there are multiple files that have "defer" or "async" attribute set (or both) and they are not preloaded, then they will be grouped into fewer files; Before, only SCRIPT tags without these attributes were combined
* Improvement to reduce disk space: Make sure already minified (100%) static .js files aren't cached
* Google Fonts Optimization: Requests that are for icons (e.g. https://fonts.googleapis.com/icon?family=Material+Icons) are also combined to reduce HTTP requests
* "Optimize CSS Delivery" from WP Rocket works together with "Inline Chosen CSS Files" from Asset CleanUp Pro
* Prevent plugin from loading when Themify Builder (iFrame) is used
* Bug Fix: Sometimes, the position of an asset (HEAD or BODY) is reported incorrectly if it was enqueued in specific action hooks; Extra checks are made to fix that as sometimes developers do not use wp_enqueue_scripts() which is the proper hook to use when enqueuing items that are meant to appear on the front end
* Bug Fix: If CSS files get inlined, make sure @import without "url" is updated correctly in all situations
* Bug Fix: In rare cases, managing assets for the Homepage is not working properly. Reason: $post is overwritten by external plugins or the theme because the developers have forgotten to use wp_reset_postdata() and reset it to its initial value (which should be 0 in this case).

= <strong>1.1.4.2</strong> - 10 September 2019
* New Feature: Remove Google Font Requests (including link/font preloads, @import/@font-face from CSS files & STYLE tags, resource hints)
* Higher accuracy in detecting META tags with the "generator" name even if the "content" attribute contains unusual characters
* Minify/Combine CSS Improvement: Any @import found including a local CSS in another CSS file is fetched (and minified/optimized if necessary) and added to the parent file (this reduces HTTP requests, saving additional round-trip times to the overall page load) - Read more: https://gtmetrix.com/avoid-css-import.html
* Hardcoded CSS/JS (not enqueued the WordPress way) from the same domain (local) get minified/optimized
* Improved the UI for "License" page
* Bug Fix: If Google Fonts loading type is async (optional with preload) then make sure it's applied even if there's only one LINK request

= <strong>1.1.4.1</strong> - 2 September 2019
* New feature: Inline Chosen CSS/JS files (usually small ones) saving the overhead of fetching them resulting in fewer HTTP requests (more: https://varvy.com/pagespeed/inline-small-css.html / https://gtmetrix.com/inline-small-css.html)
* New Option to load Google Fonts: Asynchronous by preloading the CSS stylesheet
* Reduced redundant CSS/JS files cached for logged-in users, thus making clearing the caching faster and reducing the total disk space (sometimes, on certain hosting environments with lower memory limit clearing the whole caching resulted in "PHP Fatal error: Allowed memory size of (X) bytes exhausted")

= <strong>1.1.4.0</strong> - 27 August 2019
* Option to disable "Freemius Analytics & Insights?" in "Settings" -> "Plugin Usage Preferences" (good if you often deactivate the plugin for debugging reasons or you just don't like plugin feedback popups)
* Changed the vertical "Settings" menu by renaming "Minify CSS & JS Files" & "Combine CSS & JS Files" to "Optimize CSS" & Optimize JavaScript; Added the status of the minify/combine below the menu titles to easily check what optimizations were done
* Improved the way JS files are combined; If "Defer loading JavaScript combined files" is enabled in "Optimize JavaScript", make sure that any external script between the first and last combined JS tags has "defer" attribute applied to it to avoid any JS errors in case a "child" JS file is loaded before a combined "parent" one.
* Combine CSS/JS feature now has the option to aggregate the inline tag contents associated with the combined styles/scripts (e.g. inline added after the LINK tag via wp_add_inline_style() or CDATA, inline added before/after the SCRIPT tag via wp_add_inline_script())
* Option to minify inline content between from STYLE and SCRIPT (without any "src" attribute) tags
* Optimize minify CSS/JS feature to use less resource when dynamically generating the optimized (cached) files; Minification is performed via a new library (ref: https://www.minifier.org/)
* Option to choose between "Render-blocking" and "Asynchronous via Web Font Loader (webfont.js)" when loading the combined Google Font requests
* Bug Fix: Sometimes the dynamically created drop-down from "Hide all meta boxes for the following public post types" (in "Settings" -> "Plugin Usage Preferences") via jQuery Chosen plugin was returning an empty (0px in width) drop-down

= <strong>1.1.3.9</strong> - 15 August 2019
* Option to hide all meta boxes for specific post types (e.g. not queryable or do not have a public URL, making the assets list irrelevant)
* Option to overwrite current "font-display" CSS property with the chosen one from "Settings" - "Local Fonts" for local CSS files
* Bug Fix: In some servers, when preload feature is used and the HTML is not fully valid for DOMDocument, PHP errors were printing
* Extra compatibility with "Breeze – WordPress Cache Plugin"
* Do not trigger Asset CleanUp on Avada's Fusion Builder Live: Edit Mode

= <strong>1.1.3.8</strong> - 9 August 2019
* New Feature: Local Fonts Optimization; Option to add "font-display" CSS property to @font-face within local CSS files; Option to preload local font files (e.g. .woff, .ttf, .eot)
* New Feature: Option to preload Google font files (e.g. .woff)
* Extra Compatibility with the latest version of SG Optimiser
* Bug Fix: Excluding CSS/JS files from combination was not working effectively if Minify CSS/JS was also applied to the asset
* New Feature: Strip LINKs that are made to Google Fonts (fonts.googleapis.com) without any "family" value (e.g. some themes/plugins allow to input the font family but don't validate empty submits)

= <strong>1.1.3.7</strong> - 2 August 2019
* New Feature: Google Fonts Optimization: Combine multiple font requests into fewer requests; Option to add "font-display" CSS property (PageSpeed Insights Reference: "Ensure text remains visible during webfont load")

= <strong>1.1.3.6</strong> - 30 July 2019
* New Option To Conveniently Site-Wide Unload Gutenberg CSS Library Block in "Settings" -> "Site-Wide Common Unloads"
* Better way to clear cached files as the system doesn't just check the version number of the enqueued file, but also the contents of the file in case an update is made for a CSS/JS file on the server, and the developer(s) forgot to update the version number
* When CSS/JS caching is cleared, the previously cached assets older than (X) days (set in "Settings" -> "Plugin Usage Preferences") are deleted from the server to free up space
* New Information was added to "Tools" -> "Storage Info" about the total number of cached assets and their total size
* Prevent specific already minified CSS files (based on their handle name) from various plugins from being minified again by Asset CleanUp (to save resources)
* Bug Fix: When the asset's note was saved, any quotes from the text were saved with backslashes that kept increasing on every save action

= <strong>1.1.3.5</strong> - 25 July 2019 =
* Preload CSS/JS Compatibility Update: If "WP Fastest Cache" is enabled with "Minify CSS" or "Minify JS" option, Asset CleanUp Pro preloading works fine with the new (cached) URLs
* New Feature: Async CSS Loading via preloading for the desired assets (prevent render-blocking loading)
* New Option in "Assets List Layout": Sort assets by their preload status (preloaded or not)
* Bug Fix: Sometimes, the file writing permission constants were not loaded (e.g. FS_CHMOD_FILE)
* Bug Fix: Added extra checking to prevent a PHP warning related to a foreach() call on PluginUpdater.php
* Bug Fix: Some transients where left in the database after a "Reset Everything" was performed causing confusing regarding the total number of unloaded assets
* Prevent Asset CleanUp Pro from loading any of its rules when Gravity Forms are previewed

= <strong>1.1.3.4</strong> - 16 July 2019 =
* Defer CSS: Added support for "integrity" and "crossorigin" for dynamically created LINKs and added default "all" to "media" attribute if no value is set; Only load the dynamic deferred LINK after 'body' element has loaded (once DOM is ready)
* Code CleanUp: Removed blocks of code that weren't used
* Bux Fix: PHP Notice errors were printing on some hosts related to undefined array indexes
* Bug Fix: An error is shown if "Remove HTML Comments" is enabled because of an undefined constant
* Bug Fix: Assets' Positions weren't retrieved in "Bulk Changes" because of a PHP error

= <strong>1.1.3.3</strong> - 13 July 2019 =
* New Feature: Option to preload CSS/JS files by ticking "Preload (if kept loaded)" checkbox for the corresponding file (More info: https://developers.google.com/web/tools/lighthouse/audits/preload)
* Hide irrelevant Asset CleanUp MetaBoxes when custom post types from "Popup Maker" & "Popup Builder" plugins are edited
* Deferred CSS files (moved from HEAD to BODY), are inserted right after the BODY tag

= <strong>1.1.3.2</strong> - 5 July 2019 =
* Any stylesheet LINK tag within the BODY is automatically deferred by loading it via JavaScript (fallback is in place)
* Bug Fix: When pages were updated, jQuery Migrate and Comment Reply were loaded back (when they were marked for unloading)
* Bug Fix: Sometimes, WP Rocket caching was not fully cleared because of an Asset CleanUp hook that interfered with it

= <strong>1.1.3.1</strong> - 3 July 2019 =
* Option to unload on all pages (site-wide) the Dashicons for non-logged-in users
* Load it on this page (exception) is preserved if chosen before any bulk unload
* Better accuracy in getting the total unloaded assets
* Used transient to store total unloaded assets from the SQL query (it's slow on some servers)
* Improved "Plugin Review" notice to use fewer queries to determine if it will be shown or not
* On plugin activation, mark Checkout/Cart pages from WooCommerce & EDD to not apply plugin combine/minify options
* Fixed undefined error related to ignoring "children" option
* Improved "CSS/JS Load Manager" pages overview layout
* Disable oEmbeds Feature; Option to update "Assets List Layout" while managing the assets
* Added tip messages next to various handles
* Bug Fix: AJAX call for retrieving plugins' icons was not working

= <strong>1.1.3.0</strong> - 12 June 2019 =
* Implemented WP_FileSystem for dealing with writing and reading cached CSS/JS files
* Minify/Combine CSS/JS files option from Asset CleanUp will be unavailable if already applied in Fast Velocity Minify, SG Optimizer & Swift Performance Lite
* Bug Fix: CSS Combine was returning a 500 error in specific hosting servers although the page was loading successfully in the browser

= <strong>1.1.2.9</strong> - 6 June 2019 =
* Minify/Combine CSS/JS files option from Asset CleanUp will be unavailable if the same feature is used in other plugins (the list includes: Autoptimize, WP Rocket, WP Fastest Cache, W3 Total Cache, SG Optimizer) to save resources and potential conflicts
* Remove Shortlink - Addition: Clean it up from the HTTP header as well (not just within the HEAD section of the website)
* Do not trigger Asset CleanUp on Elementor & Divi Page Builders AJAX calls from the Edit Area (this is especially to save resources on some hosting environments such as the shared ones)
* Only trigger fetching plugin icons from WordPress.org in specific situations (save resources)

= <strong>1.1.2.8</strong> - 1 June 2019 =
* New Feature: Enable Minify CSS/JS on the fly when admin is logged in (for debugging purposes) - via /?wpacu_css_minify
* Updated "Tools" -> "System Info": Has database information related to the Asset CleanUp's entries
* Option to override "administrator" (default) role, in order to access plugin's pages
* Do not trigger Asset CleanUp Pro on REST Requests, WPBakery Page Builder Edit Mode, Brizy Page Builder Edit Mode
* Prevent "Could not read" file size errors in case files (.css, .js) have extra parameters added to them (rare cases)
* Avoid notice errors if some "SG Optimizer" features are enabled
* Minify CSS: Compatibility with "Simple Custom CSS" plugin
* Match sidebar and top bar menus; Allow unloading of CSS/JS on the fly (via URI request) for debugging purposes; Added coloured left border for assets that had their position changed to easily distinguish them
* New Feature: Ignore dependency rule and keep the "children" loaded
* New Feature: CSS/JS "Notes" (useful to remember why you have unloaded or decided to keep a specific file)
* Bug Fix: Posts' Metas (e.g. load exceptions) were not imported
* Bug Fix: Make sure specific elements from "Site-Wide Common Unloads" are properly imported / exported

= <strong>1.1.2.7</strong> - 4 May 2019 =
* "Import & Export" feature (for settings, load/unload rules and everything else)
* Move CSS/JS to BODY or HEAD - Better accuracy in detecting the location of the asset - Dependencies are not affected in any way
* Better CSS/JS minify: In rare cases, if cached files are forcefully deleted from the server (e.g. "/wp-content/cache/" directory is cleared completely) for any reason, or there are partial issues in writing the files to the cache, then the plugin will detect that and provide the original version of the file to avoid any broken front-end (ideally, cache should be cleared after cleaning operations are performed)

= <strong>1.1.2.6</strong> - 21 April 2019 =
* Bug Fix: Make sure that "Unload on this page" checkbox stays selected after page/post update

= <strong>1.1.2.5</strong> - 19 April 2019 =
* Bug Fix: array_key_first() didn't have a fallback for PHP 5 causing plugin admin pages to disappear
* Do not trigger Asset CleanUp if either of the following page builders is in edit mode: "Thrive Architect", "Page Builder by SiteOrigin" & "Beaver Builder"
* Code improvement; Hide meta boxes from Themify builder templates

= <strong>1.1.2.4</strong> - 10 April 2019 =
* Option to prevent plugin to trigger any of its settings & unload rules on request via "wpacu_no_load" query string
* Do not minify CSS/JS from /wp-content/uploads/ (e.g. files belonging to Elementor or Oxygen page builder plugins)
* Added more things to "System Info" including settings and browser information
* Apply relative URLs for combined CSS/JS script/stylesheet tags, if URL opened is via SSL and the WordPress site URL starts with http://
* Bug Fix: Clear CSS/JS cache was returning a blank white page
* Bug Fix: Minify JS - Exceptions weren't applied

= <strong>1.1.2.3</strong> - 1 April 2019 =
* "Bulk Unloaded" is renamed to "Bulk Changes" and has two tabs/pages added with the following features: 1) Remove site-wide "async/defer" for JS files - 2) Restore CSS/JS to their initial positions
* Handles from "Bulk Changes" are shown in alphabetical order
* Bug Fix: The CSS/JS position (HEAD or BODY) wasn't showing correctly on each row
* New Feature: Show plugin list if CSS/JS are sorted by location in 'contracted' mode for easier management
* New Feature: "Check / Uncheck All" for Each Plugin's Assets (when sorted by location is enabled)
* If a CSS/JS has "children" (handles that depend on it), a message will be shown making the admin aware about it
* Make sure no PHP notice errors are shown if there are no bulk CSS/JS files to manage
* Do not show Asset CleanUp meta boxes when editing Oxygen Builder templates ('ct_template' custom post type) as boxes are useless in this instance; this avoids any confusion &amp; declutters the edit template page

= <strong>1.1.2.2</strong> - 16 March 2019 =
* Bug Fix: 403 Forbidden error was returned when fetching assets within the Dashboard because of the wrong nonce check
* Option to show on request all the settings (no tabs) within "Settings” plugin's area by appending '&wpacu_show_all' to the URL like: /wp-admin/admin.php?page=wpassetcleanup_settings&wpacu_show_all

= <strong>1.1.2.1</strong> - 15 March 2019 =
* "Manage in the Front-end?": Add exceptions from printing the asset list when the URI contains specific strings (e.g. "et_fb=1" for Divi Visual Builder)
* Option to hide plugin's meta boxes on edit post/page area within the Dashboard
* Make sure no irrelevant errors are written excessively to the server's log printed via DOMDocument in case the HTML is not fully valid

= <strong>1.1.2</strong> - 12 March 2019 =
* New CSS/JS Manage Sorting Option: By HEAD and BODY locations
* Make no CSS file (that should be minified) is missed from minification such as the ones from BODY which are loaded later in the code
* Prevent PHP notice errors from showing up in the server's (e.g. Apache, Nginx) error log files
* New CleanUp option: Strip HTML Comments

= <strong>1.1.1.9</strong> - 7 March 2019 =
* Added option to update the $content and $priority of the Asset CleanUp meta boxes via "add_filter" via the following tags (for each meta box): wpacu_asset_list_meta_box_context, wpacu_asset_list_meta_box_priority, wpacu_page_options_meta_box_context, wpacu_page_options_meta_box_priority
* Bug Fix: Make sure Emojis are always disabled when specified in the Settings and there is no DNS prefetch to //s.w.org
* Bug Fix: Prevent breaking the JS if minified and contains strings such as /**/

= <strong>1.1.1.8</strong> - 1 March 2019 =
* Prevent AJAX calls from triggering to retrieve asset list when a new post/page is created as the CSS/JS files should only be fetched when after the post/page is published
* Improved the PHP code to use fewer resources on checking specific IF conditions
* Added introduction to the "Settings" area about how the plugin is working to give the WordPress admin user a clear understanding of what needs to be done to optimize the pages
* Bug Fix: Prevent CSS files containing "@import" from getting combined (they remain minified) to prevent breaking the layout
* Bug Fix: "Do not minify JS files on this page" checkbox from the side meta box (edit post/page area) wasn't kept as selected after "Update" button was used
* Bug Fix: Avoid PHP notice errors in case arrays that do not always have specific keys are checked

= <strong>1.1.1.7</strong> - 24 February 2019 =
* Added readme to the "Settings" area to remind website admins about the role of the plugin
* New Feature: The location of a CSS/JS file can be updated site-wide when managing the asset on any page (from HEAD to BODY and vice-versa); Useful when, for instance, you have CSS/JS code that is loading on the HEAD (render-blocking), but it's only needed later (e.g. popups, AJAX calls outputs etc.)
* Reduced the number of cached files on the /wp-content/cache/asset-cleanup/ directory for the combine CSS files; 404 Not Found (any URL) pages now have only one caching information file created
* Make sure CSS files containing "@import" are not combined to avoid breaking the pages' layout

= <strong>1.1.1.6</strong> - 21 February 2019 =
* Feature update: "Combine CSS loaded files" - now the files loaded within BODY tag are also combined to further reduce HTTP requests

= <strong>1.1.1.5</strong> - 18 February 2019 =
* Feature update: Added "Get File Size" link to get the size of an external CSS/JS file to avoid overloading the server with many AJAX requests in case there are many assets loaded from CDN locations (useful to avoid max_user_connections errors and 503 errors in some WP environments such as shared hosting accounts where any CPU/memory usage reduction matters)

= <strong>1.1.1.4</strong> - 13 February 2019 =
* New Feature: Defer loading JavaScript combined files from BODY tag
* Changed the way the JS files are combined resulting in fewer combination groups taking into account the HEAD and BODY HTML tag locations
* Offer the option to clear the CSS/JS caching even if CSS/JS Minify/Combine options were deactivated
* Bug Fix: Make sure MSIE conditional script tags are not combined into JS groups
* Bug Fix: Old links to the manage homepage page from the admin bar were updated with the new ones
* Bug Fix: On some WordPress setups, the path to the CSS background image URL after combination was updated incorrectly

= <strong>1.1.1.3</strong> - 11 February 2019 =
* New Features: Minify CSS & JavaScript files (remaining loaded ones after the useless ones were unloaded)
* Bug Fix: Make sure no 500 errors are returned on save settings or save post when the wrong caching directory is read

= <strong>1.1.1.2</strong> - 4 February 2019 =
* New Feature: "Asset CleanUp: Options" side meta box showing options to disable plugin functionality for posts, pages, and custom post types; Ideal to use with the "Preview" feature if you wish to see how a page loads/looks before publishing any changes

= <strong>1.1.1.1</strong> - 2 February 2019 =
* Fix: Make sure scripts with "async" and "defer" are excluded from any JS combination
* "Combine CSS files into one" feature update - CSS files having media="print" or media="only screen and (max-width: 768px)" (and so on) are not combined
* "Combine JS files into fewer ones" feature update - jQuery and jQuery Migrate are combined as a single group (not together with any other files); if only jQuery is loaded (without jQuery Migrate), it will not be added to any group and load independently

= <strong>1.1.1.0</strong> - 1 February 2019 =
* Bug Fix: Prevent fatal error from showing in PHP 5.4 when the plugin was updated
* Re-organised the plugin's links within the Dashboard to make it easier to navigate through

= <strong>1.1.0.9</strong> - 29 January 2019 =
* New Feature: Combine remaining loaded JavaScript files into fewer files, depending on the page's settings (for maximum compatibility and performance, the files are not combined into only one large file)
* The combined loaded files caching is now stored only on /wp-content/cache/asset-cleanup/ directory (no longer in the database as transients to avoid overloading the options table with too many entries)

= <strong>1.1.0.8</strong> - 22 January 2019 =
* New sorting by location (default) option in "Assets List Layout" setting; Cache transients are also cleared when resetting everything; Changed plugin's default settings ("Inline code associated with this handle" is contracted by default)

= <strong>1.1.0.7</strong> - 19 January 2019 =
* WooCommerce & WP Rocket Compatibility - Bug Fix: When both WooCommerce and WP Rocket are active and an administrator user is logged in and tries to place an order, the "Sorry, your session is expired." message is shown

= <strong>1.1.0.6</strong> - 16 January 2019 =
* Make sure that no CSS is combined if "Test Mode" is ON
* State that DOMDocument is required for "Combine Loaded CSS" feature

= <strong>1.1.0.5</strong> - 16 January 2019 =
* "Combined Loaded CSS" feature (concatenates all the remaining loaded stylesheets within the HEAD section of the page and saves them into one file) to reduce HTTP requests even further
* Improved "Getting Started" area
* Made "Settings" as the default page where you (the administrator user) is redirected when activating the plugin for the first time
* "Remove Query String from Static Resources" feature was removed as it wasn't keeping the version tag inside the file (causing possible outdated CSS &amp; JS to be loaded instead) and wasn't worth it any tiny increase in GTMetrix score as performance and proper functionality are more important

= <strong>1.1.0.4</strong> - 1 January 2019 =
* Added "System Info" to "Tools" page to fetch information about the WordPress environment in case something needs debugging
* Added "Getting Started" page to make things easier for anyone who doesn't understand how the plugin works

= <strong>1.1.0.3</strong> - 22 December 2018 =
* Bug Fix: "async" and "defer" attributes were not added to the script tag if "Manage in the Front-end?" option (in the "Settings" page) was not enabled

= <strong>1.1.0.2</strong> - 19 December 2018 =
* Make sure "ver" query string is stripped on request only for the front-end view; Avoid removing the license info from the database when resetting everything (unless the admin chooses to remove the license info too for a complete uninstall)
* Updated the way temporary data is stored (from $_SESSION to WordPress transient) for more effective use of server resources

= <strong>1.1.0.1</strong> - 14 December 2018 =
* Bug Fix: When settings are reset to their default values via "Tools", make sure 'jQuery Migrate' and 'Comment Reply' are loading again if added in the bulk (site-wide) unload list (as by default they were not unloaded)

= <strong>1.1.0.0</strong> - 14 December 2018 =
* Added "Tools" page which allows you to reset all settings or reset everything
* Bug Fix: Notice error was printing when there was no source file for specific handles that are loading inline code (e.g. 'woocommerce-inline')

= <strong>1.0.9.9</strong> - 12 December 2018 =
* Better support for WordPress 5.0 when updating a post/page within the Dashboard
* On new plugin installations, "Hide WordPress Core Files From The Assets List?" is enabled by default
* Renamed "rule" text with "attribute" when dealing with "async" and "defer" options to avoid any confusions

= <strong>1.0.9.8</strong> - 12 December 2018 =
* Bug Fix: Make sure "Remove rule" for post types (any kind) works correctly in all WP environments and WordPress 5.0 when removing it from the "Edit Page" area (Dashboard) and Front-end view mode

= <strong>1.0.9.7</strong> - 9 December 2018 =
* Option to remove RSS Feed link tags from thesection of the website* Option to hide WordPress core files from the management list to avoid applying settings to any of them by mistake (showing the core files for unloading, async or defer are mostly useful for advanced developers in particular situations)* Improved security of the pages by adding nonces everywhere there is an update button within the Dashboard related to the plugin* Added confirmation message on top of the list in front-end view after an update is made (to avoid confusion whether the settings were updated or not)* The height of an asset row (CSS or JavaScript) is now smaller as "Unload on this page" and bulk unloads (site-wide, by post type etc.) are placed on the same line if the screen width is large enough, convenient when going through a big list of assets

= <strong>1.0.9.6</strong> - 4 December 2018 =
* Added "Input Fields Style" option in plugin's "Settings" which would turn the fancy CSS3 iPhone-like checkboxes to standard HTML checkboxes (good for people with disabilities who use a screen reader software or personal preference)
* Added notification in the front-end view in case WP Rocket is enabled with "User Cache" enabled
* Option to have the "Inline code associated with the handle" contracted on request as it will reduce the length of the assets management page in case there are large blocks of text making it easier to scan through the assets list
* Tested the plugin for full compatibility with PHP 7.2 (5.3+ minimum required to use it)

= <strong>1.0.9.5</strong> - 29 November 2018 =
* Bug Fix: When "Remove Query Strings from CSS &amp; JS?" option was used, other needed query strings were removed besides "ver", most common in stylesheets such as Google APIs ones

= <strong>1.0.9.4</strong> - 28 November 2018 =
* Added the plugin's logo at the top of each Asset CleanUp Pro's page
* Added new menu icon (from the new logo) to the Dashboard's left plugin menu
* Bug Fix: If the new "All Styles &amp; Scripts" option is chosen from "Assets List Layout" plugin's setting, make sure that "Expanded" and "Contracted" states work in any situation (page load, manual click on the + and - areas)

= <strong>1.0.9.3</strong> - 27 November 2018 =
* Added option to expand &amp; contract "Styles" and "Scripts" management list and ability to choose the initial state on page load via plugin's "Settings" page
* Added extra view type layout (besides the only default one) which prints all assets as one list (Styles &amp; Scripts) * Fixed internal error showing in Apache's log related to the calculation of the file size

= <strong>1.0.9.2</strong> - 23 November 2018 =
* Added "Test Mode" option which will unload assets only if the user is logged in as administrator and has the capability of activating plugins.
* This is good for debugging in case one might worry that a CSS/JavaScript file could be unloaded by mistake and break the website for the regular (non-logged in) users.
* Once the page loads fine and all looks good, the "Test Mode" can be disabled so the visitors will load the lighter version of the page.

= <strong>1.0.9.1</strong> - 17 November 2018 =
* Updated code to avoid showing errors (and trigger a fatal error on activation) in case the PHP version is lower than 5.6 as the plugin is still guaranteed to work with PHP 5.3+

= <strong>1.0.9</strong> - 15 November 2018 =
* Bug Fix: PHP code change to properly detect the singular pages had the wrong condition set

= <strong>1.0.8.9</strong> - 14 November 2018 =
* Better accuracy in detecting the file location to retrieve its size (to avoid errors such as NaN bytes); It also works fine if the path starts with '//' (without any URL scheme such as 'http' or 'https')

= <strong>1.0.8.8</strong> - 13 November 2018 =
* Improved assets list styling to avoid overwriting by 3rd party CSS (from other themes and plugins)
* Added option to force license activation in case there are issues with the "Activate License" button

= <strong>1.0.8.7</strong> - 10 November 2018 =
* Assets can be managed by an administrator that has rights to activate plugins (before just "manage_options" capability was checked)
* Added option to remove all meta generator tags from the HEAD section
* Option to disable XML-RPC protocol support (partially for Pingbacks or completely)
* PHP code cleanup for using fewer resources

= <strong>1.0.8.6</strong> - 8 November 2018 =
* In case the assets can't be retrieved via AJAX calls within the Dashboard, the user will be notified about it and any response errors (e.g. 500 Internal Errors) would be printed for debugging purposes
* Make the user aware that there could be also CSS files loaded from the WordPress core that should be unloaded only if the user is comfortable with that

= <strong>1.0.8.5</strong> - 31 October 2018 =
* Bug Fix: "Everywhere" bulk unloads could not be removed from "Bulk Unloaded" page

= <strong>1.0.8.4</strong> - 31 October 2018 =
* Bug Fix: When inline CSS code was attached to a handle, it would trigger an error and prevent the assets from printing in the back-end view

= <strong>1.0.8.3</strong> - 21 October 2018 =
* Added "Feature Request" links for both sidebar and top menus
* Less Text on the Menus (useful for the top to keep it on one line for smaller screen sizes)
* Trigger specific PHP code only in the front-end (not within the Dashboard)

= <strong>1.0.8.2</strong> - 20 October 2018 =
* Bug Fix: Asset list wasn't retrieved within the Dashboard view as the AJAX call returned a 500 error response due to a PHP bug
* Bug Fix: The plugin's version was updated correctly to the latest one to make Dashboard plugin updates work as usual

= 1.0.8.1 - 19 October 2018 =
* Bug Fix: Prevent notice errors from showing on the WordPress login page (for aesthetic reasons, functionality remains the same)

= 1.0.8 - 13 October 2018 =
* Added cleanup options to remove unneeded elements from the HEAD section of the website including: "Really Simple Discovery (RSD)" link tag, "Windows Live Writer" link tag, "REST API" link tag, Pages/Posts "Shortlink" tag, "Post's Relational Links" tag, "WordPress version" meta generator* Renamed some text to make more relevance when unloading assets* Added "Remove Query Strings from CSS &amp; JS?"

= 1.0.7 - 6 October 2018 =
* Apply async &amp; defer attributes to the loaded scripts
* Extra confirmation required when unloading site-wide "jQuery Migrate" and "Comment Reply" from the plugin's settings (to avoid accidental unload)
* Bug Fix: Sometimes, specific scripts were showing up on Dashboard view, but not showing on Front-end view
* Bug Fix: Getting file size was generating errors sometimes due to the wrong path to the file

= <strong>1.0.6</strong> - 19 September 2018 =
* Removed "@" from printing within the output result when using AJAX calls to get the assets as a delimiter to avoid conflict with Cloudflare's email protection
* Replaced deprecated jQuery's live() with on() to avoid JavaScript error on the front-end in case jQuery Migrate is disabled

= <strong>1.0.5</strong> - 18 September 2018 =
* Added new top menu to easily access plugin's pages; Added "Pages Info" page which has explanations about the type of WordPress pages (e.g. post, page, tag etc.) that can have their assets managed through the plugin
* Added "Taxonomies", "Authors", "Search Results", "Dates" &amp; "404 Not Found" tabs to "Bulk Unloaded" page; Removed iCheck and replaced with pure CSS to make the plugin lighter

= <strong>1.0.4</strong> - 5 September 2018 =
Bug Fix: JS &amp; CSS files were not unloaded if “Manage in front-end view?” was not active (which is optional and only an admin preference)

= <strong>1.0.3</strong> - 3 September 2018 =
The premium plugin does not depend anymore on the Lite version so you don't need both plugins active. If you have Asset CleanUp Pro 1.0.3+, you can safely delete the Lite plugin (no worries, all the settings will be preserved)

= <strong>1.0.2</strong> - 4 August 2018 =
Initial Release