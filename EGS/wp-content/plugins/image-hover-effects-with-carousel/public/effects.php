<?php
if (!defined('ABSPATH'))
    exit;
image_hover_effects_with_carousel_user_capabilities();
$styleid = (int) $_GET['styleid'];
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
global $wpdb;
$table_list = $wpdb->prefix . 'image_hover_with_carousel_list';
$table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
$status = get_option('image_hover_with_carousel_license_status');
$title = '';
$files = '';
$link = '';
$bottom = '';
$image = '';
$itemid = '';
$imageeffects = 'ihewc-blur';
$imagebackgroundcolor = '#0081cc';
$imagealignments = 'ihewc-layout-horizontal-center ihewc-layout-vertical-middle';
$titlecolor = '#ffffff';
$titleanimation = 'ihewc-zoom-in';
$desccolor = '#ffffff';
$descanimation = 'ihewc-zoom-in';
$buttomcolor = '#00a88f';
$buttomanimation = 'ihewc-zoom-in';
$buttombackground = '#fafafa';
$imagestyle = 'blur-effects';

if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {
    $ihtitle = sanitize_text_field(htmlentities($_POST['ihewc-title']));
    $ihfiles = sanitize_text_field(htmlentities($_POST['ihewc-desc']));
    $ihbotton = sanitize_text_field($_POST['ihewc-bottom']);
    $ihlink = sanitize_text_field($_POST['ihewc-link']);
    $ihimage = sanitize_text_field($_POST['ihewc-image-upload-url']);
    $imagebackgroundcolorfree = $status == 'valid' ? sanitize_text_field($_POST['image-background-color']) : $imagebackgroundcolor;
    $titlecolorfree = $status == 'valid' ? sanitize_hex_color($_POST['title-color']) : $titlecolor;
    $titleanimationfree = $status == 'valid' ? sanitize_text_field($_POST['title-animation']) : $titleanimation;
    $desccolorfree = $status == 'valid' ? sanitize_hex_color($_POST['desc-color']) : $desccolor;
    $descanimationfree = $status == 'valid' ? sanitize_text_field($_POST['desc-animation']) : $descanimation;
    $buttomcolorfree = $status == 'valid' ? sanitize_hex_color($_POST['buttom-color']) : $buttomcolor;
    $buttombackgroundfree = $status == 'valid' ? sanitize_text_field($_POST['buttom-background']) : $buttombackground;
    $buttomanimationfree = $status == 'valid' ? sanitize_hex_color($_POST['buttom-animation']) : $buttomanimation;

    $css = ' image-effects |' . sanitize_text_field($_POST['image-effects']) . '|'
            . ' image-background-color |' . $imagebackgroundcolorfree . '|'
            . ' image-alignments |' . sanitize_text_field($_POST['image-alignments']) . '|'
            . ' title-color |' . $titlecolorfree . '|'
            . ' title-animation |' . $titleanimationfree . '|'
            . ' desc-color |' . $desccolorfree . '|'
            . ' desc-animation |' . $descanimationfree . '|'
            . ' buttom-color |' . $buttomcolorfree . '|'
            . ' buttom-animation |' . $buttomanimationfree . '|'
            . ' buttom-background |' . $buttombackgroundfree . '|'
            . ' image-style |' . sanitize_text_field($_POST['image-style']) . '|';
    if (!wp_verify_nonce($nonce, 'ihewcsavedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        if ($_POST['item-id'] == '') {
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (title, files, buttom_text, link, image, css, styleid) VALUES ( %s, %s, %s, %s, %s, %s, %d)", array($ihtitle, $ihfiles, $ihbotton, $ihlink, $ihimage, $css, $styleid)));
        }
        if ($_POST['item-id'] != '' && is_numeric($_POST['item-id'])) {
            $item_id = (int) $_POST['item-id'];
            $wpdb->update("$table_list", array("title" => $ihtitle, "files" => $ihfiles, "buttom_text" => $ihbotton, "link" => $ihlink, "image" => $ihimage, "css" => $css), array('id' => $item_id), array('%s', '%s', '%s', '%s', '%s', '%s'), array('%d'));
        }
    }
}

if (!empty($_POST['edit']) && is_numeric($_POST['item-id'])) {
    if (!wp_verify_nonce($nonce, 'ihewceditdata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $item_id), ARRAY_A);
        $title = $data['title'];
        $files = $data['files'];
        $link = $data['link'];
        $bottom = $data['buttom_text'];
        $image = $data['image'];
        $datacss = explode('|', $data['css']);
        $imageeffects = $datacss[1];
        $imagebackgroundcolor = $datacss[3];
        $imagealignments = $datacss[5];
        $titlecolor = $datacss[7];
        $titleanimation = $datacss[9];
        $desccolor = $datacss[11];
        $descanimation = $datacss[13];
        $buttomcolor = $datacss[15];
        $buttomanimation = $datacss[17];
        $buttombackground = $datacss[19];
        $imagestyle = $datacss[21];
        $itemid = $item_id;
        echo '<script type="text/javascript"> jQuery(document).ready(function () {setTimeout(function() { jQuery("#ihewc-add-new-item-data").modal("show")  }, 500); });</script>';
    }
}
if (!empty($_POST['delete']) && is_numeric($_POST['item-id'])) {

    if (!wp_verify_nonce($nonce, 'ihewcdeletedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_list} WHERE id = %d ", $item_id));
    }
}

if (!empty($_POST['data-submit']) && $_POST['data-submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'ihewcstylecss')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $boxshadow = $status == 'valid' ? sanitize_text_field($_POST['box-shadow']) : '0';
        $headingfontfamilly = $status == 'valid' ? sanitize_text_field($_POST['heading-font-familly']) : 'Open+Sans';
        $descfontfamilly = $status == 'valid' ? sanitize_text_field($_POST['desc-font-familly']) : 'Open+Sans';
        $buttonfontfamilly = $status == 'valid' ? sanitize_text_field($_POST['button-font-familly']) : 'Open+Sans';
        $ihewccss = $status == 'valid' ? sanitize_text_field($_POST['ihewc-css']) : '';
        $ihewcanimations = $status == 'valid' ? sanitize_text_field($_POST['ihewc-animations']) : '';

        $data = 'ihewc-image-type |' . sanitize_text_field($_POST['ihewc-image-type']) . '|'
                . ' ihewc-item |' . sanitize_text_field($_POST['ihewc-item']) . '|'
                . ' ihewc-showing-type |' . sanitize_text_field($_POST['ihewc-showing-type']) . '|'
                . ' image-height |' . sanitize_text_field($_POST['image-height']) . '|'
                . ' image-padding |' . sanitize_text_field($_POST['image-padding']) . '|'
                . ' ihewc-new-tab |' . sanitize_text_field($_POST['ihewc-new-tab']) . '|'
                . ' box-shadow |' . $boxshadow . '|'
                . ' box-shadow-color |' . sanitize_text_field($_POST['box-shadow-color']) . '|'
                . ' heading-font-size |' . sanitize_text_field($_POST['heading-font-size']) . '|'
                . ' heading-font-familly |' . $headingfontfamilly . '|'
                . ' heading-font-weight |' . sanitize_text_field($_POST['heading-font-weight']) . '|'
                . ' ihewc-heading-underline |' . sanitize_text_field($_POST['ihewc-heading-underline']) . '|'
                . ' heading-padding-bottom |' . sanitize_text_field($_POST['heading-padding-bottom']) . '|'
                . ' desc-font-size |' . sanitize_text_field($_POST['desc-font-size']) . '|'
                . ' desc-font-familly |' . $descfontfamilly . '|'
                . ' desc-font-weight |' . sanitize_text_field($_POST['desc-font-weight']) . '|'
                . ' desc-padding-bottom |' . sanitize_text_field($_POST['desc-padding-bottom']) . '|'
                . ' button-font-size |' . sanitize_text_field($_POST['button-font-size']) . '|'
                . ' button-font-familly |' . $buttonfontfamilly . '|'
                . ' button-font-weight |' . sanitize_text_field($_POST['button-font-weight']) . '|'
                . ' button-padding-bottom |' . sanitize_text_field($_POST['button-padding-bottom']) . '|'
                . ' button-padding-left |' . sanitize_text_field($_POST['button-padding-left']) . '|'
                . ' button-border-radius |' . sanitize_text_field($_POST['button-border-radius']) . '|'
                . ' ihewc-css |' . $ihewccss . '|'
                . ' image-margin |' . sanitize_text_field($_POST['image-margin']) . '|'
                . ' carousel-autoplay |' . sanitize_text_field($_POST['carousel-autoplay']) . '|'
                . ' carousel-auto-timing |' . sanitize_text_field($_POST['carousel-auto-timing']) . '|'
                . ' ihewc-animations |' . sanitize_text_field($_POST['']) . '|'
                . ' animation-timing |' . $ihewcanimations . '| |';
        $data = sanitize_text_field($data);
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET css = %s WHERE id = %d", $data, $styleid));
    }
}
if (!empty($_POST['submit-css']) && $_POST['submit-css'] == 'Save' && is_numeric($_POST['itemcssid'])) {
    $itemcssid = (int) $_POST['itemcssid'];
    if (!wp_verify_nonce($nonce, 'ihewcsavestyle')) {
        die('You do not have sufficient permissions to access this page.');
    } else {

        $css = sanitize_text_field($css);
        $wpdb->query($wpdb->prepare("UPDATE {$table_list} SET css = %s WHERE id = %d", $css, $itemcssid));
    }
}

$listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
$styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
$styledata = $styledata['css'];
$styledata = explode('|', $styledata);
$ihewcimageproonly = $status == 'valid' ? '' : '<span class="oxilab-pro-only">Pro Only</span>';

function ihewcimageproonlydatagen($data) {
    global $status;
    if ($status == 'valid') {
        echo $data;
    } else {
        echo 'blur-effects';
    }
}
?>

<div class="wrap">
    <?php ihewc_promote_free(); ?>
    <div class="ihewc-admin-wrapper">
        <div class="ihewc-admin-row">
            <div class="ihewc-style-panel-left">
                <div class="ihewc-style-setting-panel">
                    <form method="post">
                        <div class="ctu-ultimate-wrapper-3"> 
                            <ul class="ctu-ulimate-style-3">  
                                <li ref="#ctu-ulitate-style-3-id-6" class="">
                                    General
                                </li>  
                                <li ref="#ctu-ulitate-style-3-id-5" class="">
                                    Typography
                                </li> 
                                <li ref="#ctu-ulitate-style-3-id-2">
                                    Custom CSS
                                </li>
                                <li ref="#ctu-ulitate-style-3-id-1">
                                    Support
                                </li>
                            </ul>

                            <div class="ctu-ultimate-style-3-content">
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-6">
                                    <div class="oxilab-tabs-content-div-50">
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                General
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="ihewc-image-type" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Circle Image or Square Image, Such as for Square Image make it 0 and Circle Image make it 50" >Image Radius</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" min="0" step="1" max="50" id="ihewc-image-type" name="ihewc-image-type" value="<?php echo $styledata[1]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="ihewc-item" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize how many items you want to show in a single Row">Item Per Row </label>
                                                <div class="col-sm-6 nopadding">
                                                    <select class="form-control" id="ihewc-item" name="ihewc-item">
                                                        <option value="ihewc-responsive-1" <?php
                                                        if ($styledata[3] == 'ihewc-responsive-1') {
                                                            echo 'selected';
                                                        }
                                                        ?> >Single Item per Row</option>
                                                        <option value="ihewc-responsive-2" <?php
                                                        if ($styledata[3] == 'ihewc-responsive-2') {
                                                            echo 'selected';
                                                        }
                                                        ?>>2 Items per Row</option>
                                                        <option value="ihewc-responsive-3"  <?php
                                                        if ($styledata[3] == 'ihewc-responsive-3') {
                                                            echo 'selected';
                                                        }
                                                        ?>>3 Items per Row</option>
                                                        <option value="ihewc-responsive-4" <?php
                                                        if ($styledata[3] == 'ihewc-responsive-4') {
                                                            echo 'selected';
                                                        }
                                                        ?>>4 Items per Row</option>
                                                        <option value="ihewc-responsive-5" <?php
                                                        if ($styledata[3] == 'ihewc-responsive-5') {
                                                            echo 'selected';
                                                        }
                                                        ?>>5 Items per Row</option>
                                                        <option value="ihewc-responsive-6" <?php
                                                        if ($styledata[3] == 'ihewc-responsive-6') {
                                                            echo 'selected';
                                                        }
                                                        ?>>6 Items per Row</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="image-height" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Height, Our Auto Set make it on percentize with width for responsive , Such as for Square Image make it 100" >Image Height</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" min="30" step="1" max="300" id="image-height" name="image-height" value="<?php echo $styledata[7]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Carousel
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Cutomize the hover showing type. Choose between Slide or Grid.">Showing Type</label>
                                                <div class="col-sm-6 nopadding">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label  oxilab-alert="Showing Type" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[5] == '') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-showing-type" id="ihewc-showing-type-normal" autocomplete="off" <?php
                                                            if ($styledata[5] == '') {
                                                                echo 'checked';
                                                            }
                                                            ?> value=""> Normal
                                                        </label>
                                                        <label oxilab-alert="Showing Type" class="oxilab-alert-click  btn btn-info <?php
                                                        if ($styledata[5] == 'carousel') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-showing-type" id="ihewc-showing-type-carousel" autocomplete="off" value="carousel"  <?php
                                                            if ($styledata[5] == 'carousel') {
                                                                echo 'checked';
                                                            }
                                                            ?>> Carousel
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row " id="carousel-autoplay-hidden-show">
                                                <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Slide AutoPlay Yes or No">Autoplay</label>
                                                <div class="col-sm-6 nopadding">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label oxilab-alert="Carousel Autoplay" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[51] == 'true') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="carousel-autoplay" id="carousel-autoplay-on" autocomplete="off" <?php
                                                            if ($styledata[51] == 'true') {
                                                                echo 'checked';
                                                            }
                                                            ?> value="true"> Yes
                                                        </label>
                                                        <label oxilab-alert="Carousel Autoplay" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[51] == 'false') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="carousel-autoplay" id="carousel-autoplay-off" autocomplete="off" value="false"  <?php
                                                            if ($styledata[51] == 'false') {
                                                                echo 'checked';
                                                            }
                                                            ?>> No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm" id="carousel-autoplay-time-show">
                                                <label for="carousel-auto-timing" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Slide Autoplay moveable Time 1 Seconds = 1000ms" >Autoplay Time</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" oxilab-alert="Carousel Autoplay Time" class="oxilab-alert-change form-control" min="100" step="10" max="10000" id="carousel-auto-timing" name="carousel-auto-timing" value="<?php echo $styledata[53]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Additional
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="image-margin" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Generate some distance from image to image." >Image Margin</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number"  min="0" step="5" max="300" class="form-control" id="image-margin" name="image-margin" value="<?php echo $styledata[49]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="image-padding" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Generate image distance from inner position." >Image Padding</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number"  min="0" step="5" max="300" class="form-control" id="image-padding" name="image-padding" value="<?php echo $styledata[9]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Image or Button Text Url Open System. Same Browser or New Tabs">Open New Tab?</label>
                                                <div class="col-sm-6 nopadding">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label oxilab-alert="Link Opening" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[11] == '_blank') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-new-tab" autocomplete="off"  value="_blank" <?php
                                                            if ($styledata[11] == '_blank') {
                                                                echo 'checked';
                                                            }
                                                            ?>> Yes
                                                        </label>
                                                        <label oxilab-alert="Link Opening" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[11] == '') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-new-tab"  autocomplete="off" value=""  <?php
                                                            if ($styledata[11] == '') {
                                                                echo 'checked';
                                                            }
                                                            ?>> No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-div-50">
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Animation
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="ihewc-animations" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Animation style during the image is viewing">View Animation <?php echo $ihewcimageproonly;?></label>
                                                <div class="col-sm-6 nopadding">
                                                    <select oxilab-alert="Animation Select" class="oxilab-alert-change form-control" id="ihewc-animations" name="ihewc-animations">
                                                        <optgroup label="Attention Seekers">
                                                            <option value="bounce" <?php
                                                            if ($styledata[55] == 'bounce') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounce</option>
                                                            <option value="flash"  <?php
                                                            if ($styledata[55] == 'flash') {
                                                                echo 'selected';
                                                            }
                                                            ?>>flash</option>
                                                            <option value="pulse"  <?php
                                                            if ($styledata[55] == 'pulse') {
                                                                echo 'selected';
                                                            }
                                                            ?>>pulse</option>
                                                            <option value="rubberBand" <?php
                                                            if ($styledata[55] == 'rubberBand') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rubberBand</option>
                                                            <option value="shake" <?php
                                                            if ($styledata[55] == 'shake') {
                                                                echo 'selected';
                                                            }
                                                            ?>>shake</option>
                                                            <option value="swing" <?php
                                                            if ($styledata[55] == 'swing') {
                                                                echo 'selected';
                                                            }
                                                            ?>>swing</option>
                                                            <option value="tada" <?php
                                                            if ($styledata[55] == 'tada') {
                                                                echo 'selected';
                                                            }
                                                            ?>>tada</option>
                                                            <option value="wobble" <?php
                                                            if ($styledata[55] == 'wobble') {
                                                                echo 'selected';
                                                            }
                                                            ?>>wobble</option>
                                                            <option value="jello" <?php
                                                            if ($styledata[55] == 'jello') {
                                                                echo 'selected';
                                                            }
                                                            ?>>jello</option>
                                                        </optgroup>
                                                        <optgroup label="Bouncing Entrances">
                                                            <option value="bounceIn" <?php
                                                            if ($styledata[55] == 'bounceIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounceIn</option>
                                                            <option value="bounceInDown" <?php
                                                            if ($styledata[55] == 'bounceInDown') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounceInDown</option>
                                                            <option value="bounceInLeft" <?php
                                                            if ($styledata[55] == 'bounceInLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounceInLeft</option>
                                                            <option value="bounceInRight" <?php
                                                            if ($styledata[55] == 'bounceInRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounceInRight</option>
                                                            <option value="bounceInUp" <?php
                                                            if ($styledata[55] == 'bounceInUp') {
                                                                echo 'selected';
                                                            }
                                                            ?>>bounceInUp</option>
                                                        </optgroup>
                                                        <optgroup label="Fading Entrances">
                                                            <option value="fadeIn" <?php
                                                            if ($styledata[55] == 'fadeIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeIn</option>
                                                            <option value="fadeInDown" <?php
                                                            if ($styledata[55] == 'fadeInDown') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInDown</option>
                                                            <option value="fadeInDownBig" <?php
                                                            if ($styledata[55] == 'fadeInDownBig') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInDownBig</option>
                                                            <option value="fadeInLeft" <?php
                                                            if ($styledata[55] == 'fadeInLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInLeft</option>
                                                            <option value="fadeInLeftBig" <?php
                                                            if ($styledata[55] == 'fadeInLeftBig') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInLeftBig</option>
                                                            <option value="fadeInRight" <?php
                                                            if ($styledata[55] == 'fadeInRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInRight</option>
                                                            <option value="fadeInRightBig" <?php
                                                            if ($styledata[55] == 'fadeInRightBig') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInRightBig</option>
                                                            <option value="fadeInUp" <?php
                                                            if ($styledata[55] == 'fadeInUp') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInUp</option>
                                                            <option value="fadeInUpBig" <?php
                                                            if ($styledata[55] == 'fadeInUpBig') {
                                                                echo 'selected';
                                                            }
                                                            ?>>fadeInUpBig</option>
                                                        </optgroup>
                                                        <optgroup label="Flippers">
                                                            <option value="flip" <?php
                                                            if ($styledata[55] == 'flip') {
                                                                echo 'selected';
                                                            }
                                                            ?>>flip</option>
                                                            <option value="flipInX" <?php
                                                            if ($styledata[55] == 'flipInX') {
                                                                echo 'selected';
                                                            }
                                                            ?>>flipInX</option>
                                                            <option value="flipInY" <?php
                                                            if ($styledata[55] == 'flipInY') {
                                                                echo 'selected';
                                                            }
                                                            ?>>flipInY</option>
                                                        </optgroup>
                                                        <optgroup label="Lightspeed">
                                                            <option value="lightSpeedIn" <?php
                                                            if ($styledata[55] == 'lightSpeedIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>lightSpeedIn</option>
                                                        </optgroup>

                                                        <optgroup label="Rotating Entrances">
                                                            <option value="rotateIn"  <?php
                                                            if ($styledata[55] == 'rotateIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rotateIn</option>
                                                            <option value="rotateInDownLeft" <?php
                                                            if ($styledata[55] == 'rotateInDownLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rotateInDownLeft</option>
                                                            <option value="rotateInDownRight" <?php
                                                            if ($styledata[55] == 'rotateInDownRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rotateInDownRight</option>
                                                            <option value="rotateInUpLeft" <?php
                                                            if ($styledata[55] == 'rotateInUpLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rotateInUpLeft</option>
                                                            <option value="rotateInUpRight" <?php
                                                            if ($styledata[55] == 'rotateInUpRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rotateInUpRight</option>
                                                        </optgroup>
                                                        <optgroup label="Sliding Entrances">
                                                            <option value="slideInUp" <?php
                                                            if ($styledata[55] == 'slideInUp') {
                                                                echo 'selected';
                                                            }
                                                            ?>>slideInUp</option>
                                                            <option value="slideInDown" <?php
                                                            if ($styledata[55] == 'slideInDown') {
                                                                echo 'selected';
                                                            }
                                                            ?>>slideInDown</option>
                                                            <option value="slideInLeft" <?php
                                                            if ($styledata[55] == 'slideInLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>slideInLeft</option>
                                                            <option value="slideInRight" <?php
                                                            if ($styledata[55] == 'slideInRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>slideInRight</option>
                                                        </optgroup>
                                                        <optgroup label="Zoom Entrances">
                                                            <option value="zoomIn" <?php
                                                            if ($styledata[55] == 'zoomIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>zoomIn</option>
                                                            <option value="zoomInDown" <?php
                                                            if ($styledata[55] == 'zoomInDown') {
                                                                echo 'selected';
                                                            }
                                                            ?>>zoomInDown</option>
                                                            <option value="zoomInLeft" <?php
                                                            if ($styledata[55] == 'zoomInLeft') {
                                                                echo 'selected';
                                                            }
                                                            ?>>zoomInLeft</option>
                                                            <option value="zoomInRight" <?php
                                                            if ($styledata[55] == 'zoomInRight') {
                                                                echo 'selected';
                                                            }
                                                            ?>>zoomInRight</option>
                                                            <option value="zoomInUp" <?php
                                                            if ($styledata[55] == 'zoomInUp') {
                                                                echo 'selected';
                                                            }
                                                            ?>>zoomInUp</option>
                                                        </optgroup>
                                                        <optgroup label="Specials">
                                                            <option value="hinge" <?php
                                                            if ($styledata[55] == 'hinge') {
                                                                echo 'selected';
                                                            }
                                                            ?>>hinge</option>
                                                            <option value="rollIn" <?php
                                                            if ($styledata[55] == 'rollIn') {
                                                                echo 'selected';
                                                            }
                                                            ?>>rollIn</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="animation-timing" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Animation duration to determine how long the image will show, based on Seconds." >Animation Duration</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" oxilab-alert="Animation Duration" class="oxilab-alert-change form-control" min="0.1" step="0.1" max="10" id="animation-timing" name="animation-timing" value="<?php echo $styledata[57]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Box Shadow
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="box-shadow" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize the Shadow around the image box. Set 0 if no need" >Box Shadow <?php echo $ihewcimageproonly;?></label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="box-shadow" name="box-shadow" value="<?php echo $styledata[13]; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="box-shadow-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize the Box Shadow color, based on RGBA.">Box Shadow Color</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="numer" class="form-control ihewc-vendor-color" data-format="rgb" data-opacity="true"  id="box-shadow-color" name="box-shadow-color" value="<?php echo $styledata[15]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-5">
                                    <div class="oxilab-tabs-content-div-50">
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Heading
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="heading-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Heading or Title font size" >Font Size</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="heading-font-size" name="heading-font-size" value="<?php echo $styledata[17]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="heading-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Title Preferred font, Based on Google Font"> Font Family  <?php echo $ihewcimageproonly;?></label>
                                                <div class="col-sm-6 nopadding">
                                                    <input class="ihewc-admin-font" type="text" name="heading-font-familly" id="heading-font-familly" value="<?php echo $styledata[19]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="heading-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Heading/Title font style">Font Weight</label>
                                                <div class="col-sm-6 nopadding">
                                                    <select class="form-control" id="heading-font-weight" name="heading-font-weight">
                                                        <option value="100"     <?php
                                                        if ($styledata[21] == '100') {
                                                            echo 'selected';
                                                        };
                                                        ?>>100</option>
                                                        <option value="200"     <?php
                                                        if ($styledata[21] == '200') {
                                                            echo 'selected';
                                                        };
                                                        ?>>200</option>
                                                        <option value="300"     <?php
                                                        if ($styledata[21] == '300') {
                                                            echo 'selected';
                                                        };
                                                        ?>>300</option>
                                                        <option value="400"     <?php
                                                        if ($styledata[21] == '400') {
                                                            echo 'selected';
                                                        };
                                                        ?>>400</option>
                                                        <option value="500"     <?php
                                                        if ($styledata[21] == '500') {
                                                            echo 'selected';
                                                        };
                                                        ?>>500</option>
                                                        <option value="600"     <?php
                                                        if ($styledata[21] == '600') {
                                                            echo 'selected';
                                                        };
                                                        ?>>600</option>
                                                        <option value="700"     <?php
                                                        if ($styledata[21] == '700') {
                                                            echo 'selected';
                                                        };
                                                        ?>>700</option>
                                                        <option value="800"     <?php
                                                        if ($styledata[21] == '800') {
                                                            echo 'selected';
                                                        };
                                                        ?>>800</option>
                                                        <option value="900"     <?php
                                                        if ($styledata[21] == '900') {
                                                            echo 'selected';
                                                        };
                                                        ?>>900</option>
                                                        <option value="normal" <?php
                                                        if ($styledata[21] == 'normal') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Normal</option>
                                                        <option value="bold"    <?php
                                                        if ($styledata[21] == 'bold') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Bold</option>
                                                        <option value="lighter" <?php
                                                        if ($styledata[21] == 'lighter') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Lighter</option>
                                                        <option value="initial"   <?php
                                                        if ($styledata[21] == 'initial') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Initial</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Underline the Heading text, yes or no.">Heading Underline</label>
                                                <div class="col-sm-6 nopadding">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <label oxilab-alert="Heading Underline" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[23] == 'yes') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-heading-underline" id="ihewc-heading-underline-yes" autocomplete="off"  value="yes" <?php
                                                            if ($styledata[23] == 'yes') {
                                                                echo 'checked';
                                                            }
                                                            ?>> Yes
                                                        </label>
                                                        <label oxilab-alert="Heading Underline" class="oxilab-alert-click btn btn-info <?php
                                                        if ($styledata[23] == '') {
                                                            echo 'active';
                                                        }
                                                        ?>">
                                                            <input type="radio" name="ihewc-heading-underline" id="ihewc-heading-underline-no" autocomplete="off" value="" <?php
                                                            if ($styledata[23] == '') {
                                                                echo 'checked';
                                                            }
                                                            ?>> No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="heading-padding-bottom" class="col-sm-6 control-label" data-toggle="tmooltip" data-placement="top" title="Generate some space from Description to Heading" >Padding Bottom</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="heading-padding-bottom" name="heading-padding-bottom" value="<?php echo $styledata[25]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Description
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="desc-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Descriptions or Content font size" >Font Size</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="desc-font-size" name="desc-font-size" value="<?php echo $styledata[27]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="desc-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Descriptions Preferred font, Based on Google Font">Font Family  <?php echo $ihewcimageproonly;?></label>
                                                <div class="col-sm-6 nopadding">
                                                    <input class="ihewc-admin-font" type="text" name="desc-font-familly" id="desc-font-familly" value="<?php echo $styledata[29]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="desc-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Descriptions Font Style">Font Weight</label>
                                                <div class="col-sm-6 nopadding">
                                                    <select class="form-control" id="desc-font-weight" name="desc-font-weight">
                                                        <option value="100"     <?php
                                                        if ($styledata[31] == '100') {
                                                            echo 'selected';
                                                        };
                                                        ?>>100</option>
                                                        <option value="200"     <?php
                                                        if ($styledata[31] == '200') {
                                                            echo 'selected';
                                                        };
                                                        ?>>200</option>
                                                        <option value="300"     <?php
                                                        if ($styledata[31] == '300') {
                                                            echo 'selected';
                                                        };
                                                        ?>>300</option>
                                                        <option value="400"     <?php
                                                        if ($styledata[31] == '400') {
                                                            echo 'selected';
                                                        };
                                                        ?>>400</option>
                                                        <option value="500"     <?php
                                                        if ($styledata[31] == '500') {
                                                            echo 'selected';
                                                        };
                                                        ?>>500</option>
                                                        <option value="600"     <?php
                                                        if ($styledata[31] == '600') {
                                                            echo 'selected';
                                                        };
                                                        ?>>600</option>
                                                        <option value="700"     <?php
                                                        if ($styledata[31] == '700') {
                                                            echo 'selected';
                                                        };
                                                        ?>>700</option>
                                                        <option value="800"     <?php
                                                        if ($styledata[31] == '800') {
                                                            echo 'selected';
                                                        };
                                                        ?>>800</option>
                                                        <option value="900"     <?php
                                                        if ($styledata[31] == '900') {
                                                            echo 'selected';
                                                        };
                                                        ?>>900</option>
                                                        <option value="normal" <?php
                                                        if ($styledata[31] == 'normal') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Normal</option>
                                                        <option value="bold"    <?php
                                                        if ($styledata[31] == 'bold') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Bold</option>
                                                        <option value="lighter" <?php
                                                        if ($styledata[31] == 'lighter') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Lighter</option>
                                                        <option value="initial"   <?php
                                                        if ($styledata[31] == 'initial') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Initial</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="desc-padding-bottom" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Generate some space from Button to Description" >Padding Bottom</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="desc-padding-bottom" name="desc-padding-bottom" value="<?php echo $styledata[33]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-div-50">
                                        <div class="oxilab-tabs-content-div">
                                            <div class="head-oxi">
                                                Button
                                            </div>                                            
                                            <div class="form-group row form-group-sm">
                                                <label for="button-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Button font size" >Font Size </label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="button-font-size" name="button-font-size" value="<?php echo $styledata[35]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="button-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Button Preferred font, Based on Google Font">Font Family <?php echo $ihewcimageproonly;?></label>
                                                <div class="col-sm-6 nopadding">
                                                    <input class="ihewc-admin-font" type="text" name="button-font-familly" id="button-font-familly" value="<?php echo $styledata[37]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="button-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Button Font Style">Font Weight</label>
                                                <div class="col-sm-6 nopadding">
                                                    <select class="form-control" id="button-font-weight" name="button-font-weight">
                                                        <option value="100"     <?php
                                                        if ($styledata[39] == '100') {
                                                            echo 'selected';
                                                        };
                                                        ?>>100</option>
                                                        <option value="200"     <?php
                                                        if ($styledata[39] == '200') {
                                                            echo 'selected';
                                                        };
                                                        ?>>200</option>
                                                        <option value="300"     <?php
                                                        if ($styledata[39] == '300') {
                                                            echo 'selected';
                                                        };
                                                        ?>>300</option>
                                                        <option value="400"     <?php
                                                        if ($styledata[39] == '400') {
                                                            echo 'selected';
                                                        };
                                                        ?>>400</option>
                                                        <option value="500"     <?php
                                                        if ($styledata[39] == '500') {
                                                            echo 'selected';
                                                        };
                                                        ?>>500</option>
                                                        <option value="600"     <?php
                                                        if ($styledata[39] == '600') {
                                                            echo 'selected';
                                                        };
                                                        ?>>600</option>
                                                        <option value="700"     <?php
                                                        if ($styledata[39] == '700') {
                                                            echo 'selected';
                                                        };
                                                        ?>>700</option>
                                                        <option value="800"     <?php
                                                        if ($styledata[39] == '800') {
                                                            echo 'selected';
                                                        };
                                                        ?>>800</option>
                                                        <option value="900"     <?php
                                                        if ($styledata[39] == '900') {
                                                            echo 'selected';
                                                        };
                                                        ?>>900</option>
                                                        <option value="normal" <?php
                                                        if ($styledata[39] == 'normal') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Normal</option>
                                                        <option value="bold"    <?php
                                                        if ($styledata[39] == 'bold') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Bold</option>
                                                        <option value="lighter" <?php
                                                        if ($styledata[39] == 'lighter') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Lighter</option>
                                                        <option value="initial"   <?php
                                                        if ($styledata[39] == 'initial') {
                                                            echo 'selected';
                                                        };
                                                        ?>>Initial</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="button-padding-bottom" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Generate distance from button text to the button box." >Padding</label>
                                                <div class="col-sm-3 nopadding">
                                                    <input type="number" class="form-control" id="button-padding-bottom" name="button-padding-bottom" value="<?php echo $styledata[41]; ?>">
                                                </div>
                                                <div class="col-sm-3 nopadding">
                                                    <input type="number" class="form-control" id="button-padding-left" name="button-padding-left" value="<?php echo $styledata[43]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row form-group-sm">
                                                <label for="button-border-radius" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Radius the button box to make Radius" >Border Radius</label>
                                                <div class="col-sm-6 nopadding">
                                                    <input type="number" class="form-control" id="button-border-radius" name="button-border-radius" value="<?php echo $styledata[45]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-2">
                                    <div class="ihewc-admin-style-settings-div-css">
                                        <div class="form-group">
                                            <label for="ihewc-css">Add Your Custom CSS Code Here</label>
                                            <textarea oxilab-alert="Custom CSS" class="oxilab-alert-change form-control" rows="4" id="ihewc-css" name="ihewc-css"><?php echo $styledata[47]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-1">
                                    <?php echo ihewc_video_toturial(); ?>
                                </div>
                            </div>

                        </div>    

                        <div class="ihewc-style-setting-save">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="data-submit" value="Save">
                            <?php wp_nonce_field("ihewcstylecss") ?>
                        </div>
                    </form>
                </div>
                <div class="ihewc-style-settings-preview">
                    <div class="ihewc-style-settings-preview-heading">
                        <div class="ihewc-style-settings-preview-heading-left">
                            Preview
                        </div>
                        <div class="ihewc-style-settings-preview-heading-right">
                            <input type="text" class="form-control ihewc-vendor-color"  data-format="rgb" data-opacity="true"  id="ihewc-preview-data-background" name="ihewc-preview-data-background" value="rgba(255, 255, 255, 1)">
                        </div>
                    </div>
                    <div class="ihewc-preview-data" id="ihewc-preview-data">
                        <?php
                        ihewc_oxi_shortcode_effects($styleid, 'yes', $styledata, $listdata)
                        ?>

                    </div>
                </div>
            </div>
            <?php ihewc_admin_right_side_data($styleid, $listdata); ?>
        </div>
    </div>

    <div id="ihewc-add-new-item-data" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="POST">
                <?php wp_nonce_field("ihewcsavedata") ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add or Modify Form of Image Hover</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ctu-title">Title</label>
                            <input type="text "class="form-control" id="ihewc-title" name="ihewc-title" value="<?php echo ihewc_html_special_charecter($title); ?>">
                            <small class="form-text text-muted">Add Your Image Hover Title.</small>
                        </div>
                        <div class="form-group">
                            <label for="ctu-details">Description:</label>
                            <textarea class="form-control" rows="4" id="ihewc-desc" name="ihewc-desc"><?php echo ihewc_html_special_charecter($files); ?></textarea>
                            <small class="form-text text-muted">Add Your Description Unless make it blank.</small>
                        </div>
                        <div class="form-group">
                            <label for="ihewc-link">Link</label>
                            <input type="text "class="form-control" id="ihewc-link" name="ihewc-link" value="<?php echo $link; ?>">
                            <small class="form-text text-muted">Add Your Desire Link or Url Unless make it blank</small>
                        </div>
                        <div class="form-group">
                            <label for="ihewc-bottom">Bottom Text</label>
                            <input type="text "class="form-control" id="ihewc-bottom" name="ihewc-bottom" value="<?php echo ihewc_html_special_charecter($bottom); ?>">
                            <small class="form-text text-muted">Add Bottom text If you Need Unless make it blank</small>
                        </div>
                        <div class="form-group">
                            <label for="ctu-title">Image Url</label>
                            <div class="col-xs-12-div">
                                <div class="col-xs-8-div">
                                    <input type="text "class="form-control" id="ihewc-image-upload-url" name="ihewc-image-upload-url" value="<?php echo $image; ?>">
                                </div>
                                <div class="col-xs-4-div">
                                    <button type="button" id="ihewc-image-upload-button" name="ihewc-image-upload-button" class="btn btn-default">Upload Image</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Add or Modify Your Image link.</small>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title">Customize Effects and Color</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row form-group-sm">
                            <label for="image-style" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select effect style of your hover">Effects Style</label>
                            <div class="col-sm-6 nopadding">
                                <select class="form-control" name="image-style" id="image-style" size="1">
                                    <option value="">All Style</option>
                                    <option <?php
                                    if ($imagestyle == 'blinds-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="blinds-effects">Blinds Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'block-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="block-effects">Block Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'blur-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="blur-effects">Blur Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'book-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="book-effects">Book Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'border-reveal-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="border-reveal-effects">Border Reveal Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'bounce-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="bounce-effects">Bounce Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'circle-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="circle-effects">Circle Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'cube-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="cube-effects">Cube Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'dive-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="dive-effects">Dive Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'fade-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="fade-effects">Fade Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'fall-away-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="fall-away-effects">Fall Away Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'flash-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="flash-effects">Flash Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'flip-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="flip-effects">Flip Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'fold-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="fold-effects">Fold Effects</option>
                                    <option <?php
                                    if ($imagestyle == 'gradient-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('gradient-effects')?>">Gradient Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'hinge-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('hinge-effects')?>">Hinge Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'lightspeed-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('lightspeed-effects')?>">Lightspeed Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'modal-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('modal-effects')?>">Modal Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'parallax-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('parallax-effects')?>">Parallax Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'pivot-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('pivot-effects')?>">Pivot Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'pixel-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('pixel-effects')?>">Pixel Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'push-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('push-effects')?>">Push Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'reveal-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('reveal-effects')?>">Reveal Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'rotate-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('rotate-effects')?>">Rotate Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'shift-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('shift-effects')?>">Shift Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'shutter-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('shutter-effects')?>">Shutter Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'slide-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('slide-effects')?>">Slide Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'splash-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('splash-effects')?>">Splash Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'stack-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('stack-effects')?>">Stack Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'strip-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('strip-effects')?>">Strip Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'switch-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('switch-effects')?>">Switch Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'throw-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('throw-effects')?>">Throw Effects <?php echo $ihewcimageproonly;?></option>
                                    <option <?php
                                    if ($imagestyle == 'zoom-effects') {
                                        echo 'selected';
                                    }
                                    ?> value="<?php ihewcimageproonlydatagen('zoom-effects')?>">Zoom Effects <?php echo $ihewcimageproonly;?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row form-group-sm" id="image-effects-parent">
                            <label for="image-effects" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select effect style of your hover">Effects Style</label>
                            <div class="col-sm-6 nopadding">
                                <select  class="form-control" name="image-effects" id="image-effects" size="1">
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-horizontal" class="sub-blinds-effects">Blinds Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-vertical" class="sub-blinds-effects">Blinds Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-up" class="sub-blinds-effects">Blinds Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-down" class="sub-blinds-effects">Blinds Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-left" class="sub-blinds-effects">Blinds Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blinds-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blinds-right" class="sub-blinds-effects">Blinds Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-rotate-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-rotate-left" class="sub-block-effects">Block Rotate Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-rotate-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-rotate-right" class="sub-block-effects">Block Rotate Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-rotate-in-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-rotate-in-left" class="sub-block-effects">Block Rotate in Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-rotate-in-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-rotate-in-right" class="sub-block-effects">Block Rotate in Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-in') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-in" class="sub-block-effects">Block In</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-out') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-out" class="sub-block-effects">Block Out</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-float-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-float-up" class="sub-block-effects">Block Float Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-float-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-float-down" class="sub-block-effects">Block Float Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-float-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-float-left" class="sub-block-effects">Block Float Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-float-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-float-right" class="sub-block-effects">Block Float Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-zoom-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-zoom-top-left" class="sub-block-effects">Block Zoom Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-zoom-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-zoom-top-right" class="sub-block-effects">Block Zoom Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-zoom-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-zoom-bottom-left" class="sub-block-effects">Block Zoom Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blocks-zoom-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blocks-zoom-bottom-right" class="sub-block-effects">Block Zoom Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-blur') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-blur" class="sub-blur-effects">Blur Effects</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-horizontal" class="sub-book-effects">Book Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-vertical" class="sub-book-effects">Book Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-up" class="sub-book-effects">Book Open Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-down" class="sub-book-effects">Book Open Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-left" class="sub-book-effects">Book Open Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-book-open-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-book-open-right" class="sub-book-effects">Book Open Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal" class="sub-border-reveal-effects">Border Reveal </option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-vertical" class="sub-border-reveal-effects">Border Reveal Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-horizontal" class="sub-border-reveal-effects">Border Reveal Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-corners-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-corners-1" class="sub-border-reveal-effects">Border Reveal Corners 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-corners-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-corners-2" class="sub-border-reveal-effects">Border Reveal Corners 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-top-left" class="sub-border-reveal-effects">Border Reveal Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-top-right" class="sub-border-reveal-effects">Border Reveal Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-bottom-left" class="sub-border-reveal-effects">Border Reveal Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-bottom-right" class="sub-border-reveal-effects">Border Reveal Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-cc-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-cc-1" class="sub-border-reveal-effects">Border Reveal CC 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-ccc-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-ccc-1" class="sub-border-reveal-effects">Border Reveal CCC 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-cc-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-cc-2" class="sub-border-reveal-effects">Border Reveal CC 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-ccc-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-ccc-2" class="sub-border-reveal-effects">Border Reveal CCC 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-cc-3') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-cc-3" class="sub-border-reveal-effects">Border Reveal CC 3</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-border-reveal-ccc-3') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-border-reveal-ccc-3" class="sub-border-reveal-effects">Border Reveal CCC 3</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-in') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-in" class="sub-bounce-effects">Bounce In</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-in-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-in-up" class="sub-bounce-effects">Bounce In Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-in-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-in-down" class="sub-bounce-effects">Bounce In Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-in-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-in-left" class="sub-bounce-effects">Bounce In Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-in-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-in-right" class="sub-bounce-effects">Bounce In Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-out') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-out" class="sub-bounce-effects">Bounce Out</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-out-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-out-up" class="sub-bounce-effects">Bounce Out Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-out-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-out-down" class="sub-bounce-effects">Bounce Out Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-out-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-out-left" class="sub-bounce-effects">Bounce Out Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-bounce-out-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-bounce-out-right" class="sub-bounce-effects">Bounce Out Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-up" class="sub-circle-effects">Circle Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-down" class="sub-circle-effects">Circle Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-left" class="sub-circle-effects">Circle Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-right" class="sub-circle-effects">Circle Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-top-left" class="sub-circle-effects">Circle Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-top-right" class="sub-circle-effects">Circle Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-bottom-left" class="sub-circle-effects">Circle Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-circle-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-circle-bottom-right" class="sub-circle-effects">Circle Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-cube-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-cube-up" class="sub-cube-effects">Cube Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-cube-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-cube-down" class="sub-cube-effects">Cube Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-cube-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-cube-left" class="sub-cube-effects">Cube Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-cube-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-cube-right" class="sub-cube-effects">Cube Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-dive') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-dive" class="sub-dive-effects">Dive </option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-dive-cc') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-dive-cc" class="sub-dive-effects">Dive CC</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-dive-ccc') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-dive-ccc" class="sub-dive-effects">Dive CCC</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fade-in-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fade-in-up" class="sub-fade-effects">Fade in Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fade-in-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fade-in-down" class="sub-fade-effects">Fade in Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fade-in-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fade-in-left" class="sub-fade-effects">Fade in Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fade-in-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fade-in-right" class="sub-fade-effects">Fade in Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fall-away-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fall-away-horizontal" class="sub-fall-away-effects">Fall Away Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fall-away-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fall-away-vertical" class="sub-fall-away-effects">Fall Away Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fall-away-cc') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fall-away-cc" class="sub-fall-away-effects">Fall Away CC</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fall-away-ccc') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fall-away-ccc" class="sub-fall-away-effects">Fall Away CCC</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flash-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flash-top-left" class="sub-flash-effects">Flash Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flash-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flash-top-right" class="sub-flash-effects">Flash Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flash-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flash-bottom-left" class="sub-flash-effects">Flash Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flash-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flash-bottom-right" class="sub-flash-effects">Flash Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flip-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flip-horizontal" class="sub-flip-effects">Flip Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flip-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flip-vertical" class="sub-flip-effects">Flip Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flip-diagonal-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flip-diagonal-1" class="sub-flip-effects">Flip Diagonal 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-flip-diagonal-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-flip-diagonal-2" class="sub-flip-effects">Flip Diagonal 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fold-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fold-up" class="sub-fold-effects">Fold Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fold-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fold-down" class="sub-fold-effects">Fold Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fold-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fold-left" class="sub-fold-effects">Fold Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-fold-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-fold-right" class="sub-fold-effects">Fold Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-radial-in') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-radial-in" class="sub-gradient-effects">Gradient Redial In</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-radial-out') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-radial-out" class="sub-gradient-effects">Gradient Redial Out</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-up" class="sub-gradient-effects">Gradient Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-down" class="sub-gradient-effects">Gradient Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-left" class="sub-gradient-effects">Gradient Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-right" class="sub-gradient-effects">Gradient Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-top-left" class="sub-gradient-effects">Gradient Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-top-right" class="sub-gradient-effects">Gradient Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-bottom-left" class="sub-gradient-effects">Gradient Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-gradient-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-gradient-bottom-right" class="sub-gradient-effects">Gradient Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-hinge-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-hinge-up" class="sub-hinge-effects">Hinge Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-hinge-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-hinge-down" class="sub-hinge-effects">Hinge Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-hinge-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-hinge-left" class="sub-hinge-effects">Hinge Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-hinge-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-hinge-right" class="sub-hinge-effects">Hinge Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-lightspeed-in-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-lightspeed-in-left" class="sub-lightspeed-effects">Lightspeed in Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-lightspeed-in-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-lightspeed-in-right" class="sub-lightspeed-effects">Lightspeed in Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-lightspeed-out-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-lightspeed-out-left" class="sub-lightspeed-effects">Lightspeed Out Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-lightspeed-out-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-lightspeed-out-right" class="sub-lightspeed-effects">Lightspeed Out Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-slide-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-slide-up" class="sub-modal-effects">Modal Slide Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-slide-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-slide-down" class="sub-modal-effects">Modal Slide Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-slide-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-slide-left" class="sub-modal-effects">Modal Slide Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-slide-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-slide-right" class="sub-modal-effects">Modal Slide Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-hinge-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-hinge-up" class="sub-modal-effects">Modal Hinge Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-hinge-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-hinge-down" class="sub-modal-effects">Modal Hinge Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-hinge-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-hinge-left" class="sub-modal-effects">Modal Hinge Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-modal-hinge-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-modal-hinge-right" class="sub-modal-effects">Modal Hinge Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-parallax-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-parallax-up" class="sub-parallax-effects">Parallax Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-parallax-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-parallax-down" class="sub-parallax-effects">Parallax Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-parallax-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-parallax-left" class="sub-parallax-effects">Parallax Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-parallax-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-parallax-right" class="sub-parallax-effects">Parallax Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-in-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-in-top-left" class="sub-pivot-effects">Pivot in Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-in-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-in-top-right" class="sub-pivot-effects">Pivot in Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-in-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-in-bottom-left" class="sub-pivot-effects">Pivot in Bottom left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-in-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-in-bottom-right" class="sub-pivot-effects">Pivot in Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-out-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-out-top-left" class="sub-pivot-effects">Pivot out Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-out-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-out-top-right" class="sub-pivot-effects">Pivot out Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-out-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-out-bottom-left" class="sub-pivot-effects">Pivot out Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pivot-out-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pivot-out-bottom-right" class="sub-pivot-effects">Pivot out Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-up" class="sub-pixel-effects">Pixel Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-down" class="sub-pixel-effects">Pixel Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-left" class="sub-pixel-effects">Pixel Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-right" class="sub-pixel-effects">Pixel Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-top-left" class="sub-pixel-effects">Pixel Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-top-right" class="sub-pixel-effects">Pixel Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-bottom-left" class="sub-pixel-effects">Pixel Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-pixel-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-pixel-bottom-right" class="sub-pixel-effects">Pixel Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-push-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-push-up" class="sub-push-effects">Push Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-push-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-push-down" class="sub-push-effects">Push Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-push-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-push-left" class="sub-push-effects">Push Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-push-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-push-right" class="sub-push-effects">Push Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-up" class="sub-reveal-effects">Reveal Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-down" class="sub-reveal-effects">Reveal Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-left" class="sub-reveal-effects">Reveal Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-right" class="sub-reveal-effects">Reveal Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-top-left" class="sub-reveal-effects">Reveal Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-top-right" class="sub-reveal-effects">Reveal Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-bottom-left" class="sub-reveal-effects">Reveal Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-reveal-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-reveal-bottom-right" class="sub-reveal-effects">Reveal Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-rotate-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-rotate-left" class="sub-rotate-effects">Rotate Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-rotate-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-rotate-right" class="sub-rotate-effects">Rotate Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shift-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shift-top-left" class="sub-shift-effects">Shift Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shift-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shift-top-right" class="sub-shift-effects">Shift Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shift-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shift-bottom-left" class="sub-shift-effects">Shift Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shift-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shift-top-right" class="sub-shift-effects">Shift Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-out-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-out-horizontal" class="sub-shutter-effects">Shutter Out Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-out-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-out-vertical" class="sub-shutter-effects">Shutter Out Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-out-diagonal-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-out-diagonal-1" class="sub-shutter-effects">Shutter Out Diagonal 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-out-diagonal-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-out-diagonal-2" class="sub-shutter-effects">Shutter Out Diagonal 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-horizontal" class="sub-shutter-effects">Shutter in Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-vertical" class="sub-shutter-effects">Shutter in Vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-out-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-out-horizontal" class="sub-shutter-effects">Shutter in out Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-out-vertical') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-out-vertical" class="sub-shutter-effects">Shutter in Out vertical</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-out-diagonal-1') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-out-diagonal-1" class="sub-shutter-effects">Shutter in Out Diagonal 1</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-shutter-in-out-diagonal-2') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-shutter-in-out-diagonal-2" class="sub-shutter-effects">Shutter  in Out Diagonal 2</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-up" class="sub-slide-effects">Slide Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-down" class="sub-slide-effects">Slide Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-left" class="sub-slide-effects">Slide Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-right" class="sub-slide-effects">Slide Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-top-left" class="sub-slide-effects">Slide Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-top-right" class="sub-slide-effects">Slide Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-bottom-left" class="sub-slide-effects">Slide Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-slide-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-slide-bottom-right" class="sub-slide-effects">Slide Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-splash-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-splash-up" class="sub-splash-effects">Splash Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-splash-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-splash-down" class="sub-splash-effects">Splash Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-splash-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-splash-left" class="sub-splash-effects">Splash Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-splash-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-splash-right" class="sub-splash-effects">Splash Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-up" class="sub-stack-effects">Stack Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-down" class="sub-stack-effects">Stack Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-left" class="sub-stack-effects">Stack Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-right" class="sub-stack-effects">Stack Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-top-left" class="sub-stack-effects">Stack Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-top-right" class="sub-stack-effects">Stack Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-bottom-left" class="sub-stack-effects">Stack Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-stack-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-stack-bottom-right" class="sub-stack-effects">Stack Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-shutter-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-shutter-up" class="sub-strip-effects">Strip Shutter Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-shutter-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-shutter-down" class="sub-strip-effects">Strip Shutter Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-shutter-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-shutter-left" class="sub-strip-effects">Strip Shutter Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-shutter-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-shutter-right" class="sub-strip-effects">Strip Shutter Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-up" class="sub-strip-effects">Strip Horizontal Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-down" class="sub-strip-effects">Strip Horizontal Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-top-left" class="sub-strip-effects">Strip Horizontal Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-top-right" class="sub-strip-effects">Strip Horizontal Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-left" class="sub-strip-effects">Strip Horizontal Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-horizontal-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-horizontal-right" class="sub-strip-effects">Strip Horizontal Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-left" class="sub-strip-effects">Strip Vertical Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-right" class="sub-strip-effects">Strip Vertical Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-top-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-top-left" class="sub-strip-effects">Strip Vertical Top Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-top-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-top-right" class="sub-strip-effects">Strip Vertical Top Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-bottom-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-bottom-left" class="sub-strip-effects">Strip Vertical Bottom Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-strip-vertical-bottom-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-strip-vertical-bottom-right" class="sub-strip-effects">Strip Vertical Bottom Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-switch-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-switch-up" class="sub-switch-effects">Switch Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-switch-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-switch-down" class="sub-switch-effects">Switch Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-switch-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-switch-left" class="sub-switch-effects">Switch Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-switch-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-switch-right" class="sub-switch-effects">Switch Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-in-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-in-up" class="sub-throw-effects">Throw In Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-in-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-in-down" class="sub-throw-effects">Throw In Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-in-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-in-left" class="sub-throw-effects">Throw In Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-in-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-in-right" class="sub-throw-effects">Throw In Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-out-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-out-up" class="sub-throw-effects">Throw Out Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-out-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-out-down" class="sub-throw-effects">Throw Out Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-out-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-out-left" class="sub-throw-effects">Throw Out Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-throw-out-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-throw-out-right" class="sub-throw-effects">Throw Out Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-in') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-in" class="sub-zoom-effects">Zoom In</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out" class="sub-zoom-effects">Zoom Out</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-up') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out-up" class="sub-zoom-effects">Zoom Out Up</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-down') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out-down" class="sub-zoom-effects">Zoom Out Down</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-left') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out-left" class="sub-zoom-effects">Zoom Out Left</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-right') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out-right" class="sub-zoom-effects">Zoom Out Right</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-flip-horizontal') {
                                        echo 'selected';
                                    }
                                    ?> value="ihewc-zoom-out-flip-horizontal" class="sub-zoom-effects">Zoom Out Flip Horizontal</option>
                                    <option <?php
                                    if ($imageeffects == 'ihewc-zoom-out-flip-vertical') {
                                        echo 'selected';
                                    }
                                    ?>  value="ihewc-zoom-out-flip-vertical" class="sub-zoom-effects">Zoom Out Flip Vertical</option>
                                </select>
                                <span id="optionstore" style="display:none;"></span>
                            </div>
                        </div>
                        <?php ihewc_addtional_items_data($imagebackgroundcolor, $imagealignments, $titlecolor, $titleanimation, $desccolor, $descanimation, $buttomcolor, $buttomanimation, $buttombackground, $ihewcimageproonly); ?>
                    </div>   
                     
                    <div class="modal-footer">
                        <input type="hidden" id="item-id" name="item-id" value="<?php echo $itemid ?>">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" id="item-submit" name="submit" value="submit">
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

