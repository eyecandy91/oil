<?php
/**
 * The template for merchandise custom posts
 *
 */

get_header();

while (have_posts()) :
	the_post();
	get_template_part('template-parts/content', 'merchandise');
endwhile; // End of the loop.

get_footer();
?>
<script>
	jQuery(document).ready(function($) {
		<?php if (!is_user_logged_in()) { ?>
			// disable the submit button
			$('input#merchandise-submit').prop('disabled', true);
			// disable the email field 
			$('#loggedout-email').prop('disabled', true);
			// add the logged out users name
			$('#loggedout-user').on('change', function() {
				console.log('logged out user adds a name');
				$('#user-name').val($(this).val());
				$('#loggedout-email').prop('disabled', false);
			});
			// add logged out users email
			// remove the disabled submit on addition of email
			$('#loggedout-email').on('change', function() {
				console.log('logged out user adds an email');
				$('#user-email').val($(this).val());
				$('input#merchandise-submit').prop('disabled', false);
			});
			// Add size to the input
			$("#size select").on("change", function() {
				console.log('User wants ' + $(this).val() + ' size');
				$("#product-size").val($(this).val()); 
			});
		<?php } else { ?>
			// Add size to the input
			// remove the disabled submit on change of select
			$("#size select").on("change", function() {
				console.log('User wants ' + $(this).val() + ' size');
				$("#product-size").val($(this).val()); 
				$('input#merchandise-submit').prop('disabled', false);
			});
		<?php } ?>

		// Make the send button disabled, user cannot send until size is added
		$('input#merchandise-submit').prop('disabled', true);
		$('input#merchandise-submit').on('submit', function() {
			$(this).find('input#merchandise-submit').attr('disabled', true);
		});
		// Add price to the input
		$('#product-price').val($('#price').html());
		// Add name to the input
		$('#product-name').val($('#name').html());
		// Add quantity to the input
		$('#quantity input').change(function() {
			console.log('added ' + $(this).val() + ' of this product')
			$('#product-quantity').val($(this).val());
		});
		$('.minus').click(function() {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
		$('.plus').click(function() {
			var $input = $(this).parent().find('input');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
		});



	});
</script>