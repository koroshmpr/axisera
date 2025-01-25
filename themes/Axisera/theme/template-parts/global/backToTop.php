
<?php $pageColor = get_field('page_color'); ?>
<button x-data="{ open: false, scrolled: false }"
		x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
		@click="window.scrollTo({ top: 0, behavior: 'smooth' })"
		x-transition
		class="size-10 fixed bottom-10 lg:bottom-4 bg-<?= $pageColor ?? 'secondary' ?> justify-center border rounded-lg border-secondary hover:opacity-80 transition-all items-center duration-500 flex text-<?= $pageColor ? 'secondary' : 'white' ?> z-[5]"
		:class="scrolled ? 'right-4' : '-right-full' "
		aria-label="Back to top">
	<span class="bg-white/20 w-1 h-4 absolute top-1 left-0.5"></span>
	<svg width="16" height="16" fill="none" viewBox="0 0 16 16" stroke="currentColor">
		<path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
	</svg>
</button>
