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
$id = 'grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// $isContainer = true;
$twiceCols = get_field('twice_columns');
$template = [
    ['acf/column'],
];


$elClasses = 'grid grid-cols-12 md:gap-[50px] gap-y-[30px]';
if($twiceCols) {
    $elClasses = $elClasses . ' twice-columns';
}
?>
<section class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="<?= $is_preview ? '' : $elClasses ?>" data-class="<?= $is_preview ? $elClasses : '' ?>">
        <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
    </div>
</section>