<?php
/**
 * Template Name: Products single page
 */

get_header();
?>
<section class="section">
<?php

while (have_posts()):
    the_post();

    the_content();

endwhile; // End of the loop.

$posts = get_field('product_cat');

if ($posts): ?>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <?php foreach ($posts as $post):
            setup_postdata($post);
            $pdf            = get_field('product_pdf');
            $image          = get_field('product_image');
            $image_full     = $image['url']; 
            //echo "<pre>";
            //print_r($image);
            //echo "</pre>";
            if ($pdf){
            ?>
	        <a href="<?php echo $pdf;?>" target="_blank">
	            <div class="column is-narrow product_block single__product image">
	                 <img src="<?php echo $image_full ?>" alt="">
                     <?php the_title(); ?>
	            </div>
	        </a>
            <? } else { ?>
                <div class="column is-narrow product_block single__product image">
	                 <img src="<?php echo $image_full ?>" alt="">
                     <?php the_title(); ?>
	            </div>
            <?php } ?>
	    <?php endforeach;?>
    </div>
    <?php wp_reset_postdata();
?>
<?php endif;?>
</section>
<?php
get_footer()
?>