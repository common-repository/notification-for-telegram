<?php
//17
if ( ! defined( 'ABSPATH' ) ) exit;



add_filter( 'cron_schedules', 'nftb_add_cron_interval' );
function nftb_add_cron_interval( $schedules ) { 

 if(!isset($schedules['telegram_sec'])){
	$schedules['telegram_sec'] = array(
        'interval' => 60,
        'display'  => esc_html__( 'Telegram sec' ), );
    }    

if(!isset($schedules['telegram_hour'])){
    $schedules['telegram_hour'] = array(
        'interval' => 3600,
        'display'  => esc_html__( 'Telegram Every hour' ), );
       }    
  if(!isset($schedules['telegram_day'])){
         $schedules['telegram_day'] = array(
        'interval' => 3600*24,
        'display'  => esc_html__( 'Telegram Every day' ), );
        
         }    
 if(!isset($schedules['telegram_week'])){
    	 $schedules['telegram_week'] = array(
        'interval' => 3600*24*7,
        'display'  => esc_html__( 'Telegram Every week' ), );
         }
         
       if(!isset($schedules['telegram_month'])){   
        $schedules['telegram_month'] = array(
        'interval' => 3600*24*7*4,
        'display'  => esc_html__( 'Telegram Every month' ), );
         }    

    return $schedules;
}


//prendo $post freschi
	



add_action( 'init', 'nftb_process_post' );
 

 
//solo se update da plug 
function nftb_process_post() {

$checksubmit = isset($_POST['telegram_notify_option_name']) ? $_POST['telegram_notify_option_name'] : null;


if( ($checksubmit)) { 

$checksubmit = $_POST['telegram_notify_option_name'];

if (isset($checksubmit['notify_update'])) {
    $notify_update2 = $checksubmit['notify_update']; // Active service
} else {
    $notify_update2 = 0;
}

if (isset($checksubmit['notify_update_time'])) {
    $notify_update_time2 = $checksubmit['notify_update_time'];
} else {
    // Handle the case when 'notify_update_time' is not set
    $notify_update_time2 = 1;
}
	
	
	$intervallo2 = 'telegram_sec';
  $schedulchecked = isset($_POST['telegram_notify_option_name']['notify_update']) ? $_POST['telegram_notify_option_name']['notify_update'] : null;
  $intervallo = isset($_POST['telegram_notify_option_name']['notify_update_time']) ? $_POST['telegram_notify_option_name']['notify_update_time'] : null;
     
} 
     
   
      
		
	
		
}


add_action( 'nftb_cron_hook', 'nftb_send_requestupdate' );		


//Fuction clean
add_action( 'wp_ajax_nftb_cron_action', 'nftb_cron_action' );
function nftb_cron_action() {
	
	  $telegram_notify_options = get_option( 'telegram_notify_option_name' ); // Array of All Options
$notify_update= $telegram_notify_options['notify_update']; // Active service
	$notify_update_time = $telegram_notify_options['notify_update_time']; // Token
	
	$intervallo = isset($_POST['intervallo']) ? $_POST['intervallo'] : null;

//nftb_send_requestupdate2($intervallo);

  $bloginfo = get_bloginfo( 'name' );
		
		// nftb_send_requestupdate2("NAJ".$_POST['telegram_notify_option_name']['notify_update']);
       
		// se dececcato leva tutto
		$timestamp = wp_next_scheduled( 'nftb_cron_hook' );
		wp_unschedule_event( $timestamp, 'nftb_cron_hook' );
		wp_clear_scheduled_hook('nftb_cron_hook');
		nftb_send_requestupdate2($bloginfo.":Cleaned All Cron");
				
			wp_die();	
		//return "OK";

	
}

//Fuction add time
add_action( 'wp_ajax_nftb_cron_action_set', 'nftb_cron_action_set' );
function nftb_cron_action_set() {
	

	$intervallo = isset($_POST['intervallo']) ? $_POST['intervallo'] : null;

//nftb_send_requestupdate2($intervallo);


	     switch ($intervallo) {
    case 1:
        $intervallo2 = 'telegram_sec';
        $messageback = 'Every Minute';
        break;
    case 2:
        $intervallo2 = 'telegram_hour';
          $messageback = 'Every Hour';
        break;
    case 3:
        $intervallo2 = 'telegram_day';
          $messageback = 'Every Day';
        break;
    case 4:
        $intervallo2 = 'telegram_week';
         $messageback = 'Every Week';
    
        break;
        
    case 5:
        $intervallo2 = 'telegram_month';
        $messageback = 'Every Month';
        break;        
}
     
     

//controlla se Update

     
        
        
        
        
        if ( !wp_next_scheduled( 'nftb_cron_hook' )  ) {
					//wp_clear_scheduled_hook('nftb_cron_hook');
      			 	wp_schedule_event( time(), $intervallo2, 'nftb_cron_hook' );
      	//		 	nftb_send_requestupdate2("check boxo enable nessun evento lo piazzo ");
			} else {
			
					//wp_clear_scheduled_hook('nftb_cron_hook');
					$timestamp = wp_next_scheduled( 'nftb_cron_hook' );
					wp_unschedule_event( $timestamp, 'nftb_cron_hook' );
					wp_schedule_event( time(), $intervallo2, 'nftb_cron_hook' );
  		//		 nftb_send_requestupdate2("check box enable gia un evento updat ");
			} 
        
      
      
      $next = nftb_next_cron_time("nftb_cron_hook");
    $bloginfo = get_bloginfo( 'name' );
		
    
		nftb_send_requestupdate2($bloginfo.": Created a new Cronjob ".$messageback);
				
				
		echo $next;
wp_die();
	
}


/**
 * Returns the time in seconds until a specified cron job is scheduled.
 *
 *@param string $cron_name The name of the cron job
 *@return int|bool The time in seconds until the cron job is scheduled. False if
 *it could not be found.
*/

//timetsmap to days 
function nftb_next_cron_time( $cron_name ){
	foreach( _get_cron_array() as $timestamp => $crons ){

        if( in_array( $cron_name, array_keys( $crons ) ) ){
            $xx =  $timestamp - time();
            
			 if (gmdate('d', $xx) > 1)   {

				$message =  " Next: ".(gmdate('d', $xx)). " Days";
 	}   else  {

				$message = " Next: ".gmdate('H:i:s', $xx ). "";
 	}


           return  $message ;
        }

    }

    return " No schedule";
}


    function nftb_plugupdate_check() {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        if (!function_exists('get_site_transient')) {
            require_once ABSPATH . 'wp-admin/includes/option.php';
        }
        $updates = get_site_transient('update_plugins');
        $plugins = get_plugins();
        $the_list = array();
        $i = 1;
        $f = 0;
        if ($updates->response) {
            $the_list["ultima_revision"] = date("Y-m-d g:i A", intval($updates->last_checked));
            foreach ($plugins as $name => $plugin) {
                $the_list["plugins"][$i]["id"] = $name;
                $the_list["plugins"][$i]["name"] = $plugin["Name"];
                $the_list["plugins"][$i]["current_version"] = $plugin["Version"];
               
               
                
                if (isset($updates->response[$name])) {
                    $the_list["plugins"][$i]["update"] = "yes";
                    
                    
                    
                     $active_plugins = get_option( 'active_plugins' );
                   
                   $plugins[ $name ]['Active'] = $is_active;
                   
                   
                 //  if (($the_list["plugins"][$i]["active"])) { $ddd = $ddd."oookkk"; }
                    
                    
                    
                    
                   $ddd = $ddd. $the_list["plugins"][$i]["name"].", ".$the_list["plugins"][$i]["active"];
                   $f++;
                    $the_list["plugins"][$i]["version"] = $updates->response[$name]->new_version;
                } else {
                    $the_list["plugins"][$i]["update"] = "no";
                }
                $i++;
            }
        }
        return $f." Plugs need to be updated:  ".$ddd;
    }


    function nftb_core_check() {      
    global $wp_version;
			 require_once ABSPATH . '/wp-admin/includes/update.php';
			 $cur_wp_version = preg_replace('/-.*$/', '', $wp_version);
			$core_updates = (array) get_core_updates();
		if (!isset($core_updates[0]->response) || 'latest' == $core_updates[0]->response || 'development' == $core_updates[0]->response || version_compare($core_updates[0]->current,  $cur_wp_version , '=')) {
         return "NO CORE UPDATE AVAILABLE ".$core_updates[0]->current;
     } else {
         return  "CORE UPDATE AVAILABLE ". $core_updates[0]->current;
     }
			
    // echo $cores[current];
}




 


//deactivate cron quand disattivi plug
register_deactivation_hook( __FILE__, 'nftb_deactivate' ); 
function nftb_deactivate() {
   $timestamp = wp_next_scheduled( 'nftb_cron_hook' );
	wp_unschedule_event( $timestamp, 'nftb_cron_hook' );

}


function nftb_send_requestupdate() {

	
	$TelegramNotify = new nftb_TelegramNotify();
	$notify_update =  $TelegramNotify->getValuefromconfig('notify_update'); 

 	if (  $notify_update) {


		 $bloginfo = get_bloginfo( 'name' );
 		nftb_send_teleg_message("".$bloginfo. " : ".nftb_plugupdate_check()." /  ". nftb_core_check() );
 	}   
}


?>
