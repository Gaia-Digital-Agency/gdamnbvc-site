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
$id = 'stack-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-stack-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$images = get_field('images');
$navigation = get_field('navigation');

?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="inner md:pr-12 pr-20">
        <div class="swiper">
            <div class="swiper-wrapper swiper-container">
                <?php foreach($images as $i => $image) : ?>
                    <div class="swiper-slide">
                        <div class="image-wrapper pt-[116%]">
                            <img src="<?= $image['image']['url'] ?>" class="absolute inset-0 w-full h-full object-cover" alt="">
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>