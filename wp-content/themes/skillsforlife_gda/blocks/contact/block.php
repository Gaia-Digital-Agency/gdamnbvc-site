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
$id = 'contact-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-contact';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$textTitle = get_field('text_title');
$form = get_field('form');

?>
<section class="<?= esc_attr($classes) ?> relative" id="<?= esc_attr($id) ?>">
    <div class="lg:absolute bg-[#E9E9E9] right-0 top-0 bottom-0 overlay hidden lg:block"></div>
    <div class="container xl:pb-[220px] lg:pb-[160px]">
        <?= $textTitle ?>
    </div>
    <div class="relative container">
        <div class="grid grid-cols-12 gap-y-[60px] lg:gap-x-[50px]">
    
            <div class="lg:col-span-6 col-span-12">
                <div class="inner contact-form">
                    <!-- form -->
                    <!-- <div class="box mb-5 px-[30px] lg:w-[600px] h-[60px] border border-theme-black flex items-center text-[rgba(23,23,25,.3)]">First Name</div>
                    <div class="box mb-5 px-[30px] lg:w-[600px] h-[60px] border border-theme-black flex items-center text-[rgba(23,23,25,.3)]">Last Name</div>
                    <div class="box mb-[50px] px-[30px] py-3 lg:w-[600px] h-[300px] border border-theme-black flex text-[rgba(23,23,25,.3)]">Message</div>
                    <div class="button lg:py-[38px] lg:w-[600px] py-4 font-extend font-medium text-cta bg-theme-black text-white text-center">
                        Send Message
                    </div> -->
                    <?php 
                    if($form) {
                        echo do_shortcode($form);
                    }
                    ?>
                </div>
            </div>
    
            <div class="lg:col-span-6 col-span-12 bg-[#E9E9E9] blocks-wrapper pb-[30px] lg:pb-0 -container-mobile">
                <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
            </div>
            <div class="col-span-12">
                <div class="spacer lg:pt-[200px] pt-[60px]"></div>
            </div>
        </div>
    
    </div>
</section>