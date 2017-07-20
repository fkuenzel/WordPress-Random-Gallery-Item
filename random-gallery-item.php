<?php
/**
 * Random Gallery Item
 *
 * a Shortcode for a Random Image
 *
 * @example		[random_gallery_item post="POSTID's" size="thumbnail" class="my-random-gallery-item"]
**/
function random_gallery_item( $atts ) {
	$atts = shortcode_atts(
		array(
			'post'	=> '',
			'size'	=> 'medium',
			'class'	=> 'random-gallery-item',
		), $atts, 'random_gallery_item' );
	
	$post_ids = explode( ',', $atts['post'] );
	
	foreach( $post_ids as $post_id ) {
		$gallery_array[] = get_post_gallery( $post_id, false );
	}
	foreach( $gallery_array as $gal ) {
		$gallery[] = $gal['ids'];
	}

	
	//array with Attachment IDS
	foreach( $gallery as $key => $value ) {
		$gal_img_id .= $value. ',';
	}
	$gal_img_id = substr($gal_img_id, 0, -1);
	$gallery_attachment_ids = explode( ',', $gal_img_id );
	$attachment_id = $gallery_attachment_ids[rand(0,count($gallery_attachment_ids)-1)];
	$attachment_uri = wp_get_attachment_image( $attachment_id ,$atts['size'], true);
	
	
	$output  = '<div class="'. $atts['class'] .'">';
	$output .= '<a href="'. get_permalink( $atts['post']) .'">';
	$output .= $attachment_uri;
	$output .= '</a>';
	$output .= '</div>';
	
	
	return $output;
} add_shortcode( 'random_gallery_item', 'random_gallery_item' );

?>
