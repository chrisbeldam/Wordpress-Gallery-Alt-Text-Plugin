<?php
/**
 * This file could be used to catch submitted form data. When using a non-configuration
 * view to save form data, remember to use some kind of identifying field in your form.
 */  


$args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID,
    );

$attachments = get_posts( $args );
if ( $attachments ) {
    echo '<p>All images which appear here, need to have alt text and a description added to them</p>';
    foreach ( $attachments as $attachment ) {
        $alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
        $image_description = $attachment ->post_content;
        $image_urls = get_permalink($attachment, true);
        $image_titles = apply_filters( 'the_title', $attachment->post_title );
        if (!$alt_text){
            echo '<p><li>';
            echo '<a href=' . $image_urls . '>' .$image_titles.'</a>';
            echo '</p></li>';
        }

    } // End of gallery iteration

//     echo '<p>All images which appear here here have no alt text but a description</p>';
//     foreach ( $attachments as $attachment ) {
//         $alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
//         $image_description = $attachment ->post_content;
//         $image_urls = get_permalink($attachment, true);
//         $image_titles = apply_filters( 'the_title', $attachment->post_title );
//         if($image_description){
//                 echo '<p><li>';
//                 echo '<a href=' . $image_urls . '>' .$image_titles.'</a>';
//                 echo '</p></li>';
//         }
//     } // End of gallery iteration
//     echo '<p>All images which appear here have an alt text and no description</p>';
//     foreach ( $attachments as $attachment ) {
//         $alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
//         $image_description = $attachment ->post_content;
//         $image_urls = get_permalink($attachment, true);
//         $image_titles = apply_filters( 'the_title', $attachment->post_title );
//         if($alt_text){
//                 echo '<p><li>';
//                 echo '<a href=' . $image_urls . '>' .$image_titles.'</a>';
//                 echo '</p></li>';
//         }
//     }
}

?>
<!-- <p>This is the front-facing part of the widget, and can be found and edited from <tt><?php echo __FILE__ ?></tt></p>
<p>Widgets can be configured as well. Currently, this is set to <b><?php echo self::get_dashboard_widget_option(self::wid, 'example_number'); ?></b> ! To change the number, hover over the widget title and click on the "Configure" link.</p> -->