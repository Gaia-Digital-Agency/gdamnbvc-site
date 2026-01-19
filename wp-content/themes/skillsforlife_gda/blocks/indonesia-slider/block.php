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
$id = 'indonesia-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-indonesia-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// $isContainer = get_field('is_container');
$image = get_field('image');

$sliders = get_field('sliders');
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="outer py-10 lg:py-0 relative overflow-x-hidden">
        <div class="inner lg:py-[100px] py-5 container bg-el" style="background-image: url(<?= $image['url'] ?>)">
            <div class="desktop-wrapper hidden lg:block">
                <?php $counter = 0; ?>
                <?php foreach($sliders as $i => $slide) : ?>
                    <?php if(!($i % 2)) : $counter = $counter+1; ?>
                        <div class="flex <?= $counter % 2 ? 'justify-center' : 'justify-between' ?> gap-x-[50px] mb-[50px]">
                    <?php endif; ?>

                    <div class="box max-w-[500px]">
                        <div class="inner py-5 px-[25px]">
                            <p class="text-center text-theme-grey-2 title text-h3 font-bold"><?= $slide['title'] ?></p>
                            <p class="text-center text-body-secondary text-theme-grey-2"><?= $slide['description'] ?></p>
                        </div>
                    </div>
                    <?php if($i % 2) : ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if(count($sliders) % 2) : ?>
                    </div>
                <?php endif ?>
            </div>
    
            <div class="mobile-wrapper lg:hidden">
                <div class="swiper overflow-visible" style="perspective: none;">
                    <div class="swiper-wrapper">
                        <?php foreach($sliders as $i => $slide) : ?>
                        <div class="swiper-slide">
                            <div class="inner box -my-10 mobile-box px-[25px] w-[350px] h-[350px] mx-auto flex flex-col gap-8 items-center justify-center" style="border-radius: 50%;">
                                <p class="text-center text-theme-grey-2 title text-h3 font-bold"><?= $slide['title'] ?></p>
                                <p class="text-center text-body-secondary text-theme-grey-2"><?= $slide['description'] ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- <?php $sliders ?> -->
            </div>
    
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>