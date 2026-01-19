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
$id = 'gallery-full-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-gallery-full';
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
            <div class="counter-wrapper container-mobile text-h3 md:mb-[50px] mb-[20px]">
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
        <?php endif; ?>
        <?php if($imageCounter) : ?>
            <div class="image-gallery">
                <div class="title-wrapper container-mobile mb-[25px]">
                    <p class="text-h3">Picture<?= $imageCounter > 1 ? 's' : '' ?></p>
                </div>
                <div class="grid grid-cols-12 gap-[50px] mb-[50px] <?= $imageCounter > 1 ? 'multi' : '' ?>">
                    <?php foreach($gallery as $i => $media) : ?>
                        <?php if($media['type'] == 'image') : ?>
                        <div class="col-span-12 md:col-span-6">
                            <div class="image-wrapper relative pt-[74%]">
                                <a href="<?= parse_url($media['url'], PHP_URL_PATH) ?>" class="block absolute inset-0 w-full h-full glightbox-<?= $block['id'] . 'image' ?>" data-glightbox data-gallery="gallery-<?= str_replace('block_', '', $block['id'] . 'image') ?>">
                                    <?php if($media['type'] == 'image') : ?>
                                        <img src="<?= $media['url'] ?>" class="image-ratio glightbox-<?= $block['id'] . 'image' ?>" alt="">
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($videoCounter) : ?>
            <div class="video-gallery">
                <div class="title-wrapper container-mobile mb-[25px]">
                    <p class="text-h3">Video<?= $videoCounter > 1 ? 's' : '' ?></p>
                </div>
                <div class="grid grid-cols-12 gap-[50px] mb-[50px] <?= $videoCounter > 1 ? 'multi' : '' ?>">
                    <?php foreach($gallery as $i => $media) : ?>
                        <?php if($media['type'] == 'video') : ?>
                            <div class="col-span-12 md:col-span-6">
                                <div class="image-wrapper relative pt-[74%]">
                                    <a href="<?= parse_url($media['url'], PHP_URL_PATH) ?>" class="block absolute inset-0 w-full h-full glightbox-<?= $block['id'] . 'video' ?>" data-glightbox data-gallery="gallery-<?= str_replace('block_', '', $block['id'] . 'video') ?>">
                                        <video src="<?= $media['url'] ?>" class="image-ratio glightbox-<?= $block['id'] . 'video' ?>" alt="">
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>