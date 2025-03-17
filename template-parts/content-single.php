<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package OnePress
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<!-- 추가된 내용: 삭제 버튼 추가 -->
		<?php
		// 현재 사용자가 글 작성자이거나 관리자 권한이 있을 때만 삭제 버튼 표시
		if ( get_current_user_id() === get_the_author_meta('ID') || current_user_can('administrator') ) : ?>
			<a href="<?php echo esc_url( get_delete_post_link( get_the_ID(), '', true ) . '&redirect_to=' . urlencode( home_url() ) ); ?>"
			onclick="return confirm('정말로 삭제하시겠습니까?');"
			style="background-color: #e74c3c; color: white; padding: 2px 8px; border: none; cursor: pointer; font-size: 14px; border-radius: 5px; float:right">
				삭제
			</a>
		<?php endif; ?>
		<!-- 삭제 버튼 추가 끝 -->
		
        <?php if ( get_theme_mod( 'single_meta', 1 ) ) { ?>
		<div class="entry-meta">
			<?php onepress_posted_on(); ?>
		</div>
        <?php } ?>
	</header>

    <?php if ( get_theme_mod( 'single_thumbnail', 0 ) && has_post_thumbnail() ) { ?>
        <div class="entry-thumbnail">
            <?php
            $layout = onepress_get_layout();
            $size = 'large';
            the_post_thumbnail( $size );
            ?>
        </div>
    <?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onepress' ),
				'after'  => '</div>',
			) );
		?>
	</div>
    <?php if ( get_theme_mod( 'single_meta', 1 ) ) { ?>

    <?php onepress_entry_footer(); ?>

    <?php } ?>
</article>

