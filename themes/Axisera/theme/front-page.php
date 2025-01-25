<?php /* Template Name: Home */
get_header(); ?>

<?php if (have_posts()) {
	the_post(); ?>
	<section class="container w-full flex justify-center max-lg:py-16 py-32 items-start lg:items-center">
	<?php
	$args = array(
		'navClass' => ' max-sm:w-[85vw] max-w-[400px] xl:max-w-[600px] ',
		'titleClass' => 'max-sm:text-2xl max-md:text-4xl text-5xl xl:text-6xl stroke-2 ',
		'svgClass' => 'size-40 lg:size-64',
	);
	get_template_part('template-parts/global/circle-menu', null, $args); ?>
	</section>
<?php
}
get_footer();
