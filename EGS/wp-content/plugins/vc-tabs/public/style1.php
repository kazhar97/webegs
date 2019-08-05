<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style1($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[75]) || $styledata[75] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    echo '<div class="ctu-ultimate-wrapper ctu-ultimate-wrapper-' . $styleid . '"><div class="ctu-ulimate-style-' . $styleid . '">';

    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                            ' . ctu_html_special_charecter($titlefiles[0]) . '';
        echo '</div>';
    }
    echo ' </div> <div class="ctu-ultimate-style-' . $styleid . '-content">';

    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo '  <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                              ' . ctu_html_special_charecter($titlefiles[0]) . '
                    </div>
                    <div class="ctu-ulitate-style-' . $styleid . '-tabs  ' . $adminclass . ' " id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
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
        echo '</div>';
    }
    echo ' </div> </div>';

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
    $jquery .= ' 
                jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li' . $initialopen . '").addClass("active");
                jQuery(".ctu-ultimate-style-heading-' . $styleid . '' . $initialopen . '").addClass("active");
                jQuery(".ctu-ulitate-style-' . $styleid . '-tabs' . $initialopen . '").' . $animationin . '("slow");
                jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").click(function () {
                    if (jQuery(this).hasClass("active")) {
                        return false;
                    } else {
                        jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-' . $styleid . '-tabs").' . $animationout . '();
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
                });
                var contentliwidth = jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").outerWidth();
                var count = jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").length;
                var fullwidth = jQuery(".ctu-ulimate-style-' . $styleid . '").width();
                var widthresult = contentliwidth * count;
                if (fullwidth <= widthresult) {
                    var eachwidth = parseInt(fullwidth / count) + "px";
                    jQuery(".ctu-ulimate-style-' . $styleid . ' .vc-tabs-li").css("width", eachwidth);
                }';
    $css = '.ctu-ultimate-wrapper-' . $styleid . '{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-' . $styleid . '{
            margin: 0 0 0 0;
            width: 100%;            
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            float: left;
            overflow:hidden;
            list-style: none;
            margin-top: 10px;
            text-align: center;            
            -webkit-box-pack: ' . $styledata[15] . ';
            -ms-flex-pack: ' . $styledata[15] . ';
            -o-flex-pack: ' . $styledata[15] . ';
            -moz-flex-pack: ' . $styledata[15] . ';
            justify-content: ' . $styledata[15] . ' ;
            border-top: ' . $styledata[53] . 'px solid ' . $styledata[9] . ';
            margin-bottom: ' . $styledata[55] . 'px;
            background-color: ' . $styledata[5] . ';
            -webkit-border-radius: ' . $styledata[21] . 'px ' . $styledata[21] . 'px 0 0;
            -ms-border-radius: ' . $styledata[21] . 'px ' . $styledata[21] . 'px 0 0;
            -o-border-radius: ' . $styledata[21] . 'px ' . $styledata[21] . 'px 0 0;
            -moz-border-radius: ' . $styledata[21] . 'px ' . $styledata[21] . 'px 0 0;
            border-radius: ' . $styledata[21] . 'px ' . $styledata[21] . 'px 0 0;
            -webkit-box-shadow: ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[23] . 'px ' . $styledata[61] . 'px ' . $styledata[25] . ';
            -ms-box-shadow: ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[23] . 'px ' . $styledata[61] . 'px ' . $styledata[25] . '; 
            -o-box-shadow: ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[23] . 'px ' . $styledata[61] . 'px ' . $styledata[25] . '; 
            -moz-box-shadow: ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[23] . 'px ' . $styledata[61] . 'px ' . $styledata[25] . '; 
            box-shadow: ' . $styledata[57] . 'px ' . $styledata[59] . 'px ' . $styledata[23] . 'px ' . $styledata[61] . 'px ' . $styledata[25] . '; 
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
            cursor: pointer;
            text-align: center;
            list-style: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -o-flex-pack: center;
            -moz-flex-pack: center;
            justify-content: center ;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -o-flex-align: center;
            -moz-flex-align: center;
            align-items: center;
            padding: ' . $styledata[19] . 'px 10px;
            margin: 0;
            font-size: ' . $styledata[1] . 'px;
            width: ' . $styledata[17] . 'px;
            float: left;
            font-family: ' . ctu_font_familly_special_charecter($styledata[11]) . ';
            color: ' . $styledata[3] . ';
            border-right: 1px solid  ' . $styledata[9] . ';
            font-weight:  ' . $styledata[13] . ';   
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li:last-child{
            border-right: none;
        }
        .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
            color: ' . $styledata[7] . ';
            position: relative;
            -webkit-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            background-color: ' . $styledata[9] . ';
        }

        .ctu-ultimate-style-' . $styleid . '-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-' . $styleid . '{
            cursor: pointer;
            -webkit-border-radius: ' . $styledata[21] . 'px;
            -ms-border-radius: ' . $styledata[21] . 'px;
            -o-border-radius: ' . $styledata[21] . 'px;
            -moz-border-radius: ' . $styledata[21] . 'px;
            border-radius: ' . $styledata[21] . 'px;
            padding: ' . $styledata[19] . 'px 5px;
            text-align: center;
            font-size: ' . $styledata[1] . 'px;
            width: 100%;
            display: inline-block;
            margin-bottom: 3px;
            color: ' . $styledata[3] . ';
            background-color: ' . $styledata[5] . ';
            font-family: ' . ctu_font_familly_special_charecter($styledata[11]) . ';
            font-weight:  ' . $styledata[13] . ';
            display: none;
        }
        .ctu-ultimate-style-heading-' . $styleid . '.active{
            color: ' . $styledata[7] . ';
            -webkit-transition:  all 0.5s linear;
            -ms-transition:  all 0.5s linear;
            -o-transition:  all 0.5s linear;
            -moz-transition:  all 0.5s linear;
            transition:  all 0.5s linear;
            background-color: ' . $styledata[9] . ';
        }
        .ctu-ulitate-style-' . $styleid . '-tabs{
            width: 100%;
            float:left;
            background-color:  ' . $styledata[31] . ' ;    
            display: none;
            -webkit-box-shadow: ' . $styledata[63] . 'px ' . $styledata[65] . 'px ' . $styledata[49] . 'px ' . $styledata[67] . 'px ' . $styledata[51] . ';
            -ms-box-shadow: ' . $styledata[63] . 'px ' . $styledata[65] . 'px ' . $styledata[49] . 'px ' . $styledata[67] . 'px ' . $styledata[51] . ';
            -o-box-shadow: ' . $styledata[63] . 'px ' . $styledata[65] . 'px ' . $styledata[49] . 'px ' . $styledata[67] . 'px ' . $styledata[51] . ';
            -moz-box-shadow: ' . $styledata[63] . 'px ' . $styledata[65] . 'px ' . $styledata[49] . 'px ' . $styledata[67] . 'px ' . $styledata[51] . ';
            box-shadow: ' . $styledata[63] . 'px ' . $styledata[65] . 'px ' . $styledata[49] . 'px ' . $styledata[67] . 'px ' . $styledata[51] . ';
            margin-bottom:10px;
            padding: ' . $styledata[33] . 'px ' . $styledata[35] . 'px ' . $styledata[37] . 'px ' . $styledata[39] . 'px;
        }
        .ctu-ulitate-style-' . $styleid . '-tabs p{          
            font-size: ' . $styledata[27] . 'px;
            color:  ' . $styledata[29] . ';
            line-height: ' . $styledata[41] . ';
            text-align: ' . $styledata[47] . ';           
            font-family: ' . ctu_font_familly_special_charecter($styledata[43]) . ';
            font-weight: ' . $styledata[45] . ';
            margin: 0;
        }

        @media only screen and (max-width: 900px) {
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
