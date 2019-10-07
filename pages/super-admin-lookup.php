<?php
/**
 *
 * Template Name: Admin user lookup
 *
 */

if (current_user_can('administrator')) {
    get_header();
    $post_amount    = myprefix_get_theme_option('pagination');
    $post           = $_GET['user'];
    $user_id        = $post;
    $user           = get_user_by( 'id', $post ); 
    // $first          = $user->user_firstname;
    // $last           = $user->user_lastname; 
    $name           = $user->display_name;
	$term 			= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
    $paged 			= ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $args           =array(
        'author' 			=> $post,
        'post_type' 		=> 'certificates',
        'posts_per_page' 	=> -1,
		'paged' 			=> $paged,
    );
		// 'tax_query' => array(
		// 	array(
		// 		'taxonomy' 	=> $taxonomy,
		// 		'field' 	=> 'slug',
        //         'terms' 	=> $term->slug,
        //         'order' => 'ASC'
		// 	)
		// )
    // );
    // $args=array(
    //     'post_type' => 'certificates',
    //     'post_status' => 'published',
    //     'posts_per_page' => 1,
    //     'author' => $user_id
    // );                       
    
    $wp_query = new WP_Query($args);
    // while ( have_posts() ) : the_post(); 
        // the_title();
    // endwhile; 
    $total = $wp_query->found_posts;
    ?>
<section class="section">
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
                        <?php _e( 'Current user : <span class="has-text-weight-bold">'.$name.'</span>'); ?>
                    </h4>
                    <h4 class="title is-4 has-text-weight-light">
                        <?php _e( 'Viewing : <span class="has-text-weight-bold">PO numbers</span>' ); ?></h4>
                    <div id="content" style="display:none">
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <div class="select is-fullwidth">
                                    <?php wp_dropdown_users(array( 'class' => 'select', 'selected' => 0, 'show_option_none' => __('Select a user you want to view'))); ?>
                                </div>
                            </div>
                            <div class="control">
                                <input style="min-width: 160px;" type="submit" name="submit" class="button is-link"
                                    value="SEARCH USER" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                    'posts_per_page' => 2, //show all PO numbers here in the portal home page
                    'author' => $post,
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
                if ($posts->have_posts()):  
                $newpo = str_replace(' ', '-', $term->name);
                ?>
    <a href="<?php echo get_term_link($term) ?>?user=<?php echo $post ?>&po=<?php echo $newpo; ?>"
        rel="single-po-number" class="column is-full-mobile is-one-third-tablet is-one-quarter-desktop">
        <article id="post-<?php the_ID();?>" <?php post_class();?> class="">
            <div class="box is-paddingless image">
                <div class="po-no">
                    <div class="folder"><i class="fas fa-folder-open has-text-link"></i></div>
                </div>
                <div class="po-no__name title is-6 is-marginless is-uppercase">
                    <?php echo $term->name; ?>
                </div>
            </div>
        </article>
    </a>
    <?php endif;
        endforeach;
        endforeach;
    // }
    echo "</div>";

    if (function_exists("pagination")) {
        pagination($loop->max_num_pages);
    }

    echo "</section>";
    get_footer();
} else {
    get_header();
    get_template_part('404');
    get_footer();
}