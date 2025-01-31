<?php /* Template Name: MDSI */
get_header();
$pageColor = get_field('page_color');
$columns = get_field('columns');
?>
<section class="lg:px-16 px-3 flex flex-col md:grid md:gap-x-6 lg:gap-x-2 xl:gap-x-12 gap-y-6 md:grid-cols-2 lg:grid-cols-3 pt-8">
	<h1 class="lg:text-6xl stroke-black text-4xl text-center md:col-span-2 lg:col-span-3 lg:py-4 text-<?= $pageColor ?? '';?>"><?php the_title(); ?></h1>
	<?php
	if ($columns):
		foreach ($columns as $column): ?>
		<div class="lg:p-4 p-2 flex flex-col justify-between gap-y-4">
			<h2 class="text-lg lg:text-2xl"><?= $column['title'] ?? ''; ?></h2>
			<article class="text-justify lg:text-lg text-sm"><?= $column['content'] ?? ''; ?></article>
			<a class="w-fit relative btn-<?= $pageColor ?? ''; ?>" href="<?= $column['btn_link']['url'] ?? ''; ?>">
				<span class="bg-white/20 w-1 h-4 absolute top-1 left-0.5"></span>
				<span class="bg-black/5 w-1 h-3 absolute bottom-1 right-0.5"></span>
				<?= $column['btn_title'] ?? ''; ?>
			</a>
		</div>
		<?php endforeach;
	endif ?>
</section>
<section class="flex justify-center mb-12">
	<div class="w-full md:w-11/12 max-lg:w-9/12 pt-20 max-lg:h-fit flex justify-center">
		<?php
		$args = array(
			'navClass' => 'max-w-[90vw] sm:max-w-[60vw] md:max-w-[300px] lg:max-w-[220px] ',
			'titleClass' => 'max-sm:text-2xl text-4xl md:text-2xl stroke-1 stroke-gray ',
			'svgClass'   => 'lg:size-52 size-32',
		);
		get_template_part('template-parts/global/circle-menu', null, $args); ?>
	</div>

</section>
<?php get_footer(); ?>
