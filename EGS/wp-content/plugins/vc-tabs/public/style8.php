<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style8($styleid, $userdata, $styledata, $listdata) {
    $oxi_fixed_header = get_option('oxi_addons_fixed_header_size');
    echo '<div class="ctu-ultimate-wrapper-' . $styleid . '">
             <div class="ctu-ulimate-style-' . $styleid . '">';
    if ($userdata == 'admin') {
        $adminclass = 'oxilab-ab-id';
    } else {
        $adminclass = '';
    }
    $jquery = $linkopening = '';
    if (!empty($styledata[51]) || $styledata[51] != 'new-tab') {
        $linkopening = ", '_self'";
    }
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        if (!empty($titlefiles[1]) && $userdata != 'admin') {
            $jquery .= 'jQuery(".vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '").click(function() {window.open("' . $titlefiles[1] . '" ' . $linkopening . ');});';
        }
        echo '<div class="vc-tabs-li vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '">
                                ' . ctu_html_special_charecter($titlefiles[0]) . ' 
                            </div>';
    }
    echo '</div>';
    foreach ($listdata as $value) {
        $titlefiles = explode('{}{}{}', $value['title']);
        echo ' <div class="ctu-ultimate-style-' . $styleid . '-content">
                        <div class="ctu-ultimate-style-heading-' . $styleid . ' vc-tabs-li-' . $styleid . '-id-' . $value['id'] . '" ref="#ctu-ulitate-style-' . $styleid . '-id-' . $value['id'] . '"> 
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
        echo '</div></div> ';
    }
    echo '</div>';
    if (empty($styledata[47])) {
        $initialopen = ':first';
    } else if ($styledata[47] == 'none') {
        $initialopen = '';
    } else {
        $initialopen = $styledata[47];
    }
    if (empty($styledata[49])) {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[49] == 'slide') {
        $animationin = 'slideDown';
        $animationout = 'slideUp';
    } else if ($styledata[49] == 'show') {
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
                    width: 100%;
                    float: left;
                    list-style: none;            
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: -o-flexbox;
                    display: -moz-flexbox;
                    display: flex;
                    text-align: center;
                    -webkit-box-pack: ' . $styledata[17] . ';
                    -ms-flex-pack: ' . $styledata[17] . ';
                    -o-flex-pack: ' . $styledata[17] . ';
                    -moz-flex-pack: ' . $styledata[17] . ';
                    justify-content: ' . $styledata[17] . ';
                    margin-bottom: 0;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                    width: ' . $styledata[15] . 'px;
                    float: left;
                    z-index: 2;
                    position: relative;
                    bottom: -1px;
                    list-style: none;
                    cursor: pointer;
                    margin-bottom: 0;
                    border-top: 1px solid;
                    border-right: 1px solid;
                    border-bottom: 1px solid;
                    border-color: ' . $styledata[43] . ';
                    padding: ' . $styledata[19] . 'px 10px;
                    text-align: center;
                    color: ' . $styledata[3] . ';
                    background-color:  ' . $styledata[5] . ';
                    font-size: ' . $styledata[1] . 'px;
                    font-family:    ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                    font-weight: ' . $styledata[13] . ';
                    line-height: 130%;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li:first-child{
                    border-left: 1px solid ' . $styledata[43] . ';
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                    color: ' . $styledata[7] . ';
                    background-color:  ' . $styledata[9] . ';
                    border-bottom-color: ' . $styledata[9] . ';
                }
                .ctu-ultimate-style-' . $styleid . '-content{
                    width: 100%;
                    float: left;
                }
                .ctu-ultimate-style-heading-' . $styleid . '{
                    width: 100%;
                    cursor: pointer;
                    display: none;
                    line-height: 100%;
                    color: ' . $styledata[3] . ';
                    background-color: ' . $styledata[5] . ';
                    font-size: ' . $styledata[1] . 'px;
                    padding: ' . $styledata[19] . 'px 10px;
                    font-weight: ' . $styledata[15] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[11]) . ';
                }
                .ctu-ultimate-style-heading-' . $styleid . '.active{
                    color: ' . $styledata[7] . ';
                    background-color: ' . $styledata[9] . ';
                    border-bottom: 1px solid ' . $styledata[43] . ';
                }
                .ctu-ulitate-style-' . $styleid . '-tabs{
                    display: none;
                    border: 1px solid ' . $styledata[43] . ';           
                    background-color:' . $styledata[25] . ';           
                    padding: ' . $styledata[27] . 'px ' . $styledata[29] . 'px ' . $styledata[31] . 'px ' . $styledata[33] . 'px ;


                }
                .ctu-ulitate-style-' . $styleid . '-tabs p{
                    font-size: ' . $styledata[21] . 'px;
                    color: ' . $styledata[23] . ';
                    font-weight: ' . $styledata[39] . ';
                    line-height: ' . $styledata[35] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[37]) . ';
                    text-align: ' . $styledata[41] . ';
                }
                @media only screen and (max-width: 900px) {
                    .ctu-ultimate-wrapper-' . $styleid . '{
                        display: block;
                    }
                    .ctu-ultimate-style-' . $styleid . '-content{
                        width: 100%;
                        margin-bottom: 10px;
                        border: 1px solid ' . $styledata[43] . ';
                    }
                    .ctu-ulimate-style-' . $styleid . ' {
                        display: none;
                    }
                    .ctu-ultimate-style-heading-' . $styleid . '{
                        display: block;
                    }
                    .ctu-ulitate-style-' . $styleid . '-tabs{
                        border:none;
                    }
                }
                ' . $styledata[45] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
