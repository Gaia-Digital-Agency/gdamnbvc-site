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
$id = 'icon-list-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-icon-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$icons = get_field('icons');

?>
<section class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <?php foreach($icons as $i => $icon) : ?>
        
        <div class="icons-wrapper mb-[10px]">
            <div class="icon-items flex items-center">
                <div class="icon-wrapper mr-[15px]">
                    <img src="<?= $icon['image']['url'] ?>" width="20" height="20" alt="">
                </div>
                <div class="text">
                    <?php if($icon['text']) : ?>
                    <a href="<?= $icon['text']['url'] ? $icon['text']['url'] : '' ?>" target="<?= $icon['text']['target'] ? $icon['text']['target'] : '_self' ?>" class="text-caption"><?= $icon['text']['title'] ? $icon['text']['title'] : '' ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</section>