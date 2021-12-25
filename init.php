<?php

/*
 * Plugin Name:       StudentSays - Make comment or feedback
 * Plugin URI:        https://jakirriaaz.com/plugins
 * Description:       StudentSays - Make comment or feedback plugin displayed the comment or feedback of the education organization by slides. This plugin will help any education center like university, college, school, and also students for making their own opinion.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      5.2
 * Author:            Jakir Riaaz
 * Author URI:        https://jakirriaaz.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       students-text-domain
 * Domain Path:       /languages
 */

 defined('ABSPATH') or die('directory path is desabled');

 //required files

 class STFB_Students{
    
    public function __construct(){
        if(file_exists(dirname(__FILE__) .'/metabox/init.php')){
            require_once(dirname(__FILE__) .'/metabox/init.php');
         }
         if(file_exists(dirname(__FILE__) .'/metabox/metabox-config.php')){
            require_once(dirname(__FILE__) .'/metabox/metabox-config.php');
         }
        
        add_action('init', array($this, 'stfb_students_feedback'));
        add_action('wp_enqueue_scripts', array($this, 'stfb_enqueue_files'));
    }

    public function stfb_enqueue_files(){
        wp_enqueue_style('slick', PLUGINS_URL('css/slick.css', __FILE__));
        wp_enqueue_style('custom-style', PLUGINS_URL('css/style.css', __FILE__));
        wp_enqueue_script('slick-js', PLUGINS_URL('js/slick.min.js', __FILE__), array('jquery'));
        wp_enqueue_script('custom-js', PLUGINS_URL('js/slick.custom.js', __FILE__), array('jquery'));
    }
    
    public function stfb_students_feedback() {
        $labels = array(
            'name'                  => _x( 'StudentsSay', 'Post type general name', 'students-text-domain' ),
            'singular_name'         => _x( 'StudentSay', 'Post type singular name', 'students-text-domain' ),
            'menu_name'             => _x( 'StudentSays', 'Admin Menu text', 'students-text-domain' ),
            'name_admin_bar'        => _x( 'StudentSay', 'Add New on Toolbar', 'students-text-domain' ),
            'add_new'               => __( 'Add New', 'students-text-domain' ),
            'add_new_item'          => __( 'Add New StudentSay', 'students-text-domain' ),
            'new_item'              => __( 'New StudentSay', 'students-text-domain' ),
            'edit_item'             => __( 'Edit StudentSay', 'students-text-domain' ),
            'view_item'             => __( 'View StudentSay', 'students-text-domain' ),
            'all_items'             => __( 'All StudentSays', 'students-text-domain' ),
            'search_items'          => __( 'Search StudentSays', 'students-text-domain' ),
            'parent_item_colon'     => __( 'Parent StudentSays:', 'students-text-domain' ),
            'not_found'             => __( 'No StudentSays found.', 'students-text-domain' ),
            'not_found_in_trash'    => __( 'No StudentSays found in Trash.', 'students-text-domain' ),
            'featured_image'        => _x( 'StudentSay Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'students-text-domain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'students-text-domain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'students-text-domain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'students-text-domain' ),
            'archives'              => _x( 'StudentSay archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'students-text-domain' ),
            'insert_into_item'      => _x( 'Insert into StudentSay', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'students-text-domain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this StudentSay', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'students-text-domain' ),
            'filter_items_list'     => _x( 'Filter StudentSays list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'students-text-domain' ),
            'items_list_navigation' => _x( 'StudentSays list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'students-text-domain' ),
            'items_list'            => _x( 'StudentSays list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'students-text-domain' ),
        );
     
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'studentsay' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-welcome-learn-more',
            'supports'           => array( 'title', 'thumbnail', ),
        );
     
        register_post_type( 'jr_student_feedback', $args );
    }

    public function stfb_student_feedback(){
        add_shortcode('stfb-students-feedback', array($this, 'stfb_student_feedback_info'));
    }

    public function stfb_student_feedback_info(){
        ob_start();

        $stfb_post_type         = new WP_Query(array(
            'post_type'         => 'jr_student_feedback',
            'posts_per_page'    => -1,
        )); ?>

        <div class="stfb-wrap-section">
            <?php while($stfb_post_type->have_posts()) : $stfb_post_type->the_post(); ?>
            <div class="student-feedback">
                <div class="top-sec">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <div class="last-sec">
                    <div class="student-comment">
                        <ul>
                            <li>Name: <span><?php echo esc_html(get_post_meta(get_the_id(), '_stfb_student_name', true)); ?></span></li>
                            <li>Class: <span><?php echo esc_html(get_post_meta(get_the_id(), '_stfb_student_class', true)); ?></span></li>
                            <li>Department: <span><?php echo esc_html(get_post_meta(get_the_id(), '_stfb_student_department', true)); ?></span></li>
                            <li>Feedback: <span><?php echo esc_html(get_post_meta(get_the_id(), '_stfb_student_feedback', true)); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endwhile; ?> 
        </div>

        <?php return ob_get_clean();
    }
 }

$studentsay = new STFB_Students();
$studentsay->stfb_student_feedback();