<?php
/**
 * Template part for displaying merchandise products
 *
 */

$name   		= get_field('product_name');
$price    		= get_field('product_price');
$information   	= get_field('product_information');
$image		   	= get_field('product_image');
$shipping		= get_field('shipping', 398);
$refund			= get_field('returns_refunds', 398);
$form			= get_field('product_order', 398);

$image_full_url	= $image['url'];
$image_alt		= $image['alt'];
$image_full_h	= $image['height'];
$image_full_w	= $image['width'];

$image_large_url= $image['sizes']['large'];
$image_large_h	= $image['sizes']['large-height'];
$image_large_w	= $image['sizes']['large-width'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="columns section">
        <div class="column is-full-mobile is-half-tablet">
            <div class="box has-text-centered">
                <?php echo "<img src='$image_full_url' alt='$image_alt' height='$image_full_h' width='$image_full_w'>"; ?>
            </div>
            <div>
                <?php echo $information; ?>
            </div>
        </div>

        <div class="column is-full-mobile is-half-tablet content">
            <?php
			echo "<h1 class='title'><div id='name'>" . $name . "</div></h1>"; ?>
            <div id='price' class='title'>
                <?php if (!empty($price)) {
				if (fmod($price, 1) !== 0.00) { ?>
                $ <?php echo $price; ?>
                <? } else { ?>
                $ <?php echo $price; ?>.00
                <?php }
            	} ?>
            </div>
            <div class="field">
                <span>Sizes</span>
                <?php
			echo "<div id='size' class='select'>
			<select>
			<option selected='true' disabled='disabled'>Select a size</option>
			<option value='xs'>xs</option>
			<option value='small'>small</option>
			<option value='medium'>medium</option>
			<option value='large'>large</option>
			<option value='xl'>xl</option>
			<option value='xxl'>xxl</option>
			<option value='xxxl'>xxxl</option>
			</select>
			</div>";
			?>
            </div>
            <div class="field">
                <span>Quantity</span>
                <?php
				echo "<div id='quantity'>
				<div class='number'>
					<span class='minus'>-</span>
					<input id='value' class='input' type='text' value='1'/>
					<span class='plus'>+</span>
				</div>
			</div>";
			?>
            </div>
            <div class="is-hidden">
                kfdflk
            </div>
            <div class="cmp-accordian">
                <h2>Genral FAQs</h2>
                <div class="cmp-accordian__panel">
                    <input id="panel-one" type="radio" name="panels">
                    <label for="panel-one">Product info</label>
                    <div class="cmp-accordian__panel-content">
                        <p><?php echo $information; ?></p>
                    </div>
                </div>
                <div class="cmp-accordian__panel">
                    <input id="panel-two" type="radio" name="panels">
                    <label for="panel-two">Returns & refund policy </label>
                    <div class="cmp-accordian__panel-content">
                        <p><?php echo $refund; ?></p>
                    </div>
                </div>
                <div class="cmp-accordian__panel">
                    <input id="panel-three" type="radio" name="panels">
                    <label for="panel-three">Shipping info</label>
                    <div class="cmp-accordian__panel-content">
                        <p><?php echo $shipping; ?></p>
                    </div>
                </div>
			</div>
			<div>
			<div id='price' class='title'>
				Email us your interest?
			</div>
			<?php 
				if (!is_user_logged_in()) { 
					echo "<div class='field'>";
					echo "<input id='loggedout-user' class='input' type='text' name='loggedout-name' placeholder='Your name'>";
					echo "</div>";
					echo "<div class='field'>";
					echo "<input id='loggedout-email' class='input' type='email' name='loggedout-email' placeholder='Email address'>";
					echo "</div>";
				}			
			?>
			<div id="merchandise-form">
				<?php if ( $form ) {
					echo do_shortcode( $form );
				} ?>
			</div>
			</div>
        </div>
    </div>
    </div>






    <?php
	
	// echo "<pre>";
	// echo print_r($image);
	// echo "</pre>";

	
	//echo "<img src='$image_large_url' alt='$image_alt' height='$image_large_h' width='$image_large_w'>";
	
	?>


</article><!-- #post-<?php the_ID(); ?> -->