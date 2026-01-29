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
$id = 'more-stack-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-more-stack-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$slides = get_field('slides');

?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="container">
        <div class="grid grid-cols-12 items-center gap-y-12 md:gap-x-[50px]">
            <div class="md:col-span-5 col-span-12 order-2 md:order-1">
                <div class="text-slider swiper mb-[15px] md:mb-[50px]">
                    <div class="swiper-wrapper swiper-container">
                        <?php foreach($slides as $i => $slide) : ?>
                            <div class="swiper-slide" data-index="<?= $i ?>">
                                <div class="text-wrapper">
                                    <p class="text-h3"><?= $slide['text'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="navigation-wrapper">
                    <div class="navigation-next">
                        <p class="text-cta-large font-extend font-bold cursor-pointer tracking-[0.05em]">MORE</p>
                    </div>
                </div>
            </div>
            <div class="md:col-span-6 md:col-start-7 col-span-12 order-1 md:order-2">
                <div class="inner md:pr-12">
                    <div class="swiper image-slider">
                        <div class="swiper-wrapper swiper-container">
                            <?php foreach($slides as $i => $slide) : ?>
                                <div class="swiper-slide">
                                    <div class="image-wrapper pt-[116%]">
                                        <img src="<?= $slide['image']['url'] ?>" class="absolute inset-0 w-full h-full object-cover" alt="">
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>