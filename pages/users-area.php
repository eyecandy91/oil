<?php
/**
 *
 * Template Name: Portal page
 *
 */

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $first = $current_user->user_firstname;
    $last = $current_user->user_lastname;
    $user = $current_user->user_login;
    get_header();
    global $current_user;
    ?>

<section class="section">
    <?php if (current_user_can('administrator')) {?>

    <?php } else {?>

    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <div class="content">
            <h2 class="title has-text-weight-light is-size-4">Welcome back<span class="has-text-weight-bold">
                    <?php
            if ($first && $last) {
                    echo $first . '&nbsp;' . $last;
            } else if ($first) {
                echo $first;
            } else {
                echo $user;
            }?></span>, here are your folders</h2>
        </div>
    </div>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
            <div>
                <input value="" name="s" id="s" class="input" type="text" placeholder="Search <?php
            if ($first && $last) {
                    echo $first . '&nbsp;' . $last;
            } else if ($first) {
                echo $first;
            } else {
                echo $user;
            }?> files">
                <input id="searchsubmit" value="Search" class="button is-link" type="submit">
            </div>
        </form>
    </div>
    <?php
    echo "<div class='columns po-results box is-mobile is-multiline is-centered has-text-centered'>";
        $post_type = 'certificates';
        // Get all the taxonomies for this post type
        $taxonomies = get_object_taxonomies(array('post_type' => $post_type));
        foreach ($taxonomies as $taxonomy):
            // Gets every "category" (term) in this taxonomy to get the respective posts
            $terms = get_terms($taxonomy);
            foreach ($terms as $term):
                $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
                $args = array(
                    'post_type' => $post_type,
                    'posts_per_page' => -1, //show all PO numbers here in the portal home page
                    'author' => $current_user->ID,
                    'paged' => $paged,
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy, // base off the custom taxonomies that are the PO numbers
                            'field' => 'slug',
                            'terms' => $term->slug,
                            'order' => 'ASC'
                        ),
                    ),
                );
                $posts = new WP_Query($args);
                $terms = get_terms($taxonomy);
                if ($posts->have_posts()):  ?>
    <a href="<?php echo get_term_link($term) ?>" rel="single-po-number"
        class="column is-full-mobile is-one-third-tablet is-one-quarter-desktop">
        <article id="post-<?php the_ID();?>" <?php post_class();?> class="">
            <div class="box is-paddingless image">
                <div class="po-no">
                    <div class="folder"><i class="fas fa-folder-open has-text-link"></i></div>
                </div>
                <div class="po-no__name title is-6 is-marginless is-uppercase">
                    <?php echo $term->name; ?><?php echo $file_name ?>
                </div>
            </div>
        </article>
    </a>
    <?php endif;
        endforeach;
        endforeach;
    }
    echo "</div>";

    if (function_exists("pagination")) {
        pagination($loop->max_num_pages);
    }

    echo "</section>";
    get_footer();
} else {
    get_header();
    $error_head         = myprefix_get_theme_option('login_error');
    $error_message      = myprefix_get_theme_option('login_error_text');
    $head_email         = myprefix_get_theme_option('head_email');
    $dalby_email        = myprefix_get_theme_option('dalby_email');
    echo "<section class='section portal_form'>";
    ?>
    <?php
        if ($_GET['login'] == 'failed') { ?>
    <article class="message is-danger has-text-centered">
        <div class="message-header">
            <p><?php echo $error_head ?></p>
        </div>
        <div class="message-body">
            <?php echo $error_message ?>
        </div>
    </article>
    <?php }
    // get_template_part('404');
    $args = array(
        'echo' => true,
        'redirect' => get_site_url() . '/portal',
        'form_id' => 'portal_form',
        'label_username' => __('Username'),
        'label_password' => __('Password'),
        'label_remember' => __('Remember Me'),
        'label_log_in' => __('Log In'),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => null,
        'value_remember' => false);
    wp_login_form($args);
    ?>
    <a class="button is-fullwidth" style="margin-bottom: 1rem" href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Forgot Password</a>
    <div class="has-text-centered">
    <a class="has-text-centered is-block" href="mailto:<?php echo $head_email; ?>" target="_blank">
    </div>
    <?php
    echo "Having issues?<br>Email ".$head_email;
    echo "</a>";
    ?>
    <?php 
    echo "</section>";
    get_footer();
    ?>
    <script>
    jQuery(document).ready(function($) {
        jQuery('#wp-submit').addClass('button is-fullwidth is-link');
        jQuery("#wp-submit").click(function() {
            var user = $("input#user_login").val();
            if (user == "") {
                $("input#user_login").focus();
                return false;
            }
        });
    });
    </script>
    <?php
}