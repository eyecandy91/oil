<?php
/**
 * Template Name: Credit application page
 */

get_header();
echo "<section class='section credit-applicant'>";
    the_title( '<h1 class="title">', '</h1>' );
    echo do_shortcode(get_post_meta(get_the_id(), 'form_id', true));
echo "</section>";
get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
        function loadme() {
            var $o = $('select.countries')
            $o.html("<option>One moment...</option>")
            $.getJSON('<?php echo get_template_directory_uri(); ?>/json/countries.php',
                function(r) {
                    $o.html('')
                    $(r).each(function(i, el) {
                        var option = document.createElement('option');
                        option.value = el.code;
                        option.text = el.name;
                        if(el.code=="AU")option.selected=1;
                        $o.append(option)
                    })
                }).error(function(r) {
                $o.html("<option>Oops</select>")
            })
        }
        loadme()
    });
</script>