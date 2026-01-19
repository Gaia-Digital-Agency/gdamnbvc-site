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
$id = 'image-text-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-image-text-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$sliders = get_field('sliders');
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="-container-mobile">
        <div class="swiper relative pb-[40px]">
            <div class="swiper-navigation hidden md:block">
                <div class="next-button navigation-button">
                    <img src="<?= assets_url('images/right-chevron.svg') ?>" class="w-[25px] h-[40px]" alt="">
                </div>
                <div class="prev-button navigation-button">
                    <img src="<?= assets_url('images/left-chevron.svg') ?>" class="w-[25px] h-[40px]" alt="">
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-wrapper">
                <?php foreach($sliders as $i => $slider) : ?>
                    <div class="swiper-slide">
                        <div class="title lg:hidden block mb-4 text-center text-h2 font-medium">
                            <?= $slider['title'] ?>
                        </div>
                        <div class="flex lg:w-min w-full">
                            <div class="outer-wrapper lg:w-[500px] w-1/2">
                                <div class="image-wrapper relative pt-[66%]">
                                    <img src="<?= $slider['image']['url'] ?>" class="image-ratio" alt="">
                                </div>
                            </div>
                            <div class="text-wrapper pl-[30px] container-mobile lg:w-[310px] w-1/2 flex lg:justify-between justify-center flex-col">
                                <div class="title hidden lg:block text-h2 font-medium">
                                    <?= $slider['title'] ?>
                                </div>
                                <div class="text">
                                    <?= $slider['text'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>