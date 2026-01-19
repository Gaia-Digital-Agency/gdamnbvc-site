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
$id = 'manual-donation-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-manual-donation';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// $isContainer = get_field('is_container');
$image = get_field('image');
$title = get_field('title');
$description = get_field('description');

$bank_information = get_field('bank_information');
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="outer relative pb-[125px]">
        <div class="outer bg-theme-grey">
            <div class="container px-0">
                <div class="grid grid-cols-12 md:gap-x-[50px] gap-y-[50px]">
                    <div class="col-span-12 md:col-span-7 p-container">
                        <div class="spacer md:pt-[100px] pt-[60px]"></div>
                        <div class="title-wrapper">
                            <p class="text-h1 font-light"><?= $title ?></p>
                        </div>
                        <div class="spacer md:pt-[50px] pt-[30px]"></div>
                        <div class="description-wrapper">
                            <p><?= $description ?></p>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-5 target-right">
                        <div class="image-wrapper relative pt-[150%]">
                            <img src="<?= $image['url'] ?>" class="image-ratio" alt="">
                            <div class="mobile-overlay block md:hidden absolute top-0 right-0 left-0 px-5 py-[25px]">
                                <?= $bank_information ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="desktop-overlay absolute bottom-0 right-0 hidden md:block">
            <div class="inner md:w-[750px] p-[50px]">
                <?= $bank_information ?>
            </div>
        </div>
    </div>
</div>