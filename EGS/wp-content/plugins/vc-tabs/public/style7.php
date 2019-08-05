<?php
if (!defined('ABSPATH'))
    exit;

function oxi_responsive_tabs_shortcode_function_style7($styleid, $userdata, $styledata, $listdata) {
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
    echo ' </div>  ';
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
    $css = '
                .ctu-ulimate-style-' . $styleid . '{
                    margin: 0 0 0 0;
                    width: 100%;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: -o-flexbox;
                    display: -moz-flexbox;
                    display: flex;
                    margin-bottom: 0;
                    list-style: none;
                    background-color:  ' . $styledata[5] . ';
                    -webkit-box-pack: ' . $styledata[19] . ';;
                    -ms-flex-pack: ' . $styledata[19] . ';;
                    -o-flex-pack: ' . $styledata[19] . ';;
                    -moz-flex-pack: ' . $styledata[19] . ';;
                    justify-content:  ' . $styledata[19] . ';
                    border-bottom: 1px solid ' . $styledata[11] . ';
                }
                .ctu-ultimate-wrapper-' . $styleid . '{
                    width: 100%;
                    float: left;
                    -webkit-box-shadow: ' . $styledata[51] . 'px ' . $styledata[53] . 'px ' . $styledata[47] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . '; 
                    -o-box-shadow: ' . $styledata[51] . 'px ' . $styledata[53] . 'px ' . $styledata[47] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . '; 
                    -ms-box-shadow: ' . $styledata[51] . 'px ' . $styledata[53] . 'px ' . $styledata[47] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . '; 
                    -moz-box-shadow:' . $styledata[51] . 'px ' . $styledata[53] . 'px ' . $styledata[47] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . '; 
                    box-shadow: ' . $styledata[51] . 'px ' . $styledata[53] . 'px ' . $styledata[47] . 'px ' . $styledata[55] . 'px ' . $styledata[49] . '; 
                    border: 1px solid ' . $styledata[45] . ';
                    border-radius: ' . $styledata[59] . 'px ' . $styledata[59] . 'px 0 0;
                    overflow: hidden;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li{
                    width: ' . $styledata[17] . 'px;
                    float: left;
                    list-style: none;
                    text-align: center;
                    cursor: pointer;
                    margin-bottom: 0;
                    font-size: ' . $styledata[1] . 'px;
                    color: ' . $styledata[3] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[13]) . ';
                    font-weight: ' . $styledata[15] . ';
                    padding: ' . $styledata[21] . 'px 10px;
                    border-right: 1px solid ' . $styledata[11] . ';

                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li:last-child{
                    border-right: none;
                }
                .ctu-ulimate-style-' . $styleid . ' .vc-tabs-li.active{
                    color: ' . $styledata[7] . ';
                    background-color: ' . $styledata[9] . ';
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
                    background-color: ' . $styledata[5] . ';
                    font-size: ' . $styledata[1] . 'px;
                    color: ' . $styledata[3] . ';
                    padding: ' . $styledata[21] . 'px 10px;
                    font-weight: ' . $styledata[15] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[13]) . ';
                }
                .ctu-ultimate-style-heading-' . $styleid . '.active{
                    color: #003eff;
                    background-color: ' . $styledata[9] . ';
                    border-bottom: 1px solid ' . $styledata[11] . ';
                }
                .ctu-ulitate-style-' . $styleid . '-tabs{
                    width: 100%;
                    float: left;
                    display: none;            
                    background-color: ' . $styledata[27] . ';           
                    padding: ' . $styledata[29] . 'px ' . $styledata[31] . 'px ' . $styledata[33] . 'px ' . $styledata[35] . 'px;
                }
                .ctu-ulitate-style-' . $styleid . '-tabs p{
                    margin-bottom: 0;
                    margin-top: 0;
                    font-size: ' . $styledata[23] . 'px;
                    color: ' . $styledata[25] . ';
                    font-weight: ' . $styledata[41] . ';
                    line-height: ' . $styledata[37] . ';
                    font-family:  ' . ctu_font_familly_special_charecter($styledata[39]) . ';
                }
                @media only screen and (max-width: 900px) {
                    .ctu-ultimate-wrapper-' . $styleid . '{
                        display: block;
                        -webkit-box-shadow: none;
                        -o-box-shadow: none;
                        -ms-box-shadow: none;
                        -moz-box-shadow: none;
                        box-shadow: none;
                        border: none;
                        overflow: visible;
                    }
                    .ctu-ultimate-style-' . $styleid . '-content{
                        -webkit-box-shadow:  0 0 ' . $styledata[47] . 'px ' . $styledata[49] . ';
                        -o-box-shadow:  0 0 ' . $styledata[47] . 'px ' . $styledata[49] . ';
                        -ms-box-shadow:   0 0 ' . $styledata[47] . 'px ' . $styledata[49] . ';
                        -moz-box-shadow:  0 0 ' . $styledata[47] . 'px ' . $styledata[49] . ';
                        box-shadow:   0 0 ' . $styledata[47] . 'px ' . $styledata[49] . ';
                        border: 1px solid  ' . $styledata[45] . ';
                        border-radius: ' . $styledata[59] . 'px;
                        overflow: hidden;
                        margin-bottom: 10px;
                    }
                    .ctu-ulimate-style-' . $styleid . ' {
                        display: none;
                    }
                    .ctu-ultimate-style-heading-' . $styleid . '{
                        display: block;
                    }

                }
                ' . $styledata[61] . '';
    wp_add_inline_script('oxi-responsive-tabs', $jquery);
    wp_add_inline_style('oxi-responsive-tabs', $css);
}
