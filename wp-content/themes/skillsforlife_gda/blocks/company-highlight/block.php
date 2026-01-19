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
$id = 'company-highlight-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'acf-block block-company-highlight';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// $isContainer = get_field('is_container');
// md:col-span-4 md:col-span-6 md:col-span-8 md:col-span-12 md:col-start-3 md:col-start-7
// lg:col-span-4 lg:col-span-6 lg:col-span-8 lg:col-span-12 lg:col-start-3

$slides = get_field('contents');

$positionDummy = [
    'right-0 top-0',
    'lg:right-[190px] right-[40px] bottom-0',
    'lg:left-[120px] left-0 top-0',
    'right-0 bottom-0'
];

$positionFixed = [
    [
        'left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-max'
    ],
    [
        'lg:left-[100px] left-[20px] top-0',
        'right-0 bottom-0'
    ],
    [
        'right-0 lg:top-1/2 top-0 lg:-translate-y-1/2 w-max',
        'bottom-0 left-1/2 -translate-x-1/2 w-max',
        'lg:left-[100px] left-[20px] top-0'
    ]
];
if(!function_exists('companyHighlightIsLandscape')) {
    function companyHighlightIsLandscape($image) {
        $height = $image['height'];
        $width = $image['width'];
        return ($height / $width) < 1;
    }
}

if(!function_exists('getPositionDummy')) {
    // $positionFixed = [
    //     [
    //         'left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-max'
    //     ],
    //     [
    //         'left-[100px] top-0',
    //         'right-0 bottom-0'
    //     ],
    //     [
    //         'right-0 top-1/2 -translate-y-1/2 w-max',
    //         'bottom-0 left-1/2 -translate-x-1/2 w-max',
    //         'left-[100px] top-0'
    //     ]
    // ];
    function getPositionDummy($arr, $currentIndex) {
        // if(count($arr) == 2 && $currentIndex == 1) {
        //     return 2;
        // }
        // if($currentIndex == 0 && companyHighlightIsLandscape($arr[$currentIndex])) {
        //     return 3;
        // }
        // var_dump($positionFixed);
        // var_dump($positionFixed[(count($arr) - 1)][$currentIndex]);
        return $positionFixed[(count($arr) - 1)][$currentIndex];
        // return $currentIndex;
    }
    // var_dump($positionFixed[1]);
}
?>


<div class="<?= esc_attr($classes) ?>" id="<?= esc_attr($id) ?>">
    <div class="inner py-[100px] bg-theme-black">
        <div class="container">
            <div class="title pb-[100px]">
                <p class="text-h1 font-light text-white">Company <span class="font-medium">Highlight</span></p>
            </div>
            <div class="slides-wrapper">
                <?php foreach($slides as $slide) : ?>
                    <div class="slides-item lg:mb-[100px] lg:max-w-[1140px] max-w-[390px] h-[385px] lg:h-[650px] mx-auto relative">
                        <div class="flex flex-col lg:flex-row w-full h-full lg:items-center lg:justify-between justify-center relative" style="z-index: 10;">
                            <div class="year text-large-2 font-extend font-bold text-white tracking-[0.05em] lg:flex-[0_0_25%]"><?= $slide['year'] ?></div>
                            <div class="description text-h3 font-medium text-white max-w-[650px] lg:flex-[0_0_75%]"><?= $slide['description'] ?></div>
                        </div>
                        <?php foreach($slide['images'] as $i => $image) : ?>
                            <?php ?>
                            <?php $classes = $positionFixed[(count($slide['images']) - 1)][$i] ?>
                            <?php // var_dump($positionFixed[count($slide['images']) - 1][$i]) ?>
                            <div class="image-item-wrapper absolute <?= $classes ?>" data-index="<?= $i ?>" style="z-index: <?= $i + 1 ?>;">
                                <div class="image-wrapper">
                                    <div class="inner overflow-y-hidden">
                                        <img src="<?= $image['url'] ?>" class="w-full lg:max-w-none max-w-[250px] h-full" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>