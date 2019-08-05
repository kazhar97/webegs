<?php
/*
  Plugin Name: Image Hover Effects - Caption Hover with Carousel
  Author: Biplob Adhikari
  Plugin URI: https://wordpress.org/plugins/image-hover-effects-with-carousel/
  Description: Image Hover Effects - Caption Hover with Carousel Plugin For WordPress is all in one image hover effect solution.
  Author URI: https://oxilab.org
  Version: 2.7
  License: GPLv2 or later
 */
if (!defined('ABSPATH'))
    exit;

$image_hover_with_carousel_version = '2.7';
define('image_hover_with_carousel_url', plugin_dir_path(__FILE__));
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define('IMAGE_HOVER_WITH_CAROUSEL_HOME', 'https://www.oxilab.org'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of your product. This should match the download name in EDD exactly
define('IMAGE_HOVER_WITH_CAROUSEL', 'Image Hover with Carousel'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of the settings page for the license input to be displayed
define('IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE', 'image-hover-with-carousel-license');

add_shortcode('ihewc_oxi', 'ihewc_oxi_shortcode');

include image_hover_with_carousel_url . 'public-data.php';

function ihewc_oxi_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    ihewc_oxi_shortcode_function($styleid);
    return ob_get_clean();
}

add_action('admin_menu', 'image_hover_with_carousel_menu');

function image_hover_with_carousel_menu() {
    $user_role = get_option('image_hover_effects_with_carousel_user_role_key');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    add_menu_page('Image Hover', 'Image Hover', $first_key, 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'Image Hover', 'Image Hover', $first_key, 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'New Hover', 'New Hover', $first_key, 'image-hover-carousel-new', 'image_hover_with_carousel_new');
    add_submenu_page('image-hover-carousel', 'Settings', 'Settings', 'manage_options', IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE, 'image_hover_with_carousel_license_page');
}

function image_hover_effects_with_carousel_user_capabilities() {
    $user_role = get_option('image_hover_effects_with_carousel_user_role_key');
    $role_object = get_role($user_role);
    $first_key = '';
    if (isset($role_object->capabilities) && is_array($role_object->capabilities)) {
        reset($role_object->capabilities);
        $first_key = key($role_object->capabilities);
    } else {
        $first_key = 'manage_options';
    }
    if (!current_user_can($first_key)) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
}

function image_hover_with_carousel_home() {
    wp_enqueue_script('ihewc-vendor-bootstrap-jss', plugins_url('css-js/bootstrap.min.js', __FILE__));
    wp_enqueue_style('ihewc-vendor-bootstrap', plugins_url('css-js/bootstrap.min.css', __FILE__));
    wp_enqueue_style('ihewc-vendor-style', plugins_url('css-js/style.css', __FILE__));
    wp_enqueue_style('font-awesome', plugins_url('css-js/font-awesome.min.css', __FILE__));
    include image_hover_with_carousel_url . 'home.php';
}

function image_hover_with_carousel_new() {
    include image_hover_with_carousel_url . 'admin.php';
    ihewc_hover_admin_drag_drop();
    add_action('wp_print_scripts', 'ihewc_hover_admin_drag_drop');
}

function ihewc_hover_admin_drag_drop() {
    wp_enqueue_script('ihewc-hover-drap-drop', plugins_url('css-js/ihewc-drag.js', __FILE__));
    wp_localize_script('ihewc-hover-drap-drop', 'ihewc_hover_drag_drop_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

function ihewc_hover_admin_ajax_data() {
    check_ajax_referer('ihewc_ajax_data', 'security');
    $list_order = sanitize_text_field($_POST['list_order']);
    $list = explode(',', $list_order);
    global $wpdb;
    $table_list = $wpdb->prefix . 'image_hover_with_carousel_list';
    foreach ($list as $value) {
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $value), ARRAY_A);
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (title, files, buttom_text, link, image, css, styleid) VALUES ( %s, %s, %s, %s, %s, %s, %d)", array($data['title'], $data['files'], $data['buttom_text'], $data['link'], $data['image'], $data['css'], $data['styleid'])));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            die();
        }
        if ($redirect_id != 0) {
            $wpdb->query($wpdb->prepare("DELETE FROM $table_list WHERE id = %d", $value));
        }
    }
    die();
}

add_action('wp_ajax_ihewc_hover_admin_ajax_data', 'ihewc_hover_admin_ajax_data');

add_action('admin_head', 'add_image_hover_carousel_icons_styles');

function add_image_hover_carousel_icons_styles() {
    ?>
    <style>
        #adminmenu #toplevel_page_image-hover-carousel div.wp-menu-image:before {
            content: "\f115";
        }
    </style>

    <?php
}

register_activation_hook(__FILE__, 'image_hover_effects_with_carousel_install');

function image_hover_effects_with_carousel_install() {
    global $wpdb;
    global $image_hover_with_carousel_version;

    $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
    $table_list = $wpdb->prefix . 'image_hover_with_carousel_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		title varchar(100),
                files varchar(400),
                buttom_text varchar(100),
                link varchar(500),
                image varchar(300),
                css varchar(500),
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);

    add_option('image_hover_with_carousel_version', $image_hover_with_carousel_version);
    set_transient('_Ihewc_image_hover_welcome_activation_redirect', true, 30);
}

add_filter('widget_text', 'do_shortcode');
include image_hover_with_carousel_url . 'widget.php';

function ihewc_html_special_charecter($data) {
    $data = html_entity_decode($data);
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    return $data;
}

function ihewc_font_familly_special_charecter($data) {
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}

//Visual Composer Data
if (!function_exists('is_plugin_active')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
if (is_plugin_active('js_composer/js_composer.php')) {
    add_action('vc_before_init', 'ihewc_oxi_VC_extension');
    add_shortcode('ihewc_oxi_VC', 'ihewc_oxi_VC_shortcode');

    function ihewc_oxi_VC_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => ''
                        ), $atts));
        $styleid = $atts['id'];
        ob_start();
        ihewc_oxi_shortcode_function($styleid);
        return ob_get_clean();
    }

    function ihewc_oxi_VC_extension() {
        global $wpdb;
        $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'image_hover_with_carousel_style ORDER BY id DESC', ARRAY_A);
        $vcdata = array();
        foreach ($data as $value) {
            $vcdata[] = $value['id'];
        }
        vc_map(array(
            "name" => __("Image Hover with Carousel"),
            "base" => "ihewc_oxi_VC",
            "category" => __("Content"),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => "Image Hover Select",
                    "param_name" => "id",
                    "value" => $vcdata,
                    'save_always' => true,
                    "description" => "Select your Image Hover ID",
                    "group" => 'Settings',
                ),
            )
        ));
    }

}

add_action('admin_init', 'Ihewc_image_hover_welcome_activation_redirect');

function Ihewc_image_hover_welcome_activation_redirect() {
    if (!get_transient('_Ihewc_image_hover_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Ihewc_image_hover_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'Ihewc-image-hover-effects-welcome'), admin_url('index.php')));
}

add_action('admin_menu', 'ihewc_image_hover_welcome_pages');

function ihewc_image_hover_welcome_pages() {
    add_dashboard_page(
            'Welcome To Image Hover Effects - Caption Hover with Carousel', 'Welcome To Image Hover Effects - Caption Hover with Carousel', 'read', 'Ihewc-image-hover-effects-welcome', 'ihewc_image_hover_effects_welcome'
    );
}

function ihewc_image_hover_effects_welcome() {
    wp_enqueue_style('ihewc-image-welcome-style', plugins_url('css-js/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">

        <h1>Welcome to Image Hover Effects - Caption Hover with Carousel</h1>
        <div class="about-text">
            Thank you for choosing image Hover Effects with Carousel - the most friendly WordPress Image Hover plugin. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <p class="about-description">
            Use the tips below to get started using Image Hover Effects - Caption Hover with Carousel. You will be up and running in no time.	
        </p>
        <div class="feature-section">
            <h3>Creating Your First Hover Effects</h3>
            <p>Image Hover Effects makes it easy to create Hover Effects in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/" target="_blank" rel="noopener">create your first Hover effects guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url(); ?>admin.php?page=image-hover-carousel-new">Image Hover - &gt; New Effects</a>.				</p>
            </br>
            </br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/44L2Q6ahOtI" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all Image Hover Effects - Caption Hover with Carousel Features</h3>
            <p>Image Hover Effects - Caption Hover with Carousel is both easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Image Hover Effects.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/image-hover-with-carousel/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">See all Features</a></p>

        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on Image Hover Effects - Caption Hover with Carousel so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a></p>

        </div>

    </div>
    <?php
}

add_action('admin_head', 'ihewc_image_hover_welcome_screen_remove_menus');

function ihewc_image_hover_welcome_screen_remove_menus() {
    remove_submenu_page('index.php', 'Ihewc-image-hover-effects-welcome');
}

// load our custom updater
include( dirname(__FILE__) . '/Plugin_Updater.php' );

function image_hover_with_carousel_plugin_updater() {
    $license_key = trim(get_option('image_hover_with_carousel_license_key'));
    // retrieve our license key from the DB
    // setup the updater
    $image_hover_with_carousel_updater = new IMAGE_HOVER_WITH_CAROUSEL_Plugin_Updater(IMAGE_HOVER_WITH_CAROUSEL_HOME, __FILE__, array(
        'version' => '2.7', // current version number
        'license' => $license_key, // license key (used get_option above to retrieve from DB)
        'item_name' => IMAGE_HOVER_WITH_CAROUSEL, // name of this plugin
        'author' => 'Biplob Adhikari', // author of this plugin
        'beta' => false
            )
    );
}

$status = get_option('image_hover_with_carousel_license_status');
if ($status == 'valid') {
    add_action('admin_init', 'image_hover_with_carousel_plugin_updater', 0);
}

/* * **********************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 * *********************************** */

function image_hover_with_carousel_license_page() {
    $license = get_option('image_hover_with_carousel_license_key');
    $status = get_option('image_hover_with_carousel_license_status');
    global $wp_roles;
    $roles = $wp_roles->get_names();
    $saved_role = get_option('image_hover_effects_with_carousel_user_role_key');
    $saved_roe = get_option('image_hover_effects_with_carousel_mobile_device_key');
    ?>
    <div class="wrap">
        <?php if ($status !== false && $status == 'valid') { ?>
            <div class="updated">
                <p>Thank you to Active our Plugins. Kindly wait 2-3 minute to get update notification if you using free or older version. Once you get notification please update.</p>
            </div>
        <?php }
        ?>
        <h2><?php _e('User Role'); ?></h2>
        <p>Select User Role Who Can Save Edit and Delete Image Hover Effects - Caption Hover with Carousel Data.</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <?php settings_fields('image_hover_effects_with_carousel_user_role'); ?>
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('Who Can Edit?'); ?>
                        </th>
                        <td>
                            <select class="widefat" name="image_hover_effects_with_carousel_user_role_key">
                                <?php foreach ($roles as $key => $role) { ?>
                                    <option value="<?php echo $key; ?>" <?php selected($saved_role, $key); ?>><?php echo $role; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>                           
                            <label class="description" for="image_hover_effects_with_carousel_user_role"><?php _e('Select the Role who can manage Image Hover Effects - Caption Hover with Carousel.'); ?>
                                <a target="_blank" href="https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table">Help</a></label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
        <br>
        <br>
        <br>
        <h2><?php _e('Mobile or Touch Device Behaviour'); ?></h2>
        <p>Select Mobile or Touch Device Behaviour at Image Hover Effects - Caption Hover with Carousel Data.</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <?php settings_fields('image_hover_effects_with_carousel_mobile_device'); ?>
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('Select One'); ?>
                        </th>
                        <td>
                            <select class="widefat" name="image_hover_effects_with_carousel_mobile_device_key">                               
                                <option value="touch" <?php
                                if ($saved_roe == 'touch') {
                                    echo 'selected';
                                }
                                ?>>Effects First and 2nd Tap to link Open</option>
                                <option value="normal" <?php
                                if ($saved_roe == 'normal') {
                                    echo 'selected';
                                }
                                ?>>Click and Open Link</option>
                            </select>
                        </td>
                        <td>                           
                            <label class="description" for="image_hover_effects_with_carousel_mobile_device"><?php _e('Select option as Effects first with second tap to open link or works normally as click to open link.'); ?></label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
        <br>
        <br>
        <br>
        <h2><?php _e('Product License Activation'); ?></h2>
        <p>Activate your copy to get direct plugin updates and official support.</p>
        <form method="post" action="options.php">

            <?php settings_fields('image_hover_with_carousel_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e('License Key'); ?>
                        </th>
                        <td>
                            <input id="image_hover_with_carousel_license_key" name="image_hover_with_carousel_license_key" type="text" class="regular-text" value="<?php esc_attr_e($license); ?>" />
                            <label class="description" for="image_hover_with_carousel_license_key"><?php _e('Enter your license key'); ?></label>
                        </td>
                    </tr>
                    <?php if (!empty($license)) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activate License'); ?>
                            </th>
                            <td>
                                <?php if ($status !== false && $status == 'valid') { ?>
                                    <span style="color:green;"><?php _e('active'); ?></span>
                                    <?php wp_nonce_field('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'); ?>
                                    <input type="submit" class="button-secondary" name="image_hover_with_carousel_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                    <?php
                                } else {
                                    wp_nonce_field('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce');
                                    ?>
                                    <input type="submit" class="button-secondary" name="image_hover_with_carousel_license_activate" value="<?php _e('Activate License'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php submit_button(); ?>

        </form>
        <?php
    }

    function image_hover_effects_with_carousel_mobile_device_option() {
        // creates our settings in the options table
        register_setting('image_hover_effects_with_carousel_mobile_device', 'image_hover_effects_with_carousel_mobile_device_key');
    }

    add_action('admin_init', 'image_hover_effects_with_carousel_mobile_device_option');

    function image_hover_effects_with_carousel_user_role_option() {
        // creates our settings in the options table
        register_setting('image_hover_effects_with_carousel_user_role', 'image_hover_effects_with_carousel_user_role_key');
    }

    add_action('admin_init', 'image_hover_effects_with_carousel_user_role_option');

    function image_hover_with_carousel_register_option() {
        // creates our settings in the options table
        register_setting('image_hover_with_carousel_license', 'image_hover_with_carousel_license_key', 'image_hover_with_carousel_sanitize_license');
    }

    add_action('admin_init', 'image_hover_with_carousel_register_option');

    function image_hover_with_carousel_sanitize_license($new) {
        $old = get_option('image_hover_with_carousel_license_key');
        if ($old && $old != $new) {
            delete_option('image_hover_with_carousel_license_status'); // new license has been entered, so must reactivate
        }
        return $new;
    }

    /*     * **********************************
     * this illustrates how to activate
     * a license key
     * *********************************** */

    function image_hover_with_carousel_activate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['image_hover_with_carousel_license_activate'])) {

            // run a quick security check
            if (!check_admin_referer('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'))
                return; // get out if we didn't click the Activate button
// retrieve the license from the database
            $license = trim(get_option('image_hover_with_carousel_license_key'));


            // data to send in our API request
            $api_params = array(
                'edd_action' => 'activate_license',
                'license' => $license,
                'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL), // the name of our product in EDD
                'url' => home_url()
            );

            // Call the custom API.
            $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }
            } else {

                $license_data = json_decode(wp_remote_retrieve_body($response));

                if (false === $license_data->success) {

                    switch ($license_data->error) {

                        case 'expired' :

                            $message = sprintf(
                                    __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                            );
                            break;

                        case 'revoked' :

                            $message = __('Your license key has been disabled.');
                            break;

                        case 'missing' :

                            $message = __('Invalid license.');
                            break;

                        case 'invalid' :
                        case 'site_inactive' :

                            $message = __('Your license is not active for this URL.');
                            break;

                        case 'item_name_mismatch' :

                            $message = sprintf(__('This appears to be an invalid license key for %s.'), IMAGE_HOVER_WITH_CAROUSEL);
                            break;

                        case 'no_activations_left':

                            $message = __('Your license key has reached its activation limit.');
                            break;

                        default :

                            $message = __('An error occurred, please try again.');
                            break;
                    }
                }
            }

            // Check if anything passed on a message constituting a failure
            if (!empty($message)) {
                $base_url = admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // $license_data->license will be either "valid" or "invalid"

            update_option('image_hover_with_carousel_license_status', $license_data->license);
            wp_redirect(admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'image_hover_with_carousel_activate_license');


    /*     * *********************************************
     * Illustrates how to deactivate a license key.
     * This will decrease the site count
     * ********************************************* */

    function image_hover_with_carousel_deactivate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST['image_hover_with_carousel_license_deactivate'])) {

            // run a quick security check
            if (!check_admin_referer('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'))
                return; // get out if we didn't click the Activate button
// retrieve the license from the database
            $license = trim(get_option('image_hover_with_carousel_license_key'));
            // data to send in our API request
            $api_params = array(
                'edd_action' => 'deactivate_license',
                'license' => $license,
                'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL), // the name of our product in EDD
                'url' => home_url()
            );
            // Call the custom API.
            $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }

                $base_url = admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE);
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // decode the license data
            $license_data = json_decode(wp_remote_retrieve_body($response));

            // $license_data->license will be either "deactivated" or "failed"
            if ($license_data->license == 'deactivated') {
                delete_option('image_hover_with_carousel_license_status');
            }

            wp_redirect(admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE));
            exit();
        }
    }

    add_action('admin_init', 'image_hover_with_carousel_deactivate_license');


    /*     * **********************************
     * this illustrates how to check if
     * a license key is still valid
     * the updater does this for you,
     * so this is only needed if you
     * want to do something custom
     * *********************************** */

    function image_hover_with_carousel_check_license() {

        global $wp_version;

        $license = trim(get_option('image_hover_with_carousel_license_key'));

        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license,
            'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL),
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        if (is_wp_error($response))
            return false;

        $license_data = json_decode(wp_remote_retrieve_body($response));

        if ($license_data->license == 'valid') {
            echo 'valid';
            exit;
            // this license is still valid
        } else {
            echo 'invalid';
            exit;
            // this license is no longer valid
        }
    }

    /**
     * This is a means of catching errors from the activation method above and displaying it to the customer
     */
    function image_hover_with_carousel_admin_notices() {
        if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

            switch ($_GET['sl_activation']) {

                case 'false':
                    $message = urldecode($_GET['message']);
                    ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;

                case 'true':
                default:
                    // Developers can put a custom success message here for when activation is successful if they way.
                    break;
            }
        }
    }

    add_action('admin_notices', 'image_hover_with_carousel_admin_notices');

    function ihewc_video_toturial() {
        ?>
        <div class="ihewc-admin-style-settings-div-css">
            <div class="col-xs-12">                                           
                <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-file" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Read Our Docs
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Learn how to set up and using Image Hover Effects - Caption Hover with Carousel
                        </div> 
                    </div>
                </a>
                <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Support
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Powered by WordPress.org, Issues resolved by Plugins Author.
                        </div> 
                    </div>
                </a>
                <a href="https://www.youtube.com/watch?v=KUUgYzE3nqI" target="_blank">
                    <div class="col-xs-support-ihewc">
                        <div class="ihewc-admin-support-icon">
                            <i class="fas fa-ticket-alt" aria-hidden="true"></i>
                        </div>  
                        <div class="ihewc-admin-support-heading">
                            Video Tutorial 
                        </div> 
                        <div class="ihewc-admin-support-info">
                            Watch our Using Video Toturial in Youtube.
                        </div> 
                    </div>
                </a>
            </div>
        </div> 
        <?php
    }

    function ihewc_promote_free() {
        $status = get_option('image_hover_with_carousel_license_status');
        ?>
        <div class="oxilab-admin-notifications">
            <h3>
                <span class="dashicons dashicons-flag"></span> 
                Notifications
            </h3>
            <p></p>
            <div class="oxilab-admin-notifications-holder">
                <div class="oxilab-admin-notifications-alert">
                    <p>Thank you for using our Image Hover Effects - Caption Hover with Carousel. We Just wanted to see if you have any questions or concerns about our plugins. If you do, Please do not hesitate to <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel#new-post">file a bug report</a></p>
                    <?php
                    if ($status != 'valid') {
                        echo '<p> By the way, did you know we also have a <a href="https://www.oxilab.org/downloads/image-hover-with-carousel/">Premium Version</a>? It offers lots of options with automatic update. It also comes with 16/5 personal support.</p>';
                    }
                    ?>

                    <p>Sincerely,<br>
                        Oxilab Team</p>   
                    <p></p>
                </div>                     
            </div>
            <p></p>
        </div> 
        <p></p>
        <?php
    }

    function image_hover_effects_with_carousel_display_admin_notice() {

        // Review URL - Change to the URL of your plugin on WordPress.org
        $reviewurl = 'https://wordpress.org/support/plugin/image-hover-effects-with-carousel';

        $nobugurl = get_admin_url() . '?image_hover_effects_with_carousel_nobug=later';
        $nobugurl2 = get_admin_url() . '?image_hover_effects_with_carousel_nobug=already';

        echo '<div class="updated">';
        echo '<p></p>';

        printf(__('<p>Hey, You’ve using <strong>Image Hover Effects - Caption Hover with Carousel </strong> more than 1 week – that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.!
                     </p>
                    <p><a href=%s target="_blank"><strong>Ok, you deserve it</strong></a></p>
                    <p><a href=%s><strong>Nope, maybe later</strong></a> </p>
                    <p><a href=%s><strong>I already did</strong></a> </p>'), $reviewurl, $nobugurl, $nobugurl2);
        echo '<p></p>';
        echo "</div>";
    }
    
    function image_hover_effects_with_carousel_set_no_bug() {
        $nobug = "";
        if (isset($_GET['image_hover_effects_with_carousel_nobug'])) {
            $nobug = esc_attr($_GET['image_hover_effects_with_carousel_nobug']);
        }
        if ('already' == $nobug) {
            add_option('image_hover_effects_with_carousel_no_bug', $nobug);
        } elseif ('later' == $nobug) {
            $now = strtotime("now");
            update_option('image_hover_effects_with_carousel_activation_date', $now);
        }
    }

    add_action('admin_init', 'image_hover_effects_with_carousel_set_no_bug');

    function image_hover_effects_with_carousel_check_installation_date() {
        $nobug = "";
        $nobug = get_option('image_hover_effects_with_carousel_no_bug');
        $past_date = strtotime('-7 days');
        if ($nobug != 'already') {
            $install_date = get_option('image_hover_effects_with_carousel_activation_date');
            if (empty($install_date)) {
                $now = strtotime("now");
                add_option('image_hover_effects_with_carousel_activation_date', $now);
            } elseif ($past_date >= $install_date) {
                add_action('admin_notices', 'image_hover_effects_with_carousel_display_admin_notice');
            }
        }
    }

    add_action('admin_init', 'image_hover_effects_with_carousel_check_installation_date');
