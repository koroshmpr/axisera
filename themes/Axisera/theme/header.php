<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Armani
 */

?><!doctype html>
<html class="overflow-x-hidden <?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'true' ? 'dark' : ''; ?>" <?php language_attributes(); ?>>
<head>
	<?php
	$iD = get_the_ID();
	$focus_keyword = function_exists('get_post_meta') ? get_post_meta($iD, 'rank_math_focus_keyword', true) :null;
	$focus_keyword = $focus_keyword ?: get_the_title($iD);
	?>
	<meta name="keywords" content="<?= esc_attr($focus_keyword); ?>">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<?php
	$scripts = get_field('header-scripts', 'option');
	echo $scripts ?? '';
	?>
</head>

<body <?php body_class('overflow-hidden dark:bg-white'); ?>>
<?php
$scripts = get_field('body-scripts', 'option');
echo $scripts ?? '';
wp_body_open();
get_template_part('template-parts/layout/header', 'content');
?>
<main class="mt-[77px] lg:mt-0 min-h-[75vh]"
	id="<?= get_post_type() ?? ''; ?>-<?= the_ID(); ?>">
