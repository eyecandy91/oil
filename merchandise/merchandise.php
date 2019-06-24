<?php
/**
 * Template Name: Merchandise page
 */

get_header();
echo "<section class='section'>";
$posts = get_field('product_cat');
if ($posts) : ?>
<div class="columns is-mobile is-multiline is-centered">
    <?php foreach ($posts as $post) :
            ?>
    <?php setup_postdata($post); ?>
    <?php 
            $products       = get_field('product_on'); 
            $price          = get_field('product_price'); 
            $image          = get_field('product_image');
            $image_url      = $image['url'];
            $image_width    = $image['width'];
            $image_height   = $image['height'];
            $image_title    = $image['title'];
            // print_r($image);
            ?>
    <a class="column is-narrow is-half-mobile is-one-third-tablet is-one-quarter-desktop product_block merchandise has-text-centered"
        href="<?php the_permalink(); ?>">
        <div class="image">
            <img src="<?php echo $image_url ?>" alt="<?php echo $title ?>" height="<?php echo $image_height ?>"
                width="<?php echo $image_width ?>">
            <div><?php the_title(); ?></div>
            <div><?php
                                if (!empty($price)) {
                                    if (fmod($price, 1) !== 0.00) { ?>
                                        <p>$ <?php echo $price; ?></p>
                                    <? } else { ?>
                                        <p>$ <?php echo $price; ?>.00</p>
                                    <?php }
                            }
                            ?></div>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php
wp_reset_postdata();
endif;
echo "</section>";
echo "<section class='section content'>";
the_content();
echo "</section>";
get_footer();