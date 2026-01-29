<?php $menus = wp_get_menu_array('Main Menu'); ?>
<?php $mobile = wp_get_menu_array('Mobile Menu'); ?>

<header class="border-b border-theme-black">
    <div class="container">
        <div class="inner py-5">
            <div class="flex justify-between items-center">
                <div class="logo-wrapper nav:block hidden">
                    <a href="/">
                        <?php if(get_theme_mod('custom_logo')) : ?>
                            <img src="<?= wp_get_attachment_image_src( get_theme_mod('custom_logo') , 'full' )[0] ?>" width=="150" alt="">
                        <?php else : ?>
                            <h1>Skills For Life</h1>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="hamburger nav:hidden block cursor-pointer">
                    <img src="<?= assets_url('images/hamburger.svg') ?>" alt="">
                </div>
                <div class="menu-wrapper flex gap-x-10 items-center">
                    <?php foreach($menus as $menu) : ?>
                    <div class="menu-item nav:block hidden <?= $menu['is_active'] ? ' active' : '' ?>">
                        <a href="<?= $menu['url'] ?>" class="font-extend leading-none text-menu-header font-light"><?= $menu['title'] ?></a>
                    </div>
                    <?php endforeach; ?>
                    <div class="">
                        <a href="/get-involved" class="font-extend get-involved-button leading-none text-button-secondary border-[2px] border-theme-black md:p-[20.5px] py-[13px] px-[19px] block font-medium text-[16px] hover:border-theme-grey-3 hover:text-theme-grey-3">Get Involved</a>
                    </div>
                    <!-- <div class="menu-item">
                        <p class="font-extend trigger-donation-form get-involved-button leading-none text-button-secondary border-[2px] border-theme-black md:p-[20.5px] py-[13px] px-[19px] block font-medium text-[16px] hover:border-theme-grey-3 hover:text-theme-grey-3">Donation</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</header>

<aside id="mobile-menu" class="fixed inset-0 w-full h-full !z-[999999] bg-white nav:disabled block">
    <div class="container h-full px-[50px] overflow-y-scroll">
        <div class="flex flex-col h-full justify-between">

            <div class="wrapper">
                <div class="close-button cursor-pointer py-5">
                        <img src="<?= assets_url('images/close.svg') ?>" class="ml-auto" alt="">
                    </div>
                <div class="inner pb-8 mb-[25px] flex items-center justify-between">
                    <div class="logo-wrapper cursor-pointer">
                        <a href="/">
                            <img src="<?= wp_get_attachment_image_src( get_theme_mod('custom_logo') , 'full' )[0] ?>" width="100" alt="">
                        </a>
                    </div>
                </div>

                <div class="search-bar-wrapper relative hidden mb-[50px]">
                    <input type="text" class="w-full border-b border-theme-black h-[50px] text-h3 px-2 text-theme-black placeholder:text-theme-black placeholder:opacity-50" placeholder="Search">
                    <img src="<?= assets_url('images/search.svg') ?>" class="absolute right-0 top-1/2 -translate-y-1/2" alt="">
                </div>

                <div class="menu-wrapper">
                    <?php foreach($mobile as $i => $menu) : ?>
                        <div class="menu-item h-10 flex items-center pb-[5px] mb-[30px]<?= $menu['is_active'] ? ' active' : '' ?>">
                            <a href="<?= $menu['url'] ?>" class="text-menu-header leading-[50px] font-light font-extend"><?= $menu['title'] ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="wrapper py-[50px]">
                <div class="socials-wrapper flex gap-x-[25px] order-2 md:order-1">
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Instagram_mobile.svg') ?>" alt="">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/TikTok_mobile.svg') ?>" alt="">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Facebook_mobile.svg') ?>" alt="">
                        </a>
                    </div>
                    <div class="socials-item">
                        <a href="#">
                            <img src="<?= assets_url('images/Pinterest_mobile.svg') ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</aside>