<?php
/**
 * Template Name: Products page
 */

get_header();
?>
<section class="section">
<?php
if (is_page( 'products' )) {
    $posts = get_field('product_cat');
    if ($posts) : ?>
        <div class="columns is-mobile is-multiline is-centered">
            <?php foreach ($posts as $post) :
                setup_postdata($post);
                $products   = get_field('product_on'); 
                $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                $url        = $image[0];
                $height     = $image[2];
                $width      = $image[2];
                //print_r($image)
                ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="column is-narrow product_block">
                        <img src="<?php echo $url ?>" alt="">
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata();
    endif;
} else {
    $posts = get_field('product_cat');
    if ($posts) : ?>
        <div class="columns is-mobile is-multiline is-centered has-text-centered">
            <?php foreach ($posts as $post) :
                setup_postdata($post); 
                    $products   = get_field('products_on'); 
                    $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                    $url        = $image[0];
                    $height     = $image[2];
                    $width      = $image[2];
                    if ($products) { ?>
                        <a class="has-text-link" href="<?php the_permalink(); ?>">
                            <div class="column is-narrow product_block single__product image">
                                <div class="picture">
                                <img src="<?php echo $url ?>" alt="">
                                </div>
                                <span class="is-uppercase is-size-5"><?php the_title();?></span>
                            </div>
                        </a> 
                    <?php } else {
                        $url_home   = home_url('/'); ?>
                        <a class="has-text-link" href="<?php echo esc_url($url_home); ?>">
                            <div class="column is-narrow product_block single__product image">
                                <div class="picture">
                                <img src="<?php echo $url ?>" alt="">
                                </div>
                                <span class="is-uppercase is-size-5"><?php the_title();?></span>
                            </div>  
                        </a>
                    <?php } 
            endforeach; ?>
        </div>
        <?php wp_reset_postdata();
    endif;
}
echo "</section>";

get_footer()
?>