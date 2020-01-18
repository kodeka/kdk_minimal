<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */
?>

<article>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

    <?php the_category(); ?>

    <?php the_tags(); ?>

    <?php if(is_single()): ?>
    <?php the_content(); ?>
    <?php else: ?>
    <?php the_excerpt(); ?>
    <?php endif; ?>

    <p>
        <?php echo get_post_meta($post->ID, KDK_ID.'_key', true); ?>
    </p>
</article>
