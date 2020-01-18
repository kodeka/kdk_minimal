<?php
/**
 * @version    1.0.0
 * @package    KDK Minimal (theme)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

/**
 * Register widget areas
 */

function kdk_reg_widgets()
{
    // Define widget areas
    $widgetAreas = array(
        'KDK Minimal - Top'            => 'kdk_top',
        'KDK Minimal - Sidebar Top'    => 'kdk_sidebar_top',
        'KDK Minimal - Sidebar Bottom' => 'kdk_sidebar_bottom'
    );

    // Register each widget area
    foreach ($widgetAreas as $name => $id) {
        register_sidebar(array(
            'name'          => esc_html__($name, 'kdk_minimal'),
            'id'            => $id,
            'description'   => esc_html__('Add widgets here.', 'kdk_minimal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'kdk_reg_widgets');

// Helper to render widget areas
function kdk_widgets($id)
{
    if (is_active_sidebar($id)) {
        ?>
        <div class="kdkWidgetArea">
            <?php dynamic_sidebar($id); ?>
        </div>
        <?php
    }
}



// Body class
function kdk_minimal_body_classes($classes)
{
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    if (is_front_page()) {
        $classes[] = 'is-frontpage';
    } elseif (is_category()) {
        $classes[] = 'is-category';
    } elseif (is_tag()) {
        $classes[] = 'is-tag';
    } elseif (get_post_type()) {
        $classes[] = 'is-'.strtolower(get_post_type());
    }

    return $classes;
}
add_filter('body_class', 'kdk_minimal_body_classes');

if (!function_exists('kdk_minimal_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function kdk_minimal_setup()
    {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on kdk_minimal, use a find and replace
     * to change 'kdk_minimal' to the name of your theme in all the template files
     */
        load_theme_textdomain('kdk_minimal', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'kdk_minimal'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ));
    }
}
add_action('after_setup_theme', 'kdk_minimal_setup');

/**
 * Enqueue scripts and styles.
 */
function kdk_minimal_scripts()
{
    wp_enqueue_style('kdk_minimal-style', get_stylesheet_uri());

    // CSS
    wp_enqueue_style('kdk_minimal-template', get_template_directory_uri().'/css/template.css', array(), '20200118');

    // JS
    wp_enqueue_script('kdk_minimal-behaviour', get_template_directory_uri().'/js/behaviour.js', array(), '20200118');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'kdk_minimal_scripts');

// Remove Emoji Support
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Hide the admin bar
add_filter('show_admin_bar', '__return_false');



// === Custom Fields (WIP) ===
function KDK_MetaBox($name, $id)
{
    define('KDK_ID', 'kdk_media');
    define('KDK_NAME', 'Media');

    function kdk_add_meta_box()
    {
        add_meta_box(
            KDK_ID,            // $id
            KDK_NAME,          // $title
            'kdk_meta_box_cb', // $callback
            'post',            // $page
            'normal',          // $context
            'high'             // $priority
        );
    }
    function kdk_meta_box_cb($post)
    {
        $meta = get_post_meta($post->ID, KDK_ID.'_key', true);

        // Add an nonce field so we can check for it later.
        wp_nonce_field(KDK_ID, KDK_ID.'_nonce');

        echo '<p><textarea name="'.KDK_ID.'_field" id="'.KDK_ID.'_field" rows="4" style="min-width:100%;">'.esc_textarea($meta).'</textarea></p>';
    }
    add_action('add_meta_boxes', 'kdk_add_meta_box');

    // Save the metabox
    function kdk_save_meta_box($post_id)
    {

        // Check if our nonce is set for both fields.
        if (!isset($_POST[KDK_ID.'_nonce'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST[KDK_ID.'_nonce'], KDK_ID)) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check permissions
        if ('post' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            } elseif (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        // Update the meta field in the database.
        update_post_meta($post_id, KDK_ID.'_key', $_POST[KDK_ID.'_field']);
    }
    add_action('save_post', 'kdk_save_meta_box');
}
//KDK_MetaBox('Video URL', 'kdk_video_url');
