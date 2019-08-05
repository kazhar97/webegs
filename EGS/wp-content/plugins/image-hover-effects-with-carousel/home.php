<?php
if (!defined('ABSPATH'))
    exit;
image_hover_effects_with_carousel_user_capabilities();
global $wpdb;
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
$table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Clone' && is_numeric($_POST['id'])) {
    if (!wp_verify_nonce($nonce, 'image_hover_carousel_home_clone')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = (int) $_POST['id'];
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $id), ARRAY_A);
        $name = sanitize_text_field($_POST['style-name']);
        $css = $data['css'];
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, css) VALUES (%s, %s)", array($name, $css)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=image-hover-carousel-new");
        }
        if ($redirect_id != 0) {
            $url = admin_url("admin.php?page=image-hover-carousel-new&styleid=$redirect_id");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
       exit;
    }
}

if (!empty($_POST['delete']) && is_numeric($_POST['id'])) {
    
    if (!wp_verify_nonce($nonce, 'ihewcdeletehomedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = $_POST['id'];        
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
    }
}
$data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'image_hover_with_carousel_style ORDER BY id DESC', ARRAY_A);
?>
<div class="wrap">
    <?php ihewc_promote_free(); ?>
    <h1> Image Hover Effects <a href="<?php echo admin_url("admin.php?page=image-hover-carousel-new"); ?>" class="btn btn-primary"> Add New</a></h1>
    <div class="ihewc-admin-wrapper table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
                 <?php
        if (count($data) == 0) {
            ?>
            <div class="orphita-admin-style-preview">
                <div class="orphita-admin-style-preview-top">
                    <a href="<?php echo admin_url("admin.php?page=image-hover-carousel-new"); ?>">
                        <div class="orphita-admin-add-new-item">
                            <span>
                                <i class="fa fa-plus-circle"></i>
                                Create Your First Hover Effects
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <?php
        } else {
            ?>
        <table class="table table-hover widefat " style="background-color: #fff; border: 1px solid #ccc">
            <thead>
                <tr>
                    <th style="width: 15%">ID</th>
                    <th style="width: 20%">Name</th>
                    <th style="width: 40%">Shortcode</th>
                    <th style="width: 25%">Edit Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $value) {
                    $id = $value['id'];
                    echo ' <tr>';
                    echo ' <td>' . $id . '</td>';
                    echo '  <td >' . $value['name'] . '</td>';
                    echo '<td ><span>Shortcode <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[ihewc_oxi id=&quot;' . $id . '&quot;]"></span>'
                    . '&nbsp;&nbsp;<span>Php Code <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ihewc_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                    echo '<td >     <button type="button" class="btn btn-success orphita-style-clone"  style="float:left; margin-right: 5px;" data-toggle="modal" data-target="#orphita-style-model" dataid="' . $id . '">Clone</button>
                                    <a href="' . admin_url("admin.php?page=image-hover-carousel-new&styleid=$id") . '"  class="btn btn-info" style="float:left; margin-right: 5px;">Edit</a>
                                    <form method="post"> ' . wp_nonce_field("ihewcdeletehomedata") . '
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button class="btn btn-danger orphita-style-delete" style="float:left" type="submit" value="delete" name="delete">Delete</button>  
                                    </form>
                                   
                             </td>';
                    echo ' </tr>';
                }
                ?>

            </tbody>
        </table> 
        <?php }
                ?>
    </div>
</div>

<div class="modal fade" id="orphita-style-model" >
    <form method="post">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Effect Settings</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row form-group-sm">
                        <label for="style" class="col-sm-6 col-form-label"  data-toggle="tooltip" class="tooltipLink" data-original-title="Give Your Template Name">Name</label>
                        <div class="col-sm-6 nopadding">
                            <input class="form-control" type="text" value="" id='style-name'  name="style-name">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" value="">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="submit" value="Clone">
                    <?php wp_nonce_field("image_hover_carousel_home_clone") ?>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".orphita-style-clone").on("click", function () {
            var dataid = jQuery(this).attr("dataid");
            jQuery("#id").val(dataid);
        });
        jQuery('.orphita-style-delete').click(function () {
            var status = confirm("Do you Want to Delete?");
            if (status == false) {
                return false;
            } else {
                return true;
            }
        });
    });
</script> 