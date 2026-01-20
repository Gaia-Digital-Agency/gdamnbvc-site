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
$id = 'image-with-details-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-image-with-details';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$image = get_field('image');
$imageWidth = get_field('width');
$imageHeight = get_field('height');
$imageAspectRatio = get_field('aspect_ratio');
$maxWidthStyle = '';
$styles = '';

$details = get_field('details');
if($imageAspectRatio) {
    $styles = $styles . 'padding-top: '. $imageAspectRatio . ';';
}
if($imageWidth) {
    $styles = $styles . 'max-width: ' . $imageWidth . ';';
}
?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="image-wrapper relative" style="<?= $styles; ?>">
        <img src="<?= $image['url'] ?>" class="image-ratio" alt="">
        <?php if($details) : ?>
            <div class="details-wrapper flex items-center gap-x-5 p-[10px] absolute bottom-0 left-0 right-0">
                <?php foreach($details as $detail) : ?>
                    <div class="detail flex items-center">
                        <div class="icon-wrapper w-[30px] h-[30px] flex justify-center items-center">
                            <img src="<?= $detail['icon']['url'] ?>" class="h-[12px]" alt="">
                        </div>
                        <div class="text-wrapper text-small text-white">
                            <?= $detail['text'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
</div>