<?php
$menu = get_field('menu', 'option');
$titleClass = $args['titleClass'] ?? '';
$svgClsss = $args['svgClass'];
$duration = ' duration-500';
if ($menu) :?>
	<nav class="grid grid-cols-2 <?= $args['navClass'] ?? ''; ?> rotate-45 items-center justify-center">
		<?php foreach ($menu as $item) :
			$page_url = $item['link'];
			$post_id = url_to_postid($page_url); // Get the post ID from the URL
			$pageColor = get_field('page_color', $post_id);
			$page_title = get_the_title($post_id); ?>
			<a href="<?= $page_url ?>"
			   class="aspect-square grid box-content group relative justify-center items-center">
				<span
					class="text-center origin-center -rotate-45 group-hover:scale-110 transition-all <?= $duration ?? ''; ?> stroke-black text-transparent group-hover:text-<?= $pageColor; ?> absolute <?= $titleClass ?? ''; ?>
				<?= ($item['direction'] == 'up' ? 'top-[10%] start-[-30%] lg:start-[-50%]' :
						($item['direction'] == 'down' ? 'bottom-[10%] start-[20%] lg:start-[-10%]' :
							($item['direction'] == 'left' ? 'top-[60%] lg:top-[70%] end-[20%] lg:end-[10%] rotate-[-135deg]' :
								($item['direction'] == 'right' ? 'top-[20%] lg:top-0 start-[30%] lg:start-[20%] rotate-[-135deg]' : '')))) ?>"
				><?= $page_title ?></span>
				<div class="size-full overflow-hidden">
					<?php
					$args = array(
						'pageColor' => $pageColor,
						'duration' => $duration,
						'svgClass' =>
							($item['direction'] == 'up' ? ' translate-x-[20%] translate-y-[20%]' :
								($item['direction'] == 'down' ? ' translate-x-[-20%] translate-y-[-20%]' :
									($item['direction'] == 'left' ? ' translate-x-[20%] translate-y-[-20%]' :
										($item['direction'] == 'right' ? ' translate-x-[-20%] translate-y-[20%]' : '')))),
						'path-1' =>
							($item['direction'] == 'up' ? ' group-hover:-translate-y-7 group-hover:-translate-x-7' :
								($item['direction'] == 'down' ? ' group-hover:translate-y-7 group-hover:translate-x-7' :
									($item['direction'] == 'left' ? ' group-hover:translate-y-7 group-hover:-translate-x-7' :
										($item['direction'] == 'right' ? ' group-hover:-translate-y-7 group-hover:translate-x-7' : '')))),
						'path-2' =>
							($item['direction'] == 'up' ? ' group-hover:translate-y-3 group-hover:translate-x-3' :
								($item['direction'] == 'down' ? ' group-hover:-translate-y-3 group-hover:-translate-x-3' :
									($item['direction'] == 'left' ? ' group-hover:-translate-y-3 group-hover:translate-x-3' :
										($item['direction'] == 'right' ? ' group-hover:translate-y-3 group-hover:-translate-x-3' : '')))),
						'class' => ' transition-all overflow-visible ' . ($svgClsss ?? '') .
							($item['direction'] == 'up' ? ' -rotate-45' :
								($item['direction'] == 'down' ? ' rotate-[135deg]' :
									($item['direction'] == 'left' ? ' rotate-[-135deg]' :
										($item['direction'] == 'right' ? ' rotate-45' : ''))))
					);
					get_template_part('template-parts/svg/menu-icon/arrow', null, $args); ?>
				</div>
			</a>
		<?php
		endforeach; ?>
	</nav>
<?php endif;
?>

