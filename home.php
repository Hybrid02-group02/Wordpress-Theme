<?php
/**
 * The front page template file.
 *
 * The front-page.php template file is used to render your site’s front page,
 * whether the front page displays the blog posts index (mentioned above) or a static page.
 * The front page template takes precedence over the blog posts index (home.php) template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package OnePress
 */

get_header();

$layout = onepress_get_layout();	// "right-sidebar"

    /**
     * @since 2.0.0
     * @see onepress_display_page_title
     */
    do_action( 'onepress_page_before_content' );


	// 페이지 헤더에 현재 로그인한 사용자 이름을 표시
	$current_user = wp_get_current_user();

	// 사용자 이름과 권한에 따른 블로그 제목 설정
	$blog_title = '';
	if ( in_array( 'author', (array) $current_user->roles ) ) {
		$blog_title = esc_js( $current_user->nickname ) . ' 님의 기술 블로그';
	} else {
		$blog_title = esc_js( $current_user->nickname ) . '님 환영합니다';
	}
	?>

	<!-- 페이지 헤더에 사용자 이름 표시 -->
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			if (document.body.classList.contains('home')) {
				const pageHeader = document.querySelector('.page-header .entry-title');

				if (pageHeader) {
					const blogTitle = '<?php echo $blog_title; ?>';
					pageHeader.innerHTML = blogTitle;
				}
			}
		});
	</script>
	<!-- 헤더에 이름 표시 끝 -->


	<div id="content" class="site-content">
        <?php onepress_breadcrumb(); ?>

        <div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">

				<!-- 카테고리 목록 출력 추가 -->
				<div class="category-list" style="margin-bottom: 20px;">
					<?php display_user_categories( get_current_user_id() ); ?>
				</div>
				<!-- 카테고리 목록 출력 끝 -->

				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main>
			</div>

			<!-- 사이드바를 표시할지 여부를 체크 -->
			<?php if ( current_user_can( 'administrator' ) || current_user_can( 'author' ) ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>
