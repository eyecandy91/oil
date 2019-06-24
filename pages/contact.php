<?php
/**
 * Template Name: Contact page
 */

get_header();
$place1                 = myprefix_get_theme_option('place1');
$place2                 = myprefix_get_theme_option('place2');
$head_phone             = myprefix_get_theme_option('head_phone');
$head_address           = myprefix_get_theme_option('head_address');
$head_email             = myprefix_get_theme_option('head_email');
$dalby_phone            = myprefix_get_theme_option('dalby_phone');
$dalby_address          = myprefix_get_theme_option('dalby_address');
$dalby_email            = myprefix_get_theme_option('dalby_email');
$maps                   = get_field('embeded_map');

// if (!empty($maps)) { ?>
<section class="columns section">
    <div class="column page-featured-image is-half-tablet">
        <div class="map-responsive">
            <?php echo $maps ?>
        </div>
    </div>
    <?php //} ?>

    <div class="column is-full-mobile is-half-tablet is-half-desktop">
        <div class="columns">
            <div class="column is-full-mobile is-half-tablet is-half-desktop">
                <?php
                echo "<h2 class='title'>";
                echo $place1;
                echo "</h2>";
                echo "<br>";
                echo "Phone: ";
                echo $head_phone;
                echo "<br>";
                echo "Address: ";
                echo $head_address;
                echo "<br>";
                echo "Email: ";
                echo $head_email; ?>
            </div>
            <div class="column is-full-mobile is-half-tablet is-half-desktop">
                <?php
                echo "<h2 class='title'>";
                echo $place2;
                echo "</h2>";
                echo "<br>";
                echo "Phone: ";
                echo $dalby_phone;
                echo "<br>";
                echo "Address: ";
                echo $dalby_address;
                echo "<br>";
                echo "Email: ";
                echo $dalby_email;
                ?>
            </div>
        </div>
        <div>
            <?php echo do_shortcode(get_post_meta(get_the_id(), 'form_id', true)); ?>
        </div>
</section>

<?php
get_footer();