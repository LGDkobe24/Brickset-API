<?php

//hook into the 'widgets_init' action to load the widget
add_action( 'widgets_init', function(){	return register_widget( 'BricksetThemeWidget' ); });

/** 
 *	Brickset Theme Widget
 *
 *	Creates a widget that generates a list of themes as maintained 
 *	by Brickset.com. The list is returned as links pointing back to the theme page
 *	on Brickset.
 *
 *	@author		Nate Jacobs
 *	@since		0.1
 */
class BricksetThemeWidget extends WP_Widget
{
	/** 
	 *	Plugin Load
	 *
	 *	Generate options for the widget display in the admin dashboard.
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function __construct()
	{
		$options = array( 'description' => __( 'A listing of all themes from Brickset sorted alphabetically with links to the theme pages on brickset.com.' ), 'classname' => 'brickset_theme' );
		parent::__construct('brickset_theme_widget', $name = __( 'Brickset Themes' ), $options );
	}
	
	/** 
	 *	Create Widget Form
	 *
	 *	Create the necessary form to customize the widget.
	 *
	 *	@uses		title	@since 0.1
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function form( $instance )
	{
		$instance = wp_parse_args( ( array ) $instance, array( 'title' => __( 'Brickset Themes' ) ) );
		$title = esc_attr( $instance['title'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>">
		</p>
		<?php
	}
	
	/** 
	 *	Update Widget Options
	 *
	 *	Updates any options used to customize the widget.
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	
	/** 
	 *	Create Brickset Theme Widget
	 *
	 *	Generates the widget that displays the themes as a list of links.
	 *
	 *	@author		Nate Jacobs
	 *	@since		0.1
	 */
	public function widget( $args, $instance )
	{
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		//call functions class and use get method to retrieve list of themes
		$brickset_functions = new BricksetAPIFunctions;
		$themes = $brickset_functions->get_themes();
		foreach ( $themes as $theme )
		{
			echo "<a href='http://www.brickset.com/browse/themes/?theme=$theme->theme'>".$theme->theme.'</a>';
			echo '<br>';
		}
			
		echo $after_widget;
	}
}