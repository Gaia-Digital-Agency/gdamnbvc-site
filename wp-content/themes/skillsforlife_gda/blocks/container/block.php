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
$id = 'container-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-container';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$template = [
    ['acf/column'],
];

$bgColor = get_field('bg_color');
$bgStyle = $bgColor ? "background-color: $bgColor;" : '';

$align = get_field('align');
$alignClass = '';
if($align) {
    $alignClass = "items-" . $align;
}
$gap = get_field('gap');
$gapStyle = "";
$gapAmount = '';
if($gap) {
    // $gapStyle = 'gap: ' . $gap . ';';
    $gapAmount = $gap;
} else {
    // $gapStyle = 'gap: 30px;';
    $gapAmount = '30px';
}
// $gapClass = "";
// if($gap) {
//     $gapClass = "md:gap-[]"
// }
// md:gap-16 md:gap-5 md:gap-6 md:items-center md:items-end md:items-start justify-center justify-end justify-start
// lg:gap-16 lg:gap-5 lg:gap-6 lg:items-center lg:items-end lg:items-start justify-center justify-end justify-start

// items-start items-end items-center
// md:gap-[30px]
$classFront = "grid grid-cols-12 " . $alignClass;
$previewAttrs = 'data-class="'.$classFront.'"';

$newClass = '';
$classToPreview = explode(' ', $classFront);
foreach($classToPreview as $class) {
    $newClass = $newClass . 'preview-' . $class . ' ';
}
?>
<section class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>" style="<?= $bgStyle ?>" data-gap="<?= $gapAmount ?>">
    <div class="wrapper container">
        <div class="<?= $is_preview ? $newClass : $classFront ?>" <?= $previewAttrs ?>>
            <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
        </div>
    </div>
</section>