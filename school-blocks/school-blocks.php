<?php
/**
 * Plugin Name:       School Blocks
 * Description:       Custom blocks for the School site.
 * Version:           0.1.0
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       school-blocks
 *
 * @package SchoolBlocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
 * based on the registered block metadata. Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function school_blocks_school_blocks_block_init() {
	wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
}
add_action( 'init', 'school_blocks_school_blocks_block_init' );


// Wrapper function for all PHP-only blocks
function school_blocks_register_php_blocks() {
    // Register our first PHP-only block, similar to block.json.
    // First parameter: Name the block.
    // Second parameter: Define array of arguments.
    register_block_type(
        'school-blocks/staff-posts',
        array(
            'title'           => "Display Staffs",
            'icon'            =>"businessman",
            'category'        =>"text",
            'description'     => "Outputs all the staffs by department.",
            'keywords'        => "service",
            'render_callback' => 'school_render_staff_posts',
            'supports'        => array(
                'autoRegister' => true,
                'spacing' => array(
                    'margin' => true
                )
            ),
            'attributes' => array(
                'sorting' => array(
                    'type' => 'string',
                    'enum' => array('ASC', 'DESC'),
                    'default' => 'ASC',
                    'label' => 'Sort A-Z or Z-A'
                )
            )
        )
    );
}
// Hook into 'init' to run this code.
add_action( 'init', 'school_blocks_register_php_blocks' );

function school_render_staff_posts( $attributes ) {
    ob_start();
    ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <?php
		$taxonomy = 'fwd-staff-department';
		$terms = get_terms( 
			array(
				'taxonomy' => $taxonomy,
			) 
		);
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				echo '<h2>' .esc_html($term->name). '</h2>';
				$args = array(
					'post_type' => 'fwd-staff',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => $term->slug
						)
					)
				);
				$query = new WP_Query( $args );
				if ( $query -> have_posts() ) {
					echo "<div class='staff-container'>";
					while( $query -> have_posts() ) {
						$query -> the_post();
		?>
					<article id = "<?php echo esc_attr(get_the_ID()); ?>">
					<?php
							echo get_the_post_thumbnail();
							echo '<h3>' .esc_html(get_the_title()). '</h3>';
							echo esc_html(the_content());
						echo '</article>';
				
					}
					echo '</div>';
					wp_reset_postdata(); 
				}
			}
		}
        
        ?>
    </div>
    <?php
    return ob_get_clean();
}

?>