<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

?>

<div class="page-header">
    <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
    ?>
</div>

<section>
    <?php while(have_posts()): the_post(); ?>
    <article>
        <!-- Excerpt view -->
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
        </a>

        <?php if(has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <figure><?php the_post_thumbnail(); ?></figure>
        </a>
        <?php endif; ?>

        <?php the_excerpt(); ?>
    </article>
    <?php endwhile; ?>
</section>

<!-- Pagination -->
<div>
    <?php the_posts_navigation(); ?>
</div>
