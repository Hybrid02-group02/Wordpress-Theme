<?php
/**
 * The header for the OnePress theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<?php do_action( 'onepress_before_site_start' ); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'onepress' ); ?></a>
	<?php
	/**
	 * @since 2.0.0
	 */
	onepress_header();
	?>

	<!-- 상세 프로필 편집 버튼 추가 -->
	<?php 
	// 'user-profile' 페이지의 URL을 가져옵니다.
	$user_profile_page = get_page_by_path( 'user-profile' );
	if ( $user_profile_page ) {
		$user_profile_url = get_permalink( $user_profile_page->ID );
		?>
		<div style="text-align: right; margin-right: 20px;">
			<a href="<?php echo esc_url( $user_profile_url ); ?>" class="button" style="padding: 10px 20px; background-color: #0073aa; color: white; text-decoration: none; border-radius: 5px;">
				상세 프로필 편집
			</a>
		</div>
		<?php
	}
	?>
