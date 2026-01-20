<?php
/**
 * Block template file: block.php
 *
 * Hero Internal Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * 
 * 
 */
// Create id attribute allowing for custom "anchor" value.
$id = 'spacer-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-spacer';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$mobileSpace = get_field('mobile');
$tabletSpace = get_field('tablet');
$desktopSpace = get_field('desktop');
$styles = '';
$defaultStyles = '';
if($desktopSpace) {
    $styles = $styles . '--desktop-height: ' . $desktopSpace . 'px;';
    $defaultStyles = '--default-height: ' . $desktopSpace . 'px;';
}
if($tabletSpace) {
    $styles = $styles . '--tablet-height: ' . $tabletSpace . 'px;';
    $defaultStyles = '--default-height: ' . $tabletSpace . 'px;';
}
if($mobileSpace) {
    $styles = $styles . '--mobile-height: ' . $mobileSpace . 'px;';
    $defaultStyles = '--default-height: ' . $mobileSpace . 'px;';
}

$styles = $styles . $defaultStyles;
$previewClass = $is_preview ? ' is-preview' : '';

?>

<div class="<?= esc_attr($classes . $previewClass) ?>" id="<?= esc_attr($id) ?>" style="<?= $styles ?>"></div>