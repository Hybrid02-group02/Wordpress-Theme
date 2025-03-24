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

<div class="sidebar-wrapper">
    <?php echo return_user_sidebar($current_user->user_login); ?>

    <?php echo return_user_tags(); ?>
</div>




