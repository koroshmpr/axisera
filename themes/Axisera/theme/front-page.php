<?php /* Template Name: Home */
get_header(); ?>

<?php if (have_posts()) {
	the_post(); ?>
	<section class="container w-full flex justify-center max-lg:py-20 py-32 items-start lg:items-center">
	<?php
	$args = array(
		'navClass' => ' max-sm:w-[85vw] max-md:w-[75vw] max-w-[400px] max-lg:max-w-[500px] xl:max-w-[600px] ',
		'titleClass' => 'text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl stroke-2 ',
		'svgClass' => 'size-40 lg:size-64',
	);
	get_template_part('template-parts/global/circle-menu', null, $args); ?>
	</section>
<?php
}
get_footer();
