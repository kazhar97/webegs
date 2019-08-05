<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style13($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-'. $styleid.'">
            <div class="ctu-ulimate-style-'. $styleid.'">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
     $jquery = $linkopening = '';
    if (!empty($styledata[79]) || $styledata[79] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
         if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo ' <div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                        ' . ctu_html_special_charecter($titlefiles[0]) . '
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
    echo '</div></div>';
    if (empty($styledata[75])) {
        $initialopen = ':first';
    } else if ($styledata[75] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[75];
    }
    if (empty($styledata[77])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[77] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[77] == 'show') {
        $animationin = 'show';
        $animationout = 'hide';
    } else {
        $animationin = 'fadeIn';
        $animationout = 'fadeOut';
    }
    $jquery .= 'jQuery(".ctu-ulimate-style-'. $styleid.' .vc-tabs-li'. $initialopen.'").addClass("active");
                    jQuery(".ctu-ultimate-style-heading-'. $styleid.''. $initialopen.'").addClass("active");
                    jQuery(".ctu-ulitate-style-'. $styleid.'-tabs'. $initialopen.'").'. $animationin.'();
                    jQuery(".ctu-ulimate-style-'. $styleid.' .vc-tabs-li").click(function () {
                        if (jQuery(this).hasClass("active")) {
                            return false;
                        } else {
                            jQuery(".ctu-ulimate-style-'. $styleid.' .vc-tabs-li").removeClass("active");
                            jQuery(this).toggleClass("active");
                            jQuery(".ctu-ulitate-style-'. $styleid.'-tabs").'. $animationout.'("slow");
                            var activeTab = jQuery(this).attr("ref");
                            jQuery(activeTab).'. $animationin.'("slow");
                        }
                    });
                    jQuery(".ctu-ultimate-style-heading-'. $styleid.'").click(function () {
                        if (jQuery(this).hasClass("active")) {
                            return false;
                        } else {
                            jQuery(".ctu-ultimate-style-heading-'. $styleid.'").removeClass("active");
                            jQuery(this).toggleClass("active");
                            jQuery(".ctu-ulitate-style-'. $styleid.'-tabs").'. $animationout.'("slow");
                            var activeTab = jQuery(this).attr("ref");
                            jQuery(activeTab).'. $animationin.'("slow");
                            var headerheight = '. $oxi_fixed_header.';
                            jQuery("html, body").animate({
                                scrollTop: jQuery(".ctu-ultimate-wrapper-'. $styleid.'").offset().top - headerheight
                            }, 2000);
                        }
                    });';
    $css = '
        .ctu-ulimate-style-'. $styleid.'{
            margin: 0 0 0 0;
            width: 100%;
            float: left;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -o-flexbox;
            display: -moz-flexbox;
            display: flex;
            list-style: none;
            text-align: center;
            -webkit-box-pack: '. $styledata[15].';
            -ms-flex-pack:'. $styledata[15].';
            -o-flex-pack: '. $styledata[15].';
            -moz-flex-pack:'. $styledata[15].';
            justify-content: '. $styledata[15].';
            margin-bottom: '. $styledata[23].'px;
        }
        .ctu-ultimate-wrapper-'. $styleid.'{
            width: 100%;
            float: left;
        }
        .ctu-ulimate-style-'. $styleid.' .vc-tabs-li{
            width: 100%;
            list-style: none;
            cursor: pointer;
            float: left;
            max-width: '. $styledata[17].'px;
            margin-bottom: 0;
            padding: '. $styledata[19].'px 10px;
            text-align: center;
            color: '. $styledata[3].';
            background-color:  '. $styledata[5].';
            font-size: '. $styledata[1].'px;
            font-family:    '. ctu_font_familly_special_charecter($styledata[11]).';
            font-weight: '. $styledata[13].';
            line-height: 100%;
            font-style: '. $styledata[59].';
            border-radius: '. $styledata[25].'px;
            -webkit-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -o-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -ms-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -moz-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            margin-right: '. $styledata[21].'px;
        }
        .ctu-ulimate-style-'. $styleid.' .vc-tabs-li:last-child{
            margin-right: 0;
        }
        .ctu-ulimate-style-'. $styleid.' .vc-tabs-li.active{
            color: '. $styledata[7].';
            background-color:  '. $styledata[9].';
        }
        .ctu-ultimate-style-'. $styleid.'-content{
            width: 100%;
            float: left;
        }
        .ctu-ultimate-style-heading-'. $styleid.'{
            width: 100%;
            float: left;
            cursor: pointer;
            display: none;
            line-height: 100%;
            color: '. $styledata[3].';
            background-color: '. $styledata[5].';
            font-size: '. $styledata[1].'px;
            padding: '. $styledata[19].'px 10px;
            font-weight: '. $styledata[13].';
            font-style: '. $styledata[59].';
            font-family:  '. ctu_font_familly_special_charecter($styledata[11]).';
            border-radius:5px;
            -webkit-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -o-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -ms-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            -moz-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
            box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';

        }
        .ctu-ultimate-style-heading-'. $styleid.'.active{
            color: '. $styledata[7].';
            background-color: '. $styledata[9].';
        }
        .ctu-ulitate-style-'. $styleid.'-tabs{
            display: none;
            width: 100%;
            float: left;            
            background-color: '. $styledata[35].';           
            padding: '. $styledata[37].'px '. $styledata[39].'px '. $styledata[41].'px '. $styledata[43].'px;
            text-align: '. $styledata[51].';
            border-radius: '. $styledata[53].'px;
            -webkit-box-shadow: '. $styledata[61].'px '. $styledata[63].'px  '. $styledata[55].'px '. $styledata[65].'px  '. $styledata[57].';
            -o-box-shadow: '. $styledata[61].'px '. $styledata[63].'px  '. $styledata[55].'px '. $styledata[65].'px  '. $styledata[57].';
            -ms-box-shadow: '. $styledata[61].'px '. $styledata[63].'px  '. $styledata[55].'px '. $styledata[65].'px  '. $styledata[57].';
            -moz-box-shadow: '. $styledata[61].'px '. $styledata[63].'px  '. $styledata[55].'px '. $styledata[65].'px  '. $styledata[57].';
            box-shadow: '. $styledata[61].'px '. $styledata[63].'px  '. $styledata[55].'px '. $styledata[65].'px  '. $styledata[57].';
        }
        .ctu-ulitate-style-'. $styleid.'-tabs p{
            font-size: '. $styledata[31].'px;
            color: '. $styledata[33].';
            font-weight: '. $styledata[49].';
            font-family: '. ctu_font_familly_special_charecter($styledata[47]).';
            line-height: '. $styledata[45].';
            margin-bottom: 0;
            margin-top: 0;
        }
        @media only screen and (max-width: 900px) {
            .ctu-ulimate-style-'. $styleid.' {
                display: none;
            }
            .ctu-ultimate-style-heading-'. $styleid.'{
                display: block;
                -webkit-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
                -o-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
                -ms-box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
                -moz-box-shadow:  '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
                box-shadow: '. $styledata[67].'px '. $styledata[69].'px '. $styledata[27].'px '. $styledata[71].'px '. $styledata[29].';
                margin-bottom: 10px;
            }
            .ctu-ulitate-style-'. $styleid.'-tabs{
                margin-bottom: 10px;
            }
        }
        '. $styledata[73].'';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
