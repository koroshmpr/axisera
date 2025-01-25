<?php
$form = get_field('form');

?>
<section class="container grid gap-6 lg:gap-8 items-center lg:grid-cols-2 px-6 py-16 lg:py-24">
	<div class="lg:col-span-2 grid gap-y-2">
		<h2 class="font-bold text-3xl border-s-4 ps-3 text-primary border-primary"><?= $form['title'] ?? ''; ?></h2>
		<article class="text-sm leading-[2]"><?= $form['content'] ?? ''; ?></article>
	</div>
	<div id="form">
		<?= do_shortcode('[gravityform id="' . ($form['formId'] ?? '') . '" title="false" description="false" ajax="true"]') ?>
	</div>
	<div class="lg:p-3">
		<img class="object-cover w-full h-auto" src="<?= $form['image']['url'] ?? '' ?>" alt="<?= $form['image']['title'] ?? '' ?>">
	</div>
</section>
