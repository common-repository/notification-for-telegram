<?php

 


class nftb_TelegramNotify {
	//private $telegram_notify_options;
	public $telegram_notify_option; 

	public function getValuefromconfig($field) {
		$prefname = "";	
		
		
	//TAB1
	if ($field == "token_0" || $field == "chatids_" || $field == "notify_donot_strip_tags" ) {
		$prefname = "telegram_notify_option_name";
		}

	//TAB2
	if ($field == "POST" || $field == "notify_newpost" || $field == "FORMS"|| $field == "notify_cf7"|| $field == "notify_ninjaform"|| $field == "notify_wpform" || $field == "notify_ele_form" || $field == "LOGIN" || $field == "notify_newuser"   || $field == "notify_login_success" || $field == "notify_login_fail" || $field == "notify_login_fail_showpass" || $field == "notify_login_fail_goodto"  || $field == "MAILCHIMP" || $field == "notify_mailchimp_sub" || $field == "notify_mailchimp_sub" || $field == "notify_mailchimp_unsub" || $field == "notify_new_comments" || $field == "notify_new_comments_filter_spam" ) {
		$prefname = "telegram_notify_option_name_tab2";
	}	

	
	//TAB3
	if ($field == "ORDERS" || $field == "notify_woocomerce_order" || $field == "order_trigger" || $field == "price_with_tax" || $field == "hide_bill"|| $field == "hide_ship" || $field == "hide_phone" || $field == "WOO PREFERENCES"  || $field == "notify_woocomerce_checkoutfield" || $field == "notify_woocomerce_checkoutext" || $field == "notify_woocomerce_order_change"  || $field == "notify_woocomerce_addtocart_item" || $field == "notify_woocomerce_remove_cart_item" ) {
		$prefname = "telegram_notify_option_name_tab3"; }

	
	//TAB4
	if ($field == "notify_update" || $field == "notify_update_time" || $field == "buttoncron" ) {
		$prefname = "telegram_notify_option_name_tab4";
		}		

			//TAB5
	if ($field == "notify_update" || $field == "notify_update_time" || $field == "buttoncron" ) {
		$prefname = "telegram_notify_option_name_tab5";
		}	

	$this->telegram_notify_option = get_option( $prefname );

	if (!isset($this->telegram_notify_option[$field])) {return  ""; }

	$firstFive = $this->telegram_notify_option[$field];
	//echo "AAAA->".$field." - " .$firstFive."<br>";
	return $firstFive;
}



	public function getValuefromconfig2($field) {
	
	
		
    $this->telegram_notify_option = get_option( 'telegram_notify_option_name' );
   
	$firstFive = array();
	$firstFive = $this->telegram_notify_option[$field];
	
        

	
	
	

            
		if ( !isset( $firstFive )) {
            $this->telegram_notify_option = get_option( 'telegram_notify_option_name' );
                 $firstFive = $this->telegram_notify_option[$field];
				 
            } 
            if (!isset( $firstFive )) {
            $this->telegram_notify_option = get_option( 'telegram_notify_option_name_tab2' );
                 $firstFive = $this->telegram_notify_option[$field];
            } 
             if ( !isset( $firstFive )) {
            $this->telegram_notify_option = get_option( 'telegram_notify_option_name_tab3' );
                 $firstFive = $this->telegram_notify_option[$field];
            } 
            if ( !isset( $firstFive )){
            $this->telegram_notify_option = get_option( 'telegram_notify_option_name_tab4' );
                 $firstFive = $this->telegram_notify_option[$field];
            } 
			
   
        
        
        return $firstFive;
		
	
       
    }

	
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'telegram_notify_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'telegram_notify_page_init' ) );
		//add_action( 'admin_init', array( $this, 'telegram_notify_page_init_tab2' ) );
		
		
		
		
	} 
	
	public function telegram_notify_add_plugin_page() {
		add_menu_page(
			'Telegram Notify', // page_title 
			'Telegram Notify', // menu_title
			'manage_options', // capability
			'telegram-notify', // menu_slug
			array( $this, 'telegram_notify_create_admin_page_tabbed' ), // function
			'dashicons-format-chat', // icon_url
			76 // position
		);
	}
	
	
	
	
	
	
	
		public function telegram_notify_create_admin_page_tabbed() {
		$this->telegram_notify_options = get_option( 'telegram_notify_option_name' ); 
		$this->telegram_notify_options_tab2 = get_option( 'telegram_notify_option_name_tab2' ); 
		$this->telegram_notify_options_tab3 = get_option( 'telegram_notify_option_name_tab3' ); 
		$this->telegram_notify_options_tab4 = get_option( 'telegram_notify_option_name_tab4' ); 
		
		$paypal= __( 'If you like this free plug-in support the developer !!', 'notification-for-telegram' ).'<br><br><form action="https://www.paypal.com/donate" method="post" target="_top">
			<input type="hidden" name="hosted_button_id" value="3ESRFDJUY732E" />
			<input type="image" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
			<img alt="" border="0" src="https://www.paypal.com/en_IT/i/scr/pixel.gif" width="1" height="1" />
			</form>';

	
		?> 

		<div class="wrap telegram_notify_div">
			<h2>Telegram  Notify</h2>
			<?php echo '<div  style="text-align:center;" ><p>';  

        printf(__('<div class="respo"><img class="bannerfoto" src="'.plugin_dir_url( dirname( __FILE__ ) ) . '../notification-for-telegram/assets/banner-772x250.jpg'.'" ></div>
        <div class="respo"><h3><a href="https://it.wordpress.org/plugins/notification-for-telegram/#reviews" target="_blank">'.__( 'Please remember to RATE Notification for Telegram!!' , 'notification-for-telegram' ).'</a></h3>'.$paypal.'</div>
'), '');
          
        echo  "</p></div>"; ?>
			<?php settings_errors(); 
			
			//echo nftb_plugupdate_check();
			//echo nftb_core_check(); 
			
			//echo $this->getValuefromconfig('order_trigger')."jjj";
			// $current_screen = get_current_screen();
			//echo  $current_screen->base;
			//var_dump($a1 );
			//echo "kkd".nftb_NotifyA()
			
	
			//$hello2 = __( 'weeda' , 'notification-for-telegram' );
			
			//echo $hello2;
			
			?>
			
			<?php
            if ( isset( $_GET['tab']) ) {
                $active_tab = $_GET['tab'];
            } else {
                $active_tab = 'telegram_settings';
            } 
            ?>
			
			
            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo $_GET['page']; ?>&tab=telegram_settings" class="nav-tab <?php echo $active_tab == 'telegram_settings' ? 'nav-tab-active' : ''; ?>">Telegram Config</a>
                <a href="?page=<?php echo $_GET['page']; ?>&tab=post_settings" class="nav-tab <?php echo $active_tab == 'post_settings' ? 'nav-tab-active' : ''; ?>">Post / Forms / Users</a>
                 <a href="?page=<?php echo $_GET['page']; ?>&tab=woocommerce" class="nav-tab <?php echo $active_tab == 'woocommerce' ? 'nav-tab-active' : ''; ?>">Woocomerce</a>
                  <a href="?page=<?php echo $_GET['page']; ?>&tab=security" class="nav-tab <?php echo $active_tab == 'security' ? 'nav-tab-active' : ''; ?>">Security</a>
            </h2>

			<form method="post" action="options.php">
				
				<?php
            if ( $active_tab == 'telegram_settings' ) {
                // settings options group name passed
                settings_fields( 'telegram_notify_option_group_tab1' );
                // settings options name passed
                do_settings_sections( 'telegram-notify-admin_tab1' );
                submit_button(); 
            } elseif ( $active_tab == 'post_settings' ) {
                // settings options group name passed
                settings_fields( 'telegram_notify_option_group_tab2' );
                // settings options name passed
                do_settings_sections( 'telegram-notify-admin_tab2' );
                submit_button(); 
            } elseif ( $active_tab == 'woocommerce' ) {
                // settings options group name passed
                settings_fields( 'telegram_notify_option_group_tab3' );
                // settings options name passed
                do_settings_sections( 'telegram-notify-admin_tab3' );
                submit_button(); 
            } elseif ( $active_tab == 'security' ) {
                // settings options group name passed
                settings_fields( 'telegram_notify_option_group_tab4' );
                // settings options name passed
                do_settings_sections( 'telegram-notify-admin_tab4' );
                submit_button(); 
            }
            
            ?>
				
			
				
				
			
			</form>
		</div>
	<?php }
	
	
	





	public function telegram_notify_page_init() {
		
		
		//TAB1
		register_setting(
			'telegram_notify_option_group_tab1', // option_group
			'telegram_notify_option_name', // option_name
			array( $this, 'telegram_notify_sanitize' ) // sanitize_callback
		);
		
		
		

		add_settings_section(
			'telegram_notify_setting_section_tab1', // id
			'Telegram Bot Settings ', // title
			array( $this, 'telegram_notify_section_info' ), // callback
			'telegram-notify-admin_tab1' // page
		);
		
		

		add_settings_field(
			'token_0', // id
			'Token', // title
			array( $this, 'token_0_callback' ), // callback
			'telegram-notify-admin_tab1', // page
			'telegram_notify_setting_section_tab1' // section
		);

		add_settings_field(
			'chatids_', // id
			'Chatids', // title
			array( $this, 'chatids__callback' ), // callback
			'telegram-notify-admin_tab1', // page
			'telegram_notify_setting_section_tab1' // section
		);


		add_settings_field(
			'saysomething', // id 
			__(  'Say Something to the people' , 'notification-for-telegram' ), // title
			array( $this, 'saysomething_callback' ), // callback
			'telegram-notify-admin_tab1', // page
			'telegram_notify_setting_section_tab1' // section
		);



		add_settings_field(
			'testbutton', // id
			__(  'Test if Token and Chatis works' , 'notification-for-telegram' ), // title
			array( $this, 'testbutton_callback' ), // callback
			'telegram-notify-admin_tab1', // page
			'telegram_notify_setting_section_tab1' // section
		);

		add_settings_field(
			'notify_donot_strip_tags', // id
			__(  'Strip Html Tags in all notification messages' , 'notification-for-telegram' ), // title
			array( $this, 'notify_donot_strip_tags_callback' ), // callback
			'telegram-notify-admin_tab1', // page
			'telegram_notify_setting_section_tab1' // section
		);


		//add_settings_field(
		//	'sleep_time_between_message_2', // id
	//		'Sleep time in sec between msgs', // title
	//		array( $this, 'sleep_time_between_message_2_callback' ), // callback
	//		'telegram-notify-admin', // page
	//		'telegram_notify_setting_section' // section
	//	);

		//TAB2
		register_setting(
			'telegram_notify_option_group_tab2', // option_group
			'telegram_notify_option_name_tab2', // option_name
			array( $this, 'telegram_notify_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'telegram_notify_setting_section_tab2', // id
			'Post / Form / User / notification settings', // title
			array( $this, 'telegram_notify_section_info_tab2' ), // callback
			'telegram-notify-admin_tab2' // page
		);
		

	add_settings_field(
			'POST', // id
			'POST', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);



	

		add_settings_field(
			'notify_newpost', // id
			__(  'Notify New Post' , 'notification-for-telegram' ), // title
			array( $this, 'notify_newpost_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);

		add_settings_field(
			'FORMS', // id
			'FORMS', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);


		add_settings_field(
			'notify_cf7', // id
			__(  'Notify Contact Form 7' , 'notification-for-telegram' ), // title
			array( $this, 'notify_cf7_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		
		add_settings_field(
			'notify_ninjaform', // id
			__(  'Notify Ninja Form' , 'notification-for-telegram' ), // title
			array( $this, 'notify_ninjaform_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		add_settings_field(
			'notify_wpform', // id
			__(  'Notify WpForm' , 'notification-for-telegram' ), // title
			array( $this, 'notify_wpform_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);

		add_settings_field(
			'notify_ele_form', // id
			__(  'Notify Elementor' , 'notification-for-telegram' ), // title
			array( $this, 'notify_ele_form_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
	add_settings_field(
			'LOGIN', // id
			'LOGIN', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		
		add_settings_field(
			'notify_newuser', // id
			__(  'User Registration' , 'notification-for-telegram' ), // title
			array( $this, 'notify_newuser_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);



		


		add_settings_field(
			'notify_login_fail', // id
			__( 'User Login Fail' , 'notification-for-telegram' ), // title
			array( $this, 'notify_login_fail_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);

		add_settings_field(
			'notify_login_success', // id
			__( 'User Login Succes' , 'notification-for-telegram' ), // title
			array( $this, 'notify_login_success_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		/*
		add_settings_field(
			'notify_login_fail_showpass', // id
			__( 'Show clear login password in message ("User Login Fail" or "User Login Succes" must be active)', 'notification-for-telegram' ), // title
			array( $this, 'notify_login_fail_showpass_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		*/

		add_settings_field(
			'notify_new_comments', // id
			__( 'Comments' , 'notification-for-telegram' ), // title
			array( $this, 'notify_new_comments_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);

		add_settings_field(
			'notify_new_comments_filter_spam', // id
			__( 'Remove Spam Comment' , 'notification-for-telegram' ), // title
			array( $this, 'notify_new_comments_filter_spam_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		/*
		add_settings_field(
			'notify_login_fail_goodto', // id
			__(  'Send a notification also for succes login (User Login Fail must be active)' , 'notification-for-telegram' ), // title
			array( $this, 'notify_login_fail_goodto_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		*/
	
	
		add_settings_field(
			'MAILCHIMP', // id
			'MAILCHIMPS', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
	
		
		add_settings_field(
			'notify_mailchimp_sub', // id
			__(  'Send a notification when new user sunscribes to mailchimp' , 'notification-for-telegram' ), // title
			array( $this, 'notify_mailchimp_sub_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		add_settings_field(
			'notify_mailchimp_unsub', // id
			__(  'Send a notification when new user Unsubscribes from mailchimp' , 'notification-for-telegram' ), // title
			array( $this, 'notify_mailchimp_unsub_callback' ), // callback
			'telegram-notify-admin_tab2', // page
			'telegram_notify_setting_section_tab2' // section
		);
		
		
	//TAB3 WOOOCOMETCE
	
	add_settings_field(
			'ORDERS', // id
			'ORDERS', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
	
		register_setting(
			'telegram_notify_option_group_tab3', // option_group
			'telegram_notify_option_name_tab3', // option_name
			array( $this, 'telegram_notify_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'telegram_notify_setting_section_tab3', // id
			'Woocommerce Notification Settings', // title
			array( $this, 'telegram_notify_section_info_tab3' ), // callback
			'telegram-notify-admin_tab3' // page
		);
		
	
	/*	
	add_settings_field(
			'woocomerce_chatids', // id
			__(  'Special CHATID only for woocomerce notification' , 'notification-for-telegram' ), // title
			array( $this, 'woocomerce_chatids_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		); c */
			

		add_settings_field(
			'notify_woocomerce_order', // id
			__(  'Woocommerce orders' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_order_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);

		
		
		add_settings_field(
			'order_trigger', // id
			__( 'Order message trigger ' , 'notification-for-telegram' ), // title
			array( $this, 'order_trigger_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		
		add_settings_field(
			'price_with_tax', // id
			__( 'Show prices including tax ' , 'notification-for-telegram' ), // title
			array( $this, 'price_with_tax_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		add_settings_field(
			'hide_bill', // id
			__( 'Billing info' , 'notification-for-telegram' ), // title
			array( $this, 'hide_bill_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		add_settings_field(
			'hide_ship', // id
			__( 'Shipping info' , 'notification-for-telegram' ), // title
			array( $this, 'hide_ship_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		add_settings_field(
			'hide_phone', // id
			__( 'Phone Number' , 'notification-for-telegram' ), // title
			array( $this, 'hide_phone_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		
			add_settings_field(
			'WOO PREFERENCES', // id
			'WOO PREFERENCES', // title
			array( $this, 'opendiv' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
				add_settings_field(
			'notify_woocomerce_checkoutfield', // id
			__(  'Customers Telegram' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_checkoutfield_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
			add_settings_field(
			'notify_woocomerce_checkoutext', // id
			__(  'Info text in checkout page' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_checkoutext_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
			
		
		add_settings_field(
			'notify_woocomerce_order_change', // id
			__(  'Woocommerce orders change status' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_order_change_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);


		add_settings_field(
			'notify_woocomerce_lowstock', // id
			__(  'Low Stock Product' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_lowstock_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);


		add_settings_field(
			'notify_woocomerce_addtocart_item', // id
			__(  'Woocommerce cart add items' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_addtocart_item_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);

		add_settings_field(
			'notify_woocomerce_remove_cart_item', // id  
			__(  'Woocommerce cart removed items' , 'notification-for-telegram' ), // title
			array( $this, 'notify_woocomerce_remove_cart_item_callback' ), // callback
			'telegram-notify-admin_tab3', // page
			'telegram_notify_setting_section_tab3' // section
		);
		
		
		//FINE TAB3
		register_setting(
			'telegram_notify_option_group_tab4', // option_group
			'telegram_notify_option_name_tab4', // option_name
			array( $this, 'telegram_notify_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'telegram_notify_setting_section_tab4', // id
			'Setup a Cron job to keep updated about Plugins & Core Update', // title
			array( $this, 'telegram_notify_section_info_tab4' ), // callback
			'telegram-notify-admin_tab4' // page
		);
		
		
		

		
		
		add_settings_field(
			'notify_update', // id
			__( 'Send me a regular message about core and plug update', 'notification-for-telegram' ), // title
			array( $this, 'notify_update_callback' ), // callback
			'telegram-notify-admin_tab4', // page
			'telegram_notify_setting_section_tab4' // section
		);
		
		

		
			add_settings_field(
			'notify_update_time', // id
			__( 'Reapeat every' , 'notification-for-telegram' ), // title
			array( $this, 'notify_update_time_callback' ), // callback
			'telegram-notify-admin_tab4', // page
			'telegram_notify_setting_section_tab4' // section
		);
		
		
		
		///
		add_settings_field(
			'buttoncron', // id
			__('Delete cron' , 'notification-for-telegram' ), // title
			array( $this, 'cronbutton_callback' ), // callback
			'telegram-notify-admin_tab4', // page
			'telegram_notify_setting_section_tab4' // section
		);

		
	}

	public function telegram_notify_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['token_0'] ) ) {
			$sanitary_values['token_0'] = sanitize_text_field( $input['token_0'] );
		}

		if ( isset( $input['chatids_'] ) ) {
			$sanitary_values['chatids_'] = esc_textarea( $input['chatids_'] );
		}

		if ( isset( $input['saysomething'] ) ) {
			$sanitary_values['saysomething'] = esc_textarea( $input['saysomething'] );
		}

		if ( isset( $input['notify_donot_strip_tags'] ) ) {
			$sanitary_values['notify_donot_strip_tags'] = $input['notify_donot_strip_tags'];
		}

		if ( isset( $input['sleep_time_between_message_2'] ) ) {
			$sanitary_values['sleep_time_between_message_2'] = sanitize_text_field( $input['sleep_time_between_message_2'] );
		}

		if ( isset( $input['notify_newpost'] ) ) {
			$sanitary_values['notify_newpost'] = $input['notify_newpost'];
		}

		if ( isset( $input['notify_cf7'] ) ) {
			$sanitary_values['notify_cf7'] = $input['notify_cf7'];
		}
		
		if ( isset( $input['notify_wpform'] ) ) {
			$sanitary_values['notify_wpform'] = $input['notify_wpform'];
		}

		if ( isset( $input['notify_ele_form'] ) ) {
			$sanitary_values['notify_ele_form'] = $input['notify_ele_form'];
		}

		if ( isset( $input['notify_newuser'] ) ) {
			$sanitary_values['notify_newuser'] = $input['notify_newuser'];
		}

		if ( isset( $input['notify_login_fail'] ) ) {
			$sanitary_values['notify_login_fail'] = $input['notify_login_fail'];
		}

		if ( isset( $input['notify_login_success'] ) ) {
			$sanitary_values['notify_login_success'] = $input['notify_login_success'];
		}
		
		if ( isset( $input['notify_login_fail_showpass'] ) ) {
			$sanitary_values['notify_login_fail_showpass'] = $input['notify_login_fail_showpass'];
		}

		if ( isset( $input['notify_new_comments'] ) ) {
			$sanitary_values['notify_new_comments'] = $input['notify_new_comments'];
		}


		if ( isset( $input['notify_new_comments_filter_spam'] ) ) {
			$sanitary_values['notify_new_comments_filter_spam'] = $input['notify_new_comments_filter_spam'];
		}

		
		if ( isset( $input['notify_login_fail_goodto'] ) ) {
			$sanitary_values['notify_login_fail_goodto'] = $input['notify_login_fail_goodto'];
		}
		
		
		
		if ( isset( $input['notify_mailchimp_sub'] ) ) {
			$sanitary_values['notify_mailchimp_sub'] = $input['notify_mailchimp_sub'];
		}
		
		
		if ( isset( $input['notify_mailchimp_unsub'] ) ) {
			$sanitary_values['notify_mailchimp_unsub'] = $input['notify_mailchimp_unsub'];
		}
		
		if ( isset( $input['notify_mailchimp_unsub'] ) ) {
			$sanitary_values['notify_mailchimp_unsub'] = $input['notify_mailchimp_unsub'];
		}

	
		if ( isset( $input['woocomerce_chatids']) && nftb_NotifyA()  ) {
			$sanitary_values['woocomerce_chatids'] = $input['woocomerce_chatids'];
		}
		
		
		
		if ( isset( $input['notify_woocomerce_order'] ) ) {
			$sanitary_values['notify_woocomerce_order'] = $input['notify_woocomerce_order'];
		}


	if ( isset( $input['order_trigger'] ) ) {
			$sanitary_values['order_trigger'] = $input['order_trigger'];
		}
		
		
	if ( isset( $input['price_with_tax'] ) ) {
			$sanitary_values['price_with_tax'] = $input['price_with_tax'];
		}

	if ( isset( $input['hide_phone'] ) ) {
			$sanitary_values['hide_phone'] = $input['hide_phone'];
		}
	
	if ( isset( $input['hide_ship'] ) ) {
			$sanitary_values['hide_ship'] = $input['hide_ship'];
		}
	
	if ( isset( $input['hide_bill'] ) ) {
			$sanitary_values['hide_bill'] = $input['hide_bill'];
		}


		if ( isset( $input['notify_woocomerce_checkoutfield'] ) ) {
			$sanitary_values['notify_woocomerce_checkoutfield'] = $input['notify_woocomerce_checkoutfield'];
		}


		if ( isset( $input['notify_woocomerce_checkoutext'] ) ) {
			$sanitary_values['notify_woocomerce_checkoutext'] = esc_textarea( $input['notify_woocomerce_checkoutext'] );
		}
		


		if ( isset( $input['notify_woocomerce_order_change'] ) ) {
			$sanitary_values['notify_woocomerce_order_change'] = $input['notify_woocomerce_order_change'];
		}
		
		if ( isset( $input['notify_woocomerce_lowstock'] ) ) {
			$sanitary_values['notify_woocomerce_lowstock'] = $input['notify_woocomerce_lowstock'];
		}


		if ( isset( $input['notify_woocomerce_addtocart_item'] ) ) {
			$sanitary_values['notify_woocomerce_addtocart_item'] = $input['notify_woocomerce_addtocart_item'];
		}

		if ( isset( $input['notify_woocomerce_remove_cart_item'] ) ) {
			$sanitary_values['notify_woocomerce_remove_cart_item'] = $input['notify_woocomerce_remove_cart_item'];
		}
		
		if ( isset( $input['notify_update'] ) ) {
			$sanitary_values['notify_update'] = $input['notify_update'];
		}

		if ( isset( $input['notify_update_time'] ) ) {
			$sanitary_values['notify_update_time'] = $input['notify_update_time'];
		}


		if ( isset( $input['notify_ninjaform'] ) ) {
			$sanitary_values['notify_ninjaform'] = $input['notify_ninjaform'];
		}

		return $sanitary_values;
	}

	public function telegram_notify_section_info() {
		
	}
	
	
	public function telegram_notify_section_info_tab2() {
		
	}
		public function telegram_notify_section_info_tab3() {
		
	}


	public function telegram_notify_section_info_tab4() {
		
	}

	public function token_0_callback() {
		printf(
			'<input class="regular-text22" type="text" size="60" name="telegram_notify_option_name[token_0]" id="token_0" value="%s"> &nbsp;<a href="https://core.telegram.org/bots#6-botfather" target="_blank" >'.__( 'How get your Token' , 'notification-for-telegram' ).'</a>',
			isset( $this->telegram_notify_options['token_0'] ) ? esc_attr( $this->telegram_notify_options['token_0']) : ''
		);
	}



	public function chatids__callback() {
		printf('<textarea class="large-text22" rows="2"  cols="60" name="telegram_notify_option_name[chatids_]" id="chatids_">%s</textarea> &nbsp;<a href="https://telegram.me/chatIDrobot" target="_blank" >'.__( 'How get your Chatid' , 'notification-for-telegram' ).'</a>',
			isset( $this->telegram_notify_options['chatids_'] ) ? esc_attr( $this->telegram_notify_options['chatids_']) : ''
		);
	}

public function opendiv() {
	
	printf('<hr id="bordersection" >');
		}

public function closediv() {
	
	printf('</div>');
		}



// TAB 1


public function saysomething_callback() {
		printf('<textarea class="large-text22" rows="3"  cols="60" name="telegram_notify_option_name_tab3[saysomething]" id="saysomething"></textarea> &nbsp;'.__( 'Write a message to the Chatids' , 'notification-for-telegram' ) ,
			isset( $this->telegram_notify_options_tab3['saysomething'] ) ? esc_attr( $this->telegram_notify_options_tab3['saysomething']) : ''
		);
		
		
	}


	public function testbutton_callback() {
	$plugulr =  plugin_dir_url(__FILE__);
	printf('<button type="button" id="buttonTest" class="buttonTest" value="'.$plugulr.'">'.__('TEST' , 'notification-for-telegram' ).'</button>');
		}
	public function sleep_time_between_message_2_callback() {
		printf(
			'<input class="regular-text22" size="3" type="text" name="telegram_notify_option_name[sleep_time_between_message_2]" id="sleep_time_between_message_2" value="%s">',
			isset( $this->telegram_notify_options['sleep_time_between_message_2'] ) ? esc_attr( $this->telegram_notify_options['sleep_time_between_message_2']) : ''
		);
	}


	public function notify_donot_strip_tags_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name[notify_donot_strip_tags]" id="notify_donot_strip_tags" value="notify_donot_strip_tags" %s><span class="slider"></span>
</label><label for="notify_donot_strip_tags">'.__('if the switch is active, all notification messages will keep any HTML tags if present.<br> if turned off (default and suggested) all html tags will be romoved in the masseges.<br>( Telegram can\'t render HTML ) This setting affects globally ' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options['notify_donot_strip_tags'] ) && $this->telegram_notify_options['notify_donot_strip_tags'] === 'notify_donot_strip_tags' ) ? 'checked' : ''
		);

		
		
		
		
	}


//TAB 2

	public function notify_newpost_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_newpost]" id="notify_newpost" value="notify_newpost" %s><span class="slider"></span>
</label><label for="notify_newpost">'.__('Enable nofications for new post pending' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_newpost'] ) && $this->telegram_notify_options_tab2['notify_newpost'] === 'notify_newpost' ) ? 'checked' : ''
		);
	}

	public function notify_cf7_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_cf7]" id="notify_cf7" value="notify_cf7" %s><span class="slider"></span>
</label><label for="notify_cf7">'.__('Enable nofications in Contact Form 7' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_cf7'] ) && $this->telegram_notify_options_tab2['notify_cf7'] === 'notify_cf7' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('contact-form-7/wp-contact-form-7.php') ) {
		 ?><script>document.getElementById("notify_cf7").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_cf7").disabled = true;document.querySelector("label[for=notify_cf7]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		 	
	}
	
	
	
	public function notify_ninjaform_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_ninjaform]" id="notify_ninjaform" value="notify_ninjaform" %s><span class="slider"></span>
</label><label for="notify_ninjaform">'.__('Enable nofications in Ninjaform' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_ninjaform'] ) && $this->telegram_notify_options_tab2['notify_ninjaform'] === 'notify_ninjaform' ) ? 'checked' : ''
		);
		
		 if ( is_plugin_active('ninja-forms/ninja-forms.php') ) {
		 ?><script>document.getElementById("notify_ninjaform").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_ninjaform").disabled = true;document.querySelector("label[for=notify_ninjaform]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}

	}
	
	
	public function notify_wpform_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_wpform]" id="notify_wpform" value="notify_wpform" %s><span class="slider"></span>
</label><label for="notify_wpform">'.__('Enable nofications in Wpform' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_wpform'] ) && $this->telegram_notify_options_tab2['notify_wpform'] === 'notify_wpform' ) ? 'checked' : ''
		);

		 if ( is_plugin_active('wpforms-lite/wpforms.php') ) {
		 ?><script>document.getElementById("notify_wpform").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_wpform").disabled = true;document.querySelector("label[for=notify_wpform]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}

	}

	public function notify_ele_form_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_ele_form]" id="notify_ele_form" value="notify_ele_form" %s><span class="slider"></span>
</label><label for="notify_ele_form">'.__('Enable nofications in Elementor Form' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_ele_form'] ) && $this->telegram_notify_options_tab2['notify_ele_form'] === 'notify_ele_form' ) ? 'checked' : ''
		);

		if (defined('ELEMENTOR_PRO_VERSION'))  {
		 ?><script>document.getElementById("notify_ele_form").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_ele_form").disabled = true;document.querySelector("label[for=notify_ele_form]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}

	}

	public function notify_newuser_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_newuser]" id="notify_newuser" value="notify_newuser" %s><span class="slider"></span>
</label><label for="notify_newuser">'.__('Enable nofications when New User Registers' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_newuser'] ) && $this->telegram_notify_options_tab2['notify_newuser'] === 'notify_newuser' ) ? 'checked' : ''
		);
	}

	public function notify_login_fail_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_login_fail]" id="notify_login_fail" value="notify_login_fail" %s><span class="slider"></span>
</label><label for="notify_login_fail">'.__('Enable nofications when user login fails' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_login_fail'] ) && $this->telegram_notify_options_tab2['notify_login_fail'] === 'notify_login_fail' ) ? 'checked' : ''
		);
	}

	public function notify_login_success_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_login_success]" id="notify_login_success" value="notify_login_success" %s><span class="slider"></span>
</label><label for="notify_login_success">'.__('Enable nofications when when an existing user has logged in' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_login_success'] ) && $this->telegram_notify_options_tab2['notify_login_success'] === 'notify_login_success' ) ? 'checked' : ''
		);
	}

	public function notify_login_fail_showpass_callback() {
		

		
		printf(
			'<div id="divpro_notify_login_fail_showpass" ><label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_login_fail_showpass]" id="notify_login_fail_showpass" value="notify_login_fail_showpass" %s><span class="slider"></span>
</label><label for="notify_login_fail_showpass">'.__('Show Clear password in message' , 'notification-for-telegram' ).'</label></div>',
			( isset( $this->telegram_notify_options_tab2['notify_login_fail_showpass'] ) && $this->telegram_notify_options_tab2['notify_login_fail_showpass'] === 'notify_login_fail_showpass' ) ? 'checked' : ''
		);
		
	
	

	// echo $this->telegram_notify_options_tab2['notify_login_fail_showpass'];

   }

  
   public function notify_new_comments_callback() {
	printf(
		'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_new_comments]" id="notify_new_comments" value="notify_new_comments" %s><span class="slider"></span>
</label><label for="notify_new_comments">'.__('Enable notifications on new comment' , 'notification-for-telegram' ).'</label>',
		( isset( $this->telegram_notify_options_tab2['notify_new_comments'] ) && $this->telegram_notify_options_tab2['notify_new_comments'] === 'notify_new_comments' ) ? 'checked' : ''
	);
}
		
	
public function notify_new_comments_filter_spam_callback() {
	printf(
		'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_new_comments_filter_spam]" id="notify_new_comments_filter_spam" value="notify_new_comments_filter_spam" %s><span class="slider"></span>
</label><label for="notify_new_comments_filter_spam">'.__('Disable notifications if comment is marked as spam' , 'notification-for-telegram' ).'</label>',
		( isset( $this->telegram_notify_options_tab2['notify_new_comments_filter_spam'] ) && $this->telegram_notify_options_tab2['notify_new_comments_filter_spam'] === 'notify_new_comments_filter_spam' ) ? 'checked' : ''
	);
}


/*

public function notify_login_fail_showpass_callback() {
		printf(
			'<div id="divpro_notify_login_fail_showpass" ><label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_login_fail_showpass]" id="notify_login_fail_showpass" value="notify_login_fail_showpass" %s><span class="slider"></span>
</label><label for="notify_login_fail_showpass">'.__('Show Clear password in message' , 'notification-for-telegram' ).'</label></div>',
			( isset( $this->telegram_notify_options_tab2['notify_login_fail_showpass'] ) && $this->telegram_notify_options_tab2['notify_login_fail_showpass'] === 'notify_login_fail_showpass' ) ? 'checked' : ''
		);
		
		if ( nftb_NotifyA() ) {
			 ?><script>
			  var checkelem = document.getElementById('notify_login_fail_showpass'); 
			  checkelem.style.display = 'none'  ;
			 document.getElementById("notify_login_fail_showpass").disabled = true;
			 document.getElementById("notify_login_fail_showpass").checked = false;
			 document.getElementById('divpro_notify_login_fail_showpass').innerHTML += "  GO PRO";
			 
			 document.getElementById("divpro_notify_login_fail_showpass").className += " gopro";
			 var area = document.getElementById("notify_login_fail_showpass");
			 area.addEventListener('click', function() {
 			 window.open('http://www.reggae.it', '_blank');
 			
 			 document.getElementById("notify_login_fail_showpass").checked = false;
 			 
});
			 </script><?php
	}	
		
	}


*/



	public function notify_login_fail_goodto_callback() { 
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_login_fail_goodto]" id="notify_login_fail_goodto" value="notify_login_fail_goodto" %s><span class="slider"></span>
</label><label for="notify_login_fail_goodto">'.__('Enable nofication on succes login ' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_login_fail_goodto'] ) && $this->telegram_notify_options_tab2['notify_login_fail_goodto'] === 'notify_login_fail_goodto' ) ? 'checked' : ''
		);
	}


	public function notify_mailchimp_sub_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_mailchimp_sub]" id="notify_mailchimp_sub" value="notify_mailchimp_sub" %s><span class="slider"></span>
</label><label for="notify_mailchimp_sub">'.__('Enable nofications' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_mailchimp_sub'] ) && $this->telegram_notify_options_tab2['notify_mailchimp_sub'] === 'notify_mailchimp_sub' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php') ) {
		 ?><script>document.getElementById("notify_mailchimp_sub").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_mailchimp_sub").disabled = true;document.querySelector("label[for=notify_mailchimp_sub]").innerHTML = '<?php _e('MC4WP: Mailchimp Plugin not Active or not Installed ! install <a href="https://wordpress.org/plugins/mailchimp-for-wp/" target="_blank" >Now</a> ' , 'notification-for-telegram' ) ?>';</script><?php
		}
		 	
	}
	


	public function notify_mailchimp_unsub_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab2[notify_mailchimp_unsub]" id="notify_mailchimp_unsub" value="notify_mailchimp_unsub" %s><span class="slider"></span>
</label><label for="notify_mailchimp_unsub">'.__('Enable nofications' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab2['notify_mailchimp_unsub'] ) && $this->telegram_notify_options_tab2['notify_mailchimp_unsub'] === 'notify_mailchimp_unsub' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php') ) {
		 ?><script>document.getElementById("notify_mailchimp_unsub").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_mailchimp_unsub").disabled = true;document.querySelector("label[for=notify_mailchimp_unsub]").innerHTML = '<?php _e('MC4WP: Mailchimp Plugin not Active or not Installed ! install <a href="https://wordpress.org/plugins/mailchimp-for-wp/" target="_blank" >Now</a> ' , 'notification-for-telegram' ) ?>';</script><?php
		}
		 	
	}
	


//TAB 3 


	public function woocomerce_chatids_callback() {
	

	
	
		printf('<div id="divpro_woocomerce_chatids" ><textarea class="large-text22" rows="1"  cols="30" name="telegram_notify_option_name_tab3[woocomerce_chatids]" id="woocomerce_chatids">%s</textarea></div> &nbsp; '.__('Replace global configuration chatid for all woocommerce notifications with these (if blank we use global configuration)  ' , 'notification-for-telegram' ), 
			isset( $this->telegram_notify_options_tab3['woocomerce_chatids'] ) ? esc_attr( $this->telegram_notify_options_tab3['woocomerce_chatids']) : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("woocomerce_chatids").enable = true;</script><?php
			} else { ?><script>document.getElementById("woocomerce_chatids").disabled = true;document.querySelector("label[for=woocomerce_chatids]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
			if ( !nftb_NotifyA() ) {
			 ?><script>document.getElementById("woocomerce_chatids").value =("GOPRO");
			 document.getElementById("woocomerce_chatids").disabled = true;
			 document.getElementById("woocomerce_chatids").className += " gopro";
			 var area = document.getElementById("divpro_woocomerce_chatids");
			 area.addEventListener('click', function() {
 			 window.open('http://www.reggae.it', '_blank');
});
			 </script><?php
		}
	}
	


	public function notify_woocomerce_order_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_order]" id="notify_woocomerce_order" value="notify_woocomerce_order" %s><span class="slider"></span>
</label><label for="notify_woocomerce_order">'.__('Enable nofications on new Orders' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_order'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_order'] === 'notify_woocomerce_order' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_order").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_order").disabled = true;document.querySelector("label[for=notify_woocomerce_order]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}

public function notify_woocomerce_checkoutfield_callback() {
		printf( 
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_checkoutfield]" id="notify_woocomerce_checkoutfield" value="notify_woocomerce_checkoutfield" %s><span class="slider"></span>
</label><label for="notify_woocomerce_checkoutfield">'.__('Create a input field in wc check-out page for Telegram nickname. (not required)' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_checkoutfield'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_checkoutfield'] === 'notify_woocomerce_checkoutfield' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_checkoutfield").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_checkoutfield").disabled = true;document.querySelector("label[for=notify_woocomerce_checkoutfield]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}
	
	 
	 
	 
public function order_trigger_callback() {
$plugulr =  plugin_dir_url(__FILE__);


$sel1 = '';
$sel2 = '';
$sel3 = '';
$sel4 = '';
$sel5 = '';


$telegram_notify_options_tab3 = get_option( 'telegram_notify_option_name' ); // Array of All Options
 $order_trigger_selected = $this->telegram_notify_options_tab3['order_trigger']; // Token
if ($order_trigger_selected == "woocommerce_checkout_order_processed")  { $sel1 = ' selected ';} 
if ($order_trigger_selected == "woocommerce_thankyou")  { $sel2 = ' selected ';} 
if ($order_trigger_selected == "woocommerce_payment_complete")  { $sel3 = ' selected ';} 



//printf('dddd'.$order_trigger_selected."fff".$this->telegram_notify_options_tab3['order_trigger']."---".$this->telegram_notify_options_tab3['notify_woocomerce_checkoutfield']);

		printf(
			'<div class="rigaplug"><div class="box"><select  name="telegram_notify_option_name_tab3[order_trigger]" id="order_trigger" ><option value="woocommerce_checkout_order_processed" >Fired after the confirm order button is pressed (hook: woocommerce_checkout_order_processed)</option>

  <option value="woocommerce_thankyou" '.$sel2.' >'.__('Fired on Thank you order page (hook: woocommerce_thankyou)' , 'notification-for-telegram' ).'</option>
  <option value="woocommerce_payment_complete" '.$sel3.' >'.__('Fired on payment_complete (hook: woocommerce_payment_complete)' , 'notification-for-telegram' ).'</option>

  </select></div><label for="order_trigger">'.__('Choose the appropriate hook  to fire notification.' , 'notification-for-telegram' ).'<a href="https://woocommerce.wp-a2z.org/oik_letters/w/page/21/?post_type=oik_hook" target="_blank"> More about hooks</a></label>',
			//isset( $this->telegram_notify_options_tab3['order_trigger'] ) ? esc_attr( $this->telegram_notify_options_tab3['order_trigger']) : ''
		//);
		
		( isset( $this->telegram_notify_options_tab3['order_trigger'] ) && $this->telegram_notify_options_tab3['order_trigger'] === 'order_trigger' ) ? 'checked' : ''
		);
	}	 
	 


public function price_with_tax_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[price_with_tax]" id="price_with_tax" value="price_with_tax" %s><span class="slider"></span>
</label><label for="price_with_tax">'.__('Include tax in product price' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['price_with_tax'] ) && $this->telegram_notify_options_tab3['price_with_tax'] === 'price_with_tax' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("price_with_tax").enable = true;</script><?php
			} else { ?><script>document.getElementById("price_with_tax").disabled = true;document.querySelector("label[for=price_with_tax]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}

public function hide_bill_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[hide_bill]" id="hide_bill" value="hide_bill" %s><span class="slider"></span>
</label><label for="hide_bill">'.__('Include Billing info in message' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['hide_bill'] ) && $this->telegram_notify_options_tab3['hide_bill'] === 'hide_bill' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("hide_bill").enable = true;</script><?php
			} else { ?><script>document.getElementById("hide_bill").disabled = true;document.querySelector("label[for=hide_bill]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}	 
	
	public function hide_ship_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[hide_ship]" id="hide_ship" value="hide_ship" %s><span class="slider"></span>
</label><label for="hide_ship">'.__('Include Shipping info in message' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['hide_ship'] ) && $this->telegram_notify_options_tab3['hide_ship'] === 'hide_ship' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("hide_ship").enable = true;</script><?php
			} else { ?><script>document.getElementById("hide_ship").disabled = true;document.querySelector("label[for=hide_ship]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}
	

	public function hide_phone_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[hide_phone]" id="hide_phone" value="hide_phone" %s><span class="slider"></span>
</label><label for="hide_phone">'.__('Include Phone in message' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['hide_phone'] ) && $this->telegram_notify_options_tab3['hide_phone'] === 'hide_phone' ) ? 'checked' : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("hide_phone").enable = true;</script><?php
			} else { ?><script>document.getElementById("hide_phone").disabled = true;document.querySelector("label[for=hide_phone]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}

public function notify_woocomerce_checkoutext_callback() {
		printf('<textarea class="large-text22" rows="2"  cols="60" name="telegram_notify_option_name_tab3[notify_woocomerce_checkoutext]" id="notify_woocomerce_checkoutext">%s</textarea> &nbsp; '.__('Text info above the telegram inputbox in check-out page' , 'notification-for-telegram' ),
			isset( $this->telegram_notify_options_tab3['notify_woocomerce_checkoutext'] ) ? esc_attr( $this->telegram_notify_options_tab3['notify_woocomerce_checkoutext']) : ''
		);
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_checkoutext").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_checkoutext").disabled = true;document.querySelector("label[for=notify_woocomerce_checkoutext]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}


	public function notify_woocomerce_order_change_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_order_change]" id="notify_woocomerce_order_change" value="notify_woocomerce_order_change" %s><span class="slider"></span>
</label><label for="notify_woocomerce_order_change">'.__('Enable nofications when any order status changes' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_order_change'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_order_change'] === 'notify_woocomerce_order_change' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_order_change").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_order_change").disabled = true;document.querySelector("label[for=notify_woocomerce_order_change]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}	
	
	
	public function notify_woocomerce_lowstock_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_lowstock]" id="notify_woocomerce_lowstock" value="notify_woocomerce_lowstock" %s><span class="slider"></span>
</label><label for="notify_woocomerce_lowstock">'.__('Enable nofications when a product is low stock conditions' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_lowstock'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_lowstock'] === 'notify_woocomerce_lowstock' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_lowstock").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_lowstock").disabled = true;document.querySelector("label[for=notify_woocomerce_lowstock]").innerHTML = "<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		}
		
	}









	public function notify_woocomerce_addtocart_item_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_addtocart_item]" id="notify_woocomerce_addtocart_item" value="notify_woocomerce_addtocart_item" %s><span class="slider"></span>
</label><label for="notify_woocomerce_addtocart_item">'.__('Enable nofications when a product is added to the cart' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_addtocart_item'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_addtocart_item'] === 'notify_woocomerce_addtocart_item' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_addtocart_item").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_addtocart_item").disabled = true;document.querySelector("label[for=notify_woocomerce_addtocart_item]").innerHTML = ".<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		} 
		
		
	}

	public function notify_woocomerce_remove_cart_item_callback() {
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab3[notify_woocomerce_remove_cart_item]" id="notify_woocomerce_remove_cart_item" value="notify_woocomerce_remove_cart_item" %s><span class="slider"></span>
</label><label for="notify_woocomerce_remove_cart_item">'.__('Enable nofications when product is removed from the cart' , 'notification-for-telegram' ).'</label>',
			( isset( $this->telegram_notify_options_tab3['notify_woocomerce_remove_cart_item'] ) && $this->telegram_notify_options_tab3['notify_woocomerce_remove_cart_item'] === 'notify_woocomerce_remove_cart_item' ) ? 'checked' : ''
		);
		
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
		 ?><script>document.getElementById("notify_woocomerce_remove_cart_item").enable = true;</script><?php
			} else { ?><script>document.getElementById("notify_woocomerce_remove_cart_item").disabled = true;document.querySelector("label[for=notify_woocomerce_remove_cart_item]").innerHTML = ".<?php _e('Plug not Active or Installed' , 'notification-for-telegram' ) ?>";</script><?php
		} 
		
		
	}

//TAB 4
	
	
public function notify_update_callback() {
$ff = " | ".nftb_next_cron_time('nftb_cron_hook');
		printf(
			'<label class="switch"><input type="checkbox" name="telegram_notify_option_name_tab4[notify_update]" id="notify_update" value="notify_update" %s><span class="slider"></span>
</label><label for="notify_update">Enable Automatic message '.$ff .'</label>',
			( isset( $this->telegram_notify_options_tab4['notify_update'] ) && $this->telegram_notify_options_tab4['notify_update'] === 'notify_update' ) ? 'checked' : ''
		);
	}


public function notify_update_time_callback() {
$plugulr =  plugin_dir_url(__FILE__);
global $telegram_notify_options_tab4;


if (isset($telegram_notify_options_tab4['notify_update_time'])) 
{ 
	$notify_update_time_selected = $telegram_notify_options_tab4['notify_update_time']; // Token
} else {

	$notify_update_time_selected = 5;
}


$telegram_notify_options = get_option( 'telegram_notify_option_name' ); // Array of All Options
// $notify_update_time_selected = $telegram_notify_options_tab4['notify_update_time']; // Token

$sel1 = '';
$sel2 = '';
$sel3 = '';
$sel4 = '';
$sel5 = '';



if ($notify_update_time_selected == 1)  { $sel1 = ' selected ';} 
if ($notify_update_time_selected == 2)  { $sel2 = ' selected ';} 
if ($notify_update_time_selected == 3)  { $sel3 = ' selected ';} 
if ($notify_update_time_selected == 4)  { $sel4 = ' selected ';} 
if ($notify_update_time_selected == 5)  { $sel5 = ' selected ';} 


		printf(
			'<div class="rigaplug"><div class="box"><select  name="telegram_notify_option_name[notify_update_time]" id="notify_update_time" ><option value="0" if (!$notify_update_time_selected)  { echo " selected "}>SELECT</option>
  <option value="1"  '.$sel1.'  >'.__('ONE MINUTE' , 'notification-for-telegram' ).'</option>
  <option value="2" '.$sel2.' >'.__('ONE HOUR' , 'notification-for-telegram' ).'</option>
  <option value="3" '.$sel3.' >'.__('DAILY' , 'notification-for-telegram' ).'</option>
  <option value="4" '.$sel4.' >'.__('WEEKLY' , 'notification-for-telegram' ).'</option>
  <option value="5" '.$sel5.' >'.__('MONTHLY' , 'notification-for-telegram' ).'</option>
  </select></div><button type="button" id="buttoncronset" class="buttoncronset" value="'.$plugulr.'">'.__('SET INTERVAL' , 'notification-for-telegram' ).'</button>
 <label for="notify_update_time">'.__('Choose an interval and press <b>set button</b> to activate the cron' , 'notification-for-telegram' ).'</label></div>',
			isset( $this->telegram_notify_options['notify_update_time'] ) ? esc_attr( $this->telegram_notify_options['notify_update_time']) : ''
		);
	}
	
	public function buttoncronset_callback() {
	$plugulr =  plugin_dir_url(__FILE__);
	//printf();
		}

public function cronbutton_callback() {
	$plugulr =  plugin_dir_url(__FILE__);
	printf('<button type="button" id="buttoncron" class="buttoncront" value="'.$plugulr.'">'.__('Delete & Clean Telegram Cronjob ' , 'notification-for-telegram' ).'</button>');
		}

	
	
 
}
if ( is_admin() )
	$telegram_notify = new nftb_TelegramNotify();




 ?>
