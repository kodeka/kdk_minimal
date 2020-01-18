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

    <?php the_content(); ?>

    <?php the_category(); ?>

    <?php the_tags(); ?>

    <p>
        <?php echo get_post_meta($post->ID, KDK_ID.'_key', true); ?>
    </p>

    <?php else: ?>

    <!-- Excerpt view -->
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
    </a>

    <?php the_excerpt(); ?>

    <?php endif; ?>
</article>
<?php endwhile; ?>
