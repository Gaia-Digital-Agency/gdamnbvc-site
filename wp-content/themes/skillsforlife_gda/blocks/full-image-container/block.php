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
$id = 'full-image-container-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-full-image-container';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// $isContainer = true;
$template = [
    ['acf/column'],
];

$image = get_field('image');
$imagePosition = get_field('image_position');
$imageRight = $imagePosition == 'right';

$imageSize = get_field('image_size');

$background = get_field('bg_color');
$layoutSize = get_field('layout_size');
$sizes = [
    [
        "md:col-span-4",
        "md:col-span-8",
    ],
    [
        "md:col-span-5",
        "md:col-span-7",
    ],
    [
        "md:col-span-6",
        "md:col-span-6",
    ],
    [
        "md:col-span-12",
        "md:col-span-0"
    ]
];

$backgroundStyle = '';
if($background) {
    $backgroundStyle = 'background-color: '.$background. ';';
}
?>
<section class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>" style="<?= $backgroundStyle ?>">
    <div class="wrapper container px-0">
        <div class="grid grid-cols-12 items-center">
            <div class="<?= $sizes[intval($layoutSize)][0] ?> col-span-12 <?= $imageRight ? 'md:order-2' : 'md:order-1' ?>">
                <div class="image-wrapper relative" style="padding-top: <?= $imageSize ?>;">
                    <img src="<?= $image['url'] ?>" class="image-ratio absolute inset-0 w-full h-full object-cover" alt="">
                </div>
            </div>
            <div class="<?= $sizes[intval($layoutSize)][1] ?> col-span-12 <?= $imageRight ? 'md:order-1' : 'md:order-2' ?>">
                <div class="inner p-container py-7 md:py-0">
                    <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
                </div>
            </div>
        </div>
    </div>
</section>