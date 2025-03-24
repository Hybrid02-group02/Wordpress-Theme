<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

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

			<!-- 현재 로그인한 사람이 구독자라면, 글 작성자의 사이드바를 출력 -->
			<?php if ( current_user_can( 'subscriber' ) ) : ?>
				<?php
					// 현재 포스트의 작성자 로그인 이름을 출력
					$author_login_name = get_the_author_meta( 'user_login', get_the_author_meta( 'ID' ) );
					echo return_user_sidebar($author_login_name);
					echo return_user_tags($author_login_name);
				?>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>
