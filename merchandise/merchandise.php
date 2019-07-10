<?php
/**
 * Template Name: Merchandise page
 */
$sponsor            = get_field('sponsor'); 
$sponsor_url        = $sponsor['url']; 
$sponsor_name       = $sponsor['name']; 
$sponsor_h          = $sponsor['height']; 
$sponsor_w          = $sponsor['width']; 
get_header();
echo "<section class='section'>";
$posts = get_field('product_cat');
if ($posts) : ?>
<div class="columns is-mobile is-multiline is-centered">
    <?php foreach ($posts as $post) :
        setup_postdata($post); 
            $products       = get_field('product_on'); 
            $price          = get_field('product_price'); 
            $image          = get_field('product_image');
            $image_url      = $image['url'];
            $image_width    = $image['width'];
            $image_height   = $image['height'];
            $image_title    = $image['title'];
            // print_r($image); ?>
    <a class="column is-narrow is-half-mobile is-one-third-tablet is-one-quarter-desktop product_block merchandise has-text-centered has-text-link"
        href="<?php the_permalink(); ?>">
        <div class="image">
            <img src="<?php echo $image_url ?>" alt="<?php echo $title ?>" height="<?php echo $image_height ?>"
                width="<?php echo $image_width ?>">
            <div class="is-uppercase is-size-5">
                <div><?php the_title(); ?></div>
                <div><?php
                    if (!empty($price)) {
                        if (fmod($price, 1) !== 0.00) { ?>
                    <p>$<?php echo $price; ?></p>
                    <? } else { ?>
                    <p>$<?php echo $price; ?>.00</p>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php
wp_reset_postdata();
endif;
echo "</section>";
echo "<section class='section content has-text-centered product_block__category-info'>";
the_content();
// echo $sponsor ;
// echo "<pre>";
// // print_r($sponsor );
?>
<img class="sponsor" src="<?php echo $sponsor_url ?>" width="<?php echo $sponsor_w ?>" height="<?php echo $sponsor_h ?>" alt="<?php echo $sponsor_name ?>">
<?php
echo "</section>";
get_footer();