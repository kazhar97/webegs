<?php
if (!defined('ABSPATH'))
    exit;

if (empty($_GET['styleid'])) {
    ihewc_vendor_js_css('new');
    include image_hover_with_carousel_url . 'public/style-new.php';
}
if (!empty($_GET['styleid']) && is_numeric($_GET['styleid'])) {
    include image_hover_with_carousel_url . 'public/effects.php';
    ihewc_vendor_js_css('style');
    ihewc_media_scripts();
}


function ihewc_addtional_items_data($imagebackgroundcolor, $imagealignments, $titlecolor, $titleanimation, $desccolor, $descanimation, $buttomcolor, $buttomanimation, $buttombackground, $ihewcimageproonly) {
    ?>

   <div class="form-group row form-group-sm">
        <label for="image-alignments" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Your Hover Item Alignments">Alignments</label>
        <div class="col-sm-6 nopadding">
            <select class="form-control" id="image-alignments" name="image-alignments">
                <option value="ihewc-layout-horizontal-left ihewc-layout-vertical-top" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-left ihewc-layout-vertical-top') {
                    echo 'selected';
                }
                ?>>Top Left</option>
                <option value="ihewc-layout-horizontal-center ihewc-layout-vertical-top" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-center ihewc-layout-vertical-top') {
                    echo 'selected';
                }
                ?>>Top Center</option>
                <option value="ihewc-layout-horizontal-right ihewc-layout-vertical-top" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-right ihewc-layout-vertical-top') {
                    echo 'selected';
                }
                ?>>Top Right</option>
                <option value="ihewc-layout-horizontal-left ihewc-layout-vertical-middle" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-left ihewc-layout-vertical-middle') {
                    echo 'selected';
                }
                ?>>Middle Left</option>
                <option value="ihewc-layout-horizontal-center ihewc-layout-vertical-middle" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-center ihewc-layout-vertical-middle') {
                    echo 'selected';
                }
                ?>>Middle Center</option>
                <option value="ihewc-layout-horizontal-right ihewc-layout-vertical-middle" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-right ihewc-layout-vertical-middle') {
                    echo 'selected';
                }
                ?>>Middle Right</option>
                <option value="ihewc-layout-horizontal-left ihewc-layout-vertical-bottom" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-left ihewc-layout-vertical-bottom') {
                    echo 'selected';
                }
                ?>>Bottom  Left</option>
                <option value="ihewc-layout-horizontal-center ihewc-layout-vertical-bottom" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-center ihewc-layout-vertical-bottom') {
                    echo 'selected';
                }
                ?>>Bottom  Center</option>
                <option value="ihewc-layout-horizontal-right ihewc-layout-vertical-bottom" <?php
                if ($imagealignments == 'ihewc-layout-horizontal-right ihewc-layout-vertical-bottom') {
                    echo 'selected';
                }
                ?>>Bottom  Right</option>
            </select>
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="image-background-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize Your Hover Background Color, Also Modify Alpha if you want">Image Background <?php echo $ihewcimageproonly;?></label>
        <div class="col-sm-6 nopadding">
            <input type="text" class="form-control ihewc-vendor-color"  data-format="rgb" data-opacity="true" id="image-background-color" name="image-background-color" value="<?php echo $imagebackgroundcolor; ?>">
        </div>
    </div>
 
    <div class="form-group row form-group-sm">
        <label for="title-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize the color of Title text">Title Color  <?php echo $ihewcimageproonly;?> </label>
        <div class="col-sm-6 nopadding">
            <input type="text" class="form-control ihewc-vendor-color"  id="title-color" name="title-color" value="<?php echo $titlecolor; ?>">
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="title-animation" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Animation style for Title">Title Animation <?php echo $ihewcimageproonly;?> </label>
        <div class="col-sm-6 nopadding">
            <select class="form-control" id="title-animation" name="title-animation">
                <option value="" <?php
                if ($titleanimation == '') {
                    echo 'selected';
                }
                ?>>None</option>                
                <option value="ihewc-fade-up" <?php
                if ($titleanimation == 'ihewc-fade-up') {
                    echo 'selected';
                }
                ?>>Fade Up</option>
                <option value="ihewc-fade-down" <?php
                if ($titleanimation == 'ihewc-fade-down') {
                    echo 'selected';
                }
                ?>>Fade Down</option>
                <option value="ihewc-fade-left" <?php
                if ($titleanimation == 'ihewc-fade-left') {
                    echo 'selected';
                }
                ?>>Fade Left</option>
                <option value="ihewc-fade-right" <?php
                if ($titleanimation == 'ihewc-fade-right') {
                    echo 'selected';
                }
                ?>>Fade Right</option>
                <option value="ihewc-fade-up-big" <?php
                if ($titleanimation == 'ihewc-fade-up-big') {
                    echo 'selected';
                }
                ?>>Fade Up Big</option>
                <option value="ihewc-fade-down-big" <?php
                if ($titleanimation == 'ihewc-fade-down-big') {
                    echo 'selected';
                }
                ?>>Fade Down Big</option>
                <option value="ihewc-fade-left-big" <?php
                if ($titleanimation == 'ihewc-fade-left-big') {
                    echo 'selected';
                }
                ?>>Fade Left Big</option>
                <option value="ihewc-fade-right-big" <?php
                if ($titleanimation == 'ihewc-fade-right-big') {
                    echo 'selected';
                }
                ?>>Fade Right Big</option>
                <option value="ihewc-zoom-in" <?php
                if ($titleanimation == 'ihewc-zoom-in') {
                    echo 'selected';
                }
                ?>>Zoom In</option>
                <option value="ihewc-zoom-out" <?php
                if ($titleanimation == 'ihewc-zoom-out') {
                    echo 'selected';
                }
                ?>>Zoom Out</option>
                <option value="ihewc-flip-x" <?php
                if ($titleanimation == 'ihewc-flip-x') {
                    echo 'selected';
                }
                ?>>Flip X</option>
                <option value="ihewc-flip-y" <?php
                if ($titleanimation == 'ihewc-flip-y') {
                    echo 'selected';
                }
                ?>>Flip Y</option>
            </select>
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="desc-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize the color of Description text">Description Color <?php echo $ihewcimageproonly;?> </label>
        <div class="col-sm-6 nopadding">
            <input type="text" class="form-control ihewc-vendor-color"  id="desc-color" name="desc-color" value="<?php echo $desccolor; ?>">
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="desc-animation" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Animation style for Description">Description Animation <?php echo $ihewcimageproonly;?>  </label>
        <div class="col-sm-6 nopadding">
            <select class="form-control" id="desc-animation" name="desc-animation">
                <option value="" <?php
                if ($descanimation == '') {
                    echo 'selected';
                }
                ?>>None</option>
                <option value="ihewc-fade-up" <?php
                if ($descanimation == 'ihewc-fade-up') {
                    echo 'selected';
                }
                ?>>Fade Up</option>
                <option value="ihewc-fade-down" <?php
                if ($descanimation == 'ihewc-fade-down') {
                    echo 'selected';
                }
                ?>>Fade Down</option>
                <option value="ihewc-fade-left" <?php
                if ($descanimation == 'ihewc-fade-left') {
                    echo 'selected';
                }
                ?>>Fade Left</option>
                <option value="ihewc-fade-right" <?php
                if ($descanimation == 'ihewc-fade-right') {
                    echo 'selected';
                }
                ?>>Fade Right</option>
                <option value="ihewc-fade-up-big" <?php
                if ($descanimation == 'ihewc-fade-up-big') {
                    echo 'selected';
                }
                ?>>Fade Up Big</option>
                <option value="ihewc-fade-down-big" <?php
                if ($descanimation == 'ihewc-fade-down-big') {
                    echo 'selected';
                }
                ?>>Fade Down Big</option>
                <option value="ihewc-fade-left-big" <?php
                if ($descanimation == 'ihewc-fade-left-big') {
                    echo 'selected';
                }
                ?>>Fade Left Big</option>
                <option value="ihewc-fade-right-big" <?php
                if ($descanimation == 'ihewc-fade-right-big') {
                    echo 'selected';
                }
                ?>>Fade Right Big</option>
                <option value="ihewc-zoom-in" <?php
                if ($descanimation == 'ihewc-zoom-in') {
                    echo 'selected';
                }
                ?>>Zoom In</option>
                <option value="ihewc-zoom-out" <?php
                if ($descanimation == 'ihewc-zoom-out') {
                    echo 'selected';
                }
                ?>>Zoom Out</option>
                <option value="ihewc-flip-x" <?php
                if ($descanimation == 'ihewc-flip-x') {
                    echo 'selected';
                }
                ?>>Flip X</option>
                <option value="ihewc-flip-y" <?php
                if ($descanimation == 'ihewc-flip-y') {
                    echo 'selected';
                }
                ?>>Flip Y</option>
            </select>
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="buttom-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize the color of Button text">Button Color <?php echo $ihewcimageproonly;?> </label>
        <div class="col-sm-6 nopadding">
            <input type="text" class="form-control ihewc-vendor-color" data-format="rgb" data-opacity="true" id="buttom-color" name="buttom-color" value="<?php echo $buttomcolor; ?>">
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="buttom-animation" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Animation style for Button">Button Animation <?php echo $ihewcimageproonly;?>  </label>
        <div class="col-sm-6 nopadding">
            <select class="form-control" id="buttom-animation" name="buttom-animation">
                <option value="" <?php
                if ($buttomanimation == '') {
                    echo 'selected';
                }
                ?>>None</option>
                <option value="ihewc-fade-up" <?php
                if ($buttomanimation == 'ihewc-fade-up') {
                    echo 'selected';
                }
                ?>>Fade Up</option>
                <option value="ihewc-fade-down" <?php
                if ($buttomanimation == 'ihewc-fade-down') {
                    echo 'selected';
                }
                ?>>Fade Down</option>
                <option value="ihewc-fade-left" <?php
                if ($buttomanimation == 'ihewc-fade-left') {
                    echo 'selected';
                }
                ?>>Fade Left</option>
                <option value="ihewc-fade-right" <?php
                if ($buttomanimation == 'ihewc-fade-right') {
                    echo 'selected';
                }
                ?>>Fade Right</option>
                <option value="ihewc-fade-up-big" <?php
                if ($buttomanimation == 'ihewc-fade-up-big') {
                    echo 'selected';
                }
                ?>>Fade Up Big</option>
                <option value="ihewc-fade-down-big" <?php
                if ($buttomanimation == 'ihewc-fade-down-big') {
                    echo 'selected';
                }
                ?>>Fade Down Big</option>
                <option value="ihewc-fade-left-big" <?php
                if ($buttomanimation == 'ihewc-fade-left-big') {
                    echo 'selected';
                }
                ?>>Fade Left Big</option>
                <option value="ihewc-fade-right-big" <?php
                if ($buttomanimation == 'ihewc-fade-right-big') {
                    echo 'selected';
                }
                ?>>Fade Right Big</option>
                <option value="ihewc-zoom-in" <?php
                if ($buttomanimation == 'ihewc-zoom-in') {
                    echo 'selected';
                }
                ?>>Zoom In</option>
                <option value="ihewc-zoom-out" <?php
                if ($buttomanimation == 'ihewc-zoom-out') {
                    echo 'selected';
                }
                ?>>Zoom Out</option>
                <option value="ihewc-flip-x" <?php
                if ($buttomanimation == 'ihewc-flip-x') {
                    echo 'selected';
                }
                ?>>Flip X</option>
                <option value="ihewc-flip-y" <?php
                if ($buttomanimation == 'ihewc-flip-y') {
                    echo 'selected';
                }
                ?>>Flip Y</option>
            </select>
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="buttom-background" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize Your Button Background Color">Button Background <?php echo $ihewcimageproonly;?> </label>
        <div class="col-sm-6 nopadding">
            <input type="text" class="form-control ihewc-vendor-color"  id="buttom-background" name="buttom-background" value="<?php echo $buttombackground; ?>">
        </div>
    </div>
    <?php
}

function ihewc_admin_right_side_data($styleid, $listdata) {
    ?>
    <div class="ihewc-style-panel-right">
        <div class="ihewc-add-new-item-panel">
            <div class="ihewc-add-new-item-heading">
                Add New
            </div>
            <div class="ihewc-add-new-item"  id="ihewc-add-new-item">
                <span>
                    <i class="fa fa-plus-circle"></i>
                    Add new Items
                </span>

            </div>
        </div>
        <div class="ihewc-shortcode">
            <div class="ihewc-shortcode-heading">
                Shortcodes
            </div>
            <div class="ihewc-shortcode-body">
                <em>Shortcode for posts/pages/plugins</em>
                <p>Copy & paste the shortcode directly into any WordPress post or page.</p>
                <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[ihewc_oxi id=&quot;<?php echo $styleid; ?>&quot;]">
                <span></span>
                <em>Shortcode for templates/themes</em>
                <p>Copy & paste this code into a template file to include the slideshow within your theme.</p>
                <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ihewc_oxi  id=&quot;<?php echo $styleid; ?>&quot;]&#039;); ?&gt;">
                <span></span>
                <em>Apply on Visual Composer</em>
                <p>Go on Visual Composer and get Our element on Content bar as Image Hover Ultimate</p>
            </div>
        </div>
        <div class="ihewc-add-new-item-panel">
            <div class="ihewc-add-new-item-heading">
                Image Rearrange
            </div>
            <div class="ihewc-add-new-item"  id="ihewc-hover-drag-and-drop">
                <span>
                    <i class="fa fa-cogs"></i>
                </span>

            </div>
        </div>
           <div id="ihewc-image-drag-and-drop-data" class="modal fade bd-example-modal-sm" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <form id="ihewc-image-drag-submit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Rearrange Image</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert text-center" id="ihewc-image-drag-saving">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    <?php
                                    echo ' <ul class="list-group" id="ihewc-image-drag-drop">';
                                    foreach ($listdata as $value) {
                                        echo '<li class="list-group-item" id ="' . $value['id'] . '"><img src="' . $value['image'] . '"  width="80"></li>';
                                    }
                                    echo '</ul>';
                                    ?>
                                </div>
                                <div class="modal-footer">    
                                    <input type="hidden" name="ihewc-ajax-nonce" id="ihewc-ajax-nonce" value="<?php echo wp_create_nonce("ihewc_ajax_data"); ?>"/>
                                    <button type="button" id="ihewc-image-drag-and-drop-data-close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <input type="submit" id="ihewc-image-drag-and-drop-data-submit" class="btn btn-primary" value="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
    </div>
    <?php
}

function ihewc_vendor_js_css($data) {
    wp_enqueue_style('ihewc-vendor-style', plugins_url('css-js/style.css', __FILE__));
    wp_enqueue_script('ihewc-vendor-bootstrap-jss', plugins_url('css-js/bootstrap.min.js', __FILE__));
    wp_enqueue_style('ihewc-vendor-bootstrap', plugins_url('css-js/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font-awesome', plugins_url('css-js/font-awesome.min.css', __FILE__));
    wp_enqueue_script('jQuery');
    if ($data == 'style') {
        wp_enqueue_script('ihewc-vendor-minicolors-js', plugins_url('css-js/jquery.minicolors.min.js', __FILE__));
        wp_enqueue_style('ihewc-vendor-minicolors', plugins_url('css-js/jquery.minicolors.css', __FILE__));
        wp_enqueue_script('ihewc-vendor-jss', plugins_url('css-js/vendor.js', __FILE__));
        wp_enqueue_script('bootstrap-growl-js', plugins_url('css-js/jquery.bootstrap-growl.js', __FILE__));
        wp_enqueue_script('ihewc-vendor-font-select', plugins_url('css-js/font-select.js', __FILE__));
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-mouse');
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('ihewc-vendor-bootstrap-jss', plugins_url('css-js/bootstrap.min.js', __FILE__));
        wp_enqueue_style('ihewc-vendor-bootstrap', plugins_url('css-js/bootstrap.min.css', __FILE__));
    }
    if ($data == 'new') {
        wp_enqueue_style('admin-style', plugins_url('public/style.css', __FILE__));
        wp_enqueue_style('style-blinds-effects', plugins_url('public/style-blinds-effects.css', __FILE__));
        wp_enqueue_style('style-block-effects', plugins_url('public/style-block-effects.css', __FILE__));
        wp_enqueue_style('style-blur-effects', plugins_url('public/style-blur-effects.css', __FILE__));
        wp_enqueue_style('style-book-effects', plugins_url('public/style-book-effects.css', __FILE__));
        wp_enqueue_style('style-border-reveal-effects', plugins_url('public/style-border-reveal-effects.css', __FILE__));
        wp_enqueue_style('style-bounce-effects', plugins_url('public/style-bounce-effects.css', __FILE__));
        wp_enqueue_style('style-circle-effects', plugins_url('public/style-circle-effects.css', __FILE__));
        wp_enqueue_style('style-cube-effects', plugins_url('public/style-cube-effects.css', __FILE__));
        wp_enqueue_style('style-dive-effects', plugins_url('public/style-dive-effects.css', __FILE__));
        wp_enqueue_style('style-fade-effects', plugins_url('public/style-fade-effects.css', __FILE__));
        wp_enqueue_style('style-fall-away-effects', plugins_url('public/style-fall-away-effects.css', __FILE__));
        wp_enqueue_style('style-flash-effects', plugins_url('public/style-flash-effects.css', __FILE__));
        wp_enqueue_style('style-flip-effects', plugins_url('public/style-flip-effects.css', __FILE__));
        wp_enqueue_style('style-fold-effects', plugins_url('public/style-fold-effects.css', __FILE__));
        wp_enqueue_style('style-gradient-effects', plugins_url('public/style-gradient-effects.css', __FILE__));
        wp_enqueue_style('style-hinge-effects', plugins_url('public/style-hinge-effects.css', __FILE__));
        wp_enqueue_style('style-lightspeed-effects', plugins_url('public/style-lightspeed-effects.css', __FILE__));
        wp_enqueue_style('style-modal-effects', plugins_url('public/style-modal-effects.css', __FILE__));
        wp_enqueue_style('style-parallax-effects', plugins_url('public/style-parallax-effects.css', __FILE__));
        wp_enqueue_style('style-pivot-effects', plugins_url('public/style-pivot-effects.css', __FILE__));
        wp_enqueue_style('style-pixel-effects', plugins_url('public/style-pixel-effects.css', __FILE__));
        wp_enqueue_style('style-push-effects', plugins_url('public/style-push-effects.css', __FILE__));
        wp_enqueue_style('style-reveal-effects', plugins_url('public/style-reveal-effects.css', __FILE__));
        wp_enqueue_style('style-rotate-effects', plugins_url('public/style-rotate-effects.css', __FILE__));
        wp_enqueue_style('style-shift-effects', plugins_url('public/style-shift-effects.css', __FILE__));
        wp_enqueue_style('style-shutter-effects', plugins_url('public/style-shutter-effects.css', __FILE__));
        wp_enqueue_style('style-slide-effects', plugins_url('public/style-slide-effects.css', __FILE__));
        wp_enqueue_style('style-splash-effects', plugins_url('public/style-splash-effects.css', __FILE__));
        wp_enqueue_style('style-stack-effects', plugins_url('public/style-stack-effects.css', __FILE__));
        wp_enqueue_style('style-strip-effects', plugins_url('public/style-strip-effects.css', __FILE__));
        wp_enqueue_style('style-switch-effects', plugins_url('public/style-switch-effects.css', __FILE__));
        wp_enqueue_style('style-throw-effects', plugins_url('public/style-throw-effects.css', __FILE__));
        wp_enqueue_style('style-zoom-effects', plugins_url('public/style-zoom-effects.css', __FILE__));
        wp_enqueue_style('animate', plugins_url('public/animate.css', __FILE__));
    }
}

function ihewc_media_scripts() {
    wp_enqueue_media();
    wp_register_script('ihewc_media_scripts', plugins_url('css-js/media-lib-uploader-js.js', __FILE__));
    wp_enqueue_script('ihewc_media_scripts');
}