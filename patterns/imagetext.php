<?php
return array(
    'title'       => 'imagetext',     // 패턴 이름(파일 이름과 비슷하거나 동일하게 추천)
    'description' => 'A custom pattern with 3 image and text.', // 패턴 설명
    'categories'  => array('basic'), // 원하는 카테고리 추가
    'content'     =>                // 내용(html 형식 작성)
    '
    <!-- wp:media-text -->
<div class="wp-block-media-text is-stacked-on-mobile"><figure class="wp-block-media-text__media"></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"콘텐츠…"} -->
<p></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->

<!-- wp:media-text -->
<div class="wp-block-media-text is-stacked-on-mobile"><figure class="wp-block-media-text__media"></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"콘텐츠…"} -->
<p></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->

<!-- wp:media-text -->
<div class="wp-block-media-text is-stacked-on-mobile"><figure class="wp-block-media-text__media"></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"placeholder":"콘텐츠…"} -->
<p></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text -->
    '
);
