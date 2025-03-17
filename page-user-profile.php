<?php
/*
Template Name: 상세 프로필 편집
*/
?>

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

// 현재 로그인된 사용자 정보 가져오기
$current_user = wp_get_current_user();

$layout = onepress_get_layout();

/**
 * @since 2.0.0
 * @see onepress_display_page_title
 * 현재 로그인한 사용자의 사진, 깃허브 주소, 이메일 주소 등을 받음
 */
do_action( 'onepress_page_before_content' );

?>
	<div id="content" class="site-content">
        <?php onepress_breadcrumb(); ?>
		<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

                    <h1>사용자 프로필 수정</h1>

						<form method="POST" enctype="multipart/form-data">
							<p>
								<label for="user_avatar">프로필 사진:</label><br>
								<input type="file" name="user_avatar" id="user_avatar">
							</p>
							<p>
								<label for="github_url">GitHub 주소:</label><br>
								<input type="url" name="github_url" id="github_url" value="<?php echo esc_attr( get_user_meta( $current_user->ID, 'github_url', true ) ); ?>" required>
							</p>
							<p>
								<label for="user_email">이메일:</label><br>
								<input type="email" name="user_email" id="user_email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required>
							</p>
							<p>
								<input type="submit" name="submit_profile" value="프로필 저장">
							</p>
						</form>

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

            <?php if ( $layout != 'no-sidebar' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>

		</div>
	</div>

<?php get_footer(); ?>
