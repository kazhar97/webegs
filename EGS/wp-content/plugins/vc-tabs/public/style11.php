<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style11($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-'.$styleid.'">
        <div class="ctu-ulimate-style-'.$styleid.'">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[73]) || $styledata[73] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $cssfile = explode('|', $value['css']);
         $titlefiles = explode('{}{}{}', $value['title']);
         if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo ' <div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color :' . $cssfile[1] . '; border-color: ' . $cssfile[1] . '">
                                <span> 
                                    ' . ctu_icon_font_selector($cssfile[3]) . '
                                    ' . ctu_html_special_charecter($titlefiles[0]) . ' 
                                </span>
                            </div>';
    }
    echo '</div>';

    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $cssfile = explode('|', $value['css']);
         $titlefiles = explode('{}{}{}', $value['title']);
        echo '  <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color :' . $cssfile[1] . '"> 
                            <span> 
                                 ' . ctu_html_special_charecter($titlefiles[0]) . ' 
                            </span>
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
    echo '</div> </div> ';
    if (empty($styledata[69])) {
        $initialopen = ':first';
    } else if ($styledata[69] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[69];
    }
  
    if (empty($styledata[71])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[71] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[61] == 'show') {
        $animationin = 'show';
        $animationout = 'hide';
    } else {
        $animationin = 'fadeIn';
        $animationout = 'fadeOut';
    }
    $jquery .= 'jQuery(".ctu-ulimate-style-'.$styleid.' .vc-tabs-li'.$initialopen.'").addClass("active");
                jQuery(".ctu-ultimate-style-heading-'.$styleid.''.$initialopen.'").addClass("active");
                jQuery(".ctu-ulitate-style-'.$styleid.'-tabs'.$initialopen.'").'.$animationin.'();
                jQuery(".ctu-ulimate-style-'.$styleid.' .vc-tabs-li").click(function () {
                    if (jQuery(this).hasClass("active")) {
                        return false;
                    } else {
                        jQuery(".ctu-ulimate-style-'.$styleid.' .vc-tabs-li").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-'.$styleid.'-tabs").'.$animationout.'("slow");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).'.$animationin.'("slow");
                    }
                });
                jQuery(".ctu-ultimate-style-heading-'.$styleid.'").click(function () {
                    if (jQuery(this).hasClass("active")) {
                        return false;
                    } else {
                        jQuery(".ctu-ultimate-style-heading-'.$styleid.'").removeClass("active");
                        jQuery(this).toggleClass("active");
                        jQuery(".ctu-ulitate-style-'.$styleid.'-tabs").'.$animationout.'("slow");
                        var activeTab = jQuery(this).attr("ref");
                        jQuery(activeTab).'.$animationin.'("slow");
                        var headerheight = '.$oxi_fixed_header.';
                        jQuery("html, body").animate({
                            scrollTop: jQuery(".ctu-ultimate-wrapper-'.$styleid.'").offset().top - headerheight
                        }, 2000);
                    }
                });';
    $css = '.ctu-ultimate-wrapper-'.$styleid.'{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-'.$styleid.'{
            margin: 0 0 0 0;
            width: 100%;
            float: left;
            list-style: none;
            display: flex;
            text-align: center;
            justify-content: '.$styledata[13].';
            margin-bottom: '.$styledata[19].'px;
        }
        .ctu-ulimate-style-'.$styleid.' .vc-tabs-li{
            list-style: none;
            width: 100%;
            float: left;
            cursor: pointer;
            max-width: '.$styledata[11].'px;
            position: relative;
            margin-bottom: 0;
            border-top: 5px solid ;
            padding: '.$styledata[15].'px 10px;
            margin-right: '.$styledata[17].'px;
            text-align: center;
            background-color: '.$styledata[5].';
            font-size: '.$styledata[1].'px;
            font-family:    '.ctu_font_familly_special_charecter($styledata[7]).';
            font-weight: '.$styledata[11].';
            line-height: 100%;
            font-style: '.$styledata[65].';
            box-shadow:  '.$styledata[59].'px '.$styledata[61].'px '.$styledata[23].'px '.$styledata[63].'px '.$styledata[25].';
        }
        .ctu-ulimate-style-'.$styleid.' .vc-tabs-li span{
            color: '.$styledata[3].';
            width: 100%;
            text-align: center;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ctu-ulimate-style-'.$styleid.' .vc-tabs-li.active span{
            color: inherit;
        }
        .ctu-ulimate-style-'.$styleid.' .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-'.$styleid.' .vc-tabs-li span .oxi-icons,  
        .ctu-ultimate-style-heading-'.$styleid.' span i{
            padding-right: 8px !important;
            font-size: '.$styledata[21].'px !important;
        }
        .ctu-ultimate-style-'.$styleid.'-content{
            width:100%;
            float: left;
        }
        .ctu-ultimate-style-heading-'.$styleid.'{
            width: 100%;
            float: left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            background-color:'.$styledata[5].';
            font-size: '.$styledata[1].'px;
            padding: '.$styledata[15].'px 10px;
            font-weight: '.$styledata[9].';
            font-style: '.$styledata[65].';
            font-family:  '.ctu_font_familly_special_charecter($styledata[7]).';
            box-shadow:  '.$styledata[59].'px '.$styledata[61].'px '.$styledata[23].'px '.$styledata[63].'px '.$styledata[25].';
        }
        .ctu-ultimate-style-heading-'.$styleid.' span{
            color: '.$styledata[3].';
            width: 100%;
            text-align: center;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ctu-ultimate-style-heading-'.$styleid.' span .oxi-icons{
            font-size:'.$styledata[21].'px !important;
        }
        .ctu-ultimate-style-heading-'.$styleid.'.active span{
            color: inherit;
        }
        .ctu-ulitate-style-'.$styleid.'-tabs{
            width: 100%;
            float: left;
            display: none;            
            background-color: '.$styledata[31].';           
            padding: '.$styledata[33].'px '.$styledata[35].'px '.$styledata[37].'px '.$styledata[39].'px ;
            text-align: '.$styledata[47].';
            box-shadow: '.$styledata[53].'px '.$styledata[55].'px '.$styledata[49].'px '.$styledata[57].'px '.$styledata[51].';
        }
        .ctu-ulitate-style-'.$styleid.'-tabs p{
            color: '.$styledata[29].';
            font-size: '.$styledata[27].'px;
            font-weight: '.$styledata[45].';
            line-height: '.$styledata[41].';
            font-family: '.ctu_font_familly_special_charecter($styledata[43]).';
            margin-bottom: 0;
            margin-top:0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ultimate-wrapper-'.$styleid.'{
                display: block;
                box-shadow: none;
            }
            .ctu-ultimate-style-'.$styleid.'-content{
                width: 100%;
                border-left: none;
                display: block;
                overflow:   visible;
            }
            .ctu-ulimate-style-'.$styleid.' {
                display: none;
            }
            .ctu-ultimate-style-heading-'.$styleid.'{
                display: block;
                box-shadow:  '.$styledata[59].'px '.$styledata[61].'px '.$styledata[23].'px '.$styledata[63].'px '.$styledata[25].';
                margin-bottom: '.$styledata[19].'px;
            }
            .ctu-ulitate-style-'.$styleid.'-tabs{
                margin-bottom: 10px;
            }
        }
        '.$styledata[67].'';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
