<?php 
/*
Plugin Name: Support and Information Widget for WordPress (Two-Panel)
Plugin URI: http://www.as.ua.edu/etech
Description: This plugin creates a Dashboard widget which provides publishing tips and support information for users of The University of Alabama College of Arts and Sciences' WordPress web publishing environment.
Author: The Office of Educational Technology (eTech)
Version: 1.5
Author URI: http://www.as.ua.edu/etech

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

//Disables Wordpress Core Update Message

# 2.3 to 2.7:
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

# 2.8 to 3.0:
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

# 3.0:
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

function welcome_dashboard_widget(){
	?>
<div style="background: #ffffff bottom right no-repeat; height: 520px; line-height:120%;">
<br />
<strong>About WordPress</strong>
<br />
  <blockquote>Welcome to the WordPress website publishing system, supported by the The University of Alabama College of Arts & Sciences. WordPress is an internet-based tool that allows you to log into your website from any location and create, edit, and delete content. For tips on how to get started creating content using the WordPress system, feel free to view the video below.
    <blockquote>
	  <ul>
	    <li><a href="http://wordpress-tutorials.ithemes.com/27tutsunbranded/wp27_overview.swf" target="_blank">WordPress Overview: An Introduction</a></li>
	  </ul>
    </blockquote>
  </blockquote>	
<br />
<strong>Pages and Posts</strong>
<br />
  <blockquote>Within WordPress there are two ways to publish content to your site—pages and posts.
  <br /><br />Pages, the most common way you will publish content, are listed in the main menu of your website.  Pages are best suited for publishing blocks of purely static content, such as faculty and staff contact listings, undergraduate information, graduate-level information, and departmental contact information.
  <br /><br />In contrast, posts are almost always located only on the front page of your website; they only contain brief bits of information - normally grouped in a listed format - which you click on to get more detailed information. The best example of the 'post' method of publishing is a traditional blog or a news website, where you browse through lists of related content, clicking only on items which interest you.
  <br /><br />Not all templates support both posts and pages, so if you encounter any problems feel free to contact us via the Help & Support information provided. For information on how to create posts and pages, please browse the following brief tutorial videos below.
    <blockquote>
    <br />
      <ul>
        <li><a href="http://wordpress-tutorials.ithemes.com/27tutsunbranded/wp27_writepage.swf" target="_blank">Creating a new page</a></li>
		<li><a href="http://wordpress-tutorials.ithemes.com/27tutsunbranded/wp27_writepost.swf" target="_blank">Creating a new post</a></li>
	  </ul>
	</blockquote>
  </blockquote>
<br />
</div>
<?php
}	// End welcome_dashboard_widget()
function welcome_dashboard_widget_images(){
	?>

<div style="background: #ffffff url(<?php echo WP_PLUGIN_URL; ?>/etech-dashboard-widget_two-panel/background.png) bottom right no-repeat; height: 520px; line-height:120%;">
  <br />
  <strong>Help and Support</strong>
  <br />
  <blockquote>For support information, you can email the College's Office of Educational Technology (eTech) at webmaster@as.ua.edu or call us at (205)348-4832.
  </blockquote>
  <div style="text-align: center; padding-top: 60px; margin-right: 230px;">
	<a href="http://www.as.ua.edu">
	<img src="<?php echo WP_PLUGIN_URL; ?>/etech-dashboard-widget_two-panel/as_plate.png"  border="0" />
	</a>
	<br /><br /><br />
	<a href="http://www.as.ua.edu/etech">
	<img src="<?php echo WP_PLUGIN_URL; ?>/etech-dashboard-widget_two-panel/eTech Logo.png"  border="0" />
	</a>
	<br /><br /><br />
	<a href="http://www.wordpress.org">
	<img src="<?php echo WP_PLUGIN_URL; ?>/etech-dashboard-widget_two-panel/wordpress-logo.png"  border="0" />
	</a>
	
  </div>
</div>

<?php
}	// End welcome_dashboard_widget_images()

function insert_welcome_dash(){
	wp_add_dashboard_widget('mydash', 'Welcome to WordPress', 'welcome_dashboard_widget');
}
function insert_welcome_dash_images(){
	wp_add_dashboard_widget('mydash1', 'Useful Links & Support', 'welcome_dashboard_widget_images');
}

function remove_dashboard_widgets() {
	// Globalize the metaboxes array (this holds all the widgets for wp-admin)
	global $wp_meta_boxes;
	// Then remove all dashboard widgets
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	
}

function set_screen_layout_columns($columns) {
    $columns['dashboard'] = 2;
    return $columns;
}
function set_screen_layout_post() {
    return 1;
}
add_filter('screen_layout_columns','set_screen_layout_columns');
add_filter('get_user_option_screen_layout_post','set_screen_layout_post');
add_action('wp_dashboard_setup', 'insert_welcome_dash');
add_action('wp_dashboard_setup', 'insert_welcome_dash_images');
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

?>