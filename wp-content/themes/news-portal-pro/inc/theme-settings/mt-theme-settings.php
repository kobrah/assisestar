<?php
/**
 * Theme settings page.
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'News_Portal_Settings' ) ) :

class News_Portal_Settings {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'news_portal_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'about_theme_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'about_theme_scripts' ) );

		add_action( 'wp_ajax_activate_demo_importer_plugin', array( $this, 'activate_demo_importer_plugin' ) );
		add_action( 'wp_ajax_install_demo_importer_plugin', array( $this, 'install_demo_importer_plugin' ) );
		$this->load_dependencies();
	}

	/**
	 * Load dependent files.
	 */
	public function load_dependencies() {
		require get_template_directory(). '/inc/theme-settings/mt-theme-demo-library.php';
	}

	/**
	 * Add admin menu.
	 */
	public function news_portal_admin_menu() {
		
		$theme 		= wp_get_theme( get_template() );
		$theme_name = $theme->display( 'Name' );

		add_theme_page( sprintf( esc_html__( '%1$s Settings', 'news-portal-pro' ), $theme_name ), sprintf( esc_html__( '%1$s Settings', 'news-portal-pro' ), $theme_name ) , 'edit_theme_options', 'news-portal-pro-settings', array( $this, 'get_started_screen' ) );

	}

	/**
	 * Enqueue styles.
	 */
	public function about_theme_styles( $hook ) {
		global $news_portal_version;

		if ( 'appearance_page_news-portal-pro-settings' != $hook && 'themes.php' != $hook ) {
			return;
		}

		wp_enqueue_style( 'mt-theme-settings-style', get_template_directory_uri() . '/inc/theme-settings/assets/css/settings.css', array(), $news_portal_version );
	}

	/**
	 * Enqueue scripts.
	 */
	public function about_theme_scripts( $hook ) {
		global $news_portal_version;
		
		if ( 'appearance_page_news-portal-pro-settings' != $hook ) {
			return;
		}

		$activated_plugins = apply_filters( 'news_portal_active_plugins', get_option('active_plugins') );
		$demo_import_plugin = in_array( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php', $activated_plugins );
		if ( $demo_import_plugin ) {
			return;
		}

		wp_enqueue_script( 'mt-theme-settings-script', get_template_directory_uri() . '/inc/theme-settings/assets/js/settings.js', array( 'jquery' ), esc_attr( $news_portal_version ) );

		$demo_importer_plugin = WP_PLUGIN_DIR . '/mysterythemes-demo-importer/mysterythemes-demo-importer.php';
		if ( file_exists( $demo_importer_plugin ) && !is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
			$action = 'activate';
		} else {
			$action = 'install';
		}

		wp_localize_script( 'mt-theme-settings-script', 'mtaboutObject', array(
			'ajax_url'	=> esc_url( admin_url( 'admin-ajax.php' ) ),
			'_wpnonce'	=> wp_create_nonce( 'news_portal_admin_plugin_install_nonce' ),
			'action'	=> esc_html( $action )
		));
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $news_portal_version;
		$theme 				= wp_get_theme( get_template() );
		$theme_name 		= $theme->get( 'Name' );
		$author_uri 		= $theme->get( 'AuthorURI' );
		$author_name 		= $theme->get( 'Author' );

		// Drop minor version if 0
?>
		<div class="news-portal-theme-info mt-theme-info mt-clearfix">
			<h1 class="mt-about-title"> <?php echo esc_html( $theme_name ); ?> </h1>
			<div class="author-credit">
				<span class="theme-version"><?php printf( esc_html__( 'Version: %1$s', 'news-portal-pro' ), $news_portal_version ); ?></span>
				<span class="author-link"><?php printf( wp_kses_post( 'By <a href="%1$s" target="_blank">%2$s</a>', 'news-portal-pro' ), $author_uri, $author_name ); ?></span>
			</div>
		</div><!-- .news-portal-theme-info -->

		<div class="mt-nav-tab-content-wrapper">
			<div class="nav-tab-wrapper">

				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'news-portal-pro-settings' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-pro-settings' ), 'themes.php' ) ) ); ?>">
					<span class="dashicons dashicons-admin-appearance"></span> <?php esc_html_e( 'Get Started', 'news-portal-pro' ); ?>
				</a>

				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'demos' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-pro-settings', 'tab' => 'demos' ), 'themes.php' ) ) ); ?>">
					<span class="dashicons dashicons-download"></span> <?php esc_html_e( 'Demos', 'news-portal-pro' ); ?>
				</a>

				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'news-portal-pro-settings', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
					<span class="dashicons dashicons-flag"></span> <?php esc_html_e( 'Changelog', 'news-portal-pro' ); ?>
				</a>
			</div><!-- .nav-tab-wrapper -->
<?php
	}

	/**
	 * Get started screen page.
	 */
	public function get_started_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {

		$theme 				= wp_get_theme( get_template() );
		$theme_name 		= $theme->template;

		$doc_url 		= '//docs.mysterythemes.com/'. $theme_name;
		$support_url	= '//mysterythemes.com/support/forum/themes/pro-themes/'. $theme_name;
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
				<div class="mt-nav-content-wrap">
					<div class="theme-features-wrap welcome-panel">
						<h4><?php esc_html_e( 'Here are some usefull links for you to get started', 'news-portal-pro' ); ?></h4>
						<div class="under-the-hood two-col">	
							<div class="col">
								<h3><?php esc_html_e( 'Next Steps', 'news-portal-pro' ); ?></h3>
								<ul>
									<li>
										<a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[section]=static_front_page' ); ?>" target="_blank" class="welcome-icon welcome-setup-home"><?php esc_html_e( 'Set up your homepage', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[panel]=news_portal_header_settings_panel' ); ?>" target="_blank" class="welcome-icon dashicons-editor-kitchensink"><?php esc_html_e( 'Manage header section', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[section]=np_post_settings_section' ); ?>" target="_blank" class="welcome-icon dashicons-text-page"><?php esc_html_e( 'Single Post Layout', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( admin_url( 'customize.php' ).'?autofocus[section]=np_social_icons_section' ); ?>" target="_blank" class="welcome-icon dashicons-networking"><?php esc_html_e( 'Manage Social Icons', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" target="_blank" class="welcome-icon welcome-menus"><?php esc_html_e( 'Manage menus', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" target="_blank" class="welcome-icon welcome-widgets"><?php esc_html_e( 'Manage widgets', 'news-portal-pro' ); ?></a>
									</li>
								</ul>
							</div>

							<div class="col">
								<h3><?php esc_html_e( 'More Actions', 'news-portal-pro' ); ?></h3>
								<ul>
									<li>
										<a href="<?php echo esc_url( $doc_url ); ?>" target="_blank" class="welcome-icon dashicons-media-text"><?php esc_html_e( 'Documentation', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( $support_url ); ?>" target="_blank" class="welcome-icon dashicons-businesswoman"><?php esc_html_e( 'Need theme support?', 'news-portal-pro' ); ?></a>
									</li>
									<li>
										<a href="<?php echo esc_url( 'https://wpallresources.com/' ); ?>" target="_blank" class="welcome-icon dashicons-admin-users"><?php esc_html_e( 'WP Tutorials', 'news-portal-pro' ); ?></a>
									</li>
								</ul>
							</div>
						</div>
					</div><!-- .theme-features-wrap -->

					<div class="return-to-dashboard news-portal">
						<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
							<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
								<?php is_multisite() ? esc_html_e( 'Return to Updates', 'news-portal-pro' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'news-portal-pro' ); ?>
							</a> |
						<?php endif; ?>
						<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'news-portal-pro' ) : esc_html_e( 'Go to Dashboard', 'news-portal-pro' ); ?></a>
					</div><!-- .return-to-dashboard -->
				</div><!-- .mt-nav-content-wrap -->
			</div><!-- .mt-nav-tab-content-wrapper -->
		</div><!-- .about-wrap -->
<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function demos_screen() {
		$activated_theme 	= get_template();
		$demodata 			= get_transient( 'news_portal_demo_packages' );
		
		if ( empty( $demodata ) || $demodata == false ) {
			$news_portal_library = new News_Portal_Demo_Library();
			$demodata = $news_portal_library->retrieve_demo_by_activatetheme();
			if ( $demodata ) {
				set_transient( 'news_portal_demo_packages', $demodata, WEEK_IN_SECONDS );
			}
		}

		$activated_demo_check 	= get_option( 'mtdi_activated_check' );
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
				<div class="mt-nav-content-wrap">
					<div class="mt-theme-demos rendered">
						<?php $this->install_demo_import_plugin_popup(); ?>
						<div class="demos wp-clearfix">
						<?php
							if ( isset( $demodata ) && empty( $demodata ) ) {
								esc_html_e( 'No demos are configured for this theme, please contact the theme author', 'news-portal-pro' );
								return;
							} else {
						?>
								<div class="mt-demo-wrapper mtdi_gl js-ocdi-gl">
									<div class="themes wp-clearfix">
									<?php
										foreach ( $demodata as $value ) {
											$theme_name 		= $value['name'];
											$theme_slug 		= $value['theme_slug'];
											$preview_screenshot = $value['preview_screen'];
											$demourl 			= $value['preview_url'];
											if ( ( strpos( $activated_theme, 'pro' ) !== false && strpos( $theme_slug, 'pro' ) !== false ) || ( strpos( $activated_theme, 'pro' ) == false ) ) {
									?>
												<div class="mt-each-demo<?php if  ( strpos( $activated_theme, 'pro' ) == false && strpos( $theme_slug, 'pro' ) !== false ) { echo ' mt-demo-pro'; } ?> theme mtdi_gl-item js-ocdi-gl-item" data-categories="ltrdemo" data-name="<?php echo esc_attr ( $theme_slug ); ?>" style="display: block;">
													<div class="mtdi-preview-screenshot mtdi_gl-item-image-container">
														<a href="<?php echo esc_url ( $demourl ); ?>" target="_blank">
															<img class="mtdi_gl-item-image" src="<?php echo esc_url ( $preview_screenshot ); ?>" />
														</a>
													</div><!-- .mtdi-preview-screenshot -->
													<div class="theme-id-container">
														<h2 class="mtdi-theme-name theme-name" id="nokri-name"><?php echo esc_html ( $theme_name ); ?></h2>
														<div class="mtdi-theme-actions theme-actions">
															<?php
																if ( $activated_demo_check != '' && $activated_demo_check == $theme_slug ) {
															?>
																	<a class="button disabled button-primary hide-if-no-js" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_html__( 'Imported %1$s', 'news-portal-pro' ), $theme_name ); ?>">
																		<?php esc_html_e( 'Imported', 'news-portal-pro' ); ?>
																	</a>
															<?php
																} else {
																	if ( strpos( $activated_theme, 'pro' ) == false && strpos( $theme_slug, 'pro' ) !== false ) {
																		$s_slug = explode( "-pro", $theme_slug );
																		$purchaseurl = 'https://mysterythemes.com/wp-themes/'.$s_slug[0].'-pro';
															?>
																		<a class="button button-primary mtdi-purchasenow" href="<?php echo esc_url( $purchaseurl ); ?>" target="_blank" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_html__( 'Purchase Now', 'news-portal-pro' ), $theme_name ); ?>">
																			<?php esc_html_e( 'Buy Now', 'news-portal-pro' ); ?>
																		</a>
															<?php
																	} else {
																		if ( is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
																			$button_tooltip = esc_html__( 'Click to import demo', 'news-portal-pro' );
																		} else {
																			$button_tooltip = esc_html__( 'Demo importer plugin is not installed or activated', 'news-portal-pro' );
																		}
															?>
																		<a title="<?php echo esc_attr( $button_tooltip ); ?>" class="button button-primary hide-if-no-js mtdi-demo-import" href="javascript:void(0);" data-name="<?php echo esc_attr ( $theme_name ); ?>" data-slug="<?php echo esc_attr ( $theme_slug ); ?>" aria-label="<?php printf ( esc_attr__( 'Import %1$s', 'news-portal-pro' ), $theme_name ); ?>">
																			<?php esc_html_e( 'Import', 'news-portal-pro' ); ?>
																		</a>
															<?php
																	}
																}
															?>
																<a class="button preview install-demo-preview" target="_blank" href="<?php echo esc_url ( $demourl ); ?>">
																	<?php esc_html_e( 'View Demo', 'news-portal-pro' ); ?>
																</a>
														</div><!-- .mtdi-theme-actions -->
													</div><!-- .theme-id-container -->
												</div><!-- .mtdi-each-demo -->
									<?php
											}
										}
									?>
									</div><!-- .themes -->
								</div><!-- .mtdi-demo-wrapper -->
						<?php
							}
						?>
						</div>
					</div><!-- .theme-browser -->
				</div><!-- .mt-nav-content-wrap -->
			</div><!-- .mt-nav-tab-content-wrapper -->
		</div><!-- .wrap.about-wrap -->
<?php
	}
	
	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

	?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
				<div class="mt-nav-content-wrap">
					<h4><?php esc_html_e( 'View changelog below:', 'news-portal-pro' ); ?></h4>

					<?php
						$changelog_file = apply_filters( 'news_portal_changelog_file', get_template_directory() . '/readme.txt' );

						// Check if the changelog file exists and is readable.
						if ( $changelog_file && is_readable( $changelog_file ) ) {
							WP_Filesystem();
							$changelog 		= $wp_filesystem->get_contents( $changelog_file );
							$changelog_list = $this->parse_changelog( $changelog );

							echo wp_kses_post( $changelog_list );
						}
					?>
				</div><!-- .mt-nav-content-wrap -->
			</div><!-- .mt-nav-tab-content-wrapper -->
		</div>
	<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes 	= explode( '\r\n', trim( $matches[1] ) );
			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}
	
	/**
	 * Popup alert for mystery themes demo importer plugin install.
	 *
	 * @since 1.2.0
	 */
	public function install_demo_import_plugin_popup() {
		$demo_importer_plugin = WP_PLUGIN_DIR . '/mysterythemes-demo-importer/mysterythemes-demo-importer.php';
	?>
			<div id="mt-demo-import-plugin-popup">
				<div class="mt-popup-inner-wrap">
					<?php
						if ( is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
							echo '<span class="mt-plugin-message">'.esc_html__( 'You can import available demos now!', 'news-portal-pro' ).'</span>';
						} else {
							if ( ! file_exists( $demo_importer_plugin ) ) {
					?>
								<span class="mt-plugin-message"><?php esc_html_e( 'Mystery Themes Demo Importer Plugin is not installed!', 'news-portal-pro' ); ?></span>
								<a href="javascript:void(0)" class="mt-install-demo-import-plugin" data-process="<?php esc_attr_e( 'Installing & Activating', 'news-portal-pro' ); ?>" data-done="<?php esc_attr_e( 'Installed & Activated', 'news-portal-pro' ); ?>">
									<?php esc_html_e( 'Install and Activate', 'news-portal-pro' ); ?>
								</a>
					<?php
							} else {
					?>
								<span class="mt-plugin-message"><?php esc_html_e( 'Mystery Themes Demo Importer Plugin is installed but not activated!', 'news-portal-pro' ); ?></span>
								<a href="javascript:void(0)" class="mt-activate-demo-import-plugin" data-process="<?php esc_attr_e( 'Activating', 'news-portal-pro' ); ?>" data-done="<?php esc_attr_e( 'Activated', 'news-portal-pro' ); ?>">
									<?php esc_html_e( 'Activate Now', 'news-portal-pro' ); ?>
								</a>
					<?php
							}
						}
					?>
				</div><!-- .mt-popup-inner-wrap -->
			</div><!-- .mt-demo-import-plugin-popup -->
		<?php
	}

	/**
	 * Activate Demo Importer Plugins Ajax Method
	 *
	 * @since 1.2.0
	 */
	public function activate_demo_importer_plugin() {
		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'news_portal_admin_plugin_install_nonce' ) ) {
			die( 'This action was stopped for security purposes.' );
		}

		$result = activate_plugin( '/mysterythemes-demo-importer/mysterythemes-demo-importer.php' );
		if ( is_wp_error( $result ) ) {
			// Process Error
			wp_send_json_error(
				array(
					'success' => false,
					'message' => $result->get_error_message(),
				)
			);
		} else {
			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Activated.', 'news-portal-pro' ),
				)
			);
		}
	}

	/**
	 * Activate Demo Importer Plugins Ajax Method
	 *
	 * @since 1.2.0
	 */
	function install_demo_importer_plugin() {

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'news_portal_admin_plugin_install_nonce' ) ) {
			die( 'This action was stopped for security purposes.' );
		}

		if ( ! current_user_can( 'install_plugins' ) ) {
			$status['message'] = __( 'Sorry, you are not allowed to install plugins on this site.', 'news-portal-pro' );
			wp_send_json_error( $status );
		}

		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => esc_html( 'mysterythemes-demo-importer' ),
				'fields' => array(
					'sections' => false,
				),
			)
		);
		if ( is_wp_error( $api ) ) {
			$status['message'] = $api->get_error_message();
			wp_send_json_error( $status );
		}

		$status['pluginName'] 	= $api->name;
		$skin     				= new WP_Ajax_Upgrader_Skin();
		$upgrader 				= new Plugin_Upgrader( $skin );
		$result   				= $upgrader->install( $api->download_link );

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$status['debug'] = $skin->get_upgrade_messages();
		}

		if ( is_wp_error( $result ) ) {
			$status['errorCode']    = $result->get_error_code();
			$status['message'] 		= $result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( is_wp_error( $skin->result ) ) {
			$status['errorCode']    = $skin->result->get_error_code();
			$status['message'] 		= $skin->result->get_error_message();
			wp_send_json_error( $status );
		} elseif ( $skin->get_errors()->get_error_code() ) {
			$status['message'] 		= $skin->get_error_messages();
			wp_send_json_error( $status );
		} elseif ( is_null( $result ) ) {
			global $wp_filesystem;

			$status['errorCode']    = 'unable_to_connect_to_filesystem';
			$status['message'] 		= __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'news-portal-pro' );

			// Pass through the error from WP_Filesystem if one was raised.
			if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				$status['message'] = esc_html( $wp_filesystem->errors->get_error_message() );
			}

			wp_send_json_error( $status );
		}

		if ( current_user_can( 'activate_plugin' ) ) {
			$result = activate_plugin( '/mysterythemes-demo-importer/mysterythemes-demo-importer.php' );
			if ( is_wp_error( $result ) ) {
				$status['errorCode']    = $result->get_error_code();
				$status['message'] 		= $result->get_error_message();
				wp_send_json_error( $status );
			}
		}
		$status['message'] = esc_html__( 'Plugin installed successfully', 'news-portal-pro' );
		wp_send_json_success( $status );
	}
}

endif;

return new News_Portal_Settings();