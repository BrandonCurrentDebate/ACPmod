<?php
namespace WpAssetCleanUpPro;

use WpAssetCleanUp\HardcodedAssets;
use WpAssetCleanUp\Main;
use WpAssetCleanUp\Misc;
use WpAssetCleanUp\ObjectCache;
use WpAssetCleanUp\OptimiseAssets\MinifyCss;
use WpAssetCleanUp\OptimiseAssets\MinifyJs;
use WpAssetCleanUp\Preloads;

/**
 * Class HardcodedAssetsPro
 * @package WpAssetCleanUpPro
 */
class HardcodedAssetsPro
{
    /**
     * @param $htmlSource
     * @param $anyHardCodedRules
     *
     * @return mixed
     */
    public static function maybeUnloadHardcodedAssets($htmlSource, $anyHardCodedRules)
    {
        $handlesInfo = Main::getHandlesInfo();

        $hardcodedMarkedForUnloadList = ! empty($anyHardCodedRules['unload']) ? $anyHardCodedRules['unload'] : MainPro::getHardcodedUnloadList();

        $hardcodedUnloadedHandles = array();

        // Go through the unloaded CSS/JS and strip them from the HTML code
        if ( ! empty($hardcodedMarkedForUnloadList) ) {
            foreach ($hardcodedMarkedForUnloadList as $hardCodedType => $hardcodedHandles) {
                $hardcodedHandles = array_unique($hardcodedHandles);

                foreach ($hardcodedHandles as $hardcodedHandle) {
                    // This has to be turned off; sometimes it's used for loading the scripts marked for unload for debugging purposes
                    $preventHardCodedCssUnloading = isset($_GET['wpacu_no_hd_css_unload']);

                    // STYLEs and LINKs ("stylesheet")
                    if ( (! $preventHardCodedCssUnloading) &&
                         (isset($handlesInfo['styles'][$hardcodedHandle]['output']) && $handlesInfo['styles'][$hardcodedHandle]['output']) &&
                         in_array($hardCodedType, array('wpacu_hardcoded_links', 'wpacu_hardcoded_styles')) )
                    {
                        $stripHardcodedAsset = self::stripHardcodedAsset($htmlSource, $hardCodedType, $handlesInfo, $hardcodedHandle);
                        $htmlSource = $stripHardcodedAsset['html_source'];

                        if ($stripHardcodedAsset['hardcoded_stripped']) {
                            $hardcodedUnloadedHandles[] = $hardcodedHandle;
                        }
                    }

                    // This has to be turned off; sometimes it's used for loading the scripts marked for unloading for debugging purposes
                    $preventHardCodedJsUnloading = isset($_GET['wpacu_no_hd_js_unload']);

                    // SCRIPTs ("src" and inline) and NOSCRIPTs
                    if ( (! $preventHardCodedJsUnloading) &&
                         (isset($handlesInfo['scripts'][$hardcodedHandle]['output']) && $handlesInfo['scripts'][$hardcodedHandle]['output']) &&
                         in_array($hardCodedType, array('wpacu_hardcoded_scripts_src', 'wpacu_hardcoded_scripts_noscripts_inline')) )
                    {
                        $stripHardcodedAsset = self::stripHardcodedAsset($htmlSource, $hardCodedType, $handlesInfo, $hardcodedHandle);
                        $htmlSource = $stripHardcodedAsset['html_source'];

                        if ($stripHardcodedAsset['hardcoded_stripped']) {
                            $hardcodedUnloadedHandles[] = $hardcodedHandle;
                        }
                    }
                }
            }
        }

        ObjectCache::wpacu_cache_set('wpacu_hardcoded_unloaded_handles', $hardcodedUnloadedHandles);

        return $htmlSource;
    }

	/**
     * This method makes changes to the hardcoded assets loaded in the page such as:
     * - The assets will be moved from HEAD to BODY (or vice-versa) if they were marked for changing their positions
     * - Preloaded (for the hardcoded assets with "src" and "href") via "basic" or "async" method
     * - Have attributes added to the SCRIPT tag such as "defer" and "async"
     * - The assets will load based on the media query set (e.g. only for mobile view)
     *
	 * @param string $htmlSource
	 * @param array $anyHardCodedAssetsLoadedOnThisPage
	 * @param array $anyHardcodedAssetsAlreadyUnloaded
     * @param array $anyHardCodedRules
	 *
	 * @return string|string[]
	 */
	public static function maybeMoveAlterHardcodedAssets($htmlSource, $anyHardCodedAssetsLoadedOnThisPage = array(), $anyHardcodedAssetsAlreadyUnloaded = array(), $anyHardCodedRules = array())
	{
        // Now that some hardcoded assets were unloaded (if any were marked for unloading), check the remaining loaded ones
        // in case there are loading rules set such as "defer" and "async" attributes for SCRIPT tags with "src"
        // or any loading based on the screen size for both LINK and SCRIPT tags

        /* [wpacu_timing] */ $wpacuTimingName = 'change_positions_hardcoded_assets'; Misc::scriptExecTimer( $wpacuTimingName ); /* [/wpacu_timing] */
        if ( ! empty($anyHardCodedRules['positions']) && ! wpacuIsDefinedConstant('WPACU_NO_POSITIONS_CHANGED_FOR_ASSETS') ) {
            $htmlSource = PositionsPro::moveForHardcoded($htmlSource, $anyHardcodedAssetsAlreadyUnloaded, $anyHardCodedAssetsLoadedOnThisPage);
        }
        /* [wpacu_timing] */ Misc::scriptExecTimer($wpacuTimingName, 'end'); /* [/wpacu_timing] */

        /* [wpacu_timing] */ $wpacuTimingName = 'preload_and_tag_changes_hardcoded_assets'; Misc::scriptExecTimer( $wpacuTimingName ); /* [/wpacu_timing] */
        if ( ! empty($anyHardCodedRules['script_attrs'])                  ||
             ! empty($anyHardCodedRules['media_queries_load']['styles'])  ||
             ! empty($anyHardCodedRules['media_queries_load']['scripts']) ||
             ! empty($anyHardCodedRules['preloads']['styles'])            ||
             ! empty($anyHardCodedRules['preloads']['scripts']) ) {
            $wpacuMainProClass = new MainPro();
            $wpacuPreloadClass = new Preloads();

            foreach ($anyHardCodedAssetsLoadedOnThisPage as $hardcodedGroupType => $hardCodedAssetsArray) {
                if ( $hardcodedGroupType === 'script_src_or_inline_and_noscript_inline_tags' &&
                    ! empty($hardCodedAssetsArray) &&
                    ( ! empty($anyHardCodedRules['script_attrs']) || ! empty($anyHardCodedRules['media_queries_load']['scripts']) || ! empty($anyHardCodedRules['preloads']['scripts']) ) ) {
                    foreach ($hardCodedAssetsArray as $tagOutput) {
                        if (strpos($tagOutput, '<script ') !== false && Misc::getValueFromTag($tagOutput, 'src', 'dom_with_fallback')) {
                            $contentUniqueStr = HardcodedAssets::determineHardcodedAssetSha1ForAssetsWithSource($tagOutput);
                            $generatedHandle  = HardcodedAssets::$handleScriptSrcPrefix . $contentUniqueStr;

                            if (in_array($generatedHandle, $anyHardcodedAssetsAlreadyUnloaded)) {
                                continue; // skip it as the hardcoded asset was unloaded
                            }

                            $tagOutputMaybeChanged = $tagOutput;

                            if ( ! empty($anyHardCodedRules['script_attrs']) || ! empty($anyHardCodedRules['media_queries_load']['scripts']) ) {
                                $tagOutputMaybeChanged = $wpacuMainProClass->scriptLoaderTag($tagOutput, $generatedHandle);

                                if ($tagOutputMaybeChanged !== $tagOutput) {
                                    $htmlSource = str_replace($tagOutput, $tagOutputMaybeChanged, $htmlSource);
                                }
                            }

                            // If the "media query load" was applied, preloading would be irrelevant and skipped
                            if ( ! empty($anyHardCodedRules['preloads']['scripts']) && strpos($tagOutputMaybeChanged, 'data-wpacu-applied-media-query=') === false ) {
                                $tagOutputMaybeChangedTwo = $wpacuPreloadClass->preloadJs($tagOutputMaybeChanged, $generatedHandle);
                                if ($tagOutputMaybeChangedTwo !== $tagOutputMaybeChanged) {
                                    if ($condComm = HardcodedAssets::isWithinConditionalComment($tagOutput, $anyHardCodedAssetsLoadedOnThisPage['within_conditional_comments'])) {
                                        $tagOutputMaybeChangedTwo = str_replace('<script ', '<script data-wpacu-cond-comm="' . $condComm . '" ', $tagOutputMaybeChangedTwo);
                                    }

                                    $htmlSource = str_replace($tagOutputMaybeChanged, $tagOutputMaybeChangedTwo, $htmlSource);
                                }
                            }
                        }
                    }
                } elseif ( $hardcodedGroupType === 'link_and_style_tags' &&
                           ! empty($hardCodedAssetsArray) &&
                           ( ! empty($anyHardCodedRules['media_queries_load']['styles']) || ! empty($anyHardCodedRules['preloads']['styles']) ) ) {
                    foreach ($hardCodedAssetsArray as $tagOutput) {
                        if (strpos($tagOutput, '<link ') !== false && Misc::getValueFromTag($tagOutput, 'href', 'dom_with_fallback')) {
                            $contentUniqueStr = HardcodedAssets::determineHardcodedAssetSha1ForAssetsWithSource($tagOutput);
                            $generatedHandle  = HardcodedAssets::$handleLinkPrefix . $contentUniqueStr;

                            if (in_array($generatedHandle, $anyHardcodedAssetsAlreadyUnloaded)) {
                                continue; // skip it as the hardcoded asset was unloaded
                            }

                            $tagOutputMaybeChanged = $tagOutput;

                            if ( ! empty($anyHardCodedRules['media_queries_load']['styles']) ) {
                                $tagOutputMaybeChanged = $wpacuMainProClass->styleLoaderTag($tagOutputMaybeChanged, $generatedHandle);

                                if ($tagOutputMaybeChanged !== $tagOutput) {
                                    $htmlSource = str_replace($tagOutput, $tagOutputMaybeChanged, $htmlSource);
                                }
                            }

                            // If the "media query load" was applied, preloading would be irrelevant and skipped
                            if ( ! empty($anyHardCodedRules['preloads']['styles']) && strpos($tagOutputMaybeChanged, 'data-wpacu-applied-media-query=') === false ) {
                                $tagOutputMaybeChanged = $wpacuPreloadClass->preloadCss($tagOutput, $generatedHandle);

                                if ($tagOutputMaybeChanged !== $tagOutput) {
                                    if ($condComm = HardcodedAssets::isWithinConditionalComment($tagOutput, $anyHardCodedAssetsLoadedOnThisPage['within_conditional_comments'])) {
                                        $tagOutputMaybeChanged = str_replace('<link ', '<link data-wpacu-cond-comm="' . $condComm . '" ', $tagOutputMaybeChanged);
                                    }

                                    $htmlSource = str_replace($tagOutput, $tagOutputMaybeChanged, $htmlSource);
                                }
                            }
                        }
                    }
                }
            }
        }
        /* [wpacu_timing] */ Misc::scriptExecTimer($wpacuTimingName, 'end'); /* [/wpacu_timing] */

		return $htmlSource;
	}

    /**
     * @param $tagOutput
     * @param $htmlSource
     *
     * @return array
     */
    public static function extractExactConditionalsAroundTag($tagOutput, $htmlSource)
    {
        $posUntilTagStarts  = strpos($htmlSource, $tagOutput);
        $htmlSourceUntilPos = substr($htmlSource, 0, $posUntilTagStarts);
        $htmlSourceFromPos  = substr($htmlSource, $posUntilTagStarts + strlen($tagOutput));

        $startCond = strrchr($htmlSourceUntilPos, '<!--');
        $endCond = strstr($htmlSourceFromPos, '-->', true) . '-->';

        return array('start' => $startCond, 'output' => $tagOutput, 'end' => $endCond);
    }

    /**
     * @param $htmlSource
     * @param $hardCodedType
     * @param $handlesInfo
     * @param $hardcodedHandle
     * @param $condComm
     *
     * @return array
     */
    public static function stripHardcodedAsset($htmlSource, $hardCodedType, $handlesInfo, $hardcodedHandle, $condComm = '')
    {
        $assetType = '';

        if (in_array($hardCodedType, array('wpacu_hardcoded_links', 'wpacu_hardcoded_styles'))) {
            $assetType = 'styles';
        } elseif (in_array($hardCodedType, array('wpacu_hardcoded_scripts_src', 'wpacu_hardcoded_scripts_noscripts_inline'))) {
            $assetType = 'scripts';
        }

        if ( $assetType === '' || ! isset($handlesInfo[$assetType][$hardcodedHandle]['output']) ) {
            return array('html_source' => $htmlSource, 'hardcoded_stripped' => '');
        }

        $hardcodedStripped = ''; // default
        $htmlSourceBefore  = $htmlSource;

        if ($condComm) {
            $extractOutput = self::extractExactConditionalsAroundTag($handlesInfo[$assetType][$hardcodedHandle]['output'], $htmlSource);
            $tagToReplace = $extractOutput['start'] . $extractOutput['output'] . $extractOutput['end'];

            $htmlSource = str_replace($tagToReplace, '', $htmlSource);

            if ($htmlSource !== $htmlSourceBefore) {
                $hardcodedStripped = $tagToReplace;
                return array('html_source' => $htmlSource, 'hardcoded_stripped' => $hardcodedStripped);
            }
        }

        $htmlSource = strtr($htmlSource, array($handlesInfo[$assetType][$hardcodedHandle]['output'] => ''));

        if ($htmlSource !== $htmlSourceBefore) {
            return array('html_source' => $htmlSource, 'hardcoded_stripped' => $handlesInfo[$assetType][$hardcodedHandle]['output']);
        }

        // No change? Perhaps it was altered (e.g. minified or had white space stripped)
        foreach (self::alternativeValuesIfMinified($handlesInfo[$assetType][$hardcodedHandle]['output']) as $altTag) {
            $htmlSource = str_replace($altTag, '', $htmlSource);

            if ($htmlSource !== $htmlSourceBefore) {
                return array('html_source' => $htmlSource, 'hardcoded_stripped' => $handlesInfo[$assetType][$hardcodedHandle]['output']);
            }
        }

        if (isset($handlesInfo[$assetType][$hardcodedHandle]['output_min']) && $handlesInfo[$assetType][$hardcodedHandle]['output_min']) {
            $htmlSource = str_replace($handlesInfo[$assetType][$hardcodedHandle]['output_min'], '', $htmlSource);

            if ($htmlSource !== $htmlSourceBefore) {
                return array('html_source' => $htmlSource, 'hardcoded_stripped' => $handlesInfo[$assetType][$hardcodedHandle]['output_min']);
            }
        }

        // Still no change? The tag output might be changed, but the relative source file could be the same
        // Or the tag has new attribute, but the inline code is the same
        // Go through the HTML source one last time and attempt to strip the tag if it matches the criteria
        $possibleHardcodedOutputs = self::possibleHardcodedOutputs($handlesInfo[$assetType][$hardcodedHandle]['output'], $hardCodedType, $htmlSource);

        if (count($possibleHardcodedOutputs) > 1) {
            foreach ( $possibleHardcodedOutputs as $outputToReplace ) {
                $htmlSource = str_replace($outputToReplace, '', $htmlSource);

                if ($htmlSource !== $htmlSourceBefore) {
                    $hardcodedStripped = $outputToReplace;
                    return array('html_source' => $htmlSource, 'hardcoded_stripped' => $hardcodedStripped);
                }
            }
        }

        return array('html_source' => $htmlSource, 'hardcoded_stripped' => $hardcodedStripped);
    }

	/**
	 * Sometimes, libraries such as Minify_HTML (source: https://github.com/mrclay/minify/blob/master/lib/Minify.php) are used
	 * which alter the content of the hardcoded asset, so even though it's the same, Asset CleanUp (Pro) might not detect it
	 * Let's make sure they are still found in case Minify_HTML is triggered by a different optimization plugin (e.g. WP Rocket, Autoptimize)
	 *
	 * @param $hardcodedAsset
	 * @return array
	 */
	public static function alternativeValuesIfMinified($hardcodedAsset)
	{
		return array(
			MinifyHtmlPro::minify($hardcodedAsset)
		);
	}

	/**
	 * @param $savedHardcodedOutput
	 * @param $hardCodedType
	 * @param $htmlSource
	 *
	 * @return array
     *
     * @noinspection PhpUndefinedVariableInspection
     */
	public static function possibleHardcodedOutputs($savedHardcodedOutput, $hardCodedType, $htmlSource)
	{
		$possibleHardcodedOutputs = array($savedHardcodedOutput);

		// Is the hardcoded content the same for the targeted tag? Stop here
		if (strpos($htmlSource, $savedHardcodedOutput) !== false) {
			return $possibleHardcodedOutputs;
		}

		// Step 1: Determine the type of the hardcoded asset (STYLE, LINK with "href", SCRIPT, SCRIPT with "src")
		if (in_array($hardCodedType, array('wpacu_hardcoded_links', 'wpacu_hardcoded_scripts_src'))) {
			$relSource = HardcodedAssets::getRelSourceFromTagOutputForReference($savedHardcodedOutput);

			if (! $relSource) {
				return $possibleHardcodedOutputs;
			}

			if ($hardCodedType === 'wpacu_hardcoded_links') {
				preg_match_all( '#<link[^>]*' . preg_quote( $relSource, '/' ) . '.*(>)#Usmi', $htmlSource, $matchedTags );
			} else {
				preg_match_all( '#<script[^>]*' . preg_quote( $relSource, '/' ) . '.*(>)(|\s+)</script>#Usmi', $htmlSource, $matchedTags );

				}

			if ( ! isset($matchedTags[0][0]) ) {
				return $possibleHardcodedOutputs;
			}

			foreach ($matchedTags[0] as $matchedAliasTag) {
				$toMatchWithinString = ($hardCodedType === 'wpacu_hardcoded_links')
					? '#rel(\s+|)=(\s+|)(["\'])stylesheet(["\'])|src(\s+|)=(\s+|)stylesheet(\s+)#Usmi'
					: '#src(\s+|)=(\s+|)(["\'])(.*)(["\'])|src(\s+|)=(\s+|)(.*)(\s+)#Usmi';

				if (! preg_match($toMatchWithinString, $matchedAliasTag)) {
					continue;
				}

				$possibleHardcodedOutputs[] = $matchedAliasTag;
				$possibleHardcodedOutputs[] = MinifyHtmlPro::minify($matchedAliasTag); // perhaps it was manually minified (e.g. by a developer)
			}
		} elseif (in_array($hardCodedType, array('wpacu_hardcoded_styles', 'wpacu_hardcoded_scripts_noscripts_inline'))) {
			if ($hardCodedType === 'wpacu_hardcoded_styles') {
				$forTagType = 'style';
			} elseif ($hardCodedType === 'wpacu_hardcoded_scripts_noscripts_inline') {
				if (strncmp($savedHardcodedOutput, '<script', 7) === 0) {
					$forTagType = 'script';
				} elseif (strncmp($savedHardcodedOutput, '<noscript', 9) === 0) {
					$forTagType = 'noscript';
				} else {
					return $possibleHardcodedOutputs; // something's funny there
				}
			}

			$tagContent = self::getTagContent($savedHardcodedOutput, $forTagType);

			if ($tagContent) {
				preg_match_all('@(<'.$forTagType.'[^>]*?>)(.*?)</'.$forTagType.'>@si', $htmlSource, $matchedFromHtmlSource);

				if ( ! empty($matchedFromHtmlSource[0]) && ! empty($matchedFromHtmlSource[2]) ) {
					foreach ($matchedFromHtmlSource[2] as $tagIndex => $tagContentFromList) {
						if ($forTagType === 'script' || $forTagType === 'noscript') {
							$tagOutputFromMatch = $matchedFromHtmlSource[0][$tagIndex];

							if ($forTagType === 'script' && stripos($tagOutputFromMatch, ' src') !== false) {
								continue; // Only SCRIPT with inline JS is allowed (no "src" attribute)
							}
						}

						if (trim($tagContentFromList) === '') {
							continue; // it needs to have a content to compare against
						}

						if ( trim($tagContentFromList) === $tagContent || self::compareMinifiedCss($tagContentFromList, $tagContent) ) {
							$possibleHardcodedOutputs[] = $matchedFromHtmlSource[0][$tagIndex];
						}
					}
				}
			}
		}

		return $possibleHardcodedOutputs;
	}

	/**
	 * @param $minifyOne
	 * @param $minifyTwo
	 *
	 * @return bool
	 */
	public static function compareMinifiedCss($minifyOne, $minifyTwo)
	{
		$minifyOneResult = MinifyCss::applyMinification($minifyOne, true);
		$minifyTwoResult = MinifyCss::applyMinification($minifyTwo, true);

		$reps = array(
			':0px}' => ':0}'
		);

		$minifyOneResult = str_replace(array_keys($reps), array_values($reps), $minifyOneResult);
		$minifyTwoResult = str_replace(array_keys($reps), array_values($reps), $minifyTwoResult);

		return $minifyOneResult === $minifyTwoResult;
	}

	/**
	 * @param $tagOutput
	 * @param $forTagType
	 *
	 * @return false|string
	 */
	public static function getTagContent($tagOutput, $forTagType)
	{
		preg_match_all('@(<'.$forTagType.'[^>]*?>)(.*?)</'.$forTagType.'>@si', $tagOutput, $matches);

		if (isset($matches[0][0], $matches[2][0]) && strlen($tagOutput) === strlen($matches[0][0])) {
			return trim($matches[2][0]);
		}

		return false;
	}

    /**
	 * @param $tagOutputFromRow
	 * @param $handlePrefix
	 * @param $generatedHandle
	 * @param $handlesInfo
	 *
	 * @return void
	 */
	public static function maybeUpdateOldGeneratedHandleNameWithTheNewOne($tagOutputFromRow, $handlePrefix, $generatedHandle, $handlesInfo)
	{
		// If the newly generated handle name is different from the old one from the database, removing the rule form the CSS/JS manager won't work
		// Update the old handle name from the database with the new one (fetch the database entries and update them accordingly)
		if ( $handlePrefix === 'wpacu_hardcoded_style_' || $handlePrefix === 'wpacu_hardcoded_link_' ) {
			$forTagType = 'style';
			$assetType  = 'styles';
		} else {
			$forTagType = 'script';
			$assetType  = 'scripts';
		}

		if (empty($handlesInfo[$assetType]) || ! empty($handlesInfo[$assetType][$generatedHandle]['output'])) {
			return; // stop here as the newly generated handle already exists in the database or there are no assets saved yet (so nothing to update)
		}

		foreach ($handlesInfo[$assetType] as $assetHandleFromDb => $assetValuesFromDb) {
			if (strpos($assetHandleFromDb, 'wpacu_hardcoded_') === false) {
				continue; // not a hardcoded tag
			}

			$tagOutputFromDb = (isset($assetValuesFromDb['output']) && $assetValuesFromDb['output']) ? $assetValuesFromDb['output'] : false;

			if (! $tagOutputFromDb) {
				continue; // no output to compare against
			}

			if (self::canBeConsideredTheSameTag($tagOutputFromRow, $tagOutputFromDb, $forTagType, $generatedHandle)) {
				// A match was found. The handle from the database is outdated, and $assetHandleFromDb will get updated to $generatedHandle

				self::updateHandle($assetHandleFromDb, $generatedHandle);
			}
		}
	}

	/**
	 * Look for all the places where a handle could be located and change its name
	 *
	 * @param $currentHandle
	 * @param $newHandle
	 * @param $triggerQueries
	 *
	 * @return void
	 */
	public static function updateHandle($currentHandle, $newHandle, $triggerQueries = true)
	{
		global $wpdb;

		if ( ! $triggerQueries ) {
			echo 'Queries are not triggered for debugging purposes' . "\n";
		}

		// Prepare just in case
		$preparedCurrentHandle = sanitize_title($currentHandle);
		$preparedNewHandle     = sanitize_title($newHandle);
		$preparedPluginPrefix  = sanitize_title(WPACU_PLUGIN_ID.'_');

		// "options" table
		$sqlUpdateQuery = <<<SQL
UPDATE `{$wpdb->prefix}options`
SET `option_value` = REPLACE(`option_value`, '{$preparedCurrentHandle}', '{$preparedNewHandle}')
WHERE `option_name` LIKE '%{$preparedPluginPrefix}%' AND `option_value` LIKE '%{$preparedCurrentHandle}%'
SQL;
		if ($triggerQueries) {
			$wpdb->query( $sqlUpdateQuery );
		}

		// Make sure all other tables from the database where there might be plugin rules are also updated
		// `postmeta`, `usermeta`, `termmeta` tables
		// `usermeta` and `termmeta` might have traces from the Pro version (if ever used)
		foreach (array('postmeta', 'usermeta', 'termmeta') as $tableBaseName) {
			$sqlUpdateQuery = <<<SQL
UPDATE `{$wpdb->prefix}{$tableBaseName}`
SET `meta_value` = REPLACE(`meta_value`, '{$preparedCurrentHandle}', '{$preparedNewHandle}')
WHERE `meta_key` LIKE '%{$preparedPluginPrefix}%' AND `meta_value` LIKE '%{$preparedCurrentHandle}%'
SQL;
			if ($triggerQueries) {
				$wpdb->query( $sqlUpdateQuery );
			}
		}
	}

    /**
     * @param $data
     *
     * @return array
     */
    public static function wpacuGenerateHardcodedAssetDataForRules($data)
    {
        $assetType  = $data['row']['asset_type'];
        $dataRowObj = $data['row']['obj'];

        $tagOutputFromRow = $data['row']['obj']->tag_output;

        $possibleHardcodedHandles = array_merge(
            array($data['row']['obj']->handle),
            $data['row']['obj']->handles_maybe
        );

        $activePageLevel = isset($data['current_unloaded_page_level'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['current_unloaded_page_level'][$assetType], $tagOutputFromRow);

        if ($activePageLevel) {
            $data['row']['class']   = 'wpacu_not_load';
            $data['row']['checked'] = 'checked="checked"';
        }

        /*
         * $dataHH['row']['is_group_unloaded'] is only used to apply a red background in the asset's area to point out that the asset is unloaded
         * is set to `true` if either the asset is unloaded everywhere or it's unloaded on a group of pages (such as all pages belonging to 'page' post type)
        */
        $data['row']['global_unloaded'] = $data['row']['is_post_type_unloaded'] = $data['row']['is_group_unloaded'] = false;

        // Mark it as unloaded - Everywhere
        if (isset($data['global_unload'][$assetType]) &&
            is_array($data['global_unload'][$assetType]) &&
            HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles,
                $data['global_unload'][$assetType], $tagOutputFromRow)) {
            $data['row']['global_unloaded']       = $data['row']['is_group_unloaded'] = true;
            $data['row']['at_least_one_rule_set'] = true;
        }

        // Mark it as unloaded - for the Current Post Type
        if (isset($data['bulk_unloaded_type'], $data['bulk_unloaded'][$data['bulk_unloaded_type']][$assetType])
            && is_array($data['bulk_unloaded'][$data['bulk_unloaded_type']][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles,
                $data['bulk_unloaded'][$data['bulk_unloaded_type']][$assetType], $tagOutputFromRow)) {
            $data['row']['is_group_unloaded']     = true;
            $data['row']['at_least_one_rule_set'] = true;

            if ($data['bulk_unloaded_type'] === 'post_type') {
                $data['row']['is_post_type_unloaded'] = true;
                $data['row']['at_least_one_rule_set'] = true;
            }
        }

        $isUnloadRegExMatch = isset($data['unloads_regex_matches'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['unloads_regex_matches'][$assetType], $tagOutputFromRow);

        $isLoadExceptionPerPage = isset($data['load_exceptions_per_page'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_per_page'][$assetType], $tagOutputFromRow);

        $isLoadExceptionForCurrentPostType = isset($data['load_exceptions_post_type'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_post_type'][$assetType], $tagOutputFromRow);

        $isLoadExceptionRegExMatch = isset($data['load_exceptions_regex_matches'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_regex_matches'][$assetType], $tagOutputFromRow);

        $isLoadExceptionForCurrentPostViaTax = isset($data['load_exceptions_post_type_via_tax_matches'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_post_type_via_tax_matches'][$assetType], $tagOutputFromRow);

        $isLoadExceptionForCurrentTaxType = isset($data['load_exceptions_via_tax_type_matches'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_via_tax_type_matches'][$assetType], $tagOutputFromRow);

        $isLoadExceptionAuthorType = isset($data['load_exceptions_via_author_type_matches'][$assetType])
            && HardcodedAssetsPro::ruleMatchesForHardcodedList($possibleHardcodedHandles, $data['load_exceptions_via_author_type_matches'][$assetType], $tagOutputFromRow);

        $data['row']['is_load_exception_per_page']        = $isLoadExceptionPerPage;
        $data['row']['is_load_exception_post_type']       = $isLoadExceptionForCurrentPostType;
        $data['row']['is_load_exception_via_tax_type']    = $isLoadExceptionForCurrentTaxType;
        $data['row']['is_load_exception_via_author_type'] = $isLoadExceptionAuthorType;

        $isLoadException = $isLoadExceptionPerPage ||
                           $isLoadExceptionForCurrentPostType ||
                           $isLoadExceptionRegExMatch ||
                           $isLoadExceptionForCurrentPostViaTax ||
                           $isLoadExceptionForCurrentTaxType ||
                           $isLoadExceptionAuthorType;

        $data['row']['is_load_exception'] = $isLoadException;

        // No load exception to any kind and a bulk unload rule is applied? Append the CSS class for unloading
        if ( ! $isLoadException && ($data['row']['is_group_unloaded'] || $isUnloadRegExMatch)) {
            $data['row']['at_least_one_rule_set'] = true;
            $data['row']['class']                 .= ' wpacu_not_load';
        }

        if (isset($dataRowObj->position_new) && $dataRowObj->position_new !== $dataRowObj->position) {
            $data['row']['class']                 .= ' wpacu_location_changed';
            $data['row']['at_least_one_rule_set'] = true;
        }

        $isAssetPreload = (isset($data['preloads'][$assetType][$dataRowObj->handle]) && $data['preloads'][$assetType][$dataRowObj->handle])
            ? $data['preloads'][$assetType][$dataRowObj->handle]
            : false;

        if ($isAssetPreload) {
            $data['is_preload']                   = $isAssetPreload;
            $data['row']['at_least_one_rule_set'] = true;
        }

        return $data;
    }

    /**
	 * @param $allPossibleHardcodedHandles
	 * @param $ruleList
	 * @param $tagOutputFromRow
	 *
	 * @return bool
	 */
	public static function ruleMatchesForHardcodedList($allPossibleHardcodedHandles, $ruleList, $tagOutputFromRow)
	{
		// Take the current hardcoded asset that is marked for unload
		// This is like a fallback for an older outputs saved
		// If the tag content or its minified content is the same as any of the found tags in the HTML source
		// grab its handle name and append it to the $allPossibleHardcodedHandles list

		// Any match already?
		if (MiscPro::inArrayIfAnyExists($allPossibleHardcodedHandles, $ruleList)) {
			return true;
		}

		// Last check, compare the outputs of the saved tag marked for unload and the ones found in the HTML source
		if ( ! empty($ruleList) ) {
			$handlesInfo = Main::getHandlesInfo();

			foreach ($ruleList as $ruleHardcodedHandle) {
				if (strpos($ruleHardcodedHandle, 'wpacu_hardcoded_') === false) {
					continue; // skip non-hardcoded assets as they are irrelevant in this case
				}

				if ( strpos( $ruleHardcodedHandle, 'wpacu_hardcoded_style_' ) !== false || strpos( $ruleHardcodedHandle, 'wpacu_hardcoded_link_' ) !== false ) {
					$assetType  = 'styles';
					$forTagType = 'style';
				} else {
					$assetType  = 'scripts';
					$forTagType = 'script';
				}

				// Get the output of the tag from $handlesInfo and compare it with the current targeted tag: $tagOutputFromRow
				$tagOutputFromHandlesInfo = isset( $handlesInfo[ $assetType ][ $ruleHardcodedHandle ]['output'] ) ? $handlesInfo[ $assetType ][ $ruleHardcodedHandle ]['output'] : false;

				if ( ! $tagOutputFromHandlesInfo ) {
					continue; // nothing to compare against
				}

				if (self::canBeConsideredTheSameTag($tagOutputFromHandlesInfo, $tagOutputFromRow, $forTagType, $ruleHardcodedHandle)) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * @param $tagOne
	 * @param $tagTwo
	 * @param $forTagType
	 * @param $hardcodedHandle
	 *
	 * @return bool
	 */
	public static function canBeConsideredTheSameTag($tagOne, $tagTwo, $forTagType, $hardcodedHandle)
	{
		$hardcodedLinkOrScriptWithSource = ( strpos($hardcodedHandle, 'wpacu_hardcoded_link_') !== false)
		                                   || ( strpos($hardcodedHandle, 'wpacu_hardcoded_script_src_') !== false);

		if ($hardcodedLinkOrScriptWithSource) {
			// In case old LINK[rel="stylesheet"][src] and SCRIPT[src] tags are in the database, make sure to compare the source code with the ones from the HTML source
			$finalCleanSourceFromOne = HardcodedAssets::getRelSourceFromTagOutputForReference($tagOne);
			$finalCleanSourceFromTwo = HardcodedAssets::getRelSourceFromTagOutputForReference($tagTwo);

			if (($finalCleanSourceFromOne && $finalCleanSourceFromTwo) && $finalCleanSourceFromOne === $finalCleanSourceFromTwo) {
				return true;
			}
		}

		$hardcodedInlineStyleOrInlineScript = ( strpos($hardcodedHandle, 'wpacu_hardcoded_style_') !== false) || ( strpos($hardcodedHandle, 'wpacu_hardcoded_script_inline_') !== false);

		if ($hardcodedInlineStyleOrInlineScript) {
			$tagContentFromOne = self::getTagContent( $tagOne, $forTagType );
			$tagContentFromTwo = self::getTagContent( $tagTwo, $forTagType );

			if ( ($tagOne && $tagTwo) &&
                 $tagContentFromOne !== '' && $tagContentFromTwo !== '' &&
                 $tagContentFromOne === $tagContentFromTwo ) { // If the tag content the same?
				return true;
			}

			// Last try, compare the minified content for both tag outputs
			if ( $forTagType === 'style' &&
                 $tagContentFromOne !== '' && $tagContentFromTwo !== '' &&
                 self::compareMinifiedCss( $tagContentFromOne, $tagContentFromTwo ) ) {
				return true;
			}

			if ( $forTagType === 'script' &&
                 $tagContentFromOne !== '' && $tagContentFromTwo !== '' &&
                 MinifyJs::applyMinification( $tagContentFromOne ) === MinifyJs::applyMinification( $tagContentFromTwo ) ) {
				return true;
			}
		}

		return false;
	}

    /**
     * @param $tagOutput
     * @param $prefix
     *
     * @return string[]
     */
    public static function getPossibleOlderHandlesForHardcodedTag($tagOutput, $prefix)
    {
        $possibleHandles = array($prefix . sha1($tagOutput)); // the original tag

        if (strpos($prefix, '_style') !== false) {
            $tagContentMinified = MinifyCss::applyMinification(HardcodedAssetsPro::getTagContent($tagOutput, 'style'));

            if ($tagContentMinified) {
                $possibleHandles[] = $prefix . sha1($tagContentMinified);

                $reps         = array(':0px}' => ':0}');
                $minifyCssAlt = str_replace(array_keys($reps), array_values($reps), $tagContentMinified);

                $possibleHandles[] = $prefix . sha1($minifyCssAlt);
            }
        } elseif (strpos($prefix, '_script_inline') !== false) {
            $tagContentMinified = MinifyJs::applyMinification(HardcodedAssetsPro::getTagContent($tagOutput, 'script'));

            if ($tagContentMinified) {
                $possibleHandles[] = $prefix . sha1($tagContentMinified);
            }
        }

        return $possibleHandles;
    }
}
