</main>
<?php
get_template_part('template-parts/layout/footer', 'content');
//get_template_part('template-parts/global/call-btn');
get_template_part('template-parts/global/backToTop');
$preloaderSwitch = get_field('preloaderSwitch', 'option');
if ($preloaderSwitch) :
	get_template_part('template-parts/global/preload');
endif;
wp_footer();
?>
</body>
</html>
