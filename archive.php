<?php

if (is_user_logged_in()) {
    get_header();
    global $current_user;
	$post_amount    = myprefix_get_theme_option('pagination');
	$term 			= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
    $paged 			= ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    if( !current_user_can('administrator') ) {
        $current_user   = wp_get_current_user();
        $first          = $current_user->user_firstname;
        $last           = $current_user->user_lastname; 
        $user           = $current_user->user_login;
        $loop = new WP_Query(array(
            'author' 			=> $current_user->ID,
            'post_type' 		=> 'certificates',
            'order'             => 'ASC',
            'posts_per_page' 	=> $post_amount,
            'paged' 			=> $paged,
            'tax_query' => array(
                array(
                    'taxonomy' 	=> $taxonomy,
                    'field' 	=> 'slug',
                    'terms' 	=> $term->slug,
                    'order' => 'ASC'
                    )
                    )
                    )
                );
    } else {
        $post           = $_GET['user'];
        $po             = $_GET['po'];
        $user_id        = $post;
        $user           = get_user_by( 'id', $post ); 
        // $first          = $user->user_firstname;
        // $last           = $user->user_lastname; 
        $name           = $user->display_name;
        $loop = new WP_Query(array(
            // 'author' 			=> $current_user->ID,
            'post_type' 		=> 'certificates',
            'order'             => 'ASC',
            'posts_per_page' 	=> $post_amount,
            'paged' 			=> $paged,
            'tax_query' => array(
                array(
                    'taxonomy' 	=> $taxonomy,
                    'field' 	=> 'slug',
                    'terms' 	=> $term->slug,
                    'order' => 'ASC'
                )
            )
        )
        );
    };
    $total = $loop->found_posts;
    // echo $post;
    ?>

<section class="section">
    <?php if( current_user_can('administrator') ) {  ?>
    <div class="columns">
        <div class="column is-full po-results is-mobile is-multiline is-centered has-text-centered">
            <div class="buttons has-addons is-centered">
                <div class="control">
                    <input class="button is-link is-outlined" type="button" value="Start"
                        onclick="window.location='<?php bloginfo( 'url' ); ?>/admin-user-search';">
                </div>
                <div class="control">
                    <input class="button is-link is-outlined" type="button" value="Back"
                        onclick="window.history.back()">
                </div>
                <div class="control">
                    <input class="button is-danger is-outlined" type="button" id="hideshow" value="Search user">
                </div>
            </div>
            <div class="column is-full is-paddingless">
                <form action="<?php bloginfo( 'url' ); ?>/admin-user-lookup" method="get">
                    <h4 class="title is-4 has-text-weight-light">
                        <?php _e( 'Current user : <span class="has-text-weight-bold">'.$name.'</span>' ); ?>
                    </h4>
                    <h4 class="title is-4 has-text-weight-light">
                        <?php _e( 'PO Number : <span class="has-text-weight-bold">'.$po.'</span>' ); ?></h4>
                    <h4 class="title is-4 has-text-weight-light">
                        <?php _e( 'Viewing : <span class="has-text-weight-bold">Current certificates</span>' ); ?></h4>
                    <div id="content" style="display:none">
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-fullwidth">
                                    <?php wp_dropdown_users(array( 'class' => 'select', 'selected' => $post, 'selected' => 0, 'show_option_none' => __('Select a user you want to view') )); ?>
                                </div>
                            </div>
                            <div class="control">
                                <input style="min-width: 160px;" type="submit" name="submit" class="button is-link" value="SEARCH USER" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php } else if( !current_user_can('administrator') ) {  ?>
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
            <h4 class="subtitle is-6 has-text-grey-light">Listed below are your certificates tied to
                <?php echo $term->name; ?> </h4>
        </div>
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url('/'); ?>">
            <div>
                <input value="" name="s" id="s" class="input" type="text"
                    placeholder="Search <?php if ($first && $last) { echo $first. ' ' .$last.'\'s'; } else if ($first) {echo $first.'\'s'; } else { echo $user;} ?> files">
                <input id="searchsubmit" value="Search" class="button is-link" type="submit">
            </div>
        </form>
    </div>
    <?php } ?>
    <div class="columns po-results box is-mobile is-multiline is-centered has-text-centered">
        <?php if ( have_posts() ) : ?>
        <?php while ($loop->have_posts()): 
				$loop->the_post();
				get_template_part('template-parts/content', 'search');
			endwhile;
			echo "</div>";
			echo "<div class='has-text-centered'>";
			echo "</div>";
			if (function_exists("pagination")) {
				pagination($loop->max_num_pages);
			} 
		endif;
		
	wp_reset_query();

    echo "</section>";

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