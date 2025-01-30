<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Armani
 */

get_header();
global $post;
?>
	<img class="object-cover w-full lg:h-screen"
		 src="<?= has_post_thumbnail() ? get_the_post_thumbnail_url() : ''; ?>" alt="<?= get_the_title(); ?>">
	<section x-data="{activeTOC : false}"
			 class="container relative mx-auto items-start justify-center p-6">
		<div class="post-container">
			<div class="flex justify-between items-start">
				<h1 class="text-title lg:text-3xl text-lg font-bold"><?php the_title(); ?></h1>
				<div class="py-2">
					<?php
					$category_detail = get_the_category($post->ID);//$post->ID
					foreach ($category_detail as $category) { ?>
						<span class="bg-primary text-white shadow-sm rounded-md p-2"><?= $category->name ?></span>
					<?php } ?>
				</div>
			</div>
			<article class="text-justify prose" id="blog_content"><?php the_content(); ?></article>
		</div>
	</section>
<?php
get_footer();
