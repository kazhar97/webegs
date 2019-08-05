jQuery(document).ready(function () {
    jQuery('.ihewc-vendor-color').each(function () {
        jQuery(this).minicolors({
            control: jQuery(this).attr('data-control') || 'hue',
            defaultValue: jQuery(this).attr('data-defaultValue') || '',
            format: jQuery(this).attr('data-format') || 'hex',
            keywords: jQuery(this).attr('data-keywords') || '',
            inline: jQuery(this).attr('data-inline') === 'true',
            letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
            opacity: jQuery(this).attr('data-opacity'),
            position: jQuery(this).attr('data-position') || 'bottom left',
            swatches: jQuery(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
            change: function (value, opacity) {
                if (!value)
                    return;
                if (opacity)
                    value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    jQuery('#ihewc-add-new-item').on('click', function () {
        jQuery("#ihewc-add-new-item-data").modal("show");
        jQuery("#ihewc-image-upload-url").val(null);
        jQuery("#ihewc-title").val(null);
        jQuery("#ihewc-desc").val(null);
        jQuery("#ihewc-bottom").val(null);
        jQuery("#ihewc-link").val(null);
        jQuery("#item-id").val(null);
    });
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery(".ihewc-draggable").draggable({
        handle: ".modal-header"
    });
    jQuery('.ihewc-admin-font').fontselect()
    jQuery('#ihewc-hover-drag-and-drop').on('click', function () {
        jQuery("#ihewc-hover-drag-and-drop-data").modal("show");
    });
    jQuery("#ihewc-preview-data-background").on("change", function () {
        var idvalue = jQuery('#ihewc-preview-data-background').val();
        jQuery("<style type='text/css'> #ihewc-preview-data{ background-color:" + idvalue + ";} </style>").appendTo("#ihewc-preview-data");
    });
    jQuery(".ctu-ulimate-style-3 li:first").addClass("active");
    jQuery(".ctu-ulitate-style-3-tabs:first").addClass("active");
    jQuery(".ctu-ulimate-style-3 li").click(function () {
        jQuery(".ctu-ulimate-style-3 li").removeClass("active");
        jQuery(this).toggleClass("active");
        jQuery(".ctu-ulitate-style-3-tabs").removeClass("active");
        var activeTab = jQuery(this).attr("ref");
        jQuery(activeTab).addClass("active");
    });
    function ihewc_carousel() {
        if (jQuery('#ihewc-showing-type-carousel').attr('checked')) {
            jQuery("#carousel-autoplay-hidden-show").slideDown();
        } else if (jQuery('#ihewc-showing-type-normal').attr('checked')) {
            jQuery("#carousel-autoplay-hidden-show").slideUp();
        }
    }
    ihewc_carousel();
    jQuery("#ihewc-showing-type-carousel").on("change", function () {
        ihewc_carousel();
    });
    jQuery("#ihewc-showing-type-normal").on("change", function () {
        ihewc_carousel();
    });
    function ihewc_carousel_timing() {
        if (jQuery('#carousel-autoplay-on').attr('checked')) {
            jQuery("#carousel-autoplay-time-show").slideDown();
        } else if (jQuery('#carousel-autoplay-off').attr('checked')) {
            jQuery("#carousel-autoplay-time-show").slideUp();
        }
    }
    ihewc_carousel_timing();
    jQuery("#carousel-autoplay-on").on("change", function () {
        ihewc_carousel_timing();
    });
    jQuery("#carousel-autoplay-off").on("change", function () {
        ihewc_carousel_timing();
    });
    jQuery(".oxilab-alert-change").on("change", function () {
        var data = "<strong>" + jQuery(this).attr('oxilab-alert') + " </strong> will works after saved data";
        jQuery.bootstrapGrowl(data, {});

    });
    jQuery(".oxilab-alert-click").on("click", function () {
        var data = "<strong>" + jQuery(this).attr('oxilab-alert') + " </strong> will works after saved data";
        jQuery.bootstrapGrowl(data, {});
    });
    /* Carousel Data JQuery Asbe*/
    jQuery('#ihewc-image-type').change(function () {
        jQuery("<style type='text/css'> .ihewc-hover, .ihewc-hover .ihewc-hover-figure, .ihewc-hover .ihewc-hover-image, .ihewc-hover .ihewc-hover-image img, .ihewc-hover .ihewc-hover-figure .ihewc-hover-figure-caption, .ihewc-hover .ihewc-hover-figure .ihewc-hover-figure-caption-content{border-radius: " + jQuery(this).val() + "%; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#ihewc-item").on("change", function () {
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-1");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-2");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-3");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-4");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-5");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-6");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-7");
        jQuery(".ihewc-editing").removeClass("ihewc-responsive-8");
        jQuery(".ihewc-editing").addClass(jQuery("#ihewc-item").val());
    });
    jQuery("#image-height").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover .ihewc-hover-image:after{padding-bottom: " + jQuery(this).val() + "%; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#image-margin").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-editing{padding: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#image-padding").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover .ihewc-hover-figure-caption{padding: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#box-shadow").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover {box-shadow: 0 0 " + jQuery("#box-shadow").val() + "px " + jQuery("#box-shadow-color").val() + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#box-shadow-color").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover {box-shadow: 0 0 " + jQuery("#box-shadow").val() + "px " + jQuery("#box-shadow-color").val() + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#heading-font-size").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover h3{font-size: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#heading-font-familly").on("change", function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'> .ihewc-hover h3{font-family: " + font[0] + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#heading-font-weight").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover h3{font-weight: " + jQuery(this).val() + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#heading-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover h3{margin-bottom: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#desc-font-size").on("change", function () {
        jQuery("<style type='text/css'>  .ihewc-hover p{font-size: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#desc-font-familly").on("change", function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'> .ihewc-hover p{font-family: " + font[0] + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#desc-font-weight").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover p{font-weight: " + jQuery(this).val() + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#desc-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover p{margin-bottom: " + jQuery(this).val() + "px !important; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-font-size").on("change", function () {
        jQuery("<style type='text/css'>  .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{font-size: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-font-familly").on("change", function () {
        var font = jQuery(this).val().replace(/\+/g, ' ');
        font = font.split(':');
        jQuery("<style type='text/css'> .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{font-family: " + font[0] + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-font-weight").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{font-weight: " + jQuery(this).val() + "; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-padding-bottom").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{padding-bottom: " + jQuery(this).val() + "px; padding-top: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-padding-left").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{padding-right: " + jQuery(this).val() + "px; padding-left: " + jQuery(this).val() + "px; } </style>").appendTo("#ihewc-preview-data");
    });
    jQuery("#button-border-radius").on("change", function () {
        jQuery("<style type='text/css'> .ihewc-hover  .img-btn, .ihewc-hover .img-btn:hover, .ihewc-hover .img-btn:focus, .ihewc-hover .img-btn:active{border-radius: " + jQuery(this).val() + "px;  } </style>").appendTo("#ihewc-preview-data");
    });

    jQuery('#ihewc-hover-drag-and-drop').on('click', function () {
        jQuery("#ihewc-image-drag-and-drop-data").modal("show");
        jQuery("#ihewc-image-drag-saving").slideUp();
        jQuery("#ihewc-image-drag-drop").slideDown();
        jQuery("#ihewc-image-drag-and-drop-data-close").slideDown();
        jQuery('#ihewc-image-drag-and-drop-data-submit').val('Submit');

    });
    jQuery('#ihewc-image-drag-drop').sortable({
        axis: 'y',
        opacity: 0.7
    });

});


jQuery(document).ready(function () {
    jQuery('#image-effects-parent').slideUp();
    jQuery('#image-style').on("change", function () {
        var cattype = jQuery(this).val();
        jQuery('#image-effects-parent').slideDown();
        optionswitch(cattype);
    });
});
function optionswitch(myfilter) {
    if (jQuery('#optionstore').text() == "") {
        jQuery('option[class^="sub-"]').each(function () {
            var optvalue = jQuery(this).val();
            var optclass = jQuery(this).prop('class');
            var opttext = jQuery(this).text();
            optionlist = jQuery('#optionstore').text() + "@%" + optvalue + "@%" + optclass + "@%" + opttext;
            jQuery('#optionstore').text(optionlist);
        });
    }

    //Delete everything
    jQuery('option[class^="sub-"]').remove();

    // Put the filtered stuff back
    populateoption = rewriteoption(myfilter);
    jQuery('#image-effects').html(populateoption);
}

function rewriteoption(myfilter) {
    //Rewrite only the filtered stuff back into the option
    var options = jQuery('#optionstore').text().split('@%');
    var resultgood = false;
    var myfilterclass = "sub-" + myfilter;
    var optionlisting = "";

    myfilterclass = (myfilter != "") ? myfilterclass : "all";

    //First variable is always the value, second is always the class, third is always the text
    for (var i = 3; i < options.length; i = i + 3) {
        if (options[i - 1] == myfilterclass || myfilterclass == "all") {
            optionlisting = optionlisting + '<option value="' + options[i - 2] + '" class="' + options[i - 1] + '">' + options[i] + '</option>';
            resultgood = true;
        }
    }
    if (resultgood) {
        return optionlisting;
    }
}
