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
        <!-- The header -->
        <header>
            <div>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
            <nav>
                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </nav>

            <?php kdk_widgets('kdk_top'); ?>
        </header>

        <!-- The body -->
        <?php
            //var_dump(get_post_type());
            //var_dump(is_category());

            if (have_posts()) {
                //ob_start();
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
                //$output = ob_get_contents();
                //ob_end_clean();
                //echo $output;
            }
        ?>

        <?php if(is_front_page()): ?>
        <!-- Show the following only on the site's frontpage -->
        <aside>
            <?php //get_sidebar(); ?>
    
            <!-- Widget position "kdk_sidebar" -->
            <?php kdk_widgets('kdk_sidebar'); ?>
    
            <!-- Widget position "kdk_right" -->
            <?php kdk_widgets('kdk_right'); ?>
        </aside>
        <?php endif; ?>

        <!-- The footer -->
        <?php wp_footer(); ?>
    </body>
</html>
