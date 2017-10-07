<?php
/**
@package CronExamplePlugin
Plugin Name: CronExamplePlugin
Plugin URI: http://webox.com.pk
Description: Example plugin for cron in wordpress
Author: Hassan Ali 
Version: 1.0
*/


// create a scheduled event (if it does not exist already)
function cronstarter_activation() {
	if( !wp_next_scheduled( 'mycronjob' ) ) {  
	   wp_schedule_event( time(), 'daily', 'mycronjob' );  
	}
}
// and make sure it's called whenever WordPress loads
add_action('wp', 'cronstarter_activation');



// here's the function we'd like to call with our cron job
function my_repeat_function() {
	
	// do here what needs to be done automatically as per your schedule
	// in this example we're sending an email
	
	// components for our email
	$recepients = 'you@example.com';
	$subject = 'Hello from your Cron Job';
	$message = 'This is a test mail sent by WordPress automatically as per your schedule.';
	
	// let's send it 
	mail($recepients, $subject, $message);
}

// hook that function onto our scheduled event:
add_action ('mycronjob', 'my_repeat_function'); 



// unschedule event upon plugin deactivation
function cronstarter_deactivate() {	

	// find out when the last event was scheduled
	$timestamp = wp_next_scheduled ('mycronjob');
	
	// unschedule previous event if any
	wp_unschedule_event ($timestamp, 'mycronjob');
} 
register_deactivation_hook (__FILE__, 'cronstarter_deactivate');



?>