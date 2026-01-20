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
$id = 'text-list-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-text-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$texts = get_field('texts');

?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="wrapper flex flex-col md:items-center gap-[10px] md:flex-row">
        <?php foreach($texts as $i => $text) : ?>
            <?php if($i) : ?>
                <div class="spacer text-h3 hidden md:block"> | </div>
            <?php endif; ?>
            <div class="text-wrapper">
                <?= $text['text'] ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>