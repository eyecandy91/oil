<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<?php
$file_name         	= get_field('file_name');
$file_pdf          	= get_field('file_pdf');
$file_desc          = get_field('file_description');
$link				= $file_pdf['url'];
$icon				= $file_pdf['icon'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <a href="<?php echo $link ?>" rel="bookmark" target="_blank">
        <div class="column is-narrow product_block single__product image">
            <div class="box">
                <div class="po-no" style="background-image: url('<?php echo $icon ?>')"></div>
                <div><?php echo $file_name ?></div>
                <div><?php echo $$file_desc ?></div>
            </div>
        </div>
    </a>
    <?php 
		//echo "<pre>";
        //print_r($file_pdf);
        //echo "</pre>";
		?>


</article>