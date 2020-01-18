<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="container">
            <!-- The header -->
            <header>
                <div>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </div>

                <nav>
                    <?php kdk_widgets('kdk_menu'); ?>
                </nav>

                <!-- Widget position "kdk_top" -->
                <?php kdk_widgets('kdk_top'); ?>
            </header>

            <div id="content">
                <main>
                <!-- The body -->
                <?php
                    if (have_posts()) {
                        if (is_front_page()) {
                            require get_template_directory().'/html/default/index.php';
                        } elseif (is_category()) {
                            require get_template_directory().'/html/default/category.php';
                        } elseif (is_tag()) {
                            require get_template_directory().'/html/default/tag.php';
                        } elseif (get_post_type()) {
                            require get_template_directory().'/html/default/'.get_post_type().'.php';
                        } else {
                            echo 'No content found';
                        }
                    }
                ?>
                </main>
    
                <?php if(is_front_page()): ?>
                <!-- Show the following only on the site's frontpage -->
                <aside>
                    <!-- Widget position "kdk_sidebar" -->
                    <?php kdk_widgets('kdk_sidebar_top'); ?>
    
                    <!-- Widget position "kdk_right" -->
                    <?php kdk_widgets('kdk_sidebar_bottom'); ?>
                </aside>
                <?php endif; ?>
            </div>
        </div>

        <footer>
            <!-- The footer -->
            <?php wp_footer(); ?>
        </footer>
    </body>
</html>
