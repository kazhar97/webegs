<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style14($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
            <div class="ctu-ulimate-style-' . $styleid . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[77]) || $styledata[77] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                    ' . ctu_icon_font_selector($value['css']) . '
                    ' . ctu_html_special_charecter($titlefiles[0]) . '
                    <div class="ctu-absolute"></div>
                 </div>';
    }
    echo '</div>';
    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo ' <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                        ' . ctu_icon_font_selector($value['css']) . '
                              ' . ctu_html_special_charecter($titlefiles[0]) . '
                      </div>
               <div class="ctu-ulitate-style-' . $styleid . '-tabs ' . $adminclass . '" id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                      ' . ctu_html_special_charecter($value['files']) . '';
        if ($userdata == 'admin') {
            ?>
            <div class="oxilab-admin-absulote">
                <div class="oxilab-style-absulate-edit">
                    <form method="post"> 
                        <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                        <button class="btn btn-primary" type="submit" value="edit" name="edit" title="Edit">Edit</button>
                        <?php echo wp_nonce_field("oxitabseditdata"); ?>
                    </form>
                </div>
                <div class="oxilab-style-absulate-delete">
                    <form method="post">
                        <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                        <button class="btn btn-danger" type="submit" value="delete" name="delete" title="Delete">Delete</button>
                        <?php echo wp_nonce_field("oxitabsdeletedata"); ?>
                    </form>
                </div>
            </div>
            <?php
        }
        echo '</div> ';
    }
    echo '</div> </div>';
    if (empty($styledata[73])) {
        $initialopen = ':first';
    } else if ($styledata[73] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[73];
    }
    if (empty($styledata[75])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[75] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[75] == 'show') {
        $animationin = 'show';
        $animationout = 'hide';
    } else {
        $animationin = 'fadeIn';
        $animationout = 'fadeOut';
    }

    $jquery .= 'jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li' . $initialopen . '").addClass("active");
                    jQuery(".ctu-ultimate-style-heading-' . $styleid . '' . $initialopen . '").addClass("active");
                    jQuery(".ctu-ulitate-style-' . $styleid . '-tabs' . $initialopen . '").' . $animationin . '();
                    jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").click(function () {
                        if (jQuery(this).hasClass("active")) {
                            return false;
                        } else {
                            jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").removeClass("active");
                            jQuery(this).toggleClass("active");
                            jQuery(".ctu-ulitate-style-' . $styleid . '-tabs").' . $animationout . '("slow");
                            var activeTab = jQuery(this).attr("ref");
                            jQuery(activeTab).' . $animationin . '("slow");
                        }
                    });
                    jQuery(".ctu-ultimate-style-heading-' . $styleid . '").click(function () {
                        if (jQuery(this).hasClass("active")) {
                            return false;
                        } else {
                            jQuery(".ctu-ultimate-style-heading-' . $styleid . '").removeClass("active");
                            jQuery(this).toggleClass("active");
                            jQuery(".ctu-ulitate-style-' . $styleid . '-tabs").' . $animationout . '("slow");
                            var activeTab = jQuery(this).attr("ref");
                            jQuery(activeTab).' . $animationin . '("slow");
                            var headerheight = ' . $oxi_fixed_header . ';
                            jQuery("html, body").animate({
                                scrollTop: jQuery(".ctu-ultimate-wrapper-' . $styleid . '").offset().top - headerheight
                            }, 2000);
                        }
                    });';
    $css = '.ctu-ultimate-wrapper-' . $styleid . '{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-' . $styleid . '{
            margin: 0 0 0 0;
            width: 100%;
            float: left;
            list-style: none;
            text-align: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            -webkit-box-pack: ' . $styledata[13] . ';
            -ms-flex-pack: ' . $styledata[13] . ';
            -o-flex-pack: ' . $styledata[13] . ';
            -moz-flex-pack: ' . $styledata[13] . ';
            justify-content: ' . $styledata[13] . ';
            margin-bottom: ' . $styledata[21] . 'px;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
            width: 100%;
            float: left;
            position: relative;
            display: flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            align-items:   center;
            list-style: none;
            cursor: pointer;
            max-width: ' . $styledata[15] . 'px;
            margin-bottom: 0;
            padding: ' . $styledata[17] . 'px 12px;
            text-align: center;
            color: ' . $styledata[3] . ';
            font-size: ' . $styledata[1] . 'px;
            font-family:    ' . ctu_font_familly_special_charecter($styledata[9]) . ';
            font-weight: ' . $styledata[11] . ';
            font-style: ' . $styledata[57] . ';
            line-height: 100%;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
            color: ' . $styledata[5] . ';
            background-color:  ' . $styledata[7] . ';
            border-radius: ' . $styledata[23] . 'px;
            -webkit-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -o-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -ms-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -moz-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li .oxi-icons{
            padding-right: 8px !important;
            font-size: ' . $styledata[19] . 'px !important;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid ' . $styledata[7] . ';

        }
        .ctu-ultimate-style-' . $styleid . '-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-' . $styleid . '{
            width: 100%;
            float: left;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            -webkit-box-align:   center;
            -ms-flex-align:   center;
            -o-flex-align:   center;
            -moz-flex-align:   center;
            align-items:   center;
            cursor: pointer;
            display: none;
            line-height: 100%;            
            font-size: ' . $styledata[1] . 'px;
            padding:' . $styledata[17] . 'px 10px;
            font-weight: ' . $styledata[11] . ';
            font-family:  ' . ctu_font_familly_special_charecter($styledata[9]) . ';
            border-radius: 5px;
            -webkit-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -o-box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -moz-box-shadow:' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            -ms-box-shadow:' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
            box-shadow: ' . $styledata[65] . 'px ' . $styledata[67] . 'px ' . $styledata[25] . 'px ' . $styledata[69] . 'px ' . $styledata[27] . ';
        }
        .ctu-ultimate-style-heading-' . $styleid . '.active{
            color: ' . $styledata[5] . ';
            background-color: ' . $styledata[7] . ';
        }
        .ctu-ultimate-style-heading-' . $styleid . ' i{
            font-size: ' . $styledata[19] . 'px !important;
        }
        .ctu-ulitate-style-' . $styleid . '-tabs{
            width: 100%;
            float: left;
            display: none;  
            background-color: ' . $styledata[33] . ';
            font-weight: ' . $styledata[47] . ';            
            padding: ' . $styledata[35] . 'px ' . $styledata[37] . 'px ' . $styledata[39] . 'px ' . $styledata[41] . 'px;
            border-radius: ' . $styledata[51] . 'px;    
            -webkit-box-shadow:  ' . $styledata[59] . 'px ' . $styledata[61] . 'px ' . $styledata[53] . 'px ' . $styledata[63] . 'px ' . $styledata[55] . ';   
            -o-box-shadow:  ' . $styledata[59] . 'px ' . $styledata[61] . 'px ' . $styledata[53] . 'px ' . $styledata[63] . 'px ' . $styledata[55] . ';
            -ms-box-shadow:  ' . $styledata[59] . 'px ' . $styledata[61] . 'px ' . $styledata[53] . 'px ' . $styledata[63] . 'px ' . $styledata[55] . ';
            -moz-box-shadow:  ' . $styledata[59] . 'px ' . $styledata[61] . 'px ' . $styledata[53] . 'px ' . $styledata[63] . 'px ' . $styledata[55] . '; 
            box-shadow: ' . $styledata[59] . 'px ' . $styledata[61] . 'px ' . $styledata[53] . 'px ' . $styledata[63] . 'px ' . $styledata[55] . ';
        }
        .ctu-ulitate-style-' . $styleid . '-tabs p{
            font-size: ' . $styledata[29] . 'px;
            color: ' . $styledata[31] . ';
            line-height: ' . $styledata[43] . ';
            font-family:' . ctu_font_familly_special_charecter($styledata[45]) . ';
            text-align:' . $styledata[49] . ';
            margin-bottom:0;
            margin-top:0;
        }
        @media only screen and (max-width: 900px) {

            .ctu-ultimate-style-' . $styleid . '-content{
                width: 100%;
            }
            .ctu-ulimate-style-' . $styleid . ' {
                display: none;
            }
            .ctu-ultimate-style-heading-' . $styleid . '{
                display: block;
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-' . $styleid . '-tabs{
                margin-bottom: 10px;

            }

        }
        ' . $styledata[71] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
