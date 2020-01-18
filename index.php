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
        <?php if(have_posts()): ?>
        <section>
            <div class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </div>

            <?php
                while(have_posts()) {
                    the_post();
                    if(is_category()) {
                        require get_template_directory().'/html/default/category.php';
                    } else {
                        require get_template_directory().'/html/default/'.get_post_type().'.php';        
                    }
                }
            ?>
            
            <?php the_posts_navigation(); ?>
        </section>
        <?php endif; ?>

        <?php if(is_front_page()): ?>
        <!-- Show the following only on the site's frontpage -->
        <?php //get_sidebar(); ?>

        <!-- Widget position "kdk_sidebar" -->
        <?php kdk_widgets('kdk_sidebar'); ?>

        <!-- Widget position "kdk_right" -->
        <?php kdk_widgets('kdk_right'); ?>
        <?php endif; ?>

        <!-- The footer -->
        <?php wp_footer(); ?>
    </body>
</html>
