<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<script data-cfasync="false">

// executes this when the DOM is ready
jQuery(document).ready(function() {
	// handles the click event of the submit button
	jQuery('#submit').click(function(){
		// defines the options and their default values
		// again, this is not the most elegant way to do this
		// but well, this gets the job done nonetheless
       var colorhighlight = jQuery('#colorhighlight').val();
	   var texthighlight = jQuery('#hightext').val();
				var Columnposition = jQuery('#Columnposition');
					if( ! tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
					 var contenthighlight = jQuery("textarea.wp-editor-area").selection('get');
					}
					else {
			        	var contenthighlight = tinyMCE.activeEditor.selection.getContent(); 
			        }				
				
				var shortcode = '[wpsm_highlight ';
				
				if(colorhighlight) {
					shortcode += 'color="'+colorhighlight+'"]';
				}
				if ( texthighlight !== '' )
					shortcode += texthighlight;
				else if	( contenthighlight !== '' )
					shortcode += contenthighlight;
				else 
					shortcode += 'Text';
				
				shortcode += '[/wpsm_highlight]';

		//window.tinyMCE.activeEditor.selection.moveToBookmark( actualCaretPositionBookmark);
		
        window.send_to_editor(shortcode);
		
		// closes Thickbox
		tb_remove();
	});
}); 
</script>
<form action="/" method="get" id="form" name="form" accept-charset="utf-8">	
	<p>
		<label for="colorhighlight"><?php esc_html_e('Color of highlight :', 'rehub-theme') ;?></label>
		<select id="colorhighlight" name="colorhighlight" style="width:100px;">
			<option value="yellow"><?php esc_html_e('yellow', 'rehub-theme') ;?></option>
			<option value="blue"><?php esc_html_e('blue', 'rehub-theme') ;?></option>
			<option value="red"><?php esc_html_e('red', 'rehub-theme') ;?></option>
			<option value="green"><?php esc_html_e('green', 'rehub-theme') ;?></option>
			<option value="black"><?php esc_html_e('black', 'rehub-theme') ;?></option>
		</select>
	</p>

	<p>
		<label for="hightext"><?php esc_html_e('Content :', 'rehub-theme') ;?></label>
        <input id="hightext" name="hightext" type="text" value="" /><br />
		<small><?php esc_html_e('Leave blank if you selected text in visual editor', 'rehub-theme') ;?></small>
	</p>
	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php esc_html_e('Insert', 'rehub-theme') ;?>" name="submit" />
    </p>
</form>