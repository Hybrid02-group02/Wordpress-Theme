<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

get_header();

$layout = onepress_get_layout();

// 아카이브 제목을 변수로 저장
$archive_title = get_the_archive_title();

// 정규 표현식을 사용하여 [ ], <span> </span> 태그 안의 내용만 추출
preg_match( '/\[(.*?):\]\s*<span>(.*?)<\/span>/', $archive_title, $matches );

// 추출된 내용이 있으면 출력
$archive_subject = !empty( $matches[1] ) ? $matches[1] : '';  // [ ] 내용
$archive_author = !empty( $matches[2] ) ? $matches[2] : '';    // <span> </span> 내용
?>

	<div id="content" class="site-content">

		<div class="page-header">
			<div class="container">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</div>
		</div>

		<?php onepress_breadcrumb(); ?>

		<div id="content-inside" class="container <?php echo esc_attr( $layout ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'list' );
						?>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main>
			</div>

			<!-- 사이드바를 표시할지 여부를 체크 -->
			<?php if ( current_user_can( 'administrator' ) || current_user_can( 'author' )) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<?php
				// 로그인한 사용자가 구독자 권한을 가지고 있고, archive_subject 값이 "글쓴이" 또는 "Author"인 경우, 사이드바 출력
				if ( current_user_can( 'subscriber' ) && in_array( $archive_subject, ['글쓴이', 'Author'] ) ) :
					echo return_user_sidebar( $archive_author ); // $archive_author 값에 해당하는 사용자의 사이드바 출력
				endif;
			?>

		</div>
	</div>

<?php get_footer(); ?>
