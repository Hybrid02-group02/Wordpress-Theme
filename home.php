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
		$blog_title = esc_js( $current_user->display_name ) . ' 님의 기술 블로그';
	} else {
		$blog_title = esc_js( $current_user->display_name ) . '님 환영합니다';
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
					<h3> Categories </h3>
					<?php
					$current_user_id = get_current_user_id();

					// 사용자가 작성한 게시물 목록을 가져옴
					$user_posts = get_posts( array(
						'author' => $current_user_id,
						'posts_per_page' => -1,
						'post_status' => 'publish', // 발행된 게시물만
					) );

					// 게시물에서 사용된 카테고리 목록을 저장할 배열
					$user_categories = array();

					// 각 게시물에서 카테고리 추출
					foreach ( $user_posts as $post ) {
						$categories = get_the_category( $post->ID );
						foreach ( $categories as $category ) {
							// 중복을 방지하기 위해 배열에 카테고리 객체를 추가
							if ( ! in_array( $category, $user_categories ) ) {
								$user_categories[] = $category;
							}
						}
					}

					// 카테고리 목록 출력
					if ( ! empty( $user_categories ) ) {
						foreach ( $user_categories as $category ) {
							// 카테고리 링크를 버튼처럼 스타일링
							echo '<a href="' . get_category_link( $category->term_id ) . '" class="custom-category-button">' . $category->name . '</a> ';
						}
					} else {
						echo '작성된 카테고리가 없습니다.';
					}
					?>
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



			<?php get_sidebar(); ?>


            <?php if ( $layout != 'no-sidebar' ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>

		</div>
	</div>

<?php get_footer(); ?>
