=== Heroic Knowledge Base ===
Contributors: herothemes
Tags: knowledge base, knowledge plugin, faq, widget
Requires at least: 4.3
Version: 2.12.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Add a Knowledge Base to WordPress. Developed by the team at [HeroThemes](https://herothemes.com)


== Installation ==

It's easy to get started

1. Upload `ht-knowledge-base` unzipped file to the `/wp-content/plugins/` directory or goto Plugins > Add New and upload the `ht-knowledge-base` zip file.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. If upgrading, ensure you deactivate and re-activate the plugin to ensure any upgrade routines are run correctly.



== Frequently Asked Questions ==

= Q. I have a question! =

A. Please consult the Heroic Knowledge Base Documentation accompanying this plugin or see https://herothemes.com/hkbdocs/

= Q. Category thumbnails are too big =

A. You need to use the `Regenerate Thumbnails` plugin to re-generate the thumbnails to the correct size.



== Screenshots ==



== Changelog ==


= 2.12.0 =
(25 Oct 2017)

New! Knowledge Base admin dashboard widget
New! Option for 90 days history in analytics
New! ht_voting_display_voting_on_article filter
Improved! Date selection and handling in analytics
Fixed! IE encoding of live search string for non-latin characters
Fixed! Array index warnings in widgets
Fixed! Timezone issues with analytics

= 2.11.8 =
(30 Jun 2017)

Fixed! Support for apostrophes in titles for TOC widget
Fixed! Custom article ordering on front page

= 2.11.7 =
(13 Jun 2017)

Fixed! TOC widget and WordPress SEO compatibility hotfix

= 2.11.6 =
(12 Jun 2017)

Improved! Validation of SQL queries
Improved! Voting animation when feedback comment left
Fixed! Issues with TOC widget

= 2.11.5 =
(15 May 2017)

New! ht_kb_toc_extract_headings_h_start_level filter
New! ht_kb_toc_extract_headings_h_end_level filter
New! ht_kb_toc_extract_headings_regex filter
Improved! Article rating, views and attachment display in article edit list
Fixed! TOC widget duplicate and non-latin header issues
Fixed! Issue with custom article orders in parent archive view

= 2.11.4 =
(12 Apr 2017)

New! Filter by category in article edit posts list
New! hkb_master_tax_terms filter
New! ht_kb_settings_page_activetab filter
New! hkb_custom_excerpt_length filter
New! hkb_custom_excerpt_more_string filter
Improved! Removed duplicate fonts
Improved! Search template for no results
Improved! Added widget_title filter to widgets for improved translation support
Fixed! Category restriction results
Fixed! Long article titles not wrapping on analytics screens

= 2.11.3 =
(28 Feb 2017)

Updated! Split out search and taxonomy article excerpt display options

= 2.11.2 =
(20 Feb 2017)

New! Added ht_kb_dummy_page_title for SEO compatibility
New! Filter for ht_voting_post_display_allow
New! Filter for ht_kb_dummy_page_title
Improved! Changed ht_kb_wp_title_master_filter to ht_kb_wp_title_tag_filter
Improved! WP SEO functionality on KB taxonomies and homepage
Improved! Title tag builder ht_kb_wp_title_suffix filter
Fixed! Bug in custom template functionality
Fixed! Bug with voting callback error
Updated! Priority of filters hooked to ht_kb_wp_title_filter function
Updated! Additional parameters to ht_kb_wp_title_tag_filter

= 2.11.1 =
(9 Feb 2017)

Fixed! Article titles issue when knowledge base set as homepage hotfix

= 2.11.0 =
(8 Feb 2017)

New! Voting templates for enhanced control in themes
New! Option to display author bio on article
New! Filters for viewing analytics, article ordering and category ordering pages capability
New! ht_kb_exits_check_nonce filter
New! ht_kb_wp_title_master_filter
New! hkb_breadcrumbs_* filters
New! ht_kb_cpt_supports filter
New! ht_kb_exits_check_nonce filter
New! ht_kb_category_rewrite_hierachical filter
New! ht_kb_livesearch_trigger_length
Improved! Title tag behavior
Improved! Automatic update checks
Improved! Feedback filter control disabled when no feedback
Fixed! Possible errors on content-article and ajax templates
Fixed! Issue with undefined index warning in article category meta
Fixed! Issue with hkb_search_terms filter
Fixed! WPML search taxonomies compatibility issues
Fixed! Related articles CSS issue - Article title overlay with meta
Fixed! Issue with category archive not displaying correctly with subcategories but no articles 
Fixed! Incorrect kb archive title when set as homepage
Updated! Removed beta tag from analytics
Updated! Readme.txt format

= 2.10.0 =
(9 Jan 2017)

New! Compatibility CSS shivs for default themes
New! Action hook for ht_voting_vote_post_action
New! Filter hkb_debug_mode filter
New! Filter ht_kb_view_count filter
New! Filter ht_usefulness filter
New! Filter hkb_search_url filter
Improved! Templates for compatibility with several third party themes
Improved! Code quality on templates
Improved! Debug functionality
Improved! Ability to add dummy data with hkb_debug_mode filter
Fixed! Table of content widget in post preview
Fixed! All results URL for WPML compatibility
Fixed! WPML language_negotiation_type and logic

= 2.9.2 =
(12 Dec 2016)

Fixed! Hotfix to prevent WPML returning all article languages

= 2.9.1 =
(30 Nov 2016)

New! Filter hkb_compat_templates
New! Filter show_ht_kb_welcome_on_activation
New! Filter hkb_author_archive_post_types
Fixed! WMPL search conflict

= 2.9.0 =
(16 Nov 2016)

New! Major redesign and improvements to Analytics module
New! Added WordPress REST API v2 endpoints
Improved! Debug information
Improved! TOC widget
Improved! Jetpack compatibility
Improved! Add articles and categories to nav menus


= 2.8.1 =
(10 Oct 2016)

Fixed! Hotfix for category meta PHP warnings

= 2.8.0 =
(4 Oct 2016)

New! HKB restrict functionality (BETA)
New! Debug info page
Improved! option to open attachments in new window
Updated! Removed mo and po files, use new pot for translations
Improved! WPML compatibility of option strings
Fixed! Unbalanced tags in TOC widget

= 2.7.12 =
(19 Sep 2016)

Improved! Further code cleanup, removing redundant modules
Improved! Re-added 0 option for num-articles-home setting
Improved! HKB category widget
Fixed! Analytics backend images

= 2.7.11 =
(15 Aug 2016)

Fixed! Issue with No articles in this category message
Improved! HKB categories widget - added heirarchy support
Improved! General code cleanup and i18n improvements

= 2.7.10 =
(1 Aug 2016)

Improved! Slug checking and options
Improved! Removed nothing else here message when category contains subcategories
Improved! Check for exits tables
Improved! Refactored backend voting styles
Improved! Filter for saving user visits and search queries
Improved! Check to display article attachments for password protected posts

= 2.7.9 =
(18 Jul 2016)

New! Package builder
Fixed! No category set warning
Improved! Added no articles in KB message
Improved! Cleaned up language files

= 2.7.8 =
(24 Jun 2016)

Fixed! Issue with settings flash

= 2.7.7 =
(21 Jun 2016)

Fixed! issue with Avast false positive
New! POT file for translators - transitional
Improved! General code cleanup

= 2.7.6 =
(17 Jun 2016)

Fixed! Settings links
Improved! Cleaning up settings code

= 2.7.5 =
(8 Jun 2016)

Fixed! Hotfix for customizer error

= 2.7.4 =
(8 Jun 2016)

Fixed! Article number setting
Fixed! TOC widget, will now not display when no headers in article
Fixed! Language used in options panel
Fixed! Search issue when WordPress address not site address
Fixed! Date issue with analytics
Improved! JS check to ensure slugs are not the same
Improved! Removed KB archive dummy page from pages list

 
= 2.7.3 =
(2 Jun 2016)

Fixed! Hotfix for article number setting
Fixed! Hotfix for exits to display at end of article, defaults to false

= 2.7.2 =
(31 May 2016)

Fixed! Hotfix for comments setting

= 2.7.1 = 
(30 May 2016)

Fixed! Hotfix for PHP formatting issues

= 2.7.0 = 
(26 May 2016)

New! Added search post types filter
Updated! Replaced/Removed Redux framework to improve theme compatibility

= 2.6.4 =
(23 Mar 2016)

Fixed! Analytics plugin detect warning hotfix

= 2.6.3 =
(23 Mar 2016)

Fixed! Attachment post title name hotfix
Fixed! Analytics date range hotfix

= 2.6.2 =
(21 Mar 2016)

Fixed! TOC Widget hotfix

= 2.6.1 =
(17 Mar 2016)

Improved! Article excerpt to search result if option enabled
Fixed! Bug with category icon display
Improved! Localization improvements

= 2.6.0 =
(14 Mar 2016)

New! Implemented transfers/exits module
Improved! Continued work on analytics functionality
Fixed! Fixes for breadcrumb display
Fixed! Various fixes for improved compatibility with SEO plugins
Improved! Various styling improvements


= 2.5.4 =
(22 Feb 2016)

Fixed! Hotfix for meta markup in widgets

= 2.5.3 =
(16 Feb 2016)

Fixed! Hotfix for article ordering
Fixed! Hotfix for Redux framework update to 3.5.9.3

= 2.5.2 =
(11 Jan 2016)

Fixed! Hotfix for auto updater

= 2.5.1 =
(7 Jan 2016)

Fixed! Hotfixes for breadcrumbs
Updated! Rebasing as 2.5.x

= 2.5.0 =
(7 Jan 2016)

New! Control filters
Fixed! Minor Bug fixes
Fixed! WPML search box fix
Fixed! Subcategory display inconsistency fix
Fixed! Responsive bugs in HKB archive fix


= 2.4.0 =
(18 Dec 2015)

New! Filters for option helpers
New! Filters for option sections
New! Filter and action hook for options
Fixed! Responsive bugs
Improved! InstaAnswers compatibility


= 2.3.4 =
(27 Nov 2015)

Fixed! Hotfix for titles in Knowledge Base archive
Fixed! Hotfix for z-index in live-search

= 2.3.3 =
(20 Nov 2015)

Fixed! Hotfix for titles in Knowledge Base archive

= 2.3.2 =
(20 Nov 2015)

Fixed! Hotfix for WordPress nav menus

= 2.3.1 =
(20 Nov 2015)

Fixed! Hotfix for page titles
Fixed! Hotfix for knowledgebase styles

= 2.3.0 =
(11 Nov 2015)

New! Metabox for article stats - views, feedback, attachments
New! Added filters to stop custom content (stop_ht_knowledge_base_custom_content)
Improved! Upgraded database functionality, rewrote controllers and additional underpinning for analytics
Improved! Database version check, upgrades performed as required
Fixed! WP REST API
Fixed! 404 error when previewing a published article
Fixed! Sub category depth display
Fixed! Custom article ordering when order previously set to descending
Fixed! Category permalink prefixed with blog slug
Fixed! Sort by article views
Fixed! Comment template, disqus compatibility
Improved! Network activate functionality

= 2.2.0 =
(30 Sep 2015)

Fixed! Issue with breadcrumbs link
Updated! Reordered admin menu
Updated! Change voting to post request and removed link
Fixed! Article count of sub-subcategories
Fixed! Issue with category icon when creating new category
Improved! Table of content widget (beta)

= 2.1.0 =
(16 Sep 2015)

New! TOC wid
Updated! Rebased versioning for new Hero Themes Version Control (HTVC)
Updated! Change textdomain hookget
Fixed! Breadcrumbs in deep categories

= 2.0.8 =
(18 Aug 2015)

Improved! Article and category ordering UI
Fixed! Bugs in demo installer

= 2.0.7 =
(13 Aug 2015)

New! Added analytics core
New! Added article sorting

= 2.0.6 =
(21 Jul 2015)

Improved! Display subcategories in parent category when option to hide in home/archive selected
Improved! Removed some legacy code

= 2.0.5 =
(9 Jul 2015)

Fixed! Category listing hotfix

= 2.0.4 =
 (27 Jun 2015)

Fixed! Textdomain fix

= 2.0.3 =
(24 Jun 2015)

Improved! Removed advanced validation for slugs to allow for more flexible permalink structure

= 2.0.2 =
(1 Jun 2015)

Fixed! Issue with CMB2 activation resulting in invalid header error

= 2.0.1 =
(29 May 2015)

Improved! Packaged voting module

= 2.0 =
(28 May 2015)

New! Templating structure
New! Search widget
New! Helper functions
New! Styling options
Fixed! Numerous bug fixes and coding enhancements

= 1.4 =
(23 Feb 2015)

Improved! Separated voting logic from knowledge base
New! Welcome page
New! Demo installer
New! Added auto updater functionality
Improved! PHP and security improvements
Updated! Redux framework
Improved! Styling for theme compatibility
Improved! Title and SEO functionality
Improved! General theme compatibility
Improved! Refined options UI
Fixed! Various bug fixes and tweaks

= 1.3 =
(15 Jan 2015)

Improved! Voting option improvements
New! Adding WPML support for knowledge base homepage
Fixed! Search placeholder when used with WPML
Updated! Translation strings
Improved! Added namespacing to some common namespacing functions
Fixed! Issue with kb as homepage not displaying posts in correct order
Updated! Namespacing on show all tag
Improved! Removed vote this comment text
Improved! view count upgrade functionality
Fixed! Bug with subcategory article markup being displayed when there are no articles to display
Improved! Updated options wording
Improved! Added data attribute for category description
Improved! HTML Output
Improved! Consistency in widget descriptions

= 1.2 =
(14 Nov 2014)

Improved! Added HT Knowledge Base Archive dummy page
Improved! Article views visible in Knowledge Base post lists on backend
New! Ability to set view count and usefulness manually
New! Reset votes option
New! Article tag support
New! Added custom field support
Improved! Option to display number of articles in category or tag
Improved! Title output text
New! Link to display remaining articles in category
Fixed! Voting option on individual articles
Fixed! Homepage option inconsistencies
Updated! Translation texts to improve i18n support
Fixed! Display comments option for Heroic Knowledgebase


= 1.1 =
(13 Aug 2014)

Improved! Removed ht_kb_homepage requirement (implementing themes must implement by default and declare support with ht_knowledge_base_templates)
New! Added loads of options for sorting and categorizing articles
New! Added rating indicator at various locations
Improved! Centralized display logic for plugin and supporting themes
Enhanced search and live search
Fixed! Breadcrumbs display
Fixed! Page titles
New! Added options for archive display
Fixed! Where meta displays
New! Support for video and standard post formats
Fixed! Various other bug fixes, tweaks and enhancements

= 1.0 =
(1 Aug 2014)

New! Initial release

== Upgrade Notice ==

= 2.7.0 =

Redux has been removed to improve compatibility issues with some themes, some options
may need to be reset/saved on first activation. Searching additional post types is 
now performed with the hkb_search_post_types filter

= 2.3.0 =

As always, please ensure you backup your configuration and database before upgrading
View counts are converted after upgrade


== Developer Notes ==

For using theme templates, add support for ht_knowledge_base_templates
For category icon support add support for ht_kb_category_icons
For category color support add support for ht_kb_category_colors

== Actions and Filters == 

*ht_kb actions
ht_kb_exit_redirect - $redirect
ht_kb_end_article - null
ht_kb_activate - $network_activate
ht_kb_activate_license - $license_data
ht_kb_deactivate_license - $license_data
ht_kb_check_license - $license_data
ht_voting_add_vote_comment_action -  $comment, $vote, $post_id
ht_voting_vote_post_action - $users_vote, $post_id, $direction

*visits and feedback filters
ht_kb_record_user_search - true, $user_id, $search_data
ht_kb_record_user_visit - true,  $user_id, $object_id

*control filters
ht_kb_exit_redirect_url
ht_kb_cpt_slug
ht_kb_cat_slug
ht_kb_tag_slug
ht_knowledge_base_custom_title
hk_kb_comments_template
hkb_the_excerpt
stop_ht_knowledge_base_custom_content
show_ht_kb_welcome_on_activation
hkb_compat_templates
hkb_debug_mode
hkb_search_url - $s, $ajax
ht_kb_exits_check_nonce
ht_kb_category_rewrite_hierachical
ht_kb_livesearch_trigger_length
ht_kb_cpt_supports
ht_kb_exits_check_nonce
hkba_analytics_page_capability
ht_kb_article_ordering_page_capability
ht_kb_category_ordering_page_capability
ht_voting_post_display_allow (deprecated?) 
ht_voting_display_voting_on_article
ht_kb_settings_page_activetab
hkb_custom_excerpt_length
hkb_custom_excerpt_more_string
ht_kb_toc_extract_headings_h_start_level
ht_kb_toc_extract_headings_h_end_level
ht_kb_toc_extract_headings_regex


*option filters
hkb_show_knowledgebase_search
hkb_archive_columns
hkb_archive_columns_string
hkb_archive_display_subcategories
hkb_archive_display_subcategory_count
hkb_archive_display_subcategory_articles
hkb_archive_hide_empty_categories
hkb_get_knowledgebase_searchbox_placeholder_text
hkb_show_knowledgebase_breadcrumbs
hkb_show_usefulness_display
hkb_show_viewcount_display
hkb_show_comments_display
hkb_show_related_articles
hkb_show_excerpt
hkb_show_taxonomy_article_excerpt
hkb_show_search_excerpt
hkb_show_realted_rating
hkb_focus_on_search_box
hkb_category_articles
hkb_get_custom_styles_css
hkb_custom_styles_sitewide
hkb_kb_search_sitewide

*settings section filters
hkb_add_general_settings_section
hkb_add_archive_settings_section
hkb_add_article_settings_section
hkb_add_search_settings_section
hkb_add_slugs_settings_section
hkb_add_customstyles_settings_section
hkb_add_articlefeedback_settings_section
hkb_add_transfers_settings_section
hkb_add_license_settings_section
-plus individual options

*search filters
hkb_search_post_types
hkb_search_terms
hkb_search_ht_kb_tag
hkb_search_ht_kb_category
hkb_author_archive_post_types

*json rest api filters
ht_kb_show_in_rest
ht_kb_rest_base
ht_kb_category_show_in_rest
ht_kb_category_rest_base
ht_kb_tag_show_in_rest
ht_kb_tag_rest_base

*output filters
ht_kb_view_count
ht_usefulness
hkb_breadcrumbs_*
ht_kb_wp_title
ht_kb_wp_title_tag_filter
ht_kb_wp_title_suffix
ht_kb_dummy_page_title
hkb_master_tax_terms