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
$id = 'full-image-overlay-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-full-image-overlay';
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
    ]
];

$template = [
    ['acf/column']
];

$backgroundStyle = '';
if($background) {
    $backgroundStyle = 'background-color: '.$background. ';';
}
?>
<section class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="outer container px-0">
        <div class="wrapper px-0 z-[2] relative md:pb-[160px]">
            <div class="grid grid-cols-12">
                <div class="col-span-12 <?= $sizes[intval($imageSize)][1] ?>">
                    <div class="outer relative z-[2]" style="<?= $backgroundStyle ?>">
                        <div class="text-wrapper container md:py-[100px] py-[60px]">
                            <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
                        </div>
                    </div>
                </div>
                <!-- <div class="col-span-12 <?= $sizes[intval($imageSize)][1] ?>">
                <div class="image-wrapper">
                    
                    </div>
                </div> -->
            </div>
            <img src="<?= $image['url'] ?>" class="md:w-4/5 md:h-4/5 w-full h-full md:absolute bottom-0 z-[1] right-0 object-cover" alt="">
        </div>
    </div>
</section>