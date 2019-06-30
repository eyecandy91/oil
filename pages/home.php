<?php
/**
 *
 * Template Name: Home page
 *
 */
get_header();

echo "<section class='section'>";
while (have_posts()):
    the_post();

    the_content();

endwhile; // End of the loop.
echo "</section>";

// get_sidebar();
get_footer();
