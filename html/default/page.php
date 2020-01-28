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
    <!-- Full page view -->
    <h3><?php the_title(); ?></h3>

    <?php if(has_post_thumbnail()): ?>
    <figure><?php the_post_thumbnail(); ?></figure>
    <?php endif; ?>

    <?php the_content(); ?>

    <?php the_category(); ?>

    <?php the_tags(); ?>
</article>
<?php endwhile; ?>
