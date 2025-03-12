<?php
return array(
    'title'       => 'Sample1',
    'description' => 'A custom pattern with columns, code, and a quote.',
    'categories'  => array('test'), // 원하는 카테고리 추가
    'content'     => '
    <!-- wp:columns -->
    <div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:paragraph -->
        <p>This is some introductory text for the custom pattern.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:paragraph -->
        <p>Here is some more information that will appear in the second column.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:code -->
    <pre class="wp-block-code"><code>
    // Here is an example of code
    function helloWorld() {
        console.log("Hello, World!");
    }
    </code></pre>
    <!-- /wp:code -->

    <!-- wp:quote -->
    <blockquote class="wp-block-quote">
    <p>“The only way to do great work is to love what you do.”</p>
    <cite>– Steve Jobs</cite>
    </blockquote>
    <!-- /wp:quote -->
    '
);