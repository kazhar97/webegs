<?php

function ihewc_oxi_shortcode_function($styleid) {
    $styleid = (int) $styleid;
    global $wpdb;
    $table_list = $wpdb->prefix . 'image_hover_with_carousel_list';
    $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
    $listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    $styledata = explode('|', $styledata['css']);
    ihewc_oxi_shortcode_effects($styleid, 'no', $styledata, $listdata);
}

function ihewc_oxi_shortcode_effects($styleid, $admin, $styledata, $listdata) {
    $saved_roe = get_option('image_hover_effects_with_carousel_mobile_device_key');
    wp_enqueue_style('ihewc-style', plugins_url('public/style.css', __FILE__));
    wp_enqueue_style('' . $styledata[19] . '', 'https://fonts.googleapis.com/css?family=' . $styledata[19] . '');
    wp_enqueue_style('' . $styledata[29] . '', 'https://fonts.googleapis.com/css?family=' . $styledata[29] . '');
    wp_enqueue_style('' . $styledata[37] . '', 'https://fonts.googleapis.com/css?family=' . $styledata[37] . '');
    if ($saved_roe != 'normal') {
        wp_enqueue_style('oxilab-animation', plugins_url('public/animation.css', __FILE__));
        wp_enqueue_script('oxilab-animation-js', plugins_url('public/animation.js', __FILE__));
        wp_add_inline_script('oxilab-animation-js', 'jQuery(\'.oxilab-touchstart\').on(\'touchstart\', function (e) {
                                "use strict";
                                var link = jQuery(this);
                                if (link.hasClass("oxi-touch")) {
                                    return true;
                                } else {
                                    jQuery(".oxilab-touchstart").removeClass("oxi-touch");
                                    link.addClass("oxi-touch");
                                    e.preventDefault();
                                    return false;
                                }
                            })');
    }
    $heading_underline = '';
    $ihewcshowingtype = '';
    if ($styledata[5] == '') {
        $ihewcitem = $styledata[3];
    } elseif ($styledata[5] == 'carousel') {
        $ihewcitem = 'ihewc-hover-responsive-owl';
        $ihewcshowingtype = 'ihewc-hover-carousel-' . $styleid . ' ihewc-hover-carousel';
    }
    if ($styledata[23] == 'yes') {
        $heading_underline = 'border-bottom: 1px solid;';
    }
    echo '<style>
                            .ihewc-hover-padding-' . $styleid . '{
                                padding: ' . $styledata[49] . 'px;
                            }
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-image:after{
                                padding-bottom: ' . $styledata[7] . '%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-' . $styleid . '.orphita-animation{
                               -webkit-animation-duration:' . $styledata[57] . 's;
                               animation-duration:' . $styledata[57] . 's;
                               -webkit-animation-fill-mode:both;
                               animation-fill-mode:both
                             }
                            .ihewc-hover-' . $styleid . ',
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-figure,
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-image,
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-image img,  
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-figure .ihewc-hover-figure-caption,
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-figure .ihewc-hover-figure-caption-content {
                                border-radius:' . $styledata[1] . '%;
                            }
                            .ihewc-hover-' . $styleid . '{
                                box-shadow: 0 0 ' . $styledata[13] . 'px ' . $styledata[15] . ';
                            }
                            .ihewc-hover-' . $styleid . ' h3{
                                font-size:' . $styledata[17] . 'px;
                                font-weight:' . $styledata[21] . ';
                                margin-bottom:' . $styledata[25] . 'px;
                                line-height: 120%;
                                font-family: ' . ihewc_font_familly_special_charecter($styledata[19]) . ';
                                padding-bottom: 0px;
                                margin-top:0px;
                                display: inline-block;
                                ' . $heading_underline . '
                            }
                            .ihewc-hover-' . $styleid . ' p{
                                font-size:' . $styledata[27] . 'px;
                                font-weight: ' . $styledata[31] . ';
                                margin-top: 0px;
                                margin-bottom: ' . $styledata[33] . 'px !important;
                                line-height: 120%;
                                font-family: ' . ihewc_font_familly_special_charecter($styledata[29]) . ';
                            }
                            .ihewc-hover-' . $styleid . '  .img-btn, .ihewc-hover-' . $styleid . ' .img-btn:hover, .ihewc-hover-' . $styleid . ' .img-btn:focus, .ihewc-hover-' . $styleid . ' .img-btn:active {
                               padding: ' . $styledata[41] . 'px ' . $styledata[43] . 'px;
                                -webkit-border-radius: ' . $styledata[45] . 'px;
                                -moz-border-radius: ' . $styledata[45] . 'px;
                                border-radius: ' . $styledata[45] . 'px;
                                font-weight: ' . $styledata[39] . ';
                                font-size: ' . $styledata[35] . 'px;
                                font-family: ' . ihewc_font_familly_special_charecter($styledata[37]) . ';
                               
                            }
                            .ihewc-hover-' . $styleid . '  .img-link {
                                font-weight: ' . $styledata[39] . ';
                                font-size: ' . $styledata[35] . 'px;
                                font-family: ' . ihewc_font_familly_special_charecter($styledata[37]) . ';
                            }
                            .ihewc-hover-' . $styleid . ' .ihewc-hover-figure-caption{
                                padding: ' . $styledata[9] . 'px;
                            }
                            ' . $styledata[47] . '
                        </style>';

    echo '<div class="ihewc-container">';
    echo '<div class="ihewc-row ' . $ihewcshowingtype . '">';
    foreach ($listdata as $value) {
        $valuecss = explode('|', $value['css']);
        wp_enqueue_style('ihewc-' . $valuecss[21] . '', plugins_url('public/style-' . $valuecss[21] . '.css', __FILE__));
        if ($value['link'] === '') {
            $valueurl1st = '';
            $valueurlbtn = '';
            $valueurllast = '';
        }
        if ($value['link'] !== '' && $value['buttom_text'] === '') {
            $valueurl1st = '<a href="' . $value['link'] . '" target="' . $styledata[11] . '" style="width: 100%;float: left;">';
            $valueurlbtn = '';
            $valueurllast = '</a>';
        }
        if ($value['link'] !== '' && $value['buttom_text'] !== '') {
            $valueurl1st = '';
            $valueurlbtn = '<a href="' . $value['link'] . '"  target="' . $styledata[11] . '" class="img-btn ' . $valuecss[17] . ' ihewc-delay-sm">' . ihewc_html_special_charecter($value['buttom_text']) . '</a>';
            $valueurllast = '';
        }
        if ($admin == 'yes') {
            $adminabsulute = 'ihewc-editing';
        } else {
            $adminabsulute = '';
        }
        echo ' <div class="' . $ihewcitem . ' ihewc-hover-padding-' . $styleid . ' ' . $adminabsulute . '" >
                                        <div orphita-animation="' . $styledata[55] . '" class="ihewc-hover ihewc-hover-' . $styleid . ' ihewc-hover-' . $styleid . '-' . $value['id'] . ' ' . $valuecss[1] . ' animated-hover-' . $styleid . ' orphita-animation">
                                            <div class="ihewc-hover-figure">
                                            ' . $valueurl1st . '
                                                <div class="ihewc-hover-image">
                                                    <img src="' . $value['image'] . '">
                                                </div>
                                                <div class="ihewc-hover-figure-caption">
                                                    <div class="ihewc-hover-figure-caption-table">
                                                        <div class="ihewc-hover-figure-caption-content ' . $valuecss[5] . '">
                                                            <h3  class="' . $valuecss[9] . ' ihewc-delay-sm">' . ihewc_html_special_charecter($value['title']) . '</h3>
                                                            <p class="' . $valuecss[13] . ' ihewc-delay-sm">' . ihewc_html_special_charecter($value['files']) . '</p>
                                                             ' . $valueurlbtn . '
                                                        </div>  
                                                    </div>
                                                </div>
                                              ' . $valueurllast . '  
                                            </div>';

        echo ' <style>';
        $stylename = $valuecss[21];


        if ($stylename == 'reveal-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
        else if ($stylename == 'slide-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
        else if ($stylename == 'push-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'fade-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption{
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'hinge-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'flip-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'shutter-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'fold-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'zoom-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'block-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'strip-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'pixel-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'pivot-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'throw-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'blinds-effects') {
            echo '   .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'border-reveal-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'rotate-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'book-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'circle-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'shift-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'bounce-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'fall-away-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'modal-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'lightspeed-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'parallax-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'stack-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'cube-effects') {
            echo '.ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption{
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'dive-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption{
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'switch-effects') {
            echo '.ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption{
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'splash-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'flash-effects') {
            echo ' .ihewc-hover-' . $styleid . '-' . $value['id'] . ',
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ':after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure:after,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:before,
                    .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption:after {
                        background-color: ' . $valuecss[3] . ';
            }';
        }
         else if ($stylename == 'blur-effects') {
            echo '.ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption{
                        background-color: ' . $valuecss[3] . ';
            }';
        }
        if ($stylename == 'gradient-effects') {
            echo '.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-radial-in:before {background-image: -webkit-radial-gradient(transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-radial-gradient(transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -o-radial-gradient(transparent 0%, ' . $valuecss[3] . ' 100%);background-image: radial-gradient(transparent 0%, ' . $valuecss[3] . ' 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-radial-out:before {background-image: -webkit-radial-gradient(' . $valuecss[3] . ' 0%, transparent 100%);background-image: -moz-radial-gradient(' . $valuecss[3] . ' 0%, transparent 100%);background-image: -o-radial-gradient(' . $valuecss[3] . ' 0%, transparent 100%);background-image: radial-gradient(' . $valuecss[3] . ' 0%, transparent 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-up:before {background-image: -webkit-linear-gradient( top , transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -webkit-gradient(linear, left top, left bottom, from(transparent), to(' . $valuecss[3] . '));background-image: -webkit-linear-gradient(top, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(top, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -o-linear-gradient(top, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: linear-gradient(to bottom, transparent 0%, ' . $valuecss[3] . ' 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-down:before {background-image: -webkit-linear-gradient( bottom , transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -webkit-gradient(linear, left bottom, left top, from(transparent), to(' . $valuecss[3] . '));background-image: -webkit-linear-gradient(bottom, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(bottom, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -o-linear-gradient(bottom, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: linear-gradient(to top, transparent 0%, ' . $valuecss[3] . ' 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-left:before {background-image: -webkit-linear-gradient( left , transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -webkit-gradient(linear, left top, right top, from(transparent), to(' . $valuecss[3] . '));background-image: -webkit-linear-gradient(left, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(left, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -o-linear-gradient(left, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: linear-gradient(to right, transparent 0%, ' . $valuecss[3] . ' 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-right:before {background-image: -webkit-linear-gradient( right , transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -webkit-gradient(linear, right top, left top, from(transparent), to(' . $valuecss[3] . '));background-image: -webkit-linear-gradient(right, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(right, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -o-linear-gradient(right, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: linear-gradient(to left, transparent 0%, ' . $valuecss[3] . ' 100%);}.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-top-left:before {background-image: -webkit-linear-gradient(-45deg, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -webkit-linear-gradient(135deg, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(135deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -o-linear-gradient(135deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: linear-gradient(-45deg, transparent 0%, ' . $valuecss[3] . ' 100%);} .ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-top-right:before { background-image: -webkit-linear-gradient(-315deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -webkit-linear-gradient(45deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -moz-linear-gradient(45deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -o-linear-gradient(45deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: linear-gradient(45deg, transparent 0%, ' . $valuecss[3] . ' 100%);} .ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-bottom-left:before { background-image: -webkit-linear-gradient(-135deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -webkit-linear-gradient(225deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -moz-linear-gradient(225deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -o-linear-gradient(225deg, transparent 0%, ' . $valuecss[3] . ' 100%);  background-image: linear-gradient(-135deg, transparent 0%, ' . $valuecss[3] . ' 100%);  }.ihewc-hover-' . $styleid . '-' . $value['id'] . '.ihewc-gradient-bottom-right:before {background-image: -webkit-linear-gradient(-405deg, transparent 0%, ' . $valuecss[3] . ' 100%);  background-image: -webkit-linear-gradient(315deg, transparent 0%, ' . $valuecss[3] . ' 100%);background-image: -moz-linear-gradient(315deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: -o-linear-gradient(315deg, transparent 0%, ' . $valuecss[3] . ' 100%); background-image: linear-gradient(135deg, transparent 0%, ' . $valuecss[3] . ' 100%);}';
        }
        echo '.ihewc-hover-' . $styleid . '-' . $value['id'] . ' h3{
                    color: ' . $valuecss[7] . '!important;
                }
                .ihewc-hover-' . $styleid . '-' . $value['id'] . ' p{
                    color: ' . $valuecss[11] . '!important;
                }
                .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption-content a.img-btn{
                    background: ' . $valuecss[19] . '!important;
                }
                .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption-content a.img-btn,
                .ihewc-hover-' . $styleid . '-' . $value['id'] . ' .ihewc-hover-figure-caption-content a.img-link{
                    color: ' . $valuecss[15] . '; }
                </style>';

        echo '</div>';
        if ($admin == 'yes') {
            echo '   <div class="ihewc-admin-absulote">'
            . '<div class="ihewc-style-absulate-edit">'
            . '<form method="post">  ' . wp_nonce_field("ihewceditdata") . ''
            . '<input type="hidden" name="item-id" value="' . $value['id'] . '"> '
            . '<button class="btn btn-primary" type="submit" value="edit" name="edit"  title="Edit">'
            . 'Edit'
            . '</button>'
            . '</form>'
            . '</div> '
            . '<div class="ihewc-style-absulate-delete">'
            . '<form method="post"> ' . wp_nonce_field("ihewcdeletedata") . ''
            . '<input type="hidden" name="item-id" value="' . $value['id'] . '"> '
            . '<button class="btn btn-danger" type="submit" value="delete" name="delete"  title="Delete">'
            . 'Delete'
            . '</button> '
            . ' </form>'
            . '</div> '
            . '</div>';
        }
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    ihewc_ultimate_oxi_shortcode_general_carousel($styledata, $styleid);
}

function ihewc_ultimate_oxi_shortcode_general_carousel($styledata, $styleid) {
    if ($styledata[5] == 'carousel') {
        wp_enqueue_script('oxilab-carousel', plugins_url('public/owl.carousel.min.js', __FILE__));
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-1') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 1}, 1000: { items: 1 }},';
        }
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-2') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 1}, 1000: { items: 2 }},';
        }
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-3') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 2}, 1000: { items: 3 }},';
        }
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-4') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 2}, 1000: { items: 4 }},';
        }
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-5') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 5}, 1000: { items: 5 }},';
        }
        if ($styledata[5] == 'carousel' && $styledata[3] == 'ihewc-responsive-6') {
            $ihewcresponsive = ' responsive: { 0: {items: 1 }, 600: { items: 3}, 1000: { items: 6 }},';
        }
        if ($styledata[51] == 'false' || $styledata[51] == 'true') {
            $ihewcautoplay = ' autoplay: ' . $styledata[51] . ',  autoplayTimeout: ' . $styledata[53] . ',';
        }

        wp_add_inline_script('oxilab-carousel', 'jQuery(".ihewc-hover-carousel-' . $styleid . '").OxiowlCarousel({
                                                            loop: true,
                                                            margin: 0,
                                                            ' . $ihewcautoplay . '
                                                            ' . $ihewcresponsive . '
                                                            nav:false,
                                                            dots:true,                                                           
                                                        });');
    }
}
