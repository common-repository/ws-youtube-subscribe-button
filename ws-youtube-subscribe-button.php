<?php
/*
* Plugin Name: WS Youtube Subscribe Button
* Plugin URI: https://wordpress.org/plugins/ws-youtube-subscribe-button/
* Description: WS Youtube Subscribe Button plugin provides a small button displayed on your blog to help users easily subscribe to your YouTube channel. 
* Author: WebShouters
* Author URI: http://www.webshouters.com/
* Version: 1.1
* Text Domain: ws-youtube-subscribe-button
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class WS_Youtube_Subscribe_Button_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'WS_Youtube_Subscribe_Button_Widget',
            __( 'WS Youtube Subscribe Button', 'ws-youtube-subscribe-button' ),
            array(
                'classname'   => 'WS_Youtube_Subscribe_Button_Widget',
                'description' => __( 'Add youtube subscribe button to your blog.', 'ws-youtube-subscribe-button' )
                )
        );
       
        load_plugin_textdomain( 'ws-youtube-subscribe-button', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
         
        extract( $args );
         
        $title = apply_filters( 'widget_title', $instance['title'] );
		$ws_yousb_id = $instance['ws_yousb_id'];
		$ws_yousb_layout = $instance['ws_yousb_layout'];
		$ws_yousb_theme = $instance['ws_yousb_theme'];
		$ws_yousb_count = $instance['ws_yousb_count'];
         
        echo $before_widget;
         
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
		
		if ( !empty( $ws_yousb_id ) ) {

		?>
		
		<div class="ws_youtube_subscribe_button_wrap">
			<script src="https://apis.google.com/js/platform.js"></script>
			<div class="g-ytsubscribe" data-channel="<?php echo $ws_yousb_id; ?>" data-layout="<?php echo $ws_yousb_layout; ?>" data-theme="<?php echo $ws_yousb_theme; ?>" data-count="<?php echo $ws_yousb_count; ?>"></div>
		</div>
		
		<?php                     
        
        }

        echo $after_widget;
         
    }
 
  
    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['ws_yousb_id'] = strip_tags( $new_instance['ws_yousb_id'] );
		$instance['ws_yousb_layout'] = strip_tags( $new_instance['ws_yousb_layout'] );
		$instance['ws_yousb_theme'] = strip_tags( $new_instance['ws_yousb_theme'] );
		$instance['ws_yousb_count'] = strip_tags( $new_instance['ws_yousb_count'] );
         
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     	
		/* Check values */
		if( $instance) {
		
	        $title = esc_attr( $instance['title'] );
			$ws_yousb_id = esc_attr( $instance['ws_yousb_id'] );
			$ws_yousb_layout = esc_attr( $instance['ws_yousb_layout'] );
			$ws_yousb_theme = esc_attr( $instance['ws_yousb_theme'] );
			$ws_yousb_count = esc_attr( $instance['ws_yousb_count'] );
		
		}
		else{
			$title = __( 'Follow Me', 'ws-youtube-subscribe-button' );
			$ws_yousb_id = 'GoogleDevelopers';
			$ws_yousb_layout = 'default';
			$ws_yousb_theme = 'default';
			$ws_yousb_count = 'default';
		}
        ?>
         
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ws-youtube-subscribe-button'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
         <p>
            <label for="<?php echo $this->get_field_id('ws_yousb_id'); ?>"><?php _e('Channel Name or ID:', 'ws-youtube-subscribe-button'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ws_yousb_id'); ?>" name="<?php echo $this->get_field_name('ws_yousb_id'); ?>" type="text" value="<?php echo $ws_yousb_id; ?>" />
         </p>
         
         <p>
			<label for="<?php echo $this->get_field_id('ws_yousb_layout'); ?>"><?php _e('Layout:', 'ws-youtube-subscribe-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_yousb_layout'); ?>" name="<?php echo $this->get_field_name('ws_yousb_layout'); ?>">
				<option value="default" <?php selected( 'default', $ws_yousb_layout ); ?>><?php _e('Button', 'ws-youtube-subscribe-button'); ?></option>
				<option value="full" <?php selected( 'full', $ws_yousb_layout ); ?>><?php _e('Full', 'ws-youtube-subscribe-button'); ?></option>
			</select>

		 </p>
		 
		 <p>
			<label for="<?php echo $this->get_field_id('ws_yousb_theme'); ?>"><?php _e('Theme:', 'ws-youtube-subscribe-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_yousb_theme'); ?>" name="<?php echo $this->get_field_name('ws_yousb_theme'); ?>">
				<option value="default" <?php selected( 'default', $ws_yousb_theme ); ?>><?php _e('Light', 'ws-youtube-subscribe-button'); ?></option>
				<option value="dark" <?php selected( 'dark', $ws_yousb_theme ); ?>><?php _e('Dark', 'ws-youtube-subscribe-button'); ?></option>
			</select>

		 </p>
         
         <p>
			<label for="<?php echo $this->get_field_id('ws_yousb_count'); ?>"><?php _e('Subscriber count:', 'ws-youtube-subscribe-button'); ?></label> 
			<select id="<?php echo $this->get_field_id('ws_yousb_count'); ?>" name="<?php echo $this->get_field_name('ws_yousb_count'); ?>">
				<option value="default" <?php selected( 'default', $ws_yousb_count ); ?>><?php _e('Yes', 'ws-youtube-subscribe-button'); ?></option>
				<option value="hidden" <?php selected( 'hidden', $ws_yousb_count ); ?>><?php _e('No', 'ws-youtube-subscribe-button'); ?></option>
			</select>

		</p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'WS_Youtube_Subscribe_Button_Widget' );
});