<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style12($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
        <div class="ctu-ulimate-style-' . $styleid . ' ' . $styledata[75] . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
     $jquery = $linkopening = '';
    if (!empty($styledata[83]) || $styledata[83] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo ' <div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                    ' . ctu_html_special_charecter($titlefiles[0]) . '
                   <div class="ctu-absolute"></div>
               </div>';
    }
    echo '</div>';
    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo '<div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
    if (empty($styledata[79])) {
        $initialopen = ':first';
    } else if ($styledata[79] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[79];
    }
    if (empty($styledata[81])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[81] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[81] == 'show') {
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
            width: calc(100% - ' . $styledata[39] . '%);
            float: left;
            list-style: none;
            margin-bottom: 0;
        }

        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
            width: calc(100% - 10px);
            position: relative;
            list-style: none;
            cursor: pointer;
            max-width: ' . $styledata[15] . 'px;
            display: block;
            margin-left:0;
            margin-bottom: ' . $styledata[19] . 'px;                
            padding: ' . $styledata[17] . 'px 15px;
            text-align: left;
            text-align: ' . $styledata[77] . ';
            color: ' . $styledata[3] . ';
            font-size: ' . $styledata[1] . 'px;
            font-family:    ' . ctu_font_familly_special_charecter($styledata[11]) . ';
            font-weight: ' . $styledata[13] . ';
            background-color: ' . $styledata[5] . ';
            line-height: 100%;
            font-style: ' . $styledata[59] . ';
            -webkit-box-shadow: ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -o-box-shadow:  ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -ms-box-shadow:  ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -moz-box-shadow: ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            box-shadow:   ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
            color: ' . $styledata[7] . ';
            background-color:  ' . $styledata[9] . ';
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            top: ' . ( ($styledata[17] * 2 + $styledata[1] - 20) / 2) . 'px;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-left: 10px solid ' . $styledata[9] . ';
            border-bottom: 10px solid transparent;

        }

        .ctu-ulimate-style-' . $styleid . '.ctu-right{
            float: right;
        }
        .ctu-ulimate-style-' . $styleid . '.ctu-right  .vc-tabs-li{
            float: right;
        }
        .ctu-ulimate-style-' . $styleid . '.ctu-right .vc-tabs-li.active .ctu-absolute{
            position: absolute;
            top: ' . (($styledata[17] * 2 + $styledata[1] - 20) / 2) . 'px;
            left: -10px;
            right: auto;
            width: 0;
            height: 0;
            border-left: none;
            border-top: 10px solid transparent;
            border-right: 10px solid ' . $styledata[9] . ';
            border-bottom: 10px solid transparent;
        }
        .ctu-ultimate-style-' . $styleid . '-content{
            width: ' . $styledata[39] . '%;
            float: left;
        }
        .ctu-ultimate-style-heading-' . $styleid . '{
            width: 100%;
            float: left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            color: ' . $styledata[3] . ';
            background-color: ' . $styledata[5] . ';
            font-size: ' . $styledata[1] . 'px;
            padding: ' . $styledata[17] . 'px 15px;
            font-weight: ' . $styledata[13] . ';
            font-style: ' . $styledata[59] . ';
            font-family:  ' . ctu_font_familly_special_charecter($styledata[11]) . ';
            -webkit-box-shadow:    ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -o-box-shadow:   ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -ms-box-shadow:   ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            -moz-box-shadow:   ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            box-shadow:   ' . $styledata[67] . 'px ' . $styledata[69] . 'px ' . $styledata[21] . 'px ' . $styledata[71] . 'px ' . $styledata[23] . ';
            border-radius: 5px;
        }
        .ctu-ultimate-style-heading-' . $styleid . '.active{
            color: ' . $styledata[7] . ';
            background-color: ' . $styledata[9] . ';
            border-radius: 5px 5px 0 0;
        }
        .ctu-ulitate-style-' . $styleid . '-tabs{
            display: none;
            float: left;
            width: 100%;            
            border: ' . $styledata[49] . 'px solid;
            border-color: ' . $styledata[51] . ';            
            border-radius: ' . $styledata[57] . 'px;
            background-color: ' . $styledata[29] . ';
            font-weight: ' . $styledata[45] . ';            
            text-align: ' . $styledata[47] . ';
            padding: ' . $styledata[31] . 'px ' . $styledata[33] . 'px ' . $styledata[35] . 'px ' . $styledata[37] . 'px ;
            -webkit-box-shadow: ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[21] . 'px ' . $styledata[65] . 'px ' . $styledata[55] . ';
            -o-box-shadow:  ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[21] . 'px ' . $styledata[65] . 'px ' . $styledata[55] . ';
            -ms-box-shadow: ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[21] . 'px ' . $styledata[65] . 'px ' . $styledata[55] . ';
            -moz-box-shadow:   ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[21] . 'px ' . $styledata[65] . 'px ' . $styledata[55] . ';
            box-shadow:   ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[21] . 'px ' . $styledata[65] . 'px ' . $styledata[55] . ';
        }
        .ctu-ulitate-style-' . $styleid . '-tabs p{
            font-size: ' . $styledata[25] . 'px;
            color: ' . $styledata[27] . ';
            line-height: ' . $styledata[41] . ';
            font-family:  ' . ctu_font_familly_special_charecter($styledata[43]) . ';
            margin-top:0;
            margin-bottom: 0;
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
                border-radius: 0 0 5px 5px;
                -webkit-box-shadow:   0 0 3px ' . $styledata[55] . ';
                -o-box-shadow:   0 0 3px ' . $styledata[55] . ';
                -ms-box-shadow:   0 0 3px ' . $styledata[55] . ';
                -moz-box-shadow:   0 0 3px ' . $styledata[55] . ';
                box-shadow:   0 0 3px ' . $styledata[55] . ';
            }
        }
        ' . $styledata[73] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
