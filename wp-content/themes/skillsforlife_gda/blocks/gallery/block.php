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
$id = 'gallery-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-gallery';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$gallery = get_field('gallery');
$counter = get_field('counter');
$button = get_field('button');
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="wrapper">
        <?php if($counter) : ?>
            <?php 
            $imageCounter = 0;
            $videoCounter = 0;
            foreach($gallery as $media) {
                if($media['type'] == 'image') {$imageCounter++;};
                if($media['type'] == 'video') {$videoCounter++;};
            }
            ?>
            <div class="flex items-center md:mb-[50px] mb-[20px] container-mobile justify-between">
                <div class="counter-wrapper text-h3">
                    <?php if($imageCounter) : ?>
                        <span class="font-medium">
                        <?= $imageCounter ?> Picture<?= $imageCounter > 1 ? 's' : '' ?>
                        </span>
                    <?php endif; ?>
                    <?php if($imageCounter && $videoCounter) : ?>
                        and
                    <?php endif; ?>
                    <?php if($videoCounter) : ?>
                        <span class="font-medium">
                            <?= $videoCounter ?> Video<?= $videoCounter > 1 ? 's' : '' ?>
                        </span>
                    <?php endif; ?>
                </div>
                <?php if(!$button) : ?>
                <div class="button-header">
                    <a href="<?= $button['link'] ?>" class="text-cta font-extend tracking-[0.05em] font-bold"><?= $button['title'] ?? 'VIEW ALL' ?></a>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="swiper pb-[40px] lg:pb-0">
            <div class="swiper-navigation hidden lg:block">
                <div class="next-button navigation-button">
                    <img src="<?= assets_url('images/right-chevron.svg') ?>" class="w-[25px] h-[40px]" alt="">
                </div>
                <div class="prev-button navigation-button">
                    <img src="<?= assets_url('images/left-chevron.svg') ?>" class="w-[25px] h-[40px]" alt="">
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-wrapper swiper-container">
                <?php foreach($gallery as $i => $media) : ?>
                    <div class="swiper-slide">
                        <div class="media-wrapper relative pt-[74%]">
                            <a href="<?= parse_url($media['url'], PHP_URL_PATH) ?>" class="block absolute inset-0 w-full h-full glightbox-<?= $block['id'] ?>" data-glightbox data-gallery="gallery-<?= str_replace('block_', '', $block['id']) ?>">
                                <?php if($media['type'] == 'image') : ?>
                                    <img src="<?= $media['url'] ?>" class="image-ratio glightbox-<?= $block['id'] ?>" alt="">
                                <?php endif; ?>
                                <?php if($media['type'] == 'video') : ?>
                                    <video src="<?= $media['url'] ?>" class="image-ratio glightbox-<?= $block['id'] ?>"></video>
                                <?php endif; ?>
                            </a>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>