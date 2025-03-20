<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

get_header();

$layout = onepress_get_layout();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 */
do_action( 'onepress_page_before_content' );

?>
	<div id="content" class="site-content">
        <?php onepress_breadcrumb(); ?>
		<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'page' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // End of the loop. ?>

				</main>
			</div>

			<!-- 사이드바를 표시할지 여부를 체크 -->
			<?php if ( current_user_can( 'administrator' ) || current_user_can( 'author' ) ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<?php if ( current_user_can( 'subscriber' ) ) : ?>
				<?php
					// 글의 작성자 ID와 로그인 네임 가져오기
					$author_id = get_post_field('post_author');
					$author_login_name = get_the_author_meta('user_login', $author_id);
					echo return_user_sidebar($author_login_name);
				?>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>
