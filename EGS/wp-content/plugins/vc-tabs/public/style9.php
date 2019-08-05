<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style9($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">';

    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[75]) || $styledata[75] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    echo '<div class="ctu-ulimate-style-' . $styleid . '">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                ' . ctu_icon_font_selector($value['css']) . '
                                ' . ctu_html_special_charecter($titlefiles[0]) . '
                                    <div class="ctu-absolute"></div>
                            </div>';
    }
    echo '</div>';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
                        <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                            ' . ctu_icon_font_selector($value['css']) . ' ' . ctu_html_special_charecter($titlefiles[0]) . '
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
        echo '</div></div> ';
    }
    echo '</div>';
    if (empty($styledata[71])) {
        $initialopen = ':first';
    } else if ($styledata[71] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[71];
    }
    if (empty($styledata[73])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[73] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[73] == 'show') {
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
    $css = '
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
                -webkit-box-pack:  ' . $styledata[17] . ';
                -ms-flex-pack:  ' . $styledata[17] . ';
                -o-flex-pack:  ' . $styledata[17] . ';
                -moz-flex-pack:  ' . $styledata[17] . ';
                justify-content: ' . $styledata[17] . ';
                margin-bottom: ' . $styledata[21] . 'px;
                -webkit-box-shadow:   ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                -o-box-shadow:    ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                -ms-box-shadow:    ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                -moz-box-shadow:    ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                box-shadow:   ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                background-color: ' . $styledata[5] . ';
                border-radius: ' . $styledata[27] . 'px ' . $styledata[27] . 'px 0 0 ;
                margin-bottom: ' . $styledata[21] . 'px
            }
            .ctu-ultimate-wrapper-' . $styleid . '{
                width: 100%;
                float: left;
            }
            .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                position: relative;
                list-style: none;
                cursor: pointer;
                width: ' . $styledata[15] . 'px;
                float: left;
                padding: 5px 10px ;
                text-align: center;
                color: ' . $styledata[3] . ';
                font-size: ' . $styledata[1] . 'px;
                font-family:    ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                font-weight: ' . $styledata[13] . ';
                line-height: 130%;
                font-style: ' . $styledata[67] . ';
                margin: ' . $styledata[19] . 'px 0;
                border-right: 1px solid;
                border-color: ' . $styledata[9] . ';
            }
            .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li:last-child{
                border-right: none
            }
            .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                color: ' . $styledata[7] . ';
            }
            .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active .ctu-absolute{
                position: absolute;
                left: 0;
                right: 0;
                bottom: calc(-10px - ' . $styledata[19] . 'px );
                margin: 0 auto;
                width: 0;
                height: 0;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-top: 10px solid ' . $styledata[5] . ';
            }
            .ctu-ultimate-style-' . $styleid . '-content{
                width: 100%;
                float: left;
            }

            .ctu-ultimate-style-heading-' . $styleid . '{
                width: 100%;
                cursor: pointer;
                float: left;
                display: none;
                line-height: 100%;
                color: ' . $styledata[3] . ';
                background-color: ' . $styledata[5] . ';
                font-size: ' . $styledata[1] . 'px;
                padding: ' . $styledata[19] . 'px 10px;
                font-weight: ' . $styledata[13] . ';
                box-shadow:   ' . $styledata[61] . 'px ' . $styledata[63] . 'px ' . $styledata[23] . 'px ' . $styledata[65] . 'px ' . $styledata[25] . ';
                font-family:  ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                font-style: ' . $styledata[67] . ';
                border-radius: ' . $styledata[27] . 'px;
            }
            .ctu-ultimate-style-heading-' . $styleid . '.active{
                color: ' . $styledata[7] . ';
                margin-bottom: 10px;
                border-radius:  ' . $styledata[27] . 'px ' . $styledata[27] . 'px 0 0;
            }

            .ctu-ulitate-style-' . $styleid . '-tabs{
                width: 100%;
                float: left;
                display: none;
                background-color: ' . $styledata[33] . ';
                font-weight:' . $styledata[47] . ';
                text-align: ' . $styledata[49] . ';
                -webkit-box-shadow:  ' . $styledata[55] . 'px ' . $styledata[57] . 'px   ' . $styledata[51] . 'px ' . $styledata[59] . 'px  ' . $styledata[53] . ';
                -o-box-shadow:  ' . $styledata[55] . 'px ' . $styledata[57] . 'px   ' . $styledata[51] . 'px ' . $styledata[59] . 'px  ' . $styledata[53] . ';
                -ms-box-shadow:   ' . $styledata[55] . 'px ' . $styledata[57] . 'px   ' . $styledata[51] . 'px ' . $styledata[59] . 'px  ' . $styledata[53] . ';
                -moz-box-shadow:   ' . $styledata[55] . 'px ' . $styledata[57] . 'px   ' . $styledata[51] . 'px ' . $styledata[59] . 'px  ' . $styledata[53] . ';
                box-shadow:   ' . $styledata[55] . 'px ' . $styledata[57] . 'px   ' . $styledata[51] . 'px ' . $styledata[59] . 'px  ' . $styledata[53] . ';
                padding: ' . $styledata[35] . 'px ' . $styledata[37] . 'px ' . $styledata[39] . 'px ' . $styledata[41] . 'px ;
                border-radius: 0 0 ' . $styledata[27] . 'px ' . $styledata[27] . 'px;
            }
            .ctu-ulitate-style-' . $styleid . '-tabs p{
                font-size: ' . $styledata[29] . 'px;
                color: ' . $styledata[31] . ';
                line-height: ' . $styledata[43] . ';
                font-family:    ' . ctu_font_familly_special_charecter($styledata[45]) . ';
                margin-top: 0;
                margin-bottom: 0;
            }
            @media only screen and (max-width: 900px) {
                .ctu-ultimate-wrapper-' . $styleid . '{
                    display: block;
                }
                .ctu-ultimate-style-' . $styleid . '-content{
                    width: 100%;
                    margin-bottom: 10px;
                }
                .ctu-ulimate-style-' . $styleid . ' {
                    display: none;
                }
                .ctu-ultimate-style-heading-' . $styleid . '{
                    display: block;
                }
            }
            ' . $styledata[69] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
