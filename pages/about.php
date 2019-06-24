<?php
/**
 * Template Name: About page
 */

get_header();
$image      = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
$image_url  = $image[0];
$pdf        = get_field('download_statement');
$url        = $pdf['url'];
$title      = $pdf['title'];
// echo "<pre>";
// print_r($image);
// echo "</pre>";
?>

<section class="section about" style="background-image: url(<?php echo $image_url; ?>); background-size: cover; background-position: right bottom">
    <div class="content">
        <?php
        the_title( '<h1 class="entry-title">', '</h1>' );
        while (have_posts()):
            the_post();
            the_content();
        endwhile; // End of the loop.
        ?>
    </div>
    </section>
<section class="has-text-centered section">
    <a class="button is-link" href="<?php echo $url ?>"><?php echo $title ?></a>
</section>
<?php
get_footer();