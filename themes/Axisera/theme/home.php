<?php
/** Template Name: Blog Page */
get_header();

// Get the current page number
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Define the number of posts per page (using WordPress settings)
$posts_per_page = get_option('posts_per_page');

// Create a custom query for pagination
$args = [
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page' => $posts_per_page,
];
$query = new WP_Query($args);

if ($query->have_posts()) { ?>
	<section class="container grid gap-4">
		<?php while ($query->have_posts()) :
			$query->the_post(); ?>
			<article class="bg-gray-200 p-8 flex lg:gap-16 gap-4 flex-wrap justify-center lg:justify-start items-start">
				<div class="grid gap-3 items-start flex-1">
					<h5 class="text-xl"><?php the_title(); ?></h5>
					<p><?= wp_trim_words(get_the_content(), 30) ?></p>
					<a href="<?= get_permalink(); ?>" class="items-end transition-colors px-6 py-2 w-fit">بیشتر</a>
				</div>
				<img class="object-cover size-80 order-first lg:order-last lg:size-56 aspect-[16/9]" alt="<?= get_the_title(); ?>"
					 src="<?= has_post_thumbnail() ? get_the_post_thumbnail_url() : ''; ?>">
			</article>
		<?php endwhile; ?>
	</section>
	<?php
} else {
	echo '<p>No posts found.</p>';
}

// Reset the main query loop
wp_reset_postdata();

get_footer();
?>
