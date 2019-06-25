<?php
/**
 * Template Name: Products single page
 */

get_header();
?>
    <div class="has-text-centered product_block__category-info">
        <?php
while (have_posts()):
    the_post();
    the_content();
endwhile; // End of the loop.?>
    </div>
    <?php
$posts = get_field('product_cat');

if ($posts): ?>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <?php foreach ($posts as $post):
    setup_postdata($post);
    $pdf = get_field('product_pdf');
    $image = get_field('product_image');
    $image_full = $image['url'];
    $image_alt = $image['alt'];
    //echo "<pre>";
    //print_r($image);
    //echo "</pre>";
    if ($pdf) {?>
	        <a class="has-text-link" href="<?php echo $pdf; ?>" target="_blank">
	            <div class="column is-narrow product_block single__product image">
	                <div class="picture">
	                    <img src="<?php echo $image_full ?>" class="image" alt="<?php echo $image_alt ?>">
	                </div>
	                <span class="is-uppercase is-size-5"><?php the_title();?></span>
	            </div>
	        </a>
	        <?} else {?>
	        <div class="column is-narrow product_block single__product image">
	            <div class="picture">
	                <img src="<?php echo $image_full ?>" class="image" alt="<?php echo $image_alt ?>">
	            </div>
	            <span class="is-uppercase is-size-5 has-text-link"><?php the_title();?></span>
	        </div>
	        <?php }
endforeach;?>
    </div>
    <?php wp_reset_postdata();
endif;?>
<?php
get_footer()
?>