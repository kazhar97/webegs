<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style16($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-'. $styleid.'">
            <div class="ctu-ulimate-style-'. $styleid.'">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[81]) || $styledata[81] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo ' <div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                               ' . ctu_icon_font_selector($value['css']) . '
                                ' . ctu_html_special_charecter($titlefiles[0]) . '
                            </div>';
    }
    echo '</div>';
    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo '<div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
    echo '</div></div> ';
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
    $css = '.ctu-ulimate-style-'. $styleid.'{
                        width: calc(100% - '. $styledata[37].'%);
                        float: '. $styledata[11].';
                        list-style: none;
                        text-align: center;
                        overflow: hidden;
                        margin-bottom: 0;
                        padding: '. $styledata[19].'px;
                    }
                    .ctu-ultimate-wrapper-'. $styleid.'{
                        margin: 0 0 0 0;
                        width: 100%;
                        float: left;
                        border-radius: '. $styledata[55].'px;
                        -webkit-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        -o-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        -ms-box-shadow:  '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        -moz-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        background-color: '. $styledata[35].';
                    }
                    .ctu-ulimate-style-'. $styleid.' .vc-tabs-li{
                        width: 100%;
                        list-style: none;
                        cursor: pointer;
                        display: block;
                        margin-bottom: '. $styledata[19].'px;
                        padding: '. $styledata[17].'px;
                        text-align: center;
                        color: '. $styledata[3].';
                        background-color:  '. $styledata[5].' ;
                        font-style:'. $styledata[61].';
                        font-size: '. $styledata[1].'px;
                        font-family:    '. ctu_font_familly_special_charecter($styledata[13]).';
                        font-weight: '. $styledata[15].';
                        line-height: 100%;
                        border-radius: '. $styledata[25].'px;
                        -webkit-box-shadow:  '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -o-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -ms-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -moz-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                    }
                    .ctu-ulimate-style-'. $styleid.' .vc-tabs-li:last-child{
                        margin-bottom: 0;
                    }
                    .ctu-ulimate-style-'. $styleid.' .vc-tabs-li.active{
                        color: '. $styledata[7].';
                        background-color: '. $styledata[9].';
                    }
                    .ctu-ulimate-style-'. $styleid.' .vc-tabs-li .oxi-icons{
                        display: block !important;
                        padding-bottom: '. $styledata[23].'px !important;
                        font-size: '. $styledata[21].'px !important;
                    }
                    .ctu-ultimate-style-'. $styleid.'-content{
                        width: '. $styledata[37].'%;
                        float: left;
                        overflow: hidden;
                    }
                    .ctu-ultimate-style-heading-'. $styleid.'{
                        width: 100%;
                        float:left;
                        cursor: pointer;
                        display: none;
                        line-height: 100%;
                        font-size: '. $styledata[1].'px;
                        padding: '. $styledata[17].'px;
                        font-weight: '. $styledata[15].';
                        font-family:  '. ctu_font_familly_special_charecter($styledata[13]).';
                        -webkit-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -o-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -ms-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        -moz-box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        box-shadow: '. $styledata[69].'px '. $styledata[71].'px '. $styledata[27].'px '. $styledata[73].'px '. $styledata[29].';
                        border-radius: '. $styledata[25].'px;
                        font-style:'. $styledata[61].';
                        color: '. $styledata[3].';
                        background-color: '. $styledata[5].';
                    }
                    .ctu-ultimate-style-heading-'. $styleid.'.active{
                        color: '. $styledata[7].'; 
                        background-color: '. $styledata[9].';
                    }
                    .ctu-ulitate-style-'. $styleid.'-tabs{
                        display: none;
                        width:100%;
                        float:left;           
                        padding: '. $styledata[39].'px '. $styledata[41].'px '. $styledata[43].'px '. $styledata[45].'px ;
                        text-align: '. $styledata[53].'
                    }
                    .ctu-ulitate-style-'. $styleid.'-tabs p{
                        font-size: '. $styledata[31].'px;
                        color:'. $styledata[33].';
                        font-weight: '. $styledata[51].';
                        line-height: '. $styledata[47].';
                        font-family:  '. ctu_font_familly_special_charecter($styledata[49]).';
                        margin-bottom:0;
                        margin-top:0;
                    }
                    @media only screen and (max-width: 900px) {
                        .ctu-ultimate-wrapper-'. $styleid.'{
                            display: block;
                            -webkit-box-shadow: none;
                            -o-box-shadow: none;
                            -ms-box-shadow: none;
                            -moz-box-shadow: none;
                            box-shadow: none;
                            border-radius:0;
                            background-color:transparent;
                        }
                        .ctu-ultimate-style-'. $styleid.'-content{
                            width: 100%;
                            float: left;
                            overflow:   visible;
                        }
                        .ctu-ulimate-style-'. $styleid.' {
                            display: none;
                        }
                        .ctu-ultimate-style-heading-'. $styleid.'{
                            display: block;
                            margin-bottom: 10px;
                        }
                        .ctu-ulitate-style-'. $styleid.'-tabs{
                            border-radius: '. $styledata[55].'px;
                            margin-bottom: 10px;
                            -webkit-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                            -o-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                            -ms-box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                            -moz-box-shadow:  '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                            box-shadow:   '. $styledata[63].'px '. $styledata[65].'px '. $styledata[57].'px '. $styledata[67].'px '. $styledata[59].';
                        }
                    }
                     '. $styledata[75].'';
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
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
