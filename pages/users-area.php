<?php
/**
 *
 * Template Name: Portal page
 *
 */

if (is_user_logged_in()) {
    $current_user   = wp_get_current_user();
    $first          = $current_user->user_firstname;
    $last           = $current_user->user_lastname; 
    $user           = $current_user->user_login;
    get_header();
    global $current_user;
    // $file_name = get_field('file_name');
    // $file_pdf = get_field('file_pdf');
    // $file_desc = get_field('file_description');
    // $link = $file_pdf['url'];
    // $icon = $file_pdf['icon'];
    $loop = new WP_Query(array(
        'author' => $current_user->ID,
        'post_type' => 'certificates',
        'posts_per_page' => -1,
    )
    );
    $total = $loop->found_posts;
    // echo "<pre>";
    // print_r($loop);
    // echo "</pre>";
    ?>

<section class="section">
    <?php if( current_user_can('administrator') ) {  ?>



    <?php } else { ?>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        
        <div class="content">    
            <h2 class="title has-text-weight-light">Welcome back<span class="has-text-weight-bold">
            <?php
            if ($first && $last) {
                echo $first. '&nbsp;' .$last; 
            } else if ($first) {
                echo $first;
            } else {
                echo $user;
            } ?></span>, here are your files</h2>
            <h4 class="subtitle is-6 has-text-grey-light">You currently have <?php echo $total ?> certificates in your portal</h4>
        </div>
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/'); ?>">
            <div>
                <input value="" name="s" id="s" class="input" type="text"
                    placeholder="Search <?php if ($first && $last) { echo $first. ' ' .$last.'\'s'; } else if ($first) {echo $first.'\'s'; } else { echo $user;} ?> files">
                <input id="searchsubmit" value="Search" class="button is-link" type="submit">
            </div>
        </form>
    </div>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <?php while ($loop->have_posts()): $loop->the_post();
        get_template_part('template-parts/content', 'search');
    endwhile;
    echo "</div>";
    } 
    

    echo "</section>";
    wp_reset_query();
    get_footer();
} else {
get_header();
    echo "<section class='section'>";
    // get_template_part('404');
    $args = array(
        'echo' => true,
        'redirect' => get_site_url().'/portal',
        'form_id' => 'portal_form',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
    wp_login_form($args);
    echo "</section>";
get_footer();
?>
        <script>
        jQuery(document).ready(function($) {
            jQuery('#wp-submit').addClass('button is-fullwidth is-link');
        });
        </script>
        <?php
}