<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="ts-header">
    <div class="ts-header-inner">

        <!-- LOGO -->
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="ts-logo">
            ISTORE<span>.</span>
        </a>

        <!-- DESKTOP MENU -->
        <nav class="ts-nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'ts-menu',
            ]);
            ?>
        </nav>

        <!-- ACTIONS -->
        <div class="ts-actions">

            <?php if ( function_exists('WC') && WC()->cart ) : ?>
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="ts-cart">
                    🛒
                    <span class="ts-cart-count">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                </a>
            <?php endif; ?>

            <button class="ts-burger" id="tsBurger">☰</button>
        </div>

    </div>

    <!-- MOBILE MENU -->
    <div class="ts-mobile-menu" id="tsMobileMenu">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'ts-mobile-list',
        ]);
        ?>
    </div>
</header>
