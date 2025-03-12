<?php
return array(
    'title'       => 'Sample1',
    'description' => 'A custom pattern with columns, code, and a quote.',
    'categories'  => array('test'), // 원하는 카테고리 추가
    'content'     => 
    '
    <!-- wp:heading -->
    <h2 class="wp-block-heading"></h2>
    <!-- /wp:heading -->

    <!-- wp:spacer -->
    <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:code -->
    <pre class="wp-block-code"><code>function helloWorld() {
        console.log("Hello, World!");
        }</code></pre>
    <!-- /wp:code -->
    '
);