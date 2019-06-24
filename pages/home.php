<?php
/**
 *
 * Template Name: Home page
 *
 */

get_header();

while (have_posts()):
    the_post();

    the_content();

endwhile; // End of the loop.

// get_sidebar();
get_footer();
