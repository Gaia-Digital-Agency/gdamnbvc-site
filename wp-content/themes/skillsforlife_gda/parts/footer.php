<?php $menus = wp_get_menu_array('Footer Menu'); ?>
<?php $limiter = ceil(count($menus) / 2); ?>

<footer>
    <div class="inner md:py-24 py-12 bg-theme-black">
        <div class="container">

            <div class="md:flex block md:justify-between justify-center mb-16 md:mb-0">

                <div class="logo-wrapper mb-16 md:mb-0">
                    <a href="/">
                        <?php if(get_theme_mod('footer_image')) : ?>
                            <img src="<?= get_theme_mod('footer_image') ?>" width="200" alt="">
                        <?php else : ?>
                            <h1>Skills for Life</h1>
                        <?php endif; ?>
                    </a>
                </div>

                <div class="menu-wrapper block md:flex gap-x-12">
                    <div class="menu-col">
                        <?php $counter = 0; ?>
                        <?php foreach($menus as $i => $menu) : ?>
                            <?php if($counter < $limiter) : ?>
                        <div class="menu-item md:mb-1 mb-6">
                            <a href="<?= $menu['url'] ?>" class="text-white font-extend text-menu-footer font-medium md:font-light"><?= $menu['title'] ?></a>
                        </div>
                        <?php endif; ?>
                        <?php $counter = $counter + 1; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="menu-col">
                        <?php $counter = 0; ?>
                        <?php foreach($menus as $i => $menu) : ?>
                            <?php if($counter >= $limiter) : ?>
                        <div class="menu-item md:mb-1 mb-6">
                            <a href="<?= $menu['url'] ?>" class="text-white font-extend text-menu-footer font-medium md:font-light"><?= $menu['title'] ?></a>
                        </div>
                        <?php endif; ?>
                        <?php $counter = $counter + 1; ?>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>


            <div class="flex md:gap-x-48 gap-y-8 md:gap-y-0 flex-col md:flex-row md:items-center">
                <div class="socials-wrapper flex md:gap-x-[30px] gap-x-[20px] order-1 md:order-1">
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Instagram.svg') ?>" alt="" class="w-[40px] h-[40px] md:w-[50px] md:h-[50px]">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/TikTok.svg') ?>" alt="" class="w-[40px] h-[40px] md:w-[50px] md:h-[50px]">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Facebook.svg') ?>" alt="" class="w-[40px] h-[40px] md:w-[50px] md:h-[50px]">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Pinterest.svg') ?>" alt="" class="w-[40px] h-[40px] md:w-[50px] md:h-[50px]">
                        </a>
                    </div>
                </div>
                
                <div class="extra-links flex gap-x-8 order-2 md:order-2">
                    <div class="link-item menu-item text-center mb-2 md:mb-0">
                        <a href="#" class="text-theme-grey-2 md:text-theme-grey text-caption-small md:text-caption md:font-light font-bold opacity-50 md:opacity-100 font-extend">Privacy Policy</a>
                    </div>
                    <div class="link-item menu-item text-center mb-2 md:mb-0">
                        <a href="#" class="text-theme-grey-2 md:text-theme-grey text-caption-small md:text-caption md:font-light font-bold opacity-50 md:opacity-100 font-extend">Terms & Conditions</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>


<div id="donation-overlay" class="fixed inset-0 bg-[rgba(0,0,0,.4)] z-[999999]"></div>
<div id="donation-form" class="fixed left-0 top-0 bottom-0 right-0 md:right-auto z-[999999]" role="dialog" aria-modal="true" hidden>
    <div class="md:p-[50px] pt-[100px] pb-[80px] container-mobile outer-wrapper wrapper bg-white max-w-3xl h-full relative overflow-y-scroll">
        <div class="close-icon absolute top-5 right-5 md:hidden">
            <div class="inner w-10 h-10 flex justify-center items-center">
                <img src="<?= assets_url('images/close_icon.svg') ?>" class="w-5 h-5" alt="">
            </div>
        </div>
        <form action="#" class="h-full">
            <div class="flex flex-col justify-between h-full">
                <div class="swiper mx-0 pb-5" style="flex-shrink: 0;">
                    <div class="swiper-wrapper swiper-container">
    
                        <div class="swiper-slide">
                            <div class="form-wrapper">
                                <div class="title-wrapper text-center mb-[50px]">
                                    <p class="text-h2 font-medium">Select Donation <span class="font-light">Amount</span></p>
                                </div>
    
                                <div class="amount-wrapper grid grid-cols-3 gap-x-[15px] md:gap-x-[25px] mb-10">
                                    <div class="box text-center col-span-1">
                                        <div class="inner py-[25px] border border-theme-black select-state amount-select" tabindex="0" data-amount="100000">
                                            <p class="text-cta font-medium">IDR 100,000</p>
                                        </div>
                                    </div>
                                    <div class="box text-center col-span-1">
                                        <div class="inner py-[25px] border border-theme-black select-state amount-select" tabindex="0" data-amount="500000">
                                            <p class="text-cta font-medium">IDR 500,000</p>
                                        </div>
                                    </div>
                                    <div class="box text-center col-span-1">
                                        <div class="inner py-[25px] border border-theme-black select-state amount-select" tabindex="0" data-amount="1000000">
                                            <p class="text-cta font-medium">IDR 1,000,000</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrapper mb-[50px]">
                                    <div class="input-manual-wrapper border border-theme-black flex items-center pl-[30px]">
                                        <div class="prefix mr-3 text-cta">IDR</div>
                                        <div class="wrapper w-full">
                                            <input type="text" class="w-full md:py-2 py-4 text-cta" id="manual-input" placeholder="Or enter your amount" name="manual-amount">
                                        </div>
                                    </div>
                                    <div id="error-amount" class="error-handler mt-1">
                                        Please put amount with minimum value 10000
                                    </div>
                                </div>
    
                                <input type="hidden" id="input-amount" class="mandatory" name="amount">
    
                                <div class="period-wrapper text-center">
                                    <div class="title-wrapper mb-10">
                                        <p class="text-h3 font-medium">Donation <span class="font-light">Period</span></p>
                                    </div>
                                    <div class="period grid grid-cols-3 gap-x-[15px] md:gap-x-[25px]">
                                        <div class="box col-span-1">
                                            <div class="inner py-3 py-4 border border-theme-black period-select select-state active" data-period="once">
                                                <p class="text-cta font-medium">Once</p>
                                            </div>
                                        </div>
                                        <div class="box col-span-1">
                                            <div class="inner py-3 py-4 border border-theme-black select-state period-select disabled" data-period="monthly">
                                                <p class="text-cta font-medium">Monthly</p>
                                            </div>
                                        </div>
                                        <div class="box col-span-1">
                                            <div class="inner py-3 py-4 border border-theme-black select-state period-select disabled" data-period="yearly">
                                                <p class="text-cta font-medium">Yearly</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <input type="hidden" id="input-period" class="mandatory" name="period" value="once">
    
                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="form-wrapper">
    
                                <div class="type-wrapper grid grid-cols-2 gap-x-[15px] md:gap-x-[50px] md:mt-[50px] md:mb-16 mb-[30px]">
                                    <div class="box text-center col-span-1">
                                        <div class="inner py-4 border border-theme-black select-state type-select active" data-type="individual">
                                            <p class="text-cta font-medium">As Individual</p>
                                        </div>
                                    </div>
                                    <div class="box text-center col-span-1">
                                        <div class="inner py-4 border border-theme-black select-state type-select" data-type="organization">
                                            <p class="text-cta font-medium">As Organization</p>
                                        </div>
                                    </div>
                                </div>
    
                                <input type="hidden" id="input-type" name="type" class="mandatory" value="individual">
    
                                <div class="information-wrapper">
                                    <div class="grid grid-cols-12 gap-x-[15px] gap-y-[15px] md:gap-[50px]">
                                        <div class="input-wrapper col-span-6">
                                            <label class="mb-[10px] block" for="#">Title</label>
                                            <select name="title" class="w-full" disabled id="input-title">
                                                <option value="mr">Mr</option>
                                                <option value="mrs">Mrs</option>
                                                <option value="miss">Miss</option>
                                                <option value="ms">Ms</option>
                                            </select>
                                        </div>
                                        <div class="input-wrapper col-span-6 organization-wrapper">
                                            <div class="flex mb-[10px] items-center justify-between">
                                                <label class="block" for="#">Organization Name</label>
                                                <div id="error-organization" class="error-handler">
                                                    This is a required field
                                                </div>
                                            </div>
                                            <input disabled type="text" class="input-form-handler" style="">
                                        </div>
                                        <div class="input-wrapper col-span-6">
                                            <div class="flex mb-[10px] items-center justify-between">
                                                <label class="block" for="#">First Name</label>
                                                <div id="error-first-name" class="error-handler">
                                                    This is a required field
                                                </div>
                                            </div>
                                            <input disabled name="first-name" type="text" id="input-first-name" class="input-form-handler mandatory" style="">
                                        </div>
                                        <div class="input-wrapper col-span-6">
                                            <div class="flex mb-[10px] items-center justify-between">
                                                <label class="block" for="#">Last Name</label>
                                                <div id="error-last-name" class="error-handler">
                                                    This is a required field
                                                </div>
                                            </div>
                                            <input disabled type="text" id="input-last-name" name="last-name" class="input-form-handler mandatory" style="">
                                        </div>
                                        <div class="input-wrapper col-span-6">
                                            <div class="flex mb-[10px] items-center justify-between">
                                                <label class="block" for="#">Email</label>
                                                <div id="error-email" class="error-handler">
                                                    This is a required field
                                                </div>
                                            </div>
                                            <input disabled type="text" id="input-email" name="email" class="input-form-handler mandatory" style="">
                                        </div>
                                        <div class="input-wrapper col-span-6">
                                            <div class="flex mb-[10px] items-center justify-between">
                                                <label class="block" for="#">Phone</label>
                                                <div id="error-mobile-number" class="error-handler">
                                                    This is a required field
                                                </div>
                                            </div>
                                            <input disabled type="text" id="input-mobile-number" name="mobile-number" class="input-form-handler mandatory" style="">
                                        </div>
                                        <div class="input-wrapper col-span-6">
                                            <label class="mb-[10px] block" for="#">Date of Birth</label>
                                            <div class="flex gap-x-[7.5px] md:gap-x-[25px]">
                                                <input disabled type="number" min="1" max="31" class="date-input w-full focus:outline-0 border text-center border-[rgba(23,23,25,.3)] focus:border-[rgba(23,23,25,1)]" placeholder="DD" style="">
                                                <input disabled type="number" min="1" max="12" class="date-input w-full focus:outline-0 border text-center border-[rgba(23,23,25,.3)] focus:border-[rgba(23,23,25,1)]" placeholder="MM" style="">
                                                <input disabled type="number" min="1" class="date-input w-2/5 focus:outline-0 border text-center border-[rgba(23,23,25,.3)] focus:border-[rgba(23,23,25,1)]" placeholder="YYYY" style="flex-shrink: 0;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <input type="hidden" id="input-period" name="period" value="once">
    
                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div id="iframe-wrapper">

                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="buttons-wrapper">
                    <div class="next-button text-cta text-white text-center w-full py-8 bg-theme-black cursor-pointer">
                        Donate
                    </div>
                    <div class="prev-button text-cta text-center w-full cursor-pointer h-[40px] underline flex items-end justify-center" style="opacity: 0; pointer-events: none;">
                        Back
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>