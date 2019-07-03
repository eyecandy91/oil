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
$file_name = get_field('file_name');
$file_pdf = get_field('file_pdf');
$file_desc = get_field('file_description');
$link = $file_pdf['url'];
$icon = $file_pdf['icon'];
?>

<a href="<?php echo $link ?>" rel="single-po-number" target="_blank">
    <article id="post-<?php the_ID();?>" <?php post_class();?> class="">
        <div class="box is-paddingless image">
            <div class="po-no">
                <div style="background-image: url('<?php echo $icon ?>')"></div>
            </div>
            <div class="po-no__name title is-6 is-marginless"><?php echo $file_name ?></div>
            <div class="po-no__desc title is-7"><?php echo $file_desc ?></div>
            
        </div>
        <?php
        //echo "<pre>";
        //print_r($file_pdf);
        //echo "</pre>";
        ?>
    </article>
</a>