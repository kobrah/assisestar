<?php
/*
 handles the settings for the WpSiteCount plugin
 Date : 2015/03/05 // 2017/02/05
 Author: ad-software, André
*/

defined('ABSPATH') OR exit;
if ( ! WP_DEBUG ) error_reporting(0);

if (!defined('ADS_ID_SETTINGS')) 	define('ADS_ID_SETTINGS', 'adswsc');
if (!defined('ADS_ID_GROUP')) 	define('ADS_ID_GROUP', 'adswsc-Group');
if (!defined('ADS_ID_PAGE1')) 	define('ADS_ID_PAGE1', 'adswsc-settings1');
if (!defined('ADS_ID_PAGE2')) 	define('ADS_ID_PAGE2', 'adswsc-settings2');
if (!defined('ADS_ID_PAGE3')) 	define('ADS_ID_PAGE3', 'adswsc-settings3');
if (!defined('ADS_ID_PAGE4')) 	define('ADS_ID_PAGE4', 'adswsc-settings4');
if (!defined('ADS_ID_PAGE5')) 	define('ADS_ID_PAGE5', 'adswsc-settings5');
if (!defined('ADS_ID_PAGE6')) 	define('ADS_ID_PAGE6', 'adswsc-settings6');
if (!defined('ADS_ID_SEC1')) 	define('ADS_ID_SEC1', 'adswsc-Section1');

class adswsc_clsSettingsPage
{
	// Holds the values to be used in the fields callbacks
	private $mGeneral;
	private $mDoReset;
	protected	$active_tab;
	
    // Start up
	public function __construct()
	{
		if( is_multisite() ) {
			add_action( 'network_admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		} else {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		}
		add_action( 'admin_init', array( $this, 'page_init' ) );
		if( isset( $_GET[ 'tab' ] ) ) {  
      $this->active_tab = sanitize_text_field($_GET[ 'tab' ]);  
    } else {
      $this->active_tab = ADS_ID_PAGE1;
    }
	}

	// Add options page
	public function add_plugin_page()
	{
		// This page will be under "Settings"
    add_menu_page( "Site Counter", "Site Counter", "manage_options", ADS_ID_SETTINGS, array( $this, 'create_admin_page'), ADS_IMAGE_URL.'icon16.png' );
		add_options_page(__('Settings', ADS_TEXT_DOMAIN),__('Settings', ADS_TEXT_DOMAIN),'manage_options', ADS_ID_SETTINGS, array( $this, 'create_admin_page' ));
	}

	// Options page callback
	public function create_admin_page()
	{
		// Set class property
		$this->mGeneral = adswsc_GetOptions( ADS_OPTIONS_GENERAL );
	
		if( isset( $_GET[ 'tab' ] ) ) {  
      $this->active_tab = sanitize_text_field($_GET[ 'tab' ]);  
    } else {
      $this->active_tab = ADS_ID_PAGE1;
    }
		?>
		<div class="wrap">
			<h2><img style="vertical-align:bottom;" alt="icon" src="<?php echo ADS_IMAGE_URL.'icon32.png'; ?>" /> 
			<?php _e('Site Counter settings', ADS_TEXT_DOMAIN)?></h2>
			<?php settings_errors(); ?>
			<form method="post" action="options.php" target="_self" enctype="multipart/form-data">
				<input type="hidden" name="tab" value="<?php echo $this->active_tab; ?>" />
				<h2 class="nav-tab-wrapper" >  
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE1;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE1 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'general16.png'; ?>" /> <?php _e('General', ADS_TEXT_DOMAIN); ?></a>
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE2;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE2 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'clean16.png'; ?>" /> <?php _e('Cleanup', ADS_TEXT_DOMAIN); ?></a>
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE3;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE3 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'statistic16.png'; ?>" /> <?php _e('Statistic', ADS_TEXT_DOMAIN); ?></a>
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE4;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE4 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'help16.png'; ?>" /> <?php _e('Help', ADS_TEXT_DOMAIN); ?> 1</a>
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE5;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE5 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'help16.png'; ?>" /> <?php _e('Help', ADS_TEXT_DOMAIN); ?> 2</a>
					<a style="font-size:14pt;" href="?page=<?php echo ADS_ID_SETTINGS; ?>&tab=<?php echo ADS_ID_PAGE6;?>" class="nav-tab <?php echo $this->active_tab == ADS_ID_PAGE6 ? 'nav-tab-active' : ''; ?>">
					<img alt="icon" src="<?php echo ADS_IMAGE_URL.'help16.png'; ?>" /> <?php _e('Help', ADS_TEXT_DOMAIN); ?> 3</a>
				</h2>
		
				<?php
				if( $this->active_tab == ADS_ID_PAGE1 ) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE1 );
					submit_button(); 
				} else if( $this->active_tab == ADS_ID_PAGE2 ) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE2 );
					submit_button(); 
				} else if( $this->active_tab == ADS_ID_PAGE3) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE3 );
					submit_button(); 
				} else if( $this->active_tab == ADS_ID_PAGE4) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE4 );
				} else if( $this->active_tab == ADS_ID_PAGE5) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE5 );
				} else if( $this->active_tab == ADS_ID_PAGE6) {  
					settings_fields( ADS_ID_GROUP );   
					do_settings_sections( ADS_ID_PAGE6 );
				} 
				print '<address>';
				print __('Translated by: <a target="_blank" href="http://www.ad-soft.ch">ad-software</a>', ADS_TEXT_DOMAIN);
				print '</address>';
				?>
			</form>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="7PW6RUUGFRL92">
					<input type="image" src="https://www.paypalobjects.com/de_DE/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		<?php	
	}

	//===============================
	//general
	//===============================
	// Register and add settings
	public function page_init()
	{        
		register_setting(
			ADS_ID_GROUP, // Option group
			ADS_OPTIONS_GENERAL, // Option name
			array( $this, 'validate_general')  // Sanitize
		);

		//PAGE 1
		#=================================================
		add_settings_section(
			ADS_ID_SEC1, // ID
			__('Counter Settings', ADS_TEXT_DOMAIN), // Title
			array( $this, 'print_info_nix' ), // Callback
			ADS_ID_PAGE1 // Page
		);  

		add_settings_field(
			'Counter', // ID
			__('Default Counter Value', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_counter' ), // Callback
			ADS_ID_PAGE1, // Page
			ADS_ID_SEC1, // Section           
			array( 'label_for' => 'Counter' )
		);      

		add_settings_field(
			'Reset', // ID
			__('Set Counter to Default Value', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_reset' ), // Callback
			ADS_ID_PAGE1, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'Reset' )
		); 

		add_settings_field(
			'CycleTime', // ID
			__('Visitor-hit cooldown', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_Cycletime' ), // Callback
			ADS_ID_PAGE1, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'CycleTime' )
		);      

		//PAGE 2
		#=================================================
		add_settings_section(
			ADS_ID_SEC1, // ID
			__('Cleanup Settings', ADS_TEXT_DOMAIN), // Title
			array( $this, 'print_info_nix' ), // Callback
			ADS_ID_PAGE2 // Page
			);  

		add_settings_field(
			'Cleanup', // ID
			__('Cleanup intervall', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_Cleanup' ), // Callback
			ADS_ID_PAGE2, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'Cleanup' )
		);   
        
		add_settings_field(
			'DeleteTime', // ID
			__('Max age of the IP to remove', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_Deletetime' ), // Callback
			ADS_ID_PAGE2, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'DeleteTime' )
		);   
        
		add_settings_field(
			'Bots', // ID
			__('Defines a comma-separated list of Robots, which prevents a count', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_bots' ), // Callback
			ADS_ID_PAGE2, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'Bots' )
		);   

		//PAGE 3
		#=================================================
		add_settings_section(
			ADS_ID_SEC1, // ID
			__('Short dashboard statistics', ADS_TEXT_DOMAIN), // Title
			array( $this, 'print_info_nix' ), // Callback
			ADS_ID_PAGE3 // Page
		);  
		
		add_settings_field(
			'PageTime', // ID
			__('Page-hit cooldown', ADS_TEXT_DOMAIN), // Title 
			array( $this, 'callback_Pagetime' ), // Callback
			ADS_ID_PAGE3, // Page
			ADS_ID_SEC1, // Section    
			array( 'label_for' => 'PageTime' )
		);  

		add_settings_section(
			ADS_ID_SEC1, // ID
			'', // Title
			array( $this, 'print_info_help' ), // Callback
			ADS_ID_PAGE4 // Page
		);  		

		add_settings_section(
			ADS_ID_SEC1, // ID
			'', // Title
			array( $this, 'print_info_help2' ), // Callback
			ADS_ID_PAGE5 // Page
		);  		

		add_settings_section(
			ADS_ID_SEC1, // ID
			'', // Title
			array( $this, 'print_info_help3' ), // Callback
			ADS_ID_PAGE6 // Page
		);  		
	}

	// Sanitize each setting field as needed
	// @param array $input Contains all settings fields as array keys
	public function validate_general( $input )
	{
		$DoReset = '';
		$temp = adswsc_GetOptions( ADS_OPTIONS_GENERAL );
		//PAGE 1
		//counter
		if ( isset( $input['Counter'] ) )
			$temp['Counter'] = absint( $input['Counter'] );
		//reset counter
		if ( isset( $input['Reset'] ) )
			$DoReset = ($input['Reset'] == 'on' ? 'on' : '' );
		//cycle
		if ( isset( $input['CycleSec'] ) || 
				 isset( $input['CycleMin'] ) || 
				 isset( $input['CycleHou'] )) {
			$t = 0;
			if ( isset( $input['CycleSec'] ) )
				$t += (absintminmax($input['CycleSec'],0,59));
			if ( isset( $input['CycleMin'] ) )
				$t += (absintminmax($input['CycleMin'], 0, 59) * 60 );
			if ( isset( $input['CycleHou'] ) )
				$t += (absintminmax($input['CycleHou'], 0, 24) * 3600);
			if ($t >= 30 && $t <= (24*3600))
				$temp['CycleTime'] = $t;
			else
				add_settings_error('validate_general', esc_attr( '' ), 
					__('only 30 sec. to 24 hour supported on cyle time', ADS_TEXT_DOMAIN), 'error');
		}				
		//PAGE 2
		//cleanup
		$DoCleanup = '';
		if ( isset( $input['CleanupNow'] ) )
			$DoCleanup = ($input['CleanupNow'] == 'on' ? 'on' : '' );
		//cleanup time
		if ( isset( $input['CleanupD'] ) || 
				 isset( $input['CleanupM'] ) ) {
			$t = 0;		
			if( isset( $input['CleanupD'] ) )
				$t += absint($input['CleanupD'])*24*3600;
			if( isset( $input['CleanupM'] ) )
				$t += absint($input['CleanupM'])*30*24*3600;
			if ($t >= (24*3600) && $t <= (6*30*24*3600) ) 
				$temp['CleanupTime'] = $t;
			else 
				add_settings_error('main',  ' ' , 
					sprintf(__('( Enter cleanup interval from 1 days to 6 months )', ADS_TEXT_DOMAIN).'<br>' ));
		}
		//delete IP
		if ( isset( $input['DeleteDay'] ) ||
				 isset( $input['DeleteMon'] ) ) {
			$t = 0;
			if( isset( $input['DeleteDay'] ) )
				$t += absint($input['DeleteDay'])*24*3600;
			if( isset( $input['DeleteMon'] ) )
				$t += absint($input['DeleteMon'])*30*24*3600;
			if ($t >= (6*24*3600) && $t <= (9*30*24*3600) )
				$temp['DeleteTime'] = $t;
			else
				add_settings_error('validate_general', esc_attr( '' ), 
					__('only 6 day to 9 months supported on cleanup', ADS_TEXT_DOMAIN), 'error');
		}			
		// bots
		if( isset( $input['Bots'] ) )
			$temp['Bots'] = htmlspecialchars($input['Bots']);
		//PAGE 3
		if ( isset( $input['PageOn'] ) )
			$temp['PageOn'] = ($input['PageOn'] == 'on' ? 'on' : '');
		if ( isset( $input['PageSec'] ) ||
				 isset( $input['PageMin'] ) ) {
			$t = 0;
			if ( isset( $input['PageSec'] ) )
				$t += (absintminmax($input['PageSec'],0,59));
			if ( isset( $input['PageMin'] ) )
				$t += (absintminmax($input['PageMin'], 0, 60)*60);
			if ($t >= 30 && $t <= (3600))
				$temp['PageTime'] = $t;
			else
				add_settings_error('validate_general', esc_attr( '' ), 
					__('only 30 sec. to 1 hour supported on cyle time', ADS_TEXT_DOMAIN), 'error');
		}
		
		//reset counter
		if ( $DoReset == 'on' ) {
			adswsc_ResetCounter($temp['Counter']);
			$temp['LastReset'] = current_time('timestamp');
			add_settings_error('main',  ' ' , 
				sprintf(__('( Counter reseted to %s )', ADS_TEXT_DOMAIN).'<br>', $temp['Counter']),
				'updated');
		}
		//Cleanup
		if ( $DoCleanup == 'on' ) {
			adswsc_CleanUp($temp['DeleteTime']);
			$temp['Cleanup'] = current_time('timestamp') + $temp['CleanupTime'];
			add_settings_error('main',  ' ' , __('( outdated hits were cleaned )', ADS_TEXT_DOMAIN).'<br>', 'updated');
		}
		if ($temp['CleanupTime'] > $temp['DeleteTime'])
			add_settings_error('main',  ' ' , __('WARNING: Cleanup time should be less than IP age', ADS_TEXT_DOMAIN).'<br>', 'updated');
		return $temp;
	}

	// Print the Section text
	#=================================================
	public function print_info_nix()
	{
	//printf
	}

	#=================================================
	public function print_info_help(){ ?>
		<div>
			<h3><b><?php _e('To create a sort code, go to the respective page / blog.', ADS_TEXT_DOMAIN); ?></b></h3>
			<ul style="padding-left: 10px">
				<li><?php _e('Use only image name that available on "./counter" plugin folder', ADS_TEXT_DOMAIN); ?></li>
				<li><?php _e('Enter a short code, e.g.', ADS_TEXT_DOMAIN); ?>: <b>[ads-wpsitecount image=itseg7blue.jpg  imgmaxw='100' width=100 whunit='px' height=0 block='' count=1234 ].</b><?php
						echo do_shortcode("[ads-wpsitecount image=itseg7blue.jpg  imgmaxw='100' width=100 whunit='px' height=0 block='' count=1234]"); ?></li>
			</ul>
			<h3><b><?php _e('What args can i put on shotcode?', ADS_TEXT_DOMAIN); ?></b></h3>
			<ul style="padding-left: 10px">
				<li>count=2014 -> Counter value from 0-999999999</li>
				<li>image='file.jpg' -> Image filename.jpg, look at the ./counter folder</li>
				<li>width=165 -> Counter width, 0=empty=automatic. It is recommended to set one of these parameters width or height</li>
				<li>height= -> Counter height, 0=empty=automatic. It is recommended to set one of these parameters width or height</li>
				<li>block='p' -> Issue with p, div or none</li>
				<li>fill='on' -> Previous vacancy with zero filled</li>
				<li>length=7 -> Minimum points of the counter. If the counter is greater than this will be adjusted automatically.</li>
				<li>align='center' -> Align: left, right, center</li>
				<li>text='on' -> Show counter as text only</li>
				<li>before='since 2001' -> Before text</li>
				<li>after='My counter' -> After text</li>
				<li>imgmaxw=350 -> max image size px on output</li>
				<li>whunit='px' -> values: '%', 'px', 'pt', 'em'</li>
				<li>bosize=3 -> border-size pixels, value from 0 to 9</li>
				<li>botype='inset' -> border-style, all css values</li>
				<li>bocolor='white' -> border-color, #FFFFFF, white </li>
				<li>boradius='3' -> border-radius pixels, value from 0 to 9</li>
				<li>save='on' -> save settings as standard</li>
			</ul>
		</div><br> <?php
	}

	#=================================================
	public function print_info_help2(){ ?>
		<div>
			<h3><?php echo __("How to use the placeholder?", ADS_TEXT_DOMAIN); ?></h3>
			<ul style="padding-left: 10px">
				<li><b><?php _e('On after or before text you can place placeholder.'.
												' ( Info: change style on css please )',
												ADS_TEXT_DOMAIN); ?></b></li>
				<ul style="padding-left: 20px">
					<li>%ip -> ip number</li>
					<li>%image -> imagename</li>
					<li>%count -> counter value</li>
					<li>%[...]% -> when user logedin</li>
					<ul style="padding-left: 30px">
						<li>%lname -> last name, %fname -> first name, %dname -> display name, %sname -> login name, %email -> email</li>
					</ul>
				</ul>
				<li><b><?php _e('You can use your language on text fields selected from WP Locale, '.
												'the WP Locale will take the right text for you',
												ADS_TEXT_DOMAIN);	?></b></li>
				<ul style="padding-left: 30px">
					<li>{lang-code} -> <?php _e('set multi text on the fields: title-, after-, before-widget',
												ADS_TEXT_DOMAIN);	?></li>
					<li>eq: title => {de}Besucher{en}Visitor</li>
					<li>or: title => {de_DE}Besucher{en_US}Visitor</li>
				</ul>
			</ul>
		</div><br> <?php
	}

	#=================================================
	public function print_info_help3(){ ?>
		<div>
			<h3><?php echo __("List of counter images", ADS_TEXT_DOMAIN); ?></h3>
			<?php
			$Directory = ADS_COUNTER_DIR.'*.jpg';
			$FILES = glob($Directory);
			echo "<table><tbody><tr>";
			for($x = 0; $x < sizeof($FILES); $x++) { 
				echo "<td style='text-align:right;'>".basename($FILES[$x])."</td>";
				echo "<td>".do_shortcode("[ads-wpsitecount image=".basename($FILES[$x])." imgmaxw='100' width=100 whunit='px' height=0 block='' count=1234 ]")."</td>";
				if ((($x+1) % 3) == 0)
					echo "</tr><tr>";
			}
			echo "</tr></tbody></table>";
			?>
		</div><br> <?php
	}
	
	// Get the settings option array and print one of its values
	public function callback_bots()
	{ 
		printf('<textarea maxlength="400" cols="50" rows="5" id="Bots" name="%s[Bots]" />%s</textarea>', 
			ADS_OPTIONS_GENERAL, 
			isset( $this->mGeneral['Bots'] ) ? esc_attr( $this->mGeneral['Bots']) : '');
		printf('<br>'.__('Example (copy & paste), white-space are removed on search:',ADS_TEXT_DOMAIN).'<br>'.
			'Google, msnbot, Rambler, Yahoo, AbachoBOT, Accoona, AcoiRobot, ASPSeek, Bing, CrocCrawler,'.
			' Dumbot, FAST-WebCrawler, GeonaBot, Gigabot, Lycos, MSRBOT, Scooter, Altavista, IDBot,'.
			' eStyle, Scrubby, facebookexternalhit, bot, robot');
	}

	public function callback_counter()
	{ 
		printf('<input type="text" id="Counter" name="%s[Counter]"  value="%s" />', 
			ADS_OPTIONS_GENERAL, 
			isset( $this->mGeneral['Counter'] ) ? esc_attr( $this->mGeneral['Counter']) : '0');
		global $wpdb;
		$table_name = $wpdb->prefix.ADS_PAGEFILE;
		$count = $wpdb->get_var("SELECT Count FROM $table_name where IP='0'");
		printf(" ".__('( actual count: %s )', ADS_TEXT_DOMAIN), $count);
	}

	public function callback_reset()
	{ 
		printf('<input type="checkbox" id="Reset" name="%s[Reset]" value="on" />', 
			ADS_OPTIONS_GENERAL);
		printf(" ".__('( Last Reset on: %s )', 
			ADS_TEXT_DOMAIN), 
			date('Y.m.d H:i:s', $this->mGeneral['LastReset']));
		print '<br>'.__('The counter is reset when saving with the above default counter value', 
			ADS_TEXT_DOMAIN);
	}

	public function callback_Cycletime() {
		$t = absint( $this->mGeneral['CycleTime'] );
		$h = absint($t / 3600);
		$m = absint(($t - ($h*3600)) / 60);
		$s = absint(($t - ($h*3600) - ($m*60)));
		
    printf('<input maxlength="2" size="2" type="text" id="CycleHou" name="%s[CycleHou]" value="%s" />:', 
			ADS_OPTIONS_GENERAL, $h);
		printf('<input maxlength="2" size="2" type="text" id="CycleMin" name="%s[CycleMin]" value="%s" />:',
			ADS_OPTIONS_GENERAL, $m);
        printf('<input maxlength="2" size="2" type="text" id="CycleSec" name="%s[CycleSec]" value="%s" /> '.__('( Time, H:M:S )', ADS_TEXT_DOMAIN),
			ADS_OPTIONS_GENERAL, $s);
		printf("<br>".__('supports 30 sec. to 24 hours on ip cycle', ADS_TEXT_DOMAIN));
	}

	public function callback_Pagetime() {
		$t = absint( $this->mGeneral['PageTime'] );
		$m = absint($t / 60);
		$s = absint($t % 60);

		printf('<input type="hidden" id="PageOn" name="%s[PageOn]" value="" />', ADS_OPTIONS_GENERAL );
		printf('<input type="checkbox" id="PageOn" name="%s[PageOn]" value="on" %s/>%s<br>', 
			ADS_OPTIONS_GENERAL, $this->mGeneral['PageOn'] == 'on' ? 'checked' : '', __('Statistic ON',ADS_TEXT_DOMAIN));
		printf('<input maxlength="2" size="2" type="text" id="PageMin" name="%s[PageMin]" value="%s" />:', ADS_OPTIONS_GENERAL, $m);
        printf('<input maxlength="2" size="2" type="text" id="PageSec" name="%s[PageSec]" value="%s" /> '.__('( Time, M:S )', ADS_TEXT_DOMAIN),
			ADS_OPTIONS_GENERAL, $s);
		printf('<br>'. __('supports 30 sec. to 1 Hour on page cycle', ADS_TEXT_DOMAIN));
	}

	public function callback_Deletetime() {
		$t = absint( $this->mGeneral['DeleteTime'] );
		$m = absint($t / (30*24*3600));
		$d = absint(($t - ($m*30*24*3600)) / (24*3600) );

		printf('<input maxlength="2" size="2" type="text" id="DeleteMon" name="%s[DeleteMon]" value="%s" />:', 
			ADS_OPTIONS_GENERAL, $m);
		printf('<input maxlength="2" size="2" type="text" id="DeleteDay" name="%s[DeleteDay]" value="%s" /> '.__('( Month / Day )',ADS_TEXT_DOMAIN), 
			ADS_OPTIONS_GENERAL, $d);
		printf('<br>'. __('supports 6 day to 9 months to start cleanup', ADS_TEXT_DOMAIN));
	}

	public function callback_Cleanup() {
		$t = absint( $this->mGeneral['CleanupTime'] );
		$m = absint($t / (30*24*3600));
		$d = absint(($t - ($m*30*24*3600)) / (24*3600) );
		
		printf('<input maxlength="2" size="2" type="text" id="CleanupM" name="%s[CleanupM]" value="%s" />:', 
			ADS_OPTIONS_GENERAL, $m);
		printf('<input maxlength="2" size="2" type="text" id="CleanupD" name="%s[CleanupD]" value="%s" /> '.__('( Month / Day )',ADS_TEXT_DOMAIN), 
			ADS_OPTIONS_GENERAL, $d);
		printf('&nbsp&nbsp<input type="checkbox" id="CleanupNow" name="%s[CleanupNow]" value="on" /> '.__('cleanup !now! ( next at %s )', ADS_TEXT_DOMAIN), 
			ADS_OPTIONS_GENERAL, date_i18n( get_option( 'date_format' ), $this->mGeneral['Cleanup'])); 
		printf('<br>'. __('supports 1 day to 6 months on cleanup', ADS_TEXT_DOMAIN));
		printf('<br>'. __('cleanup time should be less than IP age', ADS_TEXT_DOMAIN));
	}
	

}

if( is_admin() ) 
    $ads_SettingsPage = new adswsc_clsSettingsPage();
?>