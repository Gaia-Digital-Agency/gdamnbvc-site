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
$id = 'tab-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-tab-content';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$tabs = get_field('tabs');
$mobileFull = get_field('mobile_full');
$shouldCheckGalleryFull = get_field('gallery_filter');

?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <?php if($shouldCheckGalleryFull) : ?>
        <div class="filter-wrapper mb-[50px]">
            <div class="filter">
                <select name="" class="lg:w-[300px] lg:h-[90px] h-[50px]" id="">

                </select>
            </div>
        </div>
    <?php endif; ?>
    <div class="inner <?= $mobileFull ? '-container-mobile' : '' ?>">
        <div class="tabs-button-wrapper flex border-b border-theme-black md:mb-[50px] mb-[20px]">
            <?php foreach($tabs as $i => $tab) : ?>
                <div class="tabs-button lg:w-[300px] lg:h-[90px] h-[50px] flex items-center justify-center <?= $i ? '' : 'active' ?>" data-index="<?= $i ?>">
                    <?= $tab['title'] ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="tabs-content-wrapper">
            <div class="swiper">
                <div class="swiper-wrapper swiper-container">
                    <?php foreach($tabs as $i => $tab) : ?>
                        <div class="swiper-slide">
                            <?php 
                                $content = apply_filters( 'the_content', get_the_content(null, false, $tab['post']) );
                                echo $content; 
                            ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>