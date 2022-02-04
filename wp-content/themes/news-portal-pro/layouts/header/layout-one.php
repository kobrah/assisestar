<?php
/**
 * Header layout one
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 *
 */

?>
<header id="masthead" class="site-header layout1" role="banner">

	<div class="np-logo-section-wrapper">
		<div class="mt-container">
			<div class="site-branding">
				<?php if ( the_custom_logo() ) { ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div><!-- .site-logo -->
				<?php } ?>

				<?php
				if ( is_front_page() || is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<div id="np-menu-wrap" class="np-header-menu-wrapper">
				<div class="np-header-menu-block-wrap">
					<div class="mt-container">
						<?php
							$np_home_icon_option = get_theme_mod( 'np_home_icon_option', 'show' );
							if ( $np_home_icon_option == 'show' ) {
						?>
								<div class="np-home-icon">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <i class="fa fa-home"> </i> </a>
								</div><!-- .np-home-icon -->
						<?php } ?>
		                <a href="javascript:void(0)" class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </a>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'news_portal_primary_menu', 'menu_id' => 'primary-menu' ) );
							?>
						</nav><!-- #site-navigation -->

						<?php
							$np_search_icon_option = get_theme_mod( 'np_search_icon_option', 'show' );
							if ( $np_search_icon_option == 'show' ) {
						?>
							<div class="np-header-search-wrapper">
				                <span class="search-main"><i class="fa fa-search"></i></span>
				                <div class="search-form-main np-clearfix">
					                <?php get_search_form(); ?>
					            </div>
							</div><!-- .np-header-search-wrapper -->
						<?php } ?>
					</div><!-- .mt-container -->
				</div><!-- .np-header-menu-block-wrap -->
			</div><!-- .np-header-menu-wrapper -->

		</div><!-- .mt-container -->
	</div><!-- .np-logo-section-wrapper -->	

</header><!-- .site-header -->