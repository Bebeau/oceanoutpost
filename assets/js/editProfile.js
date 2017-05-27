var user = {
	onReady: function() {
		user.imageUploader();
		user.removeImage();
		user.onKeyUp();
	},
	imageUploader: function() {
		var meta_image_frame;
     	// Runs when the image button is clicked.
	    jQuery('.upload-image').on("click",function(e){

	    	// Prevents the default action from occuring.
	        e.preventDefault();

	        var button = jQuery(this);
	        var elem = jQuery(this).parent();
	    	var value = jQuery(this).attr("data-input");
	    	var input = jQuery('#'+value);

	        // Sets up the media library frame
	        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
	            title: meta_image.title,
	            button: { text:  meta_image.button },
	            library: { type: 'image, video' },
	            multiple: false
	        });

	        // Opens the media library frame.
	        meta_image_frame.open();

	        // Runs when an image is selected.
	        meta_image_frame.on('select', function(){

	            // Grabs the attachment selection and creates a JSON representation of the model.
	            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

	            // remove upload button
	            button.remove();
	            elem.css('background-image', 'url('+media_attachment.url+')');
	            input.val(media_attachment.url);
	            elem.append('<button class="remove-image button" data-input="'+value+'">X</button>');
	            user.saveImage( value, media_attachment.url );
	            meta_image_frame.close();
	        });
	    });
	},
	saveImage: function(field, image) {
        jQuery.ajax({
            url: ajaxurl,
            type: "GET",
            data: {
                imageField: field,
                fieldVal: image,
                action: 'setImage'
            },
            dataType: 'html',
            success : function() {
            	user.removeImage();
            },
            error : function(jqXHR, textStatus, errorThrown) {
                window.alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        }); 
    },
    removeImage: function() {
		jQuery('.remove-image').click(function(e){
			e.preventDefault();

			var val = jQuery(this).attr("data-input");
			var img = jQuery(this).attr("data-img");

			jQuery(this).parent().css('background-image', '');

			jQuery(this).parent().find("input").val("");

			jQuery(this).parent().append('<button class="upload-image button button-large button-primary" style="text-align:center;" data-img="'+img+'" data-input="'+val+'">Upload/Set Banner</button>');
			
			jQuery(this).remove();

			user.imageUploader();
			user.saveImage(val,"");

		});
	},
	onKeyUp: function() {
		jQuery('.text input').on('keyup',function(){
			var value = jQuery(this).val();
			var field = jQuery(this).attr("id");
			var element = jQuery(this).attr("data-element");
			jQuery.ajax({
	            url: ajaxurl,
	            type: "GET",
	            data: {
	                inputVal: value,
	                input: field,
	                action: 'setCopy'
	            },
	            dataType: 'html',
	            success : function(data) {
	            	jQuery('#BannerCTA .'+element).html(data);
	            }
	        });
		});
	}
};
jQuery(document).ready(function() {
	user.onReady();
});