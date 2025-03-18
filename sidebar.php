<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OnePress
 */
$current_user = wp_get_current_user();
?>

<aside id="secondary" class="widget-area sidebar" role="complementary">
	<?php
    $nickname = !empty($current_user->nickname) ? $current_user->nickname : '';
    ?>
    <h3><?php echo esc_html($nickname); ?>'s Profile</h3>

    <?php
    // 사용자 프로필 사진
    $user_avatar_url = get_user_meta($current_user->ID, 'user_avatar', true);
    $avatar_url = !empty($user_avatar_url) ? $user_avatar_url : get_template_directory_uri() . '/assets/images/custom_user_avatar.jpg';
    ?>
    <img src="<?php echo esc_url($avatar_url); ?>" alt="사용자 아바타" class="custom-avatar-square" style="margin-bottom: 15px;">

    <?php
    // 사용자 성과 이름 표시
    $first_name = !empty($current_user->user_firstname) ? $current_user->user_firstname : '';
    $last_name = !empty($current_user->user_lastname) ? $current_user->user_lastname : '';
    $full_name = $last_name . ' ' . $first_name;
    ?>
    <h5><?php echo esc_html($full_name); ?></h5>

    <ul>
        <?php
        // 사용자 이메일 표시 (사용자 이메일이 있다면)
        if (!empty($current_user->user_email)) {
            echo '<li>Email: ' . esc_html($current_user->user_email) . '</li>';
        }

        // GitHub URL 표시 (GitHub URL이 설정되어 있다면)
        $github_url = get_user_meta($current_user->ID, 'github_url', true);
        if (!empty($github_url)) {
            echo '<li>GitHub: <a href="' . esc_url($github_url) . '" target="_blank">' . esc_html($github_url) . '</a></li>';
        }

        // Notion URL 표시 (Notion URL이 설정되어 있다면)
        $notion_url = get_user_meta($current_user->ID, 'user_notion_url', true);
        if (!empty($notion_url)) {
            echo '<li>Notion: <a href="' . esc_url($notion_url) . '" target="_blank">' . esc_html($notion_url) . '</a></li>';
        }

		// 블로그 URL 표시 (블로그 URL이 설정되어 있다면)
		$blog_url = get_user_meta($current_user->ID, 'user_blog_url', true);
		if (!empty($blog_url)) {
			echo '<li>Blog: <a href="' . esc_url($blog_url) . '" target="_blank">' . esc_html($blog_url) . '</a></li>';
		}
        ?>
    </ul>
</aside>
