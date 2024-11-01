<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Widget Master Class
*/
class Wtn_Rss_Widget extends WP_Widget {

    function __construct() {
		parent::__construct('wtn-rss-widget', __('Top News Rss', 'wp-top-news'), array('description' => __('Top News Rss Widget', 'wp-top-news')));

		//add_action( 'load-widgets.php', array(&$this, 'wbg_color_picker_load') );
	}

	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args Widget arguments.
	* @param array $instance Saved values from database.
	*/
	function widget( $args, $instance ) {

		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		$wtn_w_rss_url				= isset( $instance['wtn_w_rss_url'] ) ? sanitize_url( $instance['wtn_w_rss_url'] ) : '';
		$wtn_w_rss_display_number 	= ( isset($instance['wtn_w_rss_display_number']) && filter_var( $instance['wtn_w_rss_display_number'], FILTER_SANITIZE_NUMBER_INT ) ) ? $instance['wtn_w_rss_display_number'] : 10;
		$wtn_w_rss_display_date		= ( isset( $instance['wtn_w_rss_display_date'] ) && filter_var( $instance['wtn_w_rss_display_date'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_date'] : '';
		$wtn_w_rss_display_content	= ( isset( $instance['wtn_w_rss_display_content'] ) && filter_var( $instance['wtn_w_rss_display_content'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_content'] : '';
		$wtn_w_rss_display_icons	= ( isset( $instance['wtn_w_rss_display_icons'] ) && filter_var( $instance['wtn_w_rss_display_icons'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_icons'] : '';
		$wtn_w_rss_display_source	= ( isset( $instance['wtn_w_rss_display_source'] ) && filter_var( $instance['wtn_w_rss_display_source'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_source'] : '';
		
		// Loading Styles
		include 'styles.php';
		
		if( '' !== $wtn_w_rss_url ) {

			$rss_feed = simplexml_load_file( $wtn_w_rss_url );

			if ( ! empty( $rss_feed ) ) {
				//echo '<pre>';
				//print_r( $rss_feed );
				$i = 0;
				foreach ( $rss_feed->channel->item as $feed_item ) {
					if ( $i >= $wtn_w_rss_display_number )
						break;
						?>
						<div class="wtnrsswidget-items">
							<div class="wtnrsswidget-title">
								<a class="feed_title" href="<?php echo esc_url( $feed_item->link ); ?>" target="_blank"><?php esc_html_e( $feed_item->title ); ?></a>
							</div>
							<div class="wtnrsswidget-content">
								<?php echo ( $wtn_w_rss_display_content ) ? implode(' ', array_slice(explode(' ', esc_html( strip_tags( $feed_item->description ) )), 0, 20)) . "..." : ''; ?>
							</div>
							<div class="wtnrsswidget-date">
								<?php echo ( $wtn_w_rss_display_icons ) ? '<i class="fa fa-calendar-days"></i>' : ''; ?>
								<?php echo ( $wtn_w_rss_display_date ) ? date( 'F d, Y', strtotime( $feed_item->pubDate )) : ''; ?>
							</div>
							<div class="wtnrsswidget-source">
								<?php echo ( $wtn_w_rss_display_icons ) ? '<i class="fa fa-newspaper"></i>' : ''; ?>
								<?php echo ( $wtn_w_rss_display_source ) ? esc_html_e(  $rss_feed->channel->title ) : ''; ?>
							</div>
						</div>
						<?php
					$i++;
				}
			}
		}

		//==========================
		echo $args['after_widget'];
	}

	/**
	* Widget Form
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*/
	public function form( $instance ) {

		$title 						= isset( $instance['title'] ) ? $instance['title'] : __('Top News Rss', 'wp-top-news');
		$wtn_w_rss_url				= isset( $instance['wtn_w_rss_url'] ) ? sanitize_url( $instance['wtn_w_rss_url'] ) : '';
		$wtn_w_rss_display_number	= ( isset( $instance['wtn_w_rss_display_number'] ) && filter_var( $instance['wtn_w_rss_display_number'], FILTER_SANITIZE_NUMBER_INT ) ) ? $instance['wtn_w_rss_display_number'] : 10;
		$wtn_w_rss_display_date		= ( isset( $instance['wtn_w_rss_display_date'] ) && filter_var( $instance['wtn_w_rss_display_date'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_date'] : '';
		$wtn_w_rss_display_content	= ( isset( $instance['wtn_w_rss_display_content'] ) && filter_var( $instance['wtn_w_rss_display_content'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_content'] : '';
		$wtn_w_rss_display_icons	= ( isset( $instance['wtn_w_rss_display_icons'] ) && filter_var( $instance['wtn_w_rss_display_icons'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_icons'] : '';
		$wtn_w_rss_display_source	= ( isset( $instance['wtn_w_rss_display_source'] ) && filter_var( $instance['wtn_w_rss_display_source'], FILTER_SANITIZE_STRING ) ) ? $instance['wtn_w_rss_display_source'] : '';
		?>
		<p>
			<label><?php _e('Title', 'wp-top-news'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php esc_attr_e( $title ); ?>">
		</p>
		<p>
			<label><?php _e('Rss Feed URL', 'wp-top-news'); ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('wtn_w_rss_url'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_url'); ?>" value="<?php esc_attr_e( $wtn_w_rss_url ); ?>">
		</p>
		<p>
			<label><?php _e('Number of Feeds', 'wp-top-news'); ?>:</label>
			<select class="tiny-text" id="<?php echo $this->get_field_id('wtn_w_rss_display_number'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_display_number'); ?>">
				<?php 
				for( $rdn = 1; $rdn <= 20; $rdn++ ) {
					?>
					<option value="<?php esc_attr_e( $rdn ); ?>" <?php echo ( $wtn_w_rss_display_number == $rdn) ? 'selected' : '' ?>><?php printf('%d', esc_html($rdn)); ?></option>
					<?php 
				} 
				?>
            </select>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('wtn_w_rss_display_content'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_display_content'); ?>" <?php checked( $wtn_w_rss_display_content, 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('wtn_w_rss_display_content'); ?>"><?php _e('Display content', 'wp-top-news'); ?>?</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('wtn_w_rss_display_date'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_display_date'); ?>" <?php checked( $wtn_w_rss_display_date, 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('wtn_w_rss_display_date'); ?>"><?php _e('Display date', 'wp-top-news'); ?>?</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('wtn_w_rss_display_source'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_display_source'); ?>" <?php checked( $wtn_w_rss_display_source, 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('wtn_w_rss_display_source'); ?>"><?php _e('Display feed source', 'wp-top-news'); ?>?</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('wtn_w_rss_display_icons'); ?>" name="<?php echo $this->get_field_name('wtn_w_rss_display_icons'); ?>" <?php checked( $wtn_w_rss_display_icons, 'on' ); ?> />
			<label for="<?php echo $this->get_field_id('wtn_w_rss_display_icons'); ?>"><?php _e('Display Icons', 'wp-top-news'); ?>?</label>
		</p>
		<?php
	}

	/*
	* Update Widget Value
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {

		$instance 								= array();
		$instance['title']						= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __('Top News Rss', 'wp-top-news');
		$instance['wtn_w_rss_url'] 				= isset( $new_instance['wtn_w_rss_url'] ) ? sanitize_url( $new_instance['wtn_w_rss_url'] ) : '';
		$instance['wtn_w_rss_display_number']	= ( isset( $new_instance['wtn_w_rss_display_number'] ) && filter_var( $new_instance['wtn_w_rss_display_number'], FILTER_SANITIZE_NUMBER_INT ) ) ? $new_instance['wtn_w_rss_display_number'] : 10;
		$instance['wtn_w_rss_display_date']		= ( isset( $new_instance['wtn_w_rss_display_date'] ) && filter_var( $new_instance['wtn_w_rss_display_date'], FILTER_SANITIZE_STRING ) ) ? $new_instance['wtn_w_rss_display_date'] : '';
		$instance['wtn_w_rss_display_content']	= ( isset( $new_instance['wtn_w_rss_display_content'] ) && filter_var( $new_instance['wtn_w_rss_display_content'], FILTER_SANITIZE_STRING ) ) ? $new_instance['wtn_w_rss_display_content'] : '';
		$instance['wtn_w_rss_display_icons']	= ( isset( $new_instance['wtn_w_rss_display_icons'] ) && filter_var( $new_instance['wtn_w_rss_display_icons'], FILTER_SANITIZE_STRING ) ) ? $new_instance['wtn_w_rss_display_icons'] : '';
		$instance['wtn_w_rss_display_source']	= ( isset( $new_instance['wtn_w_rss_display_source'] ) && filter_var( $new_instance['wtn_w_rss_display_source'], FILTER_SANITIZE_STRING ) ) ? $new_instance['wtn_w_rss_display_source'] : '';

		return $instance;
	}
}