"#### wordpress-cron-example-plugin" 


This is WordPress Example Plugin to Write Cron Job Plugin


#### You can create custom intervals 

> // add custom interval
> 
> function cron_add_minute( $schedules ) {
> 	// Adds once every minute to the existing schedules.
>     $schedules['everyminute'] = array(
> 	    'interval' => 60,
> 	    'display' => __( 'Once Every Minute' )
>     );
>     return $schedules;
> }
> 
> add_filter( 'cron_schedules', 'cron_add_minute' );

#### Create a scheduled event (if it does not exist already)


> // create a scheduled event (if it does not exist already)
> 
> function cronstarter_activation() {
> 	if( !wp_next_scheduled( 'mycronjob' ) ) {  
> 	   wp_schedule_event( time(), 'everyminute', 'mycronjob' );  
> 	}
> }
> 
> // and make sure it's called whenever WordPress loads
> add_action('wp', 'cronstarter_activation');


