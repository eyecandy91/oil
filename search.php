<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _s
 */

get_header();
?>

<section class="section">
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
            <div>
                <input value="<?php the_search_query(); ?>" name="s" id="s" class="input" type="text">
                <input id="searchsubmit" value="Search" class="button is-link" type="submit">
            </div>
        </form>
    </div>
    <div class="columns is-mobile is-multiline is-centered has-text-centered">
		<?php if ( have_posts() ) : ?>
        <div class="column is-full">

			<header class="page-header">
				<h1 class="page-title">
                    <?php
					/* translators: %s: search query. */
					//printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
					printf( esc_html__( 'Search Results' ) );
					?>
                </h1>
            </header><!-- .page-header -->
        </div>
        </div>
        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				echo "<div class='columns is-mobile is-multiline is-centered has-text-centered'>";
				get_template_part( 'template-parts/content', 'search' );
				echo "</div>";

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
    </div>
</section>
<?php
get_sidebar();
get_footer();