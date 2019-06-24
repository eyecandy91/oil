<?php
/**
 *
 * Template Name: Portal page
 *
 */

if (is_user_logged_in()) {
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
    // echo "<pre>";
    // print_r($loop);
    // echo "</pre>";
    ?>

<section class="section">
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/'); ?>">
            <div>
                <input value="" name="s" id="s" class="input" type="text" placeholder="Search your files">
                <input id="searchsubmit" value="Search" class="button is-link" type="submit">
            </div>
        </form>
        <h2>Your files</h2>
    </div>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <?php while ($loop->have_posts()): $loop->the_post();
        get_template_part('template-parts/content', 'search');
    endwhile;
echo "</div>";
echo "</section>";
wp_reset_query();
get_footer();
} else {
get_header();
    // get_template_part('404');
    $args = array(
        'echo' => true,
        'redirect' => get_site_url().'/portal',
        'form_id' => 'loginform',
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
get_footer();
}