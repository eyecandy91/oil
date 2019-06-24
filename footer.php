<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

$img1       		= get_field('footer1', 7); 
$link1      		= get_field('footerlink1', 7); 
$img1_url      		= $img1['url'];
$img1_alt      		= $img1['alt'];

$img2          		= get_field('footer2', 7); 
$link2      		= get_field('footerlink2', 7); 
$img2_url    		= $img2['url'];
$img2_alt    		= $img2['alt'];

$img3          		= get_field('footer3', 7);
$link3      		= get_field('footerlink3', 7); 
$img3_url   		= $img3['url'];
$img3_alt   		= $img3['alt'];

$img4          		= get_field('footer4', 7);
$link4	     		= get_field('footerlink4', 7); 
$img4_url   		= $img4['url'];
$img4_alt   		= $img4['alt'];

$img5          		= get_field('footer5', 7);
$link5       		= get_field('footerlink5', 7); 
$img5_url   		= $img5['url'];
$img5_alt   		= $img5['alt'];

// echo "<pre>";
// print_r($img1);
// echo "</pre>";
?>

</div>

<footer>
    <div class="has-text-centered">
        <span class="is-size-5">Proud Distributors of:</span>
    </div class="has-text-centered">
    <div class="columns is-mobile is-multiline is-centered">
	<?php if($link1){ ?>
        <a class="column is-narrow has-text-centered" href="<?php echo $link1 ?>">
            <img src="<?php echo $img1_url ?>" alt="<?php echo $img1_alt ?>">
        </a>
	<?php } else{ ?>
        <div class="column is-narrow has-text-centered">
        	<img src="<?php echo $img1_url ?>" alt="<?php echo $img1_alt ?>">
		</div>
	<?php } ?>
	<?php if($link2){ ?>
        <a class="column is-narrow has-text-centered" href="<?php echo $link2 ?>">
            <img src="<?php echo $img2_url ?>" alt="<?php echo $img2_alt ?>">
        </a>
	<?php } else{ ?>
		<div class="column is-narrow has-text-centered">
        <img src="<?php echo $img2_url ?>" alt="<?php echo $img2_alt ?>">
		</div>
	<?php } ?>
	<?php if($link3){ ?>
        <a class="column is-narrow has-text-centered" href="<?php echo $link3 ?>">
            <img src="<?php echo $img3_url ?>" alt="<?php echo $img3_alt ?>">
        </a>
	<?php } else{ ?>
		<div class="column is-narrow has-text-centered">
        <img src="<?php echo $img3_url ?>" alt="<?php echo $img3_alt ?>">
		</div>
	<?php } ?>
	<?php if($link4){ ?>
        <a class="column is-narrow has-text-centered" href="<?php echo $link4 ?>">
            <img src="<?php echo $img4_url ?>" alt="<?php echo $img4_alt ?>">
        </a>
	<?php } else{ ?>
		<div class="column is-narrow has-text-centered">
        <img src="<?php echo $img4_url ?>" alt="<?php echo $img4_alt ?>">
		</div>
	<?php } ?>
	<?php if($link5){ ?>
        <a class="column is-narrow has-text-centered" href="<?php echo $link5?>">
            <img src="<?php echo $img5_url ?>" alt="<?php echo $img5_alt ?>">
        </a>
	<?php } else{ ?>
		<div class="column is-narrow has-text-centered">
        <img src="<?php echo $img5_url ?>" alt="<?php echo $img5_alt ?>">
		</div>
	<?php } ?>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>