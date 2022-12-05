=== Filter Everything&nbsp;— WooCoomerce Product & WordPress Filter ===
Contributors: stepasyuk
Tags: woocommerce product filter, woocommerce filter, product filter, post filter, ajax filter, product filter woocommerce, filter, taxonomy filter, post type filter, woocommerce products filter, category filter, price filter
Stable tag: 1.7.1
Requires at least: 4.6
Tested up to: 6.0.2
Requires PHP: 5.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Filters everything in WordPress & WooCommerce: Products, any Post types, by Any Criteria. Compatible with WPML, ACF and others popular. Supports AJAX. Just Try it.

== Description ==
Next generation of **WordPress Filter** (and also **WooCommerce Product Filter**) that allows you to build powerful faceted filtering system by any criteria. It filters any post types including Custom Post Types and Products, well-designed and has useful filtering options.

### Filters everything in WordPress & WooCommerce
That is any Post types including WooCommerce Products and custom Post types. For example Products, Posts, Pages, Recipes, Real estate objects, Cars — **everything**.

### Video review from WPTuts
https://www.youtube.com/watch?v=g1_qlJvNdsg

### Filters by Any Criteria
They are Categories, Tags, custom Taxonomies, WooCommerce attributes, Custom Fields including created with ACF, Authors etc.

No need to list all possible filters you can create &mdash; they can be any, but most popular are:
* [Price](https://demo.filtereverything.pro/example/by-price/), [Sale price](https://demo.filtereverything.pro/example/by-sale-price/)
* [Brand](https://demo.filtereverything.pro/product-category/electronics/smartphones/)
* [Product Category](https://demo.filtereverything.pro/), Tag
* [Custom Taxonomy](https://demo.filtereverything.pro/posts/)
* [Custom Fields](https://demo.filtereverything.pro/example/acf/) including created with ACF plugin
* [Size](https://demo.filtereverything.pro/product-category/clothing/women/size-xxl/), [Color](https://demo.filtereverything.pro/product-category/clothing/women/color-red/) - any WooCommerce attributes
* [Width, Height, Length](https://demo.filtereverything.pro/example/by-length-width-height/), [Weight](https://demo.filtereverything.pro/example/by-weight/)
* [On sale](https://demo.filtereverything.pro/example/by-sale/) status
* [In Stock](https://demo.filtereverything.pro/example/by-stock/) status
* [Downloadable](https://demo.filtereverything.pro/example/by-downloadable/), [Backordered](https://demo.filtereverything.pro/example/by-backorders/), [Featured](https://demo.filtereverything.pro/example/by-featured/) product statuses
* [Product type](https://demo.filtereverything.pro/example/by-type/)
* [Shipping Class](https://demo.filtereverything.pro/example/by-shipping/)
* [Product Visibility](https://demo.filtereverything.pro/example/by-rating/)
* [Featured image](https://demo.filtereverything.pro/posts/) exists/not exists
* [Views count](https://demo.filtereverything.pro/posts/)
* Cooking time
* Calories
* [Author](https://demo.filtereverything.pro/posts/)
* ... **any**

### Advanced settings for a Filter
Including URL variable name, frontend view, logic, sorting and excluding options as well as filter collapsing/expanding, hierarchical structure, tooltips, search field and others.

### "Autosubmit" and "Apply button" modes
"Autosubmit" - filter updates results every time, when you choose option.
"Apply button" - allows you to select desired criteria and updates results after click on the Submit button only.

### Step by Step filtering
Allows you to load specific Filter terms in dependency from selection another Filter.

### Supports AJAX
Thus your visitors can faster to filter and to find relevant products or posts.

### Supports filtering values in any languages
Among them Chinese, Arabic, Hebrew, Hindi etc

### Compatible with Themes and popular Plugins
Compatible with WPML, ACF, Polylang and others popular. Supports color schemes to allow you easily integrate with your design

### Responsive, Mobile ready

#### Contains Widgets, Shortcodes, has clean WordPress style UI, Regularly updated, Made for Developers, Lightweight — it's all about Filter Everything

### TRY DEMO
* [Clothing](https://demo.filtereverything.pro/product-category/clothing/women/color-black/c-kind-dress/?max_price=250&utm_source=repository)
* [Smartphones](https://demo.filtereverything.pro/product-category/electronics/smartphones/?utm_source=repository)
* [Laptops](https://demo.filtereverything.pro/product-category/electronics/laptops/?utm_source=repository)
* [Blog](https://demo.filtereverything.pro/posts/?utm_source=repository)
* [Color schemes](https://demo.filtereverything.pro/example/color_scheme/color-white/brand-karree/status-instock/?utm_source=repository)

### PRO VERSION
Filter Everything is also available in a professional version which includes:
- Filtering any Custom WP Queries
- Ability to place Filters on any page including Singular
- Full Compatibility with Page builders like Elementor, Oxygen, Divi, WPBakery Composer etc
- Enhanced SEO options that allows you to adjust SEO for filtering pages
- Clean URLs and Permalinks. Full control over filtering page URLs
- Includes Premium Support
[Learn more](https://filtereverything.pro/) About PRO version.

== Frequently Asked Questions ==

= How do I get support? =

You can try to find a solution to your problem in the plugin [documentation](https://filtereverything.pro/resources/&utm_source=repository) or ask your question on the support [forum](https://wordpress.org/support/plugin/filter-everything/). PRO version users can get more info about support [here](https://filtereverything.pro/support/).

= The Filter Widget doesn't appear on desired page =

Usually if you don’t see the Filter Widget on desired page, you need to:
1. Check if the Filter Everything widget is placed in the correct sidebar (widget area) for this page.
1. Check if the Filter Set post type matches to this post type’s page.
1. Check if the Filter Set location settings matches to this page.
1. Check if all filters terms are not empty and contain at least one post.
Or read please this [article](https://filtereverything.pro/resources/filters-widget/)

= AJAX feature does not work on my site =

On those WordPress themes that are created according to the standards, AJAX works automatically. However, if you are having problems, check out the AJAX settings in [this article](https://filtereverything.pro/resources/plugin-settings/).

== Installation ==

Uploading via WordPress dashboard
1. From the WordPress dashboard visit Plugins > Add New > Upload Plugin
2. Choose plugin zip file and upload it
3. Install and Activate the plugin
4. After installation, you will find a new menu item “Filters”
5. Read the documentation to [get started](https://filtereverything.pro/resources/quickstart/)

Uploading via FTP
1. Download the Filter Everything plugin zip file
2. Extract zip file and upload “filter-everything” folder to the /wp-content/plugins/ directory
3. Activate the plugin through the “Plugins” menu in WordPress
4. After installation, you will find a new menu item “Filters”
5. Read the documentation to [get started](https://filtereverything.pro/resources/quickstart/)

== Screenshots ==

1. Common Filters view
2. Filtering Smartphones
3. Mobile views
4. Filter Set with filters
5. Single filter fields
6. URL prefixes settings

== Changelog ==

= 1.7.1 =
*Release Date - 30 September 2022*
* Dev   - Added Show more/Show less toggle for filters
* Tweak - Added hooks to make opened by default Folding, Hierarchy and Show more/Show less filters
* Tweak - Optimized JavaScript code to increase speed of AJAX requests
* Tweak - Added hook 'wpc_dropdown_default_option' to modify default option name in the dropdown view.
* Fix   - Hide Show hierarchy field for non-taxonomy filters and for inappropriate views
* Fix   - Fixed bug for Numeric filters when Min and Max values were incorrect

= 1.7.0 =
*Release Date - 31 August 2022*
* Tweak - Reduced Chips size

= 1.6.8 =
*Release Date - 10 August 2022*
* Dev   - Ability to change mobile breakpoint in one code line
* Dev   - Added Czech translation
* Fix   - Fixed compatibility issue with the Brizy page builder
* Tweak - Changed the Reset button color to inactive

= 1.6.7 =
*Release Date - 07 August 2022*
* Fix   - Fixed problem with Select2 script in dashboard

= 1.6.6 =
*Release Date - 06 August 2022*
* Fix   - Fixed problem with Post Meta Num terms if they are used for several post types
* Fix   - Added translation for the "Select %s first" phrase.
* Fix   - Fixed color for a filter arrow in dashboard that becomes white with Divi theme.
* Fix   - Added additional check for the $screen variable to avoid errors on some customized WP dashboards
* Fix   - Fixed compatibility issue with the Brizy page builder
* Fix   - Fixed problem with Select2 script in dashboard
* Tweak - Replace makeNoticesDismissible() JS function with common event
* Tweak - Added aria-label to select fields

= 1.6.5 =
*Release Date - 22 May 2022*
* Dev   - Updated WpManager->customParseRequest(); method for compatibility with WP 6.0
* Fix   - Fixed bug with Grouped product prices and Custom Field Num filter
* Fix   - Fixed compatibility issue with Yoast SEO Premium
* Fix   - Fixed WP_Queries collecting algorithm to catch all queries

= 1.6.4 =
*Release Date - 11 April 2022*
* Tweak - added A3 Lazy load support.
* Fix   - Fixed closed current children term
* Fix   - Fixed bug with Custom Field Num prefix that contains "_" symbol at the beginning

= 1.6.3 =
*Release Date - 31 March 2022*
* Dev   - Added Ukrainian translation
* Tweak - Added tip to inactive greyed filters
* Fix   - Fixed Sorting widget compatibility problems with Beaver Builder
* Fix   - Fixed closed current children term
* Fix   - Fixed notice in FiltersWidget.php when Hide empty filter selected
* Fix   - Fixed bug with meta value 0 for Custom Field filter

= 1.6.2 =
*Release Date - 16 March 2022*
* Fix   - Fixed widget debug messages

= 1.6.1 =
*Release Date - 15 March 2022*
* Dev   - Added support for the Polylang plugin
* Dev   - Added "no order" option for the 'Sort terms by' filter field
* Tweak - Added hooks to display content in Filters widget
* Tweak - Moved bottom controls into separate template to allow users override it
* Fix   - Fixed small bug with filter prefixes
* Fix   - Fixed validation for URL prefixes

= 1.6.0 =
*Release Date - 08 February 2022*
* Dev   - Added Include/Exclude options to a terms list
* Dev   - Added ability to specify Parent filter to the current that provides step filtering
* Tweak - Returned back the term matches to the current WP Queried object.
* Tweak - Added support of brand images for Perfect Brands for WooCommerce plugin
* Tweak - Improved situation with WPML when Filter Set is not translatable post type
* Tweak - Added SQL comment to mark filtered SQL query
* Tweak - Added before and after Filters widget actions
* Tweak - Improved some option names and translations
* Fix   - Fixed problem with hidden Range slider filter when terms are 0-0
* Fix   - Fixed problem with 'isMetaValueSerialized' method
* Fix   - Fixed problem with 0 count of parent tax term if it do not contain posts
* Fix   - Fixed bug with "Hide empty Filters" option when "Empty Terms" has 'inital' value
* Fix   - Fixed bug with Select2 undefined on some admin pages
* Fix   - Fixed bug with port number in form URL for range filter

[See changelog for all versions](https://demo.filtereverything.pro/changelog.txt).

== Upgrade Notice ==

= 1.7.1 =
* Dev   - Added Show more/Show less toggle for filters
* Tweak - Added hooks to make opened by default Folding, Hierarchy and Show more/Show less filters
* Tweak - Optimized JavaScript code to increase speed of AJAX requests
* Tweak - Added hook 'wpc_dropdown_default_option' to modify default option name in the dropdown view.
* Fix   - Hide Show hierarchy field for non-taxonomy filters and for inappropriate views
* Fix   - Fixed bug for Numeric filters when Min and Max values were incorrect