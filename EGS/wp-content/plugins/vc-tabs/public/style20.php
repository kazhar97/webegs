<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style20($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
             <div class="ctu-ulimate-style-' . $styleid . '">';

    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $css = $jquery = $linkopening = '';
    if (!empty($styledata[43]) || $styledata[43] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        $cssdata = explode('|', $value['css']);
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="" style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '">
                                 ' . ctu_html_special_charecter($titlefiles[0]) . '
                            </div>';
    }
    echo '</div>';
    echo '<div class="ctu-ultimate-style-' . $styleid . '-content">';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        $cssdata = explode('|', $value['css']);
        echo '<div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '"> 
                                    ' . ctu_html_special_charecter($titlefiles[0]) . '
                                </div>
                        <div class="ctu-ulitate-style-' . $styleid . '-tabs ' . $adminclass . '" id="ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"  style="color: ' . $cssdata[1] . '; background-color:  ' . $cssdata[3] . '">
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
    if (empty($styledata[39])) {
        $initialopen = ':first';
    } else if ($styledata[39] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[39];
    }
    if (empty($styledata[41])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[41] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[41] == 'show') {
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
    $css .= '.ctu-ultimate-wrapper-' . $styleid . '{
                    width: 100%;
                    float: left;
                }
                .ctu-ulimate-style-' . $styleid . '{
                    margin: 0 0 0 0;
                    width: 100%;
                    float: left;
                    position: relative;
                    list-style: none;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: -o-flexbox;
                    display: -moz-flexbox;
                    display: flex;
                    overflow: hidden;
                    text-align: center;
                    -webkit-box-pack: start ' . $styledata[7] . ';
                    -ms-flex-pack:  ' . $styledata[7] . ';
                    -o-flex-pack:  ' . $styledata[7] . ';
                    -moz-flex-pack:  ' . $styledata[7] . ';
                    justify-content: ' . $styledata[7] . ';
                    margin-bottom: 0;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                    width: 100%;
                    float: left;
                    position: relative;
                    list-style: none;
                    cursor: pointer;
                    max-width: ' . $styledata[9] . 'px;
                    margin-bottom: 0;
                    margin-right: ' . $styledata[13] . 'px;
                    padding: ' . $styledata[11] . 'px 10px;
                    text-align: center;
                    font-size: ' . $styledata[1] . 'px;
                    font-style: ' . $styledata[35] . ';
                    font-family:   ' . ctu_font_familly_special_charecter($styledata[3]) . ';
                    font-weight: ' . $styledata[5] . ';
                    line-height: 100%;
                    bottom: -5px;
                    border-radius: ' . $styledata[15] . 'px ' . $styledata[15] . 'px 0 0;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li:last-child{
                    margin-right: 0;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                    bottom: 0;
                }
                .ctu-ultimate-style-' . $styleid . '-content{
                    width: 100%;
                    float: left;
                    overflow: hidden;
                }
                .ctu-ultimate-style-heading-' . $styleid . '{
                    width: 100%;
                    float:left;
                    cursor: pointer;
                    display: none;
                    line-height: 100%;
                    font-size: ' . $styledata[1] . 'px;
                    padding: ' . $styledata[11] . 'px 10px;
                    font-weight: ' . $styledata[5] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[3]) . ';
                    border-radius: 5px;
                }
                .ctu-ultimate-style-heading-' . $styleid . '.active{
                    border-radius: 5px 5px 0 0;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs{
                    display: none;
                    float:left;
                    width: 100%;
                    text-align: ' . $styledata[33] . ';
                    padding: ' . $styledata[19] . 'px ' . $styledata[21] . 'px ' . $styledata[23] . 'px ' . $styledata[25] . 'px ;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs p{
                    font-size: ' . $styledata[17] . 'px;
                    font-weight: ' . $styledata[31] . ';
                    line-height: ' . $styledata[27] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[29]) . ';
                    margin-top:0;
                    margin-bottom:0;
                }
                @media only screen and (max-width: 900px) {

                    .ctu-ultimate-style-' . $styleid . '-content{
                        width: 100%;
                        overflow:   visible;
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
                ' . $styledata[37] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
