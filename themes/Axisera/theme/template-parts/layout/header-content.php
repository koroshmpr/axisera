<header x-data="{ open: false, scrolled: false }"
		x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
		:class="scrolled ? 'py-2 bg-white' : ' py-3'"
		class="fixed inset-x-0 top-0 w-screen lg:px-8 px-6 z-10 flex lg:justify-between justify-center items-center transition-all duration-300"
		id="masthead">
	<?php
	$args = array(
		'size' => '160',
		'height' => '40'
	);
	get_template_part('template-parts/global/logo', null, $args);
	?>
<!--	--><?php //get_template_part('template-parts/global/darkmode-btn'); ?>
</header>
