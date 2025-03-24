<?php
return array(
    'title'       => 'pattern2',     // 패턴 이름(파일 이름과 비슷하거나 동일하게 추천)
    'description' => 'A preminum custom pattern2.', // 패턴 설명
    'categories'  => array('premium'), // 원하는 카테고리 추가
    'content'     =>                // 내용(html 형식 작성)
    '
    <!-- wp:heading -->
<h2 class="wp-block-heading"></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"></h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"></h3>
<!-- /wp:heading -->

<!-- wp:code {"align":"wide"} -->
<pre class="wp-block-code alignwide"><code></code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"></h3>
<!-- /wp:heading -->

<!-- wp:code {"align":"wide"} -->
<pre class="wp-block-code alignwide"><code></code></pre>
<!-- /wp:code -->

<!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph -->
    '
);