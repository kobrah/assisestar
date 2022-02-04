<?php
/*
 display widget on dashboard to show a small statistic
 Date : 2015/10/23
 Date : 2016/02/09
 Author: ad-software, André
*/
defined('ABSPATH') OR exit;
if ( ! WP_DEBUG ) error_reporting(0);

if (!defined('ADS_DASHBOARD')) 		define('ADS_DASHBOARD', 'ads-dashboardwidget');

// Class
class adswsc_clsDashboardWidgets {

	//Constructor
    function __construct() {
        add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widgets' ) );
    }
 
	// Remove
	function remove_dashboard_widgets() {
		remove_meta_box( ADS_DASHBOARD, 'home', 'side' );
	}	

	// Add
    function add_dashboard_widgets() {
		wp_add_dashboard_widget( ADS_DASHBOARD,
			__('ADS-WpSiteCount - Small statistic',ADS_TEXT_DOMAIN),
			array($this,'content_dashboard_widget' ));
	}	

	// Remove
    function content_dashboard_widget() {
		global $wpdb;
		$pageRows = 5;
		$period = 0;
		$searchDate = "";

		$table_name = $wpdb->prefix.ADS_PAGEFILE;
		$general = adswsc_GetOptions( ADS_OPTIONS_GENERAL );
		
		if (isset($_POST['rows']))  
			$pageRows = (absint($_POST['rows']));
		if (isset($_POST['period']))  
			$period = (absint($_POST['period']));
		switch ($period) {
			case "1": $searchDate = " and time >= ".(current_time('timestamp') - (60*60*24)); break;
			case "2": $searchDate = " and time >= ".(current_time('timestamp') - (60*60*24*7)); break;
			case "3": $searchDate = " and time >= ".(current_time('timestamp') - (60*60*24*7*31)); break;
			default: $searchDate = ""; break;
		}
		
		if (isset($_POST['button_clean']))  {
			$results = $wpdb->get_results("SELECT PageID FROM $table_name WHERE IP != '0' and PageID != 0 GROUP BY PageID");
			foreach($results as $result) {
				$link = get_permalink( $result->PageID, false ); 
				$title = get_the_title( $result->PageID );
				if ((empty($link) && empty($title)))
					$wpdb->query("DELETE FROM $table_name WHERE IP != '0' and PageID=$result->PageID");
			}
			if (isset($_POST['clean_yes']) == true)
				$wpdb->query("DELETE FROM $table_name WHERE IP != '0' and PageID != 0");
		}
		$x =  $wpdb->get_results( "SELECT PageID FROM $table_name ".
															" WHERE IP !='0' and PageID != 0 ".$searchDate.
															" GROUP BY PageID");
		$pageMaxx = sizeof($x);
		$pageMax = absint($pageMaxx / $pageRows) + ( ($pageMaxx % $pageRows) > 0 ? 1 : 0);
		$pageStart = 0;
		if (isset($_POST['page']))  
			$pageStart = (absint($_POST['page'])-1);
		if (isset($_POST['button_next']))
			$pageStart += $pageStart < ($pageMax-1) ? 1 : 0;
		if (isset($_POST['button_prev']))
			$pageStart -= $pageStart > 0 ? 1 : 0;
		if (isset($_POST['button_top']))
			$pageStart = 0;
		if (isset($_POST['button_last']))
			$pageStart = $pageMax-1;

		echo "<p>".__('The table shows the number of calls for each page.', ADS_TEXT_DOMAIN).' ';
		echo __('Not referring page addresses will not be displayed.' , ADS_TEXT_DOMAIN)."</p>"; 
		$results = $wpdb->get_results("SELECT PageID,IP,Time,sum(Count) as Total FROM $table_name".
									  " WHERE PageID > 0 ".$searchDate.
									  " GROUP BY PageID ORDER BY Total Desc, Time Asc".
									  " LIMIT ".($pageStart * $pageRows).", ".$pageRows);
									  
		echo '<form class="update" method="post" action="#" enctype="multipart/form-data">';
		echo '<input style="width:30px;" class="button" type="submit" name="button_top" value="«">';
		echo '<input style="width:30px;" class="button" type="submit" name="button_prev" value="‹">';
		echo '&nbsp;<select class="actions bulkactions" name="page" onchange="this.form.submit()">';
		for ($x=1; $x <= $pageMax; $x++) {	
			echo '<option value="'.$x.'" '.($pageStart == ($x-1) ? "selected" : "" ).' >'.__('Page', ADS_TEXT_DOMAIN).' '.$x.'</option>';
		}
		echo '</select>&nbsp'.__('from', ADS_TEXT_DOMAIN).'&nbsp;'.$pageMax.'&nbsp;';
		echo '<input style="width:30px;" class="button" type="submit" name="button_next" value="›">';
		echo '<input style="width:30px;" class="button" type="submit" name="button_last" value="»">';
		echo '&nbsp;&nbsp; '.__('rows', ADS_TEXT_DOMAIN);
		echo '&nbsp;<select class="actions bulkactions" name="rows" onchange="this.form.submit()">';
		echo '<option value="5" '.($pageRows == 5 ? "selected" : "").'>5</option>';
		echo '<option value="10" '.($pageRows == 10 ? "selected" : "").'>10</option>';
		echo '<option value="20" '.($pageRows == 20 ? "selected" : "").'>20</option>';
		echo '<option value="50" '.($pageRows == 50 ? "selected" : "").'>50</option>';
		echo '</select> ';		
		echo '&nbsp;&nbsp; '.__('Period', ADS_TEXT_DOMAIN);
		echo '&nbsp;<select  class="actions bulkactions" name="period" onchange="this.form.submit()">';
		echo '<option value="0" '.($period == 0 ? "selected" : "").'>'.__('All', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="1" '.($period == 1 ? "selected" : "").'>'.__('Today', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="2" '.($period == 2 ? "selected" : "").'>'.__('Week', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="3" '.($period == 3 ? "selected" : "").'>'.__('Month', ADS_TEXT_DOMAIN).'</option>';
		echo '</select></form>';
		echo '<table class="widefat"><thead><tr>';
		echo '<th width="1%" align="center" class="manage-column"><strong>'.__('Count', ADS_TEXT_DOMAIN).'</strong></th>';
		echo '<th class="manage-column"><strong>'.__('page', ADS_TEXT_DOMAIN).'</strong></th>';
		echo '</tr></thead><tbody class="plugins">';
		if ($results) {
			$i=0;
			foreach($results as $result) { 
				$i++;
				if (($i % 2) == 1)
					echo '<tr style="background:#f5f5f5">';
				else
					echo '<tr>';
				echo '<td align="center">'.$result->Total.'</td>';
				$link  = get_permalink( $result->PageID, false ); 
				$title = get_the_title($result->PageID);
				if (empty($title) || empty($link) ) 
					echo "<td>-deleted- id:$result->PageID.</td>";
				else 
					echo "<td><a target='_blank' href='$link'>$title</a></td>";
				echo '</tr>';
			}	
		} else 
			echo '<tr><td>-</td><td><b>'.__('no data found', ADS_TEXT_DOMAIN).'</b></td></tr>';
		echo '</tbody></table>';
		if ( $pageRows > 10 ) {
			echo '<form class="update" method="post" action="#" enctype="multipart/form-data">';
			echo '<input style="width:30px;" class="button" type="submit" name="button_top" value="«">';
			echo '<input style="width:30px;" class="button" type="submit" name="button_prev" value="‹">';
			echo '&nbsp;<select class="actions bulkactions" name="page" onchange="this.form.submit()">';
			for ($x=1; $x <= $pageMax; $x++) {	
					echo '<option size="100px" value="'.$x.'" '.($pageStart == ($x-1) ? "selected" : "" ).' >'.__('Page', ADS_TEXT_DOMAIN).' '.$x.'</option>';
			}
			echo '</select>  '.__('from', ADS_TEXT_DOMAIN).'&nbsp;'.$pageMax.'&nbsp;';
			echo '<input style="width:30px;" class="button" type="submit" name="button_next" value="›">';
			echo '<input style="width:30px;" class="button" type="submit" name="button_last" value="»">';
		echo '<select style="display:none" class="actions bulkactions" name="rows" onchange="this.form.submit()">';
		echo '<option value="5" '.($pageRows == 5 ? "selected" : "").'>5</option>';
		echo '<option value="10" '.($pageRows == 10 ? "selected" : "").'>10</option>';
		echo '<option value="20" '.($pageRows == 20 ? "selected" : "").'>20</option>';
		echo '<option value="50" '.($pageRows == 50 ? "selected" : "").'>50</option>';
		echo '</select> ';		
		echo '<select style="display:none;" class="actions bulkactions" name="period" onchange="this.form.submit()">';
		echo '<option value="0" '.($period == 0 ? "selected" : "").'>'.__('All', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="1" '.($period == 1 ? "selected" : "").'>'.__('Today', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="2" '.($period == 2 ? "selected" : "").'>'.__('Week', ADS_TEXT_DOMAIN).'</option>';
		echo '<option value="3" '.($period == 3 ? "selected" : "").'>'.__('Month', ADS_TEXT_DOMAIN).'</option>';
		echo '</select></form>';
		}
		echo '<form class="update" method="post" action="#" enctype="multipart/form-data">';
		echo '<p class="submit">'.__('delete rows',ADS_TEXT_DOMAIN).' ('.$pageMaxx.') <input class="checkbox" type="checkbox" name="clean_yes">';
		echo '&nbsp;<input class="button" type="submit" name="button_clean" value="'.__('GO', ADS_TEXT_DOMAIN).'">';
		echo '</p></form>';
		}
}

$adswsc_DashboardWidget = new adswsc_clsDashboardWidgets();
?>
