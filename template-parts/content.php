<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

$show_thumbnail = true;
if (get_theme_mod('onepress_hide_thumnail_if_not_exists', false)) {
	if (!has_post_thumbnail()) {
		$show_thumbnail = false;
	}
}


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('list-article', 'clearfix')); ?>>
	<?php if ($show_thumbnail) { ?>
		<div class="list-article-thumb">
			<a href="<?php echo esc_url(get_permalink()); ?>">
				<?php
				// 특성 이미지(글 등록시 오른쪽 사이드 바에서 등록)가 있으면 그 이미지를 썸네일로 사용
				if (has_post_thumbnail()) {
					the_post_thumbnail('onepress-blog-small');
				} else {
                    // 특성 이미지가 없으면 본문에서 첫 번째 이미지 추출
                    $content = apply_filters( 'the_content', get_post_field( 'post_content', get_the_ID() ) );
                    $first_image = get_first_image_from_content( $content );

                    if ( $first_image ) {
                        // 첫 번째 이미지를 썸네일로 사용
                        echo '<img alt="" src="' . esc_url( $first_image ) . '" style="width: 300px; height: 150px;">';
                    } else {
                        // 첫 번째 이미지도 없으면 기본 이미지 사용
                        echo '<img alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/thumbnail_image.png' ) . '">';
                    }
                }
				?>
			</a>
		</div>
	<?php } ?>

	<div class="list-article-content">
		<?php
		/**
		 * Hook before article content
		 *
		 * @since 2.3.4
		 */
		do_action('onepress_loop_content_before');

		?>
		<div class="list-article-meta">
			<?php the_category(' / '); ?>
		</div>
		<header class="entry-header">
			<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
		</header>
		<div class="entry-excerpt">
			<?php
			the_excerpt();
			?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'onepress'),
					'after'  => '</div>',
				)
			);
			?>
		</div>
		<?php

		/**
		 * Hook after article content
		 *
		 * @since 2.3.4
		 */
		do_action('onepress_loop_content_after');

		?>
	</div>

</article>