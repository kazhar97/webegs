<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style22($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
             <div class="ctu-ulimate-style-' . $styleid . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[65]) || $styledata[65] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
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
    echo '</div> </div>';
    if (empty($styledata[61])) {
        $initialopen = ':first';
    } else if ($styledata[61] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[61];
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
    $css = '.ctu-ultimate-wrapper-' . $styleid . '{
                    width: 100%;
                    float: left;
                    -webkit-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                    -o-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                    -ms-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                    -moz-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                    box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                    background-color: ' . $styledata[25] . ';
                    overflow: hidden;
                    border-radius: ' . $styledata[45] . 'px;
                }
                .ctu-ulimate-style-' . $styleid . '{
                    margin: 0 0 0 0;
                    width: calc(100% - ' . $styledata[27] . '%);
                    float: ' . $styledata[15] . ';
                    list-style: none;
                    text-align: center;
                    margin-bottom: 0;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                    width: 100%;
                    list-style: none;
                    cursor: pointer;
                    display: block;
                    margin-bottom: ' . $styledata[19] . 'px;
                    padding: ' . $styledata[17] . 'px 10px;
                    text-align: left;
                    color: ' . $styledata[3] . ';
                    background-color: ' . $styledata[5] . ';
                    font-size: ' . $styledata[1] . 'px;
                    font-family:    ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                    font-weight: ' . $styledata[13] . ';
                    font-style: ' . $styledata[51] . ';
                    line-height: 130%;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                    color: ' . $styledata[7] . ';
                    background-color: ' . $styledata[9] . ';
                }
                .ctu-ultimate-style-' . $styleid . '-content{
                    width: ' . $styledata[27] . '%;
                    float: left;
                }
                .ctu-ultimate-style-heading-' . $styleid . '{
                    width: 100%;
                    float: left;
                    cursor: pointer;
                    display: none;
                    line-height: 100%;
                    border-radius: 5px;
                    color: ' . $styledata[3] . ';
                    background-color: ' . $styledata[5] . ';
                    font-size: ' . $styledata[1] . 'px;
                    padding: ' . $styledata[17] . 'px 10px;
                    font-weight: ' . $styledata[13] . ';
                    font-style: ' . $styledata[51] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                }
                .ctu-ultimate-style-heading-' . $styleid . '.active{
                    color: ' . $styledata[7] . ';
                    background-color: ' . $styledata[9] . ';
                    border-radius: 5px 5px 0 0;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs{
                    width: 100%;
                    float: left;
                    display: none;           
                    text-align: ' . $styledata[43] . ';           
                    padding: ' . $styledata[29] . 'px ' . $styledata[31] . 'px ' . $styledata[33] . 'px ' . $styledata[35] . 'px;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs p{
                    font-size: ' . $styledata[21] . 'px;
                    color: ' . $styledata[23] . ';
                    font-weight: ' . $styledata[41] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[39]) . ';
                    line-height: ' . $styledata[37] . ';
                    margin-top:0;
                    margin-bottom:0;
                }
                @media only screen and (max-width: 900px) {
                    .ctu-ultimate-wrapper-' . $styleid . '{
                        display: block;
                        -webkit-box-shadow: none;
                        -o-box-shadow: none;
                        -ms-box-shadow: none;
                        -moz-box-shadow: none;
                        box-shadow: none;
                        background-color: transparent;
                        border-radius: 0;
                        overflow: visible;

                    }
                    .ctu-ultimate-style-' . $styleid . '-content{
                        width: 100%;
                        overflow:   visible;
                    }
                    .ctu-ulimate-style-' . $styleid . ' {
                        display: none;
                    }
                    .ctu-ultimate-style-heading-' . $styleid . '{
                        display: block;
                        -webkit-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -o-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -ms-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -moz-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        margin-bottom: 10px;
                    }
                    .ctu-ulitate-style-' . $styleid . '-tabs{
                        margin-bottom: 10px;
                        background-color: ' . $styledata[25] . ';
                        -webkit-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -o-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -ms-box-shadow:  ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        -moz-box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        box-shadow:   ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[47] . 'px ' . $styledata[57] . 'px ' . $styledata[49] . ';
                        border-radius: 0 0 5px 5px;
                    }
                }
                ' . $styledata[59] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
