<?php
/**
 * This file could be used to catch submitted form data. When using a non-configuration
 * view to save form data, remember to use some kind of identifying field in your form.
 */  



// PHP code which hooks into the wordpress media gallery and then allows me to return images without alt text
function altTextChecker(){
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID,
        );
    
    $attachments = get_posts( $args );
    
    if ( $attachments ) {
        echo '<p>All images which appear here, currently have no alt text. To improve your SEO score, add alt text to these images.</p>';
        // echo '<p>Total Number of images to fix: '. $amount_of_images .'' . '</p>';
        foreach ( $attachments as $attachment ) {
            $alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
            $image_urls = get_permalink($attachment, true);
            $image_titles = apply_filters( 'the_title', $attachment->post_title );
            if (strpos($image_urls, '%postname%') === false){
                if (!$alt_text){
                    echo '<p><li>';
                    echo '<a href=' . $image_urls . '>' .$image_titles.'</a>';
                    echo '</p></li>';
                    if (!$alt_text === false){
                        echo 'There are no images requiring alt text';
                    }
                }
            }
        } // End of gallery iteration
    }
}

// Function which hooks into the wordpress media gallery and checks for descriptions on images
function descriptionChecker(){
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID,
        );
    
    $attachments = get_posts( $args );
    if ( $attachments ) {
        echo '<p>All images which appear here, currently have no description text.</p>';
        // echo '<p>Total Number of images to fix: '. $amount_of_images .'' . '</p>';
        foreach ( $attachments as $attachment ) {      
            $image_description = $attachment ->post_content;
            $image_urls = get_permalink($attachment, true);
            $image_titles = apply_filters( 'the_title', $attachment->post_title );
            if (strpos($image_urls, '%postname%') === false){
                if (!$image_description){     
                    echo '<p><li>';
                    echo '<a href=' . $image_urls . '>' .$image_titles.'</a>';
                    echo '</p></li>';
                }
            }
        } // End of gallery iteration
    }
}

function footerText(){
    echo 'Plugin Created By: Chris Beldam' . ' ' . '&copy; 2018';
    echo '<br>';
    echo 'If you would like to report any bugs or would like to suggest additional functionality you can find me on ' . ' ' . 
         '<a href="https://www.github.com/chrisbeldam">GitHub</a> or email me <a href="mailto:chrisgbeldam@gmail.com?subject=Wordpress Alt Text Plugin">Email</a>';
}

altTextChecker();
// footerText();


?>
<!-- <p>This is the front-facing part of the widget, and can be found and edited from <tt><?php echo __FILE__ ?></tt></p>
<p>Widgets can be configured as well. Currently, this is set to <b><?php echo self::get_dashboard_widget_option(self::wid, 'example_number'); ?></b> ! To change the number, hover over the widget title and click on the "Configure" link.</p> -->



