<?php
return array(
    'title'       => 'code',     // 패턴 이름(파일 이름과 비슷하거나 동일하게 추천)
    'description' => 'A custom pattern with title and code.', // 패턴 설명
    'categories'  => array('test'), // 원하는 카테고리 추가
    'content'     =>                // 내용(html 형식 작성)
    '
    <!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"></h4>
<!-- /wp:heading -->

<!-- wp:code -->
<pre class="wp-block-code"><code></code></pre>
<!-- /wp:code -->
    '
);