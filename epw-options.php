<?php
/**
 * This function introduces a single theme menu option into the WordPress 'Plugins'
 * menu.
 */
 
 /*
function epw_plugin_menu() {

    add_options_page(
        'WordPress Visual Icon Fonts',           // The title to be displayed in the browser window for this page.
        'Icon Fonts',           // The text to be displayed for this menu item
        'administrator',            // Which type of users can see this menu item
        'epw_plugin_options',   // The unique ID - that is, the slug - for this menu item
        'epw_plugin_display'    // The name of the function to call when rendering the page for this menu
    );

} // end epw_theme_menu
add_action('admin_menu', 'epw_plugin_menu');
*/

add_action('admin_menu', 'epw_plugin_menu');
function epw_plugin_menu(){
    add_menu_page('Fontallic Panel', 'Fontallic Panel', 'administrator', 'epw_plugin_options', 'epw_plugin_display' );
    /*add_submenu_page('epw_plugin_options', 'About', 'About', 'administrator', 'epw_plugin_about', 'epw_about_page' );*/
    add_submenu_page('epw_plugin_options', 'Help - Support', 'Help - Support', 'administrator', 'epw_plugin_help', 'epw_help_page' );
}

function epw_about_page(){
	echo "<h2>Wordpress Fontallic - About</h2>";

	}
function epw_help_page(){

	$htmlc = '<div class="wrap">';
	$htmlc .= '<h2 style="margin-bottom:20px;">Wordpress Fontallic - Help</h2><div style="float:right;margin-top:-60px;"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8F8NY9RU2LR4L&source=url"><img type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"></a></div>';
	$htmlc .= "<hr/>";
	$htmlc .= "<iframe src='".plugins_url( '/inc/frame/demo.html', __FILE__ )."' width='100%' height='500' /></iframe>";
	$htmlc .= '<h2>Shortcodes</h2><br/><strong>Parameters</strong><br/>For Fontallic: [iconepw <br/> For FontAwesome: [iconfa<br/>';
	$htmlc .= '<ul>';
	$htmlc .= '<li>type * <strong>[iconepw type="umbrella"]</strong> or <strong>[iconfa type="umbrella"]</strong> ( <font color="red">You can find type name in above list.</font> )</li>';
	$htmlc .= '<li>class * <strong>[iconepw type="umbrella" class="className"]</strong> or <strong>[iconfa type="umbrella" class="className"]</strong> ( <font color="red">Need to enter class name from stylesheet.</font> )</li>';
	$htmlc .= '<li>color * <strong>[iconepw type="umbrella" color="#ff0000"]</strong> or <strong>[iconfa type="umbrella" color="#ff0000"]</strong> ( <font color="red">Need to enter hex code.</font> )</li>';
	$htmlc .= '<li>size * <strong>[iconepw type="umbrella" size="4x"]</strong> or <strong>[iconfa type="umbrella" size="4x"]</strong> ( <font color="red">Options are 2x, 3x, and 4x</font> )</li>';
	$htmlc .= '<li>rotate * <strong>[iconepw type="umbrella" rotate="4x"]</strong> or <strong>[iconfa type="umbrella" rotate="4x"]</strong> ( <font color="red">Options are 90, 180, 270</font> )</li>';
	$htmlc .= '<li>flip * <strong>[iconepw type="umbrella" flip="vertical"]</strong> or <strong>[iconfa type="umbrella" flip="vertical"]</strong> ( <font color="red">Options are vertical and horizontal</font> )</li>';
	$htmlc .= '<li>pull * <strong>[iconepw type="umbrella" pull="right"]</strong> or <strong>[iconfa type="umbrella" pull="right"]</strong> ( <font color="red">Options are left and right</font> )</li>';
	$htmlc .= '<li>animated * <strong>[iconepw type="umbrella" animated="spin"]</strong> or <strong>[iconfa type="umbrella" animated="spin"]</strong> ( <font color="red">Options are spin or do not specify to use</font> )</li>';
	$htmlc .= '</ul>';
	$htmlc .= '</div>';
	echo $htmlc;
}


/**
 * Renders a simple page to display for the theme menu defined above.
 */
function epw_plugin_display() {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">

        <!-- Add the icon to the page -->
        <!-- <div id="icon-themes" class="icon32"></div> -->
        <h2>Wordpress Fontallic - Dashboard</h2>

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php settings_errors(); epw_op_style(); ?>

        <!-- Create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <?php settings_fields( 'epw_plugin_options' ); ?>
            <?php do_settings_sections( 'epw_plugin_options' ); ?>
            <?php submit_button(); ?>
        </form>

    </div><!-- /.wrap -->
<?php
} // end sandbox_theme_display


/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */

/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */

function epw_initialize_theme_options() {

	// First, we register a section. This is necessary since all future options must belong to one.
	add_settings_section(
		'epw_settings_section',			// ID used to identify this section and with which to register options
		'',	// Title to be displayed on the administration page
		'epw_plugin_options_options_callback',	// Callback used to render the description of the section
		'epw_plugin_options'							// Page on which to add this section of options
	);


	/* ------------------------------------------------------------------------ *
	 * Settings
	 * ------------------------------------------------------------------------ */

	// Next, we will introduce the fields for toggling the visibility of content elements.
	add_settings_field(
		'font_select',						// ID used to identify the field throughout the theme
		'Select the Icon font family to use in your theme, font details, links, basic information and credits are also listed for your convenience.',							// The label to the left of the option interface element
		'epw_toggle_font_callback',	// The name of the function responsible for rendering the option interface
		'epw_plugin_options',							// The page on which this option will be displayed
		'epw_settings_section',			// The name of the section to which this field belongs
		array()
	);

	  // Finally, we register the fields with WordPress
    register_setting(
        'epw_plugin_options',
        'font_select'
    );



} // end epw_initialize_theme_options

add_action('admin_init', 'epw_initialize_theme_options');

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */

/**
 * This function provides a simple description for the epw_plugin_options Options page.
 *
 * It is called from the 'epw_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function epw_plugin_options_options_callback() {
	// echo '<p>Select which areas of content you wish to display.</p>';
} // end epw_epw_plugin_options_options_callback





/**
 * This function renders the interface elements for toggling the visibility of the header element.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function epw_toggle_font_callback($args) {

	// Font Awesome
	$html = '<div class="available-theme"><label for="font_select_fa">';
	$html .= "<img src='".plugins_url( '/img/fa-cover2.png', __FILE__ )."' width='300' height='225' />";
	$html .= '<input type="radio" id="font_select_fa" name="font_select" value="fa4" ' . checked('fa4', get_option('font_select'), false) . '/>';
	$html .= '</label>';
	$html .= '<div>Font Awesome 4.0.1</div>';
	$html .= '<em>The iconic font designed for Bootstrap</em>';
	$html .= '<p>Font Awesome - One font, 369 Icons, n a single collection, Font Awesome is a pictographic language of web-related actions.</p>';
	$html .= '<small>Created by Dave Gandy</small>';
	$html .= '<a href="http://fontawesome.io/">http://fontawesome.io/</a>';
	$html .= '</div><hr/><br/>';

	// EasyPromoWeb
	
	$html .= '<div class="available-theme"><label for="font_select_fontallic">';
	$html .= "<img src='".plugins_url( '/img/fontallic-cover2.png', __FILE__ )."' width='300' height='225' />";
	$html .= '<input type="radio" id="font_select_fontallic" name="font_select" value="fontallic" ' . checked('fontallic', get_option('font_select'), false) . '/>';
	$html .= '</label>';
	$html .= '<div>Easypromoweb 2122 Icons</div>';
	$html .= '<em>The iconic font designed for Bootstrap</em>';
	$html .= '<p>Easypromoweb - One font, 2122 Icons, in a single collection.</p>';
	$html .= '<small>Created by Dan Ichim - credit: fontello</small>';
	$html .= '<a href="https://www.linkedin.com/in/danichimc/">https://www.linkedin.com/in/danichimc/</a>';
	$html .= '</div><hr/><br/>';
	
	// Genericons
	$html .= '<div class="available-theme"><label for="font_select_gen">';
	$html .= "<img src='".plugins_url( '/img/gen-cover2.png', __FILE__ )."' width='300' height='225' />";
	$html .= '<input type="radio" id="font_select_gen" name="font_select" value="genericon" ' . checked('genericon', get_option('font_select'), false) . '/>';
	$html .= '</label>';
	$html .= '<div>Genericons</div>';
	$html .= '<em>a free, GPL, flexible icon font for blogs!</em>';
	$html .= '<p>Genericons are vector icons embedded in a webfont designed to be clean and simple keeping with a generic aesthetic.</p>';
	$html .= '<small>Created by Automatic</small>';
	$html .= '<a href="http://genericons.com/">http://genericons.com/</a>';
	$html .= '</div>';

	echo $html;

} // end sandbox_toggle_header_callback



// admin style
function epw_op_style() {
	wp_register_style( 'wpvi-ops', plugins_url('/css/epw-options.css', __FILE__ ), array(), array(), $media = 'all' );
	wp_enqueue_style( 'wpvi-ops' );
}

add_action('admin_print_styles-settings_page_epw_plugin_options', 'epw_op_style' );




