<?php
/*
Template Name: 상세 프로필 편집
*/
?>

<?php
/**
 * The template for displaying all pages.
 */

get_header();

$current_user = wp_get_current_user();

// 업데이트 메시지를 띄우기 위한 플래그 변수
$profile_updated = false;

// 폼 제출 시 데이터 처리
if (isset($_POST['submit_profile'])) {

    // 이메일 업데이트
    if (array_key_exists('user_email', $_POST)) {
        $user_email = sanitize_email(trim($_POST['user_email']));
        if (!empty($user_email)) {
            if ($user_email !== $current_user->user_email) {
                $result = wp_update_user(array(
                    'ID' => $current_user->ID,
                    'user_email' => $user_email,
                ));

                // 이메일이 변경되었으면 플래그를 true로
                if (!is_wp_error($result)) {
                    $profile_updated = true;
                }
            }
        } else {
            // 빈 값이 입력되면 기존 값 삭제
            update_user_meta($current_user->ID, 'user_email', '');
        }
    }

    // GitHub URL 업데이트
    if (array_key_exists('user_github_url', $_POST)) {
        $github_url = esc_url_raw(trim($_POST['user_github_url']));
        $current_github_url = get_user_meta($current_user->ID, 'github_url', true);
        if ($github_url !== $current_github_url) {
            if (!empty($github_url)) {
                update_user_meta($current_user->ID, 'github_url', $github_url);
            } else {
                delete_user_meta($current_user->ID, 'github_url');
            }
            // GitHub URL이 변경되었으면 플래그를 true로
            $profile_updated = true;
        }
    }

    // Notion URL 업데이트
    if (array_key_exists('user_notion_url', $_POST)) {
        $notion_url = esc_url_raw(trim($_POST['user_notion_url']));
        $current_notion_url = get_user_meta($current_user->ID, 'user_notion_url', true);
        if ($notion_url !== $current_notion_url) {
            if (!empty($notion_url)) {
                update_user_meta($current_user->ID, 'user_notion_url', $notion_url);
            } else {
                delete_user_meta($current_user->ID, 'user_notion_url');
            }
            // Notion URL이 변경되었으면 플래그를 true로
            $profile_updated = true;
        }
    }

    // 프로필 사진 업로드 처리 (파일이 선택된 경우에만 처리)
    if (!empty($_FILES['user_avatar']['name'])) {
        $avatar = $_FILES['user_avatar'];
        $upload = wp_handle_upload($avatar, array('test_form' => false));

        // 업로드 성공 시 URL 저장
        if (isset($upload['url'])) {
            $avatar_url = $upload['url'];
            $current_avatar_url = get_user_meta($current_user->ID, 'user_avatar', true);
            if ($avatar_url !== $current_avatar_url) {
                update_user_meta($current_user->ID, 'user_avatar', $avatar_url);
                // 프로필 사진이 변경되었으면 플래그를 true로
                $profile_updated = true;
            }
        }
    }

    // 성과 이름 업데이트
    if (array_key_exists('user_firstname', $_POST) && array_key_exists('user_lastname', $_POST)) {
        $first_name = sanitize_text_field(trim($_POST['user_firstname']));
        $last_name = sanitize_text_field(trim($_POST['user_lastname']));
        if ($first_name !== $current_user->user_firstname || $last_name !== $current_user->user_lastname) {
            wp_update_user(array(
                'ID' => $current_user->ID,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ));
            $profile_updated = true;
        }
    }

    // 블로그 URL 업데이트
    if (array_key_exists('user_blog_url', $_POST)) {
        $blog_url = esc_url_raw(trim($_POST['user_blog_url']));
        $current_blog_url = get_user_meta($current_user->ID, 'user_blog_url', true);
        if ($blog_url !== $current_blog_url) {
            if (!empty($blog_url)) {
                update_user_meta($current_user->ID, 'user_blog_url', $blog_url);
            } else {
                delete_user_meta($current_user->ID, 'user_blog_url');
            }
            // 블로그 URL이 변경되었으면 플래그를 true로
            $profile_updated = true;
        }
    }

    // 별칭 업데이트
    if (array_key_exists('user_nickname', $_POST)) {
        $nickname = sanitize_text_field(trim($_POST['user_nickname']));
        if ($nickname !== $current_user->nickname) {
            wp_update_user(array(
                'ID' => $current_user->ID,
                'nickname' => $nickname,
            ));
            $profile_updated = true;
        }
    }

}

$layout = onepress_get_layout();

do_action('onepress_page_before_content');

?>

<div id="content" class="site-content">
    <?php onepress_breadcrumb(); ?>
    <div id="content-inside" class="container <?php echo esc_attr($layout); ?>">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php while (have_posts()) : the_post(); ?>

                    <style>
                        input { width: 300px; }
                        p { margin-bottom: 25px; }
                    </style>

                    <!-- 알림창 띄우기 -->
                    <?php if ($profile_updated) : ?>
                        <script type="text/javascript">
                            alert('프로필이 업데이트 되었습니다!');
                        </script>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data">
                        <p>
                            <label for="user_avatar">프로필 사진:</label><br>
                            <input type="file" name="user_avatar" id="user_avatar">
                        </p>
						<p>
                            <label for="user_lastname">성:</label><br>
                            <input type="text" name="user_lastname" id="user_lastname" value="<?php echo esc_attr($updated_lastname ?? $current_user->user_lastname); ?>">
                        </p>
                        <p>
                            <label for="user_firstname">이름:</label><br>
                            <input type="text" name="user_firstname" id="user_firstname" value="<?php echo esc_attr($updated_firstname ?? $current_user->user_firstname); ?>">
                        </p>
						<p>
                            <label for="user_nickname">별칭:</label><br>
                            <input type="text" name="user_nickname" id="user_nickname" value="<?php echo esc_attr($updated_nickname ?? $current_user->nickname); ?>">
                        </p>
                        <p>
                            <label for="user_email">이메일:</label><br>
                            <input type="email" name="user_email" id="user_email" value="<?php echo esc_attr($updated_email ?? $current_user->user_email); ?>">
                        </p>
                        <p>
                            <label for="github_url">GitHub 주소:</label><br>
                            <input type="url" name="user_github_url" id="user_github_url" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'github_url', true)); ?>">
                        </p>
                        <p>
                            <label for="user_notion_url">Notion 주소:</label><br>
                            <input type="url" name="user_notion_url" id="user_notion_url" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'user_notion_url', true)); ?>">
                        </p>
						<p>
                            <label for="user_blog_url">블로그 URL:</label><br>
                            <input type="url" name="user_blog_url" id="user_blog_url" value="<?php echo esc_attr($updated_blog_url ?? get_user_meta($current_user->ID, 'user_blog_url', true)); ?>">
                        </p>
                        <p>
                            <input type="submit" name="submit_profile" value="프로필 저장" class="custom-category-button">
                        </p>
                    </form>
                <?php endwhile; ?>
            </main>
        </div>

        <?php if ($layout != 'no-sidebar') { ?>
            <?php get_sidebar(); ?>
        <?php } ?>

    </div>
</div>

<?php get_footer(); ?>
