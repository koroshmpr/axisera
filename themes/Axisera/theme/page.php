<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Armani
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content/content', 'page');

				// If comments are open, or we have at least one comment, load
				// the comment template.
				if (comments_open() || get_comments_number()) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>
			<span class="text-purple bg-purple group-hover:fill-purple group-hover:text-purple stroke-purple btn-purple "></span>
			<span class="text-yellow bg-yellow stroke-yellow group-hover:fill-yellow group-hover:text-yellow btn-yellow "></span>
			<span class="text-green bg-green stroke-green group-hover:fill-green group-hover:text-green btn-green"></span>
			<span class="text-red bg-red stroke-red group-hover:fill-red group-hover:text-red btn-red"></span>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
