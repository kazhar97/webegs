<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style10($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    $jquery = $linkopening = '';
    if (!empty($styledata[75]) || $styledata[75] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
             <div class="ctu-ulimate-style-' . $styleid . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $index = 1;
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                <em>' . $index++ . '</em>
                                ' . ctu_html_special_charecter($titlefiles[0]) . '
                                    <span></span>
                            </div>';
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
    }
    echo '</div>';
    $index = 1;
    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo '  <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                     <em>' . $index++ . '</em> ' . ctu_html_special_charecter($titlefiles[0]) . '
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
    if (empty($styledata[77])) {
        $initialopen = ':first';
    } else if ($styledata[77] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[77];
    }
    if (empty($styledata[79])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[79] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[79] == 'show') {
        $animationin = 'show';
        $animationout = 'hide';
    } else {
        $animationin = 'fadeIn';
        $animationout = 'fadeOut';
    }

    $jquery .= 'jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li' . $initialopen . '").addClass("active");
                    jQuery(".ctu-ultimate-style-heading-' . $styleid . '' . $initialopen . '").addClass("active");
                    jQuery(".ctu-ulitate-style-' . $styleid . '-tabs' . $initialopen . '").' . $animationin . '("slow");
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
            width: calc(' . (100 - $styledata[35]) . '% + ' . $styledata[25] . 'px);
            float: left;
            list-style: none;
            text-align: center;
            margin-bottom: 0;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
            width:  calc(100% - ' . $styledata[25] . 'px);
            position: relative;
            list-style: none;
            cursor: pointer;
            max-width: ' . $styledata[13] . 'px;
            display: block;
            padding-left: 10px;
            margin-bottom: 0;
            padding-top: ' . $styledata[17] . 'px;
            padding-bottom:' . $styledata[17] . 'px;
            text-align: left;
            color: ' . $styledata[3] . ';
            border-left: 5px solid;
            border-left-color: transparent; 
            font-size: ' . $styledata[1] . 'px;
            font-family:    ' . ctu_font_familly_special_charecter($styledata[9]) . ';
            font-weight: ' . $styledata[11] . ';
            line-height: 100%;

        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
            color: ' . $styledata[5] . ';
            border-left-color: ' . $styledata[5] . ';
            background-color: ' . $styledata[7] . ';
            border-radius:  5px 0 0 5px;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li em{
            display: inline-block;
            float: left;
            margin-right: 10px;
            background: ' . $styledata[23] . ';
            text-align: center;
            height: ' . $styledata[1] . 'px;
            width: ' . $styledata[1] . 'px;
            border-radius: 50%;
            font-style: normal;
            font-size: ' . $styledata[19] . 'px;
            color: ' . $styledata[21] . ';
            line-height: ' . $styledata[1] . 'px;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
            border-color:  ' . $styledata[5] . ';
            -webkit-box-shadow:    ' . $styledata[69] . 'px ' . $styledata[71] . 'px ' . $styledata[65] . 'px ' . $styledata[73] . 'px ' . $styledata[67] . ';
            -o-box-shadow:    ' . $styledata[69] . 'px ' . $styledata[71] . 'px ' . $styledata[65] . 'px ' . $styledata[73] . 'px ' . $styledata[67] . ';
            -ms-box-shadow:    ' . $styledata[69] . 'px ' . $styledata[71] . 'px ' . $styledata[65] . 'px ' . $styledata[73] . 'px ' . $styledata[67] . ';
            -moz-box-shadow:    ' . $styledata[69] . 'px ' . $styledata[71] . 'px ' . $styledata[65] . 'px ' . $styledata[73] . 'px ' . $styledata[67] . ';
            box-shadow:   ' . $styledata[69] . 'px ' . $styledata[71] . 'px ' . $styledata[65] . 'px ' . $styledata[73] . 'px ' . $styledata[67] . ';
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active em{
            background-color: ' . $styledata[5] . ';
            color: ' . $styledata[15] . ';
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active span{
            width: ' . $styledata[25] . 'px;
            position: absolute;
            right: -' . ($styledata[25] / 2) . 'px;
            top: ' . $styledata[27] . 'px;
            height: ' . $styledata[25] . 'px;
            border-radius: 14px;
            -webkit-border-radius: 14px;
            -moz-border-radius: 14px;
            -ms-border-radius: 14px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            display: block;
            background-color: ' . $styledata[7] . ';
        }
        .ctu-ultimate-style-' . $styleid . '-content{
            width: calc(' . $styledata[35] . '% - ' . $styledata[25] . 'px);
            float: left;
        }
        .ctu-ultimate-style-heading-' . $styleid . '{
            width: 100%;
            cursor: pointer;
            display: none;
            float: left;
            line-height: 100%;
            color: ' . $styledata[3] . ';
            background-color: ' . $styledata[7] . ';
            font-size: ' . $styledata[1] . 'px;
            padding: ' . $styledata[17] . 'px 10px;
            font-weight: ' . $styledata[11] . ';
            border-radius: 5px;
            font-family:  ' . ctu_font_familly_special_charecter($styledata[9]) . ';
        }
        .ctu-ultimate-style-heading-' . $styleid . ' em{
            display: inline-block;
            float: left;
            margin-right: 10px;
            background: ' . $styledata[23] . ';
            text-align: center;
            height: ' . $styledata[1] . 'px;
            width: ' . $styledata[1] . 'px;
            border-radius: 50%;
            font-weight: normal;
            font-size: ' . $styledata[19] . 'px;
            color: ' . $styledata[21] . ';
            line-height: ' . $styledata[1] . 'px;
        }
        .ctu-ultimate-style-heading-' . $styleid . '.active em{
            background-color: ' . $styledata[5] . ';
            color: ' . $styledata[15] . ';
        }
        .ctu-ultimate-style-heading-' . $styleid . '.active{
            color: ' . $styledata[5] . ';
            border-radius: 5px 5px 0 0;                         
        }
        .ctu-ulitate-style-' . $styleid . '-tabs{
            float: left;
            width: 100%;
            display: none;
            float: left;
            text-align: ' . $styledata[51] . ';
            border-radius: ' . $styledata[63] . 'px;
            color: ' . $styledata[31] . ';
            background-color: ' . $styledata[33] . ';
            -webkit-box-shadow:    ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
            -o-box-shadow:    ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
            -ms-box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
            -moz-box-shadow:    ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
            box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
            padding: ' . $styledata[37] . 'px ' . $styledata[39] . 'px  ' . $styledata[41] . 'px  ' . $styledata[43] . 'px ;
        }
        .ctu-ulitate-style-' . $styleid . '-tabs p{
            font-family:  ' . ctu_font_familly_special_charecter($styledata[47]) . ';
            font-size: ' . $styledata[29] . 'px;
            font-weight: ' . $styledata[49] . ';
            line-height: ' . $styledata[45] . ';
            margin-bottom: 0;
            margin-top: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-' . $styleid . '{
                display: block;
            }
            .ctu-ultimate-style-' . $styleid . '-content{
                width: 100%;
                float: left;
            }
            .ctu-ulimate-style-' . $styleid . ' {
                display: none;
            }
            .ctu-ultimate-style-heading-' . $styleid . '{
                display: block;
                -webkit-box-shadow:   0 0 5px ' . $styledata[55] . ';
                -o-box-shadow:   0 0 5px ' . $styledata[55] . ';
                -ms-box-shadow:   0 0 5px ' . $styledata[55] . ';
                -moz-box-shadow:   0 0 5px' . $styledata[55] . ';
                box-shadow:   0 0 5px ' . $styledata[55] . ';
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-' . $styleid . '-tabs{
                margin-bottom: 10px;
                -webkit-box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
                -o-box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
                -ms-box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
                -moz-box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
                box-shadow:   ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[53] . 'px ' . $styledata[61] . 'px ' . $styledata[55] . ';
                border-radius: 0 0 5px 5px;
            }
        }

        ' . $styledata[75] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
