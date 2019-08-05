jQuery(function () {
    jQuery("#ihewc-image-drag-submit").submit(function (e) {
        var list_sortable = jQuery('#ihewc-image-drag-drop').sortable('toArray').toString();
        var security = jQuery('#ihewc-ajax-nonce').val();
        jQuery.post({
            url: ihewc_hover_drag_drop_ajax.ajaxurl,
            beforeSend: function () {
                jQuery("#ihewc-image-drag-saving").slideDown();
                jQuery("#ihewc-image-drag-drop").slideUp();
                jQuery("#ihewc-image-drag-and-drop-data-close").slideUp();
                jQuery('#ihewc-image-drag-and-drop-data-submit').val('Saving...');
            },
            data: {
                action: 'ihewc_hover_admin_ajax_data',
                list_order: list_sortable,
                security: security
            },
            success: function () {
                setTimeout(function () {
                    location.reload();
                }, 500);
            }
        });
        e.preventDefault();
        return false;
    });
});
  