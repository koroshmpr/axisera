<?php
/* Template Name: Form */

get_header();
$form_id = get_field('gravity_form');
$subtitle = get_field('subtitle');
?>
	<section class="container pt-12 max-lg:px-4">
		<h1 class="font-bold text-xl pb-6"><?php the_title(); ?></h1>
		<?php if ($subtitle) : ?>
			<h2 class="pb-6 form_subtitle text-black/70"><?= $subtitle; ?></h2>
		<?php
		endif;
		if ($form_id) {
			// Display the Gravity Form using the ID
			echo do_shortcode('[gravityform id="' . $form_id . '" title="false" ajax="false" description="true"]');
		} else {
			echo '';
		} ?>
	</section>
<?php

get_footer();
