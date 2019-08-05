<?php

if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function($styleid, $userdata) {
    $styleid = (int) $styleid;
    global $wpdb;
    $table_name = $wpdb->prefix . 'content_tabs_ultimate_style';
    $table_list = $wpdb->prefix . 'content_tabs_ultimate_list';
    $listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    if (is_array($styledata)) {
        $stylename = $styledata['style_name'];
        $styledata = $styledata['css'];
        $styledata = explode('|', $styledata);
        wp_enqueue_script("jquery");
        wp_enqueue_style('oxi-responsive-tabs', plugins_url('public/style.css', __FILE__));
        wp_enqueue_script('oxi-responsive-tabs', plugins_url('public/tabs.js', __FILE__));
        include_once content_tabs_ultimate_plugin_url . 'public/' . $stylename . '.php';
        $stylefunctionmane = 'oxi_responsive_tabs_shortcode_function_' . $stylename . '';
        echo '<div class="oxi-addons-container">';
        $stylefunctionmane($styleid, $userdata, $styledata, $listdata);
        echo '</div>';
    }
}
