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

<?php echo return_user_sidebar($current_user->user_login); ?>

<aside id="thrid" class="widget-area sidebar" role="complementary">
    <button class="custom-category-button" id="profileEditButton">
        상세 프로필 편집
    </button>
</aside>

<aside id="forth" class="widget-area sidebar" role="complementary" style="margin-top: 20px; display: none;" >
    <div id="user_profile_edit_form">
        <?php get_template_part( 'template-parts/content', 'profile-edit' ); ?>
    </div>
</aside>

<script>
    // profileEditButton 클릭 시 forth 부분을 토글
    document.getElementById('profileEditButton').addEventListener('click', function() {
        var forthSection = document.getElementById('forth');
        if (forthSection.style.display === 'none' || forthSection.style.display === '') {
            forthSection.style.display = 'block';
        } else {
            forthSection.style.display = 'none';
        }
    });
</script>


