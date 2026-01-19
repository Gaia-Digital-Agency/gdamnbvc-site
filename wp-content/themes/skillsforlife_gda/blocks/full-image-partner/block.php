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
$id = 'full-image-partner-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-full-image-partner';
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

$logo = get_field('logo');
$logoMobile = get_field('logo_mobile');
$image = get_field('image');
$imagePosition = get_field('image_position');
$imageRight = $imagePosition == 'right';

$background = get_field('bg_color');

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
        <div class="wrapper px-0 z-[2] relative">
            <div class="grid grid-cols-12 items-center">
                <div class="col-span-12 block md:hidden">
                    <div class="logo-wrapper container-mobile mb-[30px]">
                        <img src="<?= $logoMobile ? $logoMobile['url'] : $logo['url'] ?>" class="w-full w-3/4" alt="">
                    </div>
                </div>
                <div class="col-span-12 md:col-span-7 <?= $imageRight ? 'md:order-1' : 'md:order-2' ?>">
                    <div class="outer relative z-[2]" style="<?= $backgroundStyle ?>">
                        <div class="text-wrapper container md:py-[100px] py-[60px]">
                            <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5 <?= $imageRight ? 'md:order-2' : 'md:order-1' ?>">
                    <div class="logo-wrapper mb-[50px] hidden md:block mx-auto">
                        <img src="<?= $logo['url'] ?>" class="w-1/2 mx-auto" alt="">
                    </div>
                    <div class="image-wrapper pt-[110%] relative">
                        <img src="<?= $image['url'] ?>" class="image-ratio" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>