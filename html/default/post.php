<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

?>

<?php while(have_posts()): the_post(); ?>
<article>
    <?php if(is_single()): ?>

    <!-- Full post view -->
    <h3><?php the_title(); ?></h3>

    <?php if(has_post_thumbnail()): ?>
    <figure><?php the_post_thumbnail('medium_large'); ?></figure>
    <?php endif; ?>

    <?php the_content(); ?>

    <?php the_category(); ?>

    <?php the_tags(); ?>

    <?php the_post_navigation(); ?>

    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) {
            require get_template_directory().'/html/default/comments.php';
        }
    ?>

    <?php //echo get_post_meta($post->ID, KDK_ID.'_key', true); ?>

    <?php else: ?>

    <!-- Excerpt view -->
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
    </a>

    <?php the_excerpt(); ?>

    <?php endif; ?>
</article>
<?php endwhile; ?>
