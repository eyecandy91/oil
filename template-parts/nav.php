<header>
    <nav id="navbar" class="navbar is-spaced navbar has-shadow is-spaced is-uppercase"
        itemscope="itemscope" itemtype="https://schema.org/SiteHeader">
        <div class="container">
        <div class="navbar-brand">
            <div class="navbar-item">
                    <?php echo get_custom_logo(); ?>
                
            </div>
            <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navMenuDocumentation" class="navbar-menu">
            <div class="navbar-end ">
                <?php
                wp_nav_menu(array(
                    'theme_location'  => 'menu-1',
                    'menu_id'         => 'primary-menu',
                    'menu_class'      => 'navbar-nav ',
                    'list_item_class' => 'nav-item',
                ));
                if (is_user_logged_in()) {?>
                <a href="<?php echo esc_url( wp_logout_url(home_url())); ?>">Logout</a>
                <?php }?>
            </div>
        </div>
        </div>
    </nav>
</header>