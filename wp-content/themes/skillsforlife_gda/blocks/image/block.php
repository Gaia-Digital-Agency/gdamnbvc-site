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
$id = 'image-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-image';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$image = get_field('image');
$imageWidth = get_field('width');
$imageHeight = get_field('height');
$imageAspectRatio = get_field('aspect_ratio');
$maxWidthStyle = '';
$styles = '';
if($imageAspectRatio) {
    $styles = $styles . 'padding-top: '. $imageAspectRatio . ';';
}
if($imageWidth) {
    $styles = $styles . 'max-width: ' . $imageWidth . ';';
}
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="image-wrapper relative" style="<?= $styles; ?>">
        <img src="<?= $image['url'] ?>" class="image-ratio" alt="">
    </div>
</div>