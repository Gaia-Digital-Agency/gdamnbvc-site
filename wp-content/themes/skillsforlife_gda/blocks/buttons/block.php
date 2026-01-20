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
$id = 'buttons-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-buttons';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

$buttons = get_field('buttons');

$buttonsStyle = [
    "bg-theme-black text-white hover:bg-theme-grey-3 hover:border-theme-grey-3 hover:text-white hover:text-theme-black",
    "bg-transparent text-theme-black hover:bg-theme-grey-5 hover:border-theme-grey-5",
]

?>
<?php if($buttons) : ?>
<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    
    <div class="buttons-wrapper flex flex-wrap md:gap-7 gap-y-[15px]">
        <?php foreach($buttons as $i => $button) : ?>
            <div class="button-item" style="flex: 0 0 calc(<?= 100 / count($buttons) ?>% - <?= 1.75 / 2 ?>rem);">
                <a href="<?= $button['url'] ?>" class="md:py-[38px] py-4 border-[3px] block font-medium text-center w-full border-theme-black text-button transition <?= $buttonsStyle[$i] ?>"><?= $button['text'] ?></a>
            </div>
        <?php endforeach ?>
    </div>

</div>

<?php endif; ?>