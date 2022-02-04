<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

$mt_body_classes = get_body_class();
if ( in_array( 'woocommerce', $mt_body_classes ) ) {
	if ( ! is_active_sidebar( 'np_shop_sidebar' ) ) {
		return;
	}
?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'np_shop_sidebar' ); ?>
	</aside><!-- #secondary -->
<?php
} else {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
<?php 
}