=== Notification for Telegram ===
Contributors: rainafarai
Donate link: https://www.paypal.com/paypalme/rainafarai
Tags: Telegram, Woocommerce ,Contact form, mailchimp
Requires at least: 4.0
Tested up to: 6.6.2
Stable tag: 3.3.3
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Sends notifications to Telegram users or groups, when some events occur in WordPress.

== Description ==
The "Notification for Telegram" plugin for WordPress is a tool that allows you to send notifications and messages to a Telegram channel, group or user/s when specific events occur on your WordPress site.
This plugin is useful for monitoring critical events on your site, such as new comments, new user registrations, publishing activities, New forms sent,  Woocommerce orders, cart and lowstock, Mailchimp and more, by sending notifications directly to a Telegram channel or group or user/s of your choice. It also offers a shortcode to send Telegram notifications on every page of your website or in your code.

Receive Telegram messages notification when:  

 
* When receive a new order in Woocommerce.
* When a Woocommerce order change status.
* New field in Woocommerce checkout page let customers add the own telegram nickname
* Low Stock Product notifications when a product is low stock conditions.
* Shows Telegram Nick link in admin order details page when present
* When receive new forms (supports Elementor Pro Form, WPForm , CF7 and Ninjaform)
* When new user subscribes  or unsubscribes to mailchimp. MC4WP integration
* When new user registers.
* When users login or fail login.
* When new comment is posted.
* When someone adds or remove a product in the Woocommerce cart.
* When a new Pending posts is received. (works with any post type)
* Say function to speak to make the bot say Something to the people
* Cron job detect and notify when Plugins & Core need to update. 
* Send custom message with Shortcode anywhere in your WP.
* Should Work on Multisite

You can enable/disable every notification in the Plugin settings page.
 

To configure the plugin, you need a valid Telegram API token. Its easy to get starting a Telegram Bot.
You can learn about obtaining  tokens and generating new ones in 
[this document](https://core.telegram.org/bots#6-botfather/ "Obtaining tokens and generating new ones")  
or follow the info in [this post](https://medium.com/shibinco/create-a-telegram-bot-using-botfather-and-get-the-api-token-900ba00e0f39 "Create a Telegram bot using BotFather and Get the Api Token")  

You also need at least one "chatid" number, that is the recipient to the message will be send. To know you personal chatid number, search on telegram app for "@get_id_bot" or  
[click here ](https://telegram.me/chatIDrobot/ "@chatIDrobot")  OR  another bot @RawDataBot [click here ](https://t.me/RawDataBot)  


Once You got the 2 fields save the configuration and try the "TEST" button .. you should receive a message in you telegram : "WOW IT WORKS" !! If not, check token and chatid fields again for the correct values.

this plugin is relying on a 3rd party service to geolocate the Ip address https://ip-api.com/
https://ip-api.com/docs/legal  to see the services’ a terms of use and/or privacy policies


SHORTCODE EXAMPLE

`[telegram_mess  message="Im so happy" chatids="0000000," token="000000000:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" showsitename="1" showip="1" showcity="1" ]`


SHORTCODE OPTIONS:

* message : Your message to be sent. Example (message="hello world")

* chatids : Recipient(s) who will receive your message separated by comma (example chatids="0000000,11111111") , If not present this field  the shortcode will use default value in Plugin option page.

* token:  The token looks something like 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11 
If not present this field, the shortcode will use default value in Plugin option page.

* showsitename: if set to "1" appends sitename after the message. Defaultvalue is "0" Example (showsitename="1")

* showip: if set to "1" appends user ip address after the message. Default value is "0" Example (showip="1")

* showcity: if set to "1" appends user city name after the message. Default value is "0" Example (showcity="1")


USE SHORTCODE IN YOU PHP CODE

`<?php

$date = date("d-m-Y");

do_shortcode('[telegram_mess  message="'.$date .'" chatids="0000000," token="000000000:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" showsitename="1" showip="1" showcity="1" ]'); 

?>`

** WOOCOMERCE FILTER HOOKS **

We have created 4 filter hooks for WooCommerce order notification message. 4 new positions: Message Header, Message Footer, before Items, and after Items. And we have created a filter through which you can add custom code to product rows, and if you want, you can replace and customize the entire row. :

4 new Positions and code axample ( echo payment_status in the 4 positions)

`<?php
add_filter('nftb_order_header_message_hook', 'my_filter_function', 10, 1); 
add_filter('nftb_order_before_items_hook', 'my_filter_function', 10, 1);
add_filter('nftb_order_after_items_hook', 'my_filter_function', 10, 1);
add_filter('nftb_order_footer_message_hook', 'my_filter_function', 10, 1);

function my_filter_function($order_id) {
  $order = wc_get_order($order_id);
  if ($order) {
      // Get order details
      $order_data = $order->get_data();
  
      // Extract specific order information
      
      $payment_status = $order->get_status();
      $payment_method = $order->get_payment_method();  
  }
  return  "\r\n\r\n".$payment_method."(".$payment_status.")\r\n" ;
}
?>`

Product rows Filter with 2 different behaviors ADD or REPLACE LINE 

`<?php
add_filter('nftb_order_product_line_hook', 'my_item_line_function', 10, 3);

function my_item_line_function($message ,$product_id, $item) {

    // ADD SOME CODE $product_id TO ORIGINAL row $message.
    $modified_data = $message. "->".$product_id. "\r\n";

    // REPLACE Product ITEM LINE CODE WITH YOUR CODE  without concatenate $message.
    $modified_data = $product_id. "\r\n";

    return $modified_data;
} 
?>`

** USER LOGIN HOOKS **

`<?php
//Filter to add code on user login notification message
add_filter('nftb_login_notification', 'custom_message_modifier', 10, 1);

//Filter to add code  on user registration notification message
add_filter('nftb_user_registered_notification', 'custom_message_modifier', 10, 1);

//Filter to add code when existing user fails login notification message
add_filter('nftb_existing_user_fails_login_notification', 'custom_message_modifier', 10, 1);

//Filter to add code when unknown user fails login notification message
add_filter('nftb_unknown_user_fails_login_notification', 'custom_message_modifier', 10, 1);
  
  

// ADD User registration date to notification message
function custom_message_modifier( $user_id) {

    $user_info = get_userdata($user_id);

    if ($user_info) {
        $registration_date = $user_info->user_registered;
        $timestamp = strtotime($registration_date);
        $locale = 'it_IT'; // Italian locale
        
        $formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::LONG, 'UTC');
        $formatter->setPattern('d MMMM y HH:mm:ss');
        
        $formatted_date = $formatter->format($timestamp);
        $message =  "\r\n\r\nUser gistration Date: " . $formatted_date."\r\n\r\n";
    } else {

      $message =  "\r\n No info about user ! \r\n " ;

    }
   

    return $message;
}
?>`



before the hooks we introduced 3 function so you can add things in message without changing the plug code 
We keep them for compatibility but encourage the use of hooks!!
Position in the order message are:  before items, after items, product_line

1) before the product list : (add order ID example)

	<?php function nftb_order_before_items($order_id){
    		return "ORDER ID : ".$order_id; 
		} ?php>


2) after the product list: (add order Currency example)

	<?php function nftb_order_after_items($order_id){
	 	$order = wc_get_order( $order_id );
    		$data = $order->get_data(); // order data
    		return "Currency: ".$data['currency']; 
		} ?php>

3) at the end of the line of each individual product of the order: (add product slug example)

	<?php function nftb_order_product_line($product_id,$item){
   		 $product = wc_get_product( $product_id );
    		return " | ".$product->get_slug()." ";
			} ?php>


Suggestions for other Notification, hooks and others plug integrations are Welcome !! 

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)

== Frequently Asked Questions ==

= How to obtain Token? =

When You create a telegram bot you will get a Token. 
BotFather @botfather is the one bot to rule them all. It will help you create new bots and change settings for existing ones.

search for @botfather

Creating a new bot
Use the /newbot command to create a new bot. The BotFather will ask you for a name and username, then generate an authorization token for your new bot.

The name of your bot is displayed in contact details and elsewhere.

The Username is a short name, to be used in mentions and t.me links. Usernames are 5-32 characters long and are case insensitive, but may only include Latin characters, numbers, and underscores. Your bot's username must end in 'bot', e.g. 'tetris_bot' or 'TetrisBot'.

The token is a string along the lines of 110201543:AAHdqTcvCH1vGWJxfSeofSAs0K5PALDsaw that is required to authorize the bot and send requests to the Bot API. Keep your token secure and store it safely, it can be used by anyone to control your bot.

Generating an authorization token.
If your existing token is compromised or you lost it for some reason, use the /token command to generate a new one.



= How to obtain the chat_id of a private Telegram channel? =

The easiest way is to invite @get_id_bot in your chat and then type:

/my_id @get_id_bot 


or search in telegram @RawDataBot -> https://t.me/RawDataBot  write something and the bot
will reply your account info with the id .

= Can i insert more than one recipient chatid? =

Yes you can add more than one chattid  separated by a comma (,)
both in option page and in the shortcode.



== Screenshots == 

1. This is the Global option page in you Dashboard. Enter Token Chatid
2. Choose which notification you want to receive 
3. A shortcode example.
4. Order Telegram Notification 
5. Login fails result on your Mobile app 
6. Woocommerce Setting Tab
7. Cron Setting Tab keep update your system 
8. Hook Position in Order Notification
9. Hook Position in Login Notification 

== Changelog ==

= 3.3.3 = 
Fix unauthorized test message sending due to a missing capability (thx Wordfence)

= 3.3.1 = 
Added html_entity_decode to clean HTML entity
fix check if user is set before apply_filters('nftb_login_notification') 
Fix in user login sometimes the userdata was empty
Fix Warning: Undefined array key "notify_update" "notify_update_time" php > 8 

= 3.3 = 
Fix on  apply_filters('nftb_existing_user_* return empty if not set
Added User Role info in the message when a registered user fails to login
Added Spam Filter on comment. If enabled you will not receive notification if comment is marked as spam


= 3.2 = 
Fix: "Wc order change status" was triggering the comment notification remove order_shop post type.
Small fixes on user message formatting CR 
Removed all the calls to Extarnal plugin activator & link to webpage


= 3.1 =
Added notification for new comment 

= 3.0 =
Added Succes User Login notification 
Added donation link to block the random message "Im really happy you are using my plugin !!".
Added a notification for removed products from cart.
Added Customer Order Note from Wc checkout page.
Added Option "Do not Remove <html tags> from the telegram messages".
Added IP address for any User Login Notification not just the map
Fix Enable notifications when user login fails.


Added 4 REAL WOOCOMERCE notification HOOKS : nftb_order_product_line_hook, nftb_order_header_message_hook, nftb_order_before_items_hook,
nftb_order_after_items_hook, nftb_order_footer_message_hook .

Addes 4 REAL USER LOGIN notification HOOKS 
nftb_login_notification, nftb_user_registered_notification , nftb_existing_user_fails_login_notification, nftb_unknown_user_fails_login_notification

Added $item to the function -> nftb_order_product_line($product_id,$item); (wsjrcatarri request)



= 2.9 =
Added Support for Elementor Form
User Login notification new Layout more clear 
Fix Function get_userdatabylogin (deprecated) on User login 
Better Jquery validations ( token and chatids ) on config page

= 2.8 =
Fixed Shortcode 

= 2.7 =
Fixed Many Notice on woocommerce order confirmation Thankyou page. 
Added customer total orders number in order confirmation message.

= 2.6 =
Added Customer Phone Number in order message (Everybody Asking :=) )

= 2.5 =
- Formatted fields for CF7 Contact Form no more Var_dump()
- Added 3 Hooks in Order notification to add your custom code without modify plugin code
- Updated instructions to get your telegram chat_id number 

= 2.4 =
- Added Support for WPFORM : all fields in you telegram notification
- New Option in Woocommerce Tab : Hide/view Billing Information
- New Option in Woocommerce Tab : Hide/view Shipping Information
- Small UI fix 

= 2.3 =
- Fix warning on PHP 8

= 2.2 =
- New option to select the woocommerce trigger for the notification with 3 different actions:
	woocommerce_checkout_order_processed / woocommerce_payment_complete / woocommerce_thankyou
- Show items price with tax or not 
- Fixed activation notice error 

= 2.0 =
New Backend UserGUI Tab division for better User Experience
Full fields Order Notification (Items shipment, billing, is paid?, and many order details)
Low Stock Product Enable notifications when a product is low stock conditions.
Create a input field in wc check-out page for Telegram nickname.
Say function to speak to make the bot say Something to the people
MC4WP Mailchimp for WordPress plugin integration send a notification when new user subscribes to mailchimp or unsubscribes
Cron message Setup a Cron job to keep updated about Plugins & Core Update 
Added Emoji to messages

= 1.6 =
now you can enable a new field in Woocommerce checkout page let customers add his telegram nickname

= 1.4 = 
Fix new order received and Order status change
No duplication now !!

= 1.3 =
Fix message text in shortcode was blank before


= 1.2 =
Add new option on woocommerce notification : only on new orders or on any order status change

= 1.1 =
add icons

= 1.0 =
Initial release



== Upgrade Notice ==
For Old versions Only !!
after updating to version> 2 check the settings again, if you have problems in the update uninstall and reinstall the plug sorry for the problem