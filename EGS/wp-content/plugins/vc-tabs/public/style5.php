<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style5($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
             <div class="ctu-ulimate-style-' . $styleid . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[67]) || $styledata[67] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '" class="">
                                <span>' . ctu_icon_font_selector($value['css']) . '</span>
                                ' . ctu_html_special_charecter($titlefiles[0]) . '
                                <div class="ctu-absulote"></div>
                            </div> ';
    }
    echo '  </div>';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
                                <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
                                    ' . ctu_icon_font_selector($value['css']) . '   ' . ctu_html_special_charecter($titlefiles[0]) . '
                                    
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
        echo '</div></div>';
    }
    echo ' </div>';
    if (empty($styledata[63])) {
        $initialopen = ':first';
    } else if ($styledata[63] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[63];
    }
    if (empty($styledata[65])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[65] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[65] == 'show') {
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
                    -webkit-box-shadow: ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . 'px ' . $styledata[57] . 'px ' . $styledata[51] . '; 
                    -o-box-shadow: ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . 'px ' . $styledata[57] . 'px ' . $styledata[51] . '; 
                    -ms-box-shadow: ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . 'px ' . $styledata[57] . 'px ' . $styledata[51] . '; 
                    -moz-box-shadow: ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . 'px ' . $styledata[57] . 'px ' . $styledata[51] . '; 
                    box-shadow: ' . $styledata[53] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . 'px ' . $styledata[57] . 'px ' . $styledata[51] . '; 
                    border-radius: ' . $styledata[25] . 'px ' . $styledata[25] . 'px 0 0;
                }
                .ctu-ulimate-style-' . $styleid . '{
                    margin: 0 0 0 0;
                    width: 100%;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: -o-flexbox;
                    display: -moz-flexbox;
                    display: flex;
                    list-style:none;
                    float: left;
                    text-align: center;
                    margin: 0;
                    border-radius: ' . $styledata[25] . 'px ' . $styledata[25] . 'px 0 0;
                    -webkit-box-pack: ' . $styledata[17] . ';
                    -ms-flex-pack: ' . $styledata[17] . ';
                    -o-flex-pack: ' . $styledata[17] . ';
                    -moz-flex-pack: ' . $styledata[17] . ';
                    justify-content:  ' . $styledata[17] . ';
                    border-bottom: 1px solid ' . $styledata[19] . ';
                    background-color: ' . $styledata[5] . ';
                    z-index: 1;
                    position: relative;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                    cursor: pointer;
                    float: left;
                    list-style:none;
                    margin-bottom: 0;
                    position: relative;
                    padding: ' . $styledata[23] . 'px 10px;        
                    font-size: ' . $styledata[1] . 'px;
                    line-height: 120%;
                    color: ' . $styledata[3] . ';
                    width: ' . $styledata[21] . 'px;
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[13]) . ';
                    font-weight: ' . $styledata[15] . ';
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li span{
                    width: 100%;
                    display: block;
                    text-align: center;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li span .oxi-icons{
                    margin-bottom: ' . $styledata[11] . 'px !important;
                    font-size: ' . $styledata[9] . 'px !important;

                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li span .oxi-icons{
                    color: ' . $styledata[3] . ' !important;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active span .oxi-icons{
                    color: ' . $styledata[7] . ' !important;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                    position: relative;
                    -webkit-transition:  all 0.5s linear;
                    -o-transition:  all 0.5s linear;
                    -ms-transition:  all 0.5s linear;
                    -moz-transition:  all 0.5s linear;
                    transition:  all 0.5s linear;
                    color: ' . $styledata[7] . ';
                }
                .ctu-absulote{
                    position: absolute;
                    width: 11px;
                    height: 11px;
                    margin: auto;
                    left: 0;
                    right: 0;
                    border-color: ' . $styledata[19] . ';
                    border: 1px solid;
                    border-radius: 10px;
                    bottom: -6px;
                    background-color: transparent;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active .ctu-absulote{
                    background-color: ' . $styledata[7] . ';
                    border-color: ' . $styledata[7] . ';
                }
                .ctu-ultimate-style-' . $styleid . '-content{
                    width: 100%;
                    float: left;
                }
                .ctu-ultimate-style-heading-' . $styleid . '{
                    cursor: pointer;
                    display: none;
                    width: 100%;
                    font-weight: ' . $styledata[19] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[13]) . ' ;
                    line-height: 120%;
                    padding: ' . $styledata[23] . 'px 10px;
                    text-align: center;
                    font-size: ' . $styledata[1] . 'px;
                    color: ' . $styledata[3] . ';
                    background-color: ' . $styledata[5] . ';
                    border-radius: ' . $styledata[25] . 'px;
                }
                .ctu-ultimate-style-heading-' . $styleid . '.active{
                    -webkit-transition:  all 0.5s linear;
                    -o-transition:  all 0.5s linear;
                    -ms-transition:  all 0.5s linear;
                    -moz-transition:  all 0.5s linear;
                    transition:  all 0.5s linear;
                    color: ' . $styledata[7] . ';
                    border-bottom: 1px solid ' . $styledata[19] . ';
                    border-radius: ' . $styledata[25] . 'px ' . $styledata[25] . 'px 0 0;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs{
                    width: 100%;
                    display: none;
                    padding: ' . $styledata[33] . 'px ' . $styledata[35] . 'px ' . $styledata[37] . 'px ' . $styledata[39] . 'px;
                    background-color: ' . $styledata[31] . ';
                }
                .ctu-ulitate-style-' . $styleid . '-tabs p{
                    margin-bottom: 0;
                    margin-top: 0;
                    font-size: ' . $styledata[27] . 'px;
                    color: ' . $styledata[29] . ';
                    line-height: ' . $styledata[41] . ';
                    text-align: ' . $styledata[47] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[43]) . ';
                    font-weight: ' . $styledata[45] . ';
                }
                @media only screen and (max-width: 900px) {
                    .ctu-ultimate-wrapper-' . $styleid . '{
                        -webkit-box-shadow: none;
                        -o-box-shadow: none;
                        -moz-box-shadow: none;
                        -ms-box-shadow: none;
                        box-shadow: none;
                        border-radius: 0;
                    }
                    .ctu-ulimate-style-' . $styleid . ' {
                        display: none;
                    }
                    .ctu-ultimate-style-heading-' . $styleid . '{
                        display: block;
                    }
                    .ctu-ultimate-style-' . $styleid . '-content{
                        margin-bottom: 10px;
                        -webkit-box-shadow: 0 0 5px ' . $styledata[31] . ';
                        -o-box-shadow: 0 0 5px ' . $styledata[31] . ';
                        -ms-box-shadow: 0 0 5px ' . $styledata[31] . ';
                        -moz-box-shadow: 0 0 5px ' . $styledata[31] . ';
                        box-shadow: 0 0 5px ' . $styledata[31] . ';
                        border-radius: ' . $styledata[25] . 'px;
                        overflow: hidden;
                    }
                }
                ' . $styledata[61] . ' ';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
