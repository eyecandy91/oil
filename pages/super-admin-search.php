<?php
/**
 *
 * Template Name: Admin user search
 *
 */

if (current_user_can('administrator')) {
    get_header();
    ?>
<section class="section">
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <form action="<?php bloginfo( 'url' ); ?>/admin-user-lookup" method="get">
            <h4 class="title is-4 has-text-weight-light"><?php _e( '<span class="has-text-weight-bold">Select a user</span>' ); ?></h4>
            <div class="field has-addons">
                <div class="control is-expanded">
                    <div class="select is-fullwidth">
                        <?php wp_dropdown_users(array( 'class' => 'select', 'selected' => 0, 'show_option_none' => __('Select a user you want to view') )); ?>
                    </div>
                </div>
                <div class="control">
                    <input style="min-width: 160px;" type="submit" name="submit" class="button is-link" value="SEARCH USER" />
                </div>
            </div>
        </form>
    </div>
</section>
<?php get_footer();
} else {
    get_header();
    get_template_part('404');
    get_footer();
} 