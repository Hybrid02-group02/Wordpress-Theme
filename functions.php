<?php

/**
 * OnePress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OnePress
 */



define('ONEPRESS_THEME_PATH', dirname(__FILE__));

function onepress_allowed_tags()
{
	$allowed_tags = array(
		'div' => array(),
		'span' => array(),
		'p' => array(),
		'b' => array(),
		'i' => array(),
		'em' => array(),
		'a' => array(
			'href'  => true,
			'title' => true,
			'class' => true,
		),
	);
	return $allowed_tags;
}


if (!function_exists('onepress_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function onepress_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on OnePress, use a find and replace
		 * to change 'onepress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('onepress', get_template_directory() . '/languages');

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Excerpt for page
		 */
		add_post_type_support('page', 'excerpt');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		add_image_size('onepress-blog-small', 300, 150, true);
		add_image_size('onepress-small', 480, 300, true);
		add_image_size('onepress-medium', 640, 400, true);

		/*
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__('Primary Menu', 'onepress'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * WooCommerce support.
		 */
		add_theme_support('woocommerce');

		/**
		 * Add theme Support custom logo
		 *
		 * @since WP 4.5
		 * @sin 1.2.1
		 */

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 36,
				'width'       => 160,
				'flex-height' => true,
				'flex-width'  => true,
				// 'header-text' => array( 'site-title',  'site-description' ), //
			)
		);

		$recommend_plugins =  array(
			'wpforms-lite'             => array(
				'name'            => esc_html__('Contact Form by WPForms', 'onepress'),
				'active_filename' => 'wpforms-lite/wpforms.php',
			),
			'famethemes-demo-importer' => array(
				'name'            => esc_html__('Famethemes Demo Importer', 'onepress'),
				'active_filename' => 'famethemes-demo-importer/famethemes-demo-importer.php',
			),
		);


		// Check if WooCommerce activated.
		if (function_exists('WC')) {

			if (!defined('PMCS_URL')) {
				$recommend_plugins['currency-switcher-for-woocommerce'] = array(
					'name'            => esc_html__('Currency Switcher for WooCommerce', 'onepress'),
					'active_filename' => 'currency-switcher-for-woocommerce/pmcs.php',
				);
			}

			if (!defined('PBE_URL')) {
				$recommend_plugins['bulk-edit-for-woocommerce'] = array(
					'name'            => esc_html__('Bulk Edit for WooCommerce', 'onepress'),
					'active_filename' => 'bulk-edit-for-woocommerce/bulk-edit.php',
				);
			}
		}

		// Recommend plugins.
		add_theme_support(
			'recommend-plugins',
			$recommend_plugins
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for WooCommerce.
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		/**
		 * Add support for Gutenberg.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
		 */
		add_theme_support('editor-styles');
		add_theme_support('align-wide');

		add_theme_support('wp-block-styles');

		/*
		 * This theme styles the visual editor to resemble the theme style.
		 */
		add_editor_style(array('editor-style.css', onepress_fonts_url()));

		if (get_theme_mod('onepress_gallery_disable')) {
			/**
			 * Dequeue Google Fonts loaded by Elementor.
			 * @since  2.3.1
			 */
			add_filter('elementor/frontend/print_google_fonts', '__return_false');
		}
	}
endif;
add_action('after_setup_theme', 'onepress_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function onepress_content_width()
{
	/**
	 * Support dynamic content width
	 *
	 * @since 2.1.1
	 */
	$width = absint(get_theme_mod('single_layout_content_width'));
	if ($width <= 0) {
		$width = 800;
	}
	$GLOBALS['content_width'] = apply_filters('onepress_content_width', $width);
}
add_action('after_setup_theme', 'onepress_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function onepress_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'onepress'),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	if (class_exists('WooCommerce')) {
		register_sidebar(
			array(
				'name'          => esc_html__('WooCommerce Sidebar', 'onepress'),
				'id'            => 'sidebar-shop',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
	for ($i = 1; $i <= 4; $i++) {
		register_sidebar(
			array(
				'name'          => esc_html(sprintf(
					 /* translators: 1: widget number */
					__('Footer %s', 'onepress'), $i
				)),
				'id'            => 'footer-' . $i,
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action('widgets_init', 'onepress_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function onepress_scripts()
{

	$theme   = wp_get_theme('onepress');
	$version = $theme->get('Version');
	$min_ext  = defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';

	if (!get_theme_mod('onepress_disable_g_font')) {
		$google_font_url = onepress_fonts_url();
		if ($google_font_url) {
			wp_enqueue_style('onepress-fonts', onepress_fonts_url(), array(), $version);
		}
	}

	wp_enqueue_style('onepress-animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), $version);
	wp_enqueue_style('onepress-fa', get_template_directory_uri() . '/assets/fontawesome-v6/css/all.min.css', array(), '6.5.1');
	wp_enqueue_style('onepress-fa-shims', get_template_directory_uri() . '/assets/fontawesome-v6/css/v4-shims.min.css', array(), '6.5.1');
	wp_enqueue_style('onepress-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, $version);
	wp_enqueue_style('onepress-style', get_template_directory_uri() . '/style.css');

	$custom_css = onepress_custom_inline_style();
	wp_add_inline_style('onepress-style', $custom_css);

	$deps = array('jquery');

	// Animation from settings.
	$onepress_js_settings = array(
		'onepress_disable_animation'     => get_theme_mod('onepress_animation_disable'),
		'onepress_disable_sticky_header' => get_theme_mod('onepress_sticky_header_disable'),
		'onepress_vertical_align_menu'   => get_theme_mod('onepress_vertical_align_menu'),
		'hero_animation'                 => get_theme_mod('onepress_hero_option_animation', 'flipInX'),
		'hero_speed'                     => intval(get_theme_mod('onepress_hero_option_speed', 5000)),
		'hero_fade'                      => intval(get_theme_mod('onepress_hero_slider_fade', 750)),
		'submenu_width'                  => intval(get_theme_mod('onepress_submenu_width', 0)),
		'hero_duration'                  => intval(get_theme_mod('onepress_hero_slider_duration', 5000)),
		'hero_disable_preload'           => get_theme_mod('onepress_hero_disable_preload', false) ? true : false,
		'disabled_google_font'           => get_theme_mod('onepress_disable_g_font', false) ? true : false,
		'is_home'                        => '',
		'gallery_enable'                 => '',
		'is_rtl'                         => is_rtl(),
	);

	// Load gallery scripts.
	$galley_disable = get_theme_mod('onepress_gallery_disable') == 1 ? true : false;
	$is_shop        = false;
	if (function_exists('is_woocommerce')) {
		if (is_woocommerce()) {
			$is_shop = true;
		}
	}

	// Don't load scripts for woocommerce because it don't need.
	if (!$is_shop) {
		if (!$galley_disable || is_customize_preview()) {
			$onepress_js_settings['gallery_enable'] = 1;
			$display                                = get_theme_mod('onepress_gallery_display', 'grid');
			if (!is_customize_preview()) {
				switch ($display) {
					case 'masonry':
						$deps[] = 'onepress-gallery-masonry';
						wp_register_script('onepress-gallery-masonry', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), $version, true);
						break;
					case 'justified':
						$deps[] = 'onepress-gallery-justified';
						wp_register_script('onepress-gallery-justified', get_template_directory_uri() . '/assets/js/jquery.justifiedGallery.min.js', array(), $version, true);
						break;
					case 'slider':
					case 'carousel':
						$deps[] = 'onepress-gallery-carousel';
						wp_register_script('onepress-gallery-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), $version, true);
						break;
					default:
						break;
				}
			} else {
				$deps[] = 'onepress-gallery-masonry';
				$deps[] = 'onepress-gallery-justified';
				$deps[] = 'onepress-gallery-carousel';

				wp_register_script('onepress-gallery-masonry', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), $version, true);
				wp_register_script('onepress-gallery-justified', get_template_directory_uri() . '/assets/js/jquery.justifiedGallery.min.js', array(), $version, true);
				wp_register_script('onepress-gallery-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), $version, true);
			}
		}
		wp_enqueue_style('onepress-gallery-lightgallery', get_template_directory_uri() . '/assets/css/lightgallery.css');
	}

	wp_enqueue_script('onepress-theme', get_template_directory_uri() . '/assets/js/theme-all' . $min_ext . '.js', $deps, $version, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (is_front_page() && is_page_template('template-frontpage.php')) {
		if (get_theme_mod('onepress_header_scroll_logo')) {
			$onepress_js_settings['is_home'] = 1;
		}
	}

	$onepress_js_settings['parallax_speed'] = 0.5;
	$onepress_js_settings =  apply_filters('onepress_js_settings', $onepress_js_settings);
	wp_localize_script('onepress-theme', 'onepress_js_settings', $onepress_js_settings);
}
add_action('wp_enqueue_scripts', 'onepress_scripts');


if (!function_exists('onepress_block_all_js_google_fonts')) {
	/**
	 * Disable all google added by js.
	 * 
	 * @since 2.3.1
	 *
	 * @return void
	 */
	function onepress_block_all_js_google_fonts()
	{

		if (!get_theme_mod('onepress_disable_g_font')) {
			return;
		}
?>
		<script>
			var head = document.getElementsByTagName('head')[0];
			// Save the original method
			var insertBefore = head.insertBefore;
			// Replace it!
			head.insertBefore = function(newElement, referenceElement) {
				if (newElement.href && newElement.href.indexOf('https://fonts.googleapis.com/css?family=') === 0) {
					return;
				}
				if (newElement.href && newElement.href.indexOf('https://fonts.gstatic.com/') === 0) {
					return;
				}
				insertBefore.call(head, newElement, referenceElement);
			};
		</script>
<?php
	}
}
add_action('wp_head', 'onepress_block_all_js_google_fonts', 2);




if (!function_exists('onepress_fonts_url')) :
	/**
	 * Register default Google fonts
	 */
	function onepress_fonts_url()
	{
		$fonts_url = '';

		/*
		* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x('on', 'Open Sans font: on or off', 'onepress');

		/*
		* Translators: If there are characters in your language that are not
		* supported by Raleway, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$raleway = _x('on', 'Raleway font: on or off', 'onepress');

		if ('off' !== $raleway || 'off' !== $open_sans) {
			$font_families = array();

			if ('off' !== $raleway) {
				$font_families[] = 'Raleway:400,500,600,700,300,100,800,900';
			}

			if ('off' !== $open_sans) {
				$font_families[] = 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic';
			}

			$query_args = array(
				'family' => urlencode(implode('|', $font_families)),
				'subset' => urlencode('latin,latin-ext'),
				'display' => 'swap'
			);

			$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
		}

		return esc_url_raw($fonts_url);
	}
endif;



/**
 * Glabel OnePress loop properties
 *
 * @since 2.1.0
 */
global $onepress_loop_props;
$onepress_loop_props = array();

/**
 * Set onepress loop property.
 *
 * @since 2.1.0
 *
 * @param string $prop
 * @param string $value
 */
function onepress_loop_set_prop($prop, $value)
{
	global $onepress_loop_props;
	$onepress_loop_props[$prop] = $value;
}


/**
 * Get onepress loop property
 *
 * @since 2.1.0
 *
 * @param $prop
 * @param bool $default
 *
 * @return bool|mixed
 */
function onepress_loop_get_prop($prop, $default = false)
{
	global $onepress_loop_props;
	if (isset($onepress_loop_props[$prop])) {
		return apply_filters('onepress_loop_get_prop', $onepress_loop_props[$prop], $prop);
	}

	return apply_filters('onepress_loop_get_prop', $default, $prop);
}

/**
 * Remove onepress loop property
 *
 * @since 2.1.0
 *
 * @param $prop
 */
function onepress_loop_remove_prop($prop)
{
	global $onepress_loop_props;
	if (isset($onepress_loop_props[$prop])) {
		unset($onepress_loop_props[$prop]);
	}
}

/**
 * Trim the excerpt with custom length
 *
 * @since 2.1.0
 *
 * @see wp_trim_excerpt
 * @param $text
 * @param null $excerpt_length
 * @return string
 */
function onepress_trim_excerpt($text, $excerpt_length = null)
{
	$text = strip_shortcodes($text);
	/** This filter is documented in wp-includes/post-template.php */
	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);

	if (!$excerpt_length) {
		/**
		 * Filters the number of words in an excerpt.
		 *
		 * @since 2.7.0
		 *
		 * @param int $number The number of words. Default 55.
		 */
		$excerpt_length = apply_filters('excerpt_length', 55);
	}

	/**
	 * Filters the string in the "more" link displayed after a trimmed excerpt.
	 *
	 * @since 2.9.0
	 *
	 * @param string $more_string The string shown within the more link.
	 */
	$excerpt_more = apply_filters('excerpt_more', ' ' . '&hellip;');

	return wp_trim_words($text, $excerpt_length, $excerpt_more);
}

/**
 * Display the excerpt
 *
 * @param string $type
 * @param bool   $length
 */
function onepress_the_excerpt($type = false, $length = false)
{

	$type   = onepress_loop_get_prop('excerpt_type', 'excerpt');
	$length = onepress_loop_get_prop('excerpt_length', false);

	switch ($type) {
		case 'excerpt':
			the_excerpt();
			break;
		case 'more_tag':
			the_content('', true);
			break;
		case 'content':
			the_content('', false);
			break;
		default:
			$text = '';
			global $post;
			if ($post) {
				if ($post->post_excerpt) {
					$text = $post->post_excerpt;
				} else {
					$text = $post->post_content;
				}
			}
			$excerpt = onepress_trim_excerpt($text, $length);
			if ($excerpt) {
				// WPCS: XSS OK.
				echo wp_kses_post(apply_filters('the_excerpt', $excerpt));
			} else {
				the_excerpt();
			}
	}
}


/*
*	사용자 추가 funtion
*/
// '글쓴이' 권한의 유저가 자신의 게시물만 볼 수 있도록
function restrict_content_to_author( $query ) {
    // 로그인한 사용자 확인
    if ( ! is_admin() && is_user_logged_in() && $query->is_main_query() ) {
        // 현재 사용자 ID
        $current_user_id = get_current_user_id();

        // 관리자가 아닌 '글쓴이' 역할을 가진 사용자만 자신의 글만 보도록 설정
        if ( current_user_can( 'author' ) && ! current_user_can( 'administrator' ) ) {
            $query->set( 'author', $current_user_id ); // 자신의 글만 보도록 설정
        }
    }
}
add_action( 'pre_get_posts', 'restrict_content_to_author' );



// 사용자가 작성한 게시물의 카테고리 객체 배열
function display_user_categories( $user_id ) {
	// 사용자 ID가 유효한지 확인
	if ( ! is_numeric( $user_id ) || $user_id <= 0 ) {
		echo '<p>유효하지 않은 사용자입니다.</p>';
		return;
	}

	// 현재 사용자 정보 가져오기
	$current_user = get_userdata( $user_id );
	$user_categories = array();

	// 관리자 또는 글쓴이 권한이면 해당 사용자의 게시물 카테고리 가져오기
	if ( in_array( 'author', (array) $current_user->roles, true ) ) {
		$user_posts = get_posts( array(
			'author' => $user_id,
			'posts_per_page' => -1,
			'post_status' => 'publish', // 발행된 게시물만
		) );

		// 게시물에서 카테고리 추출
		foreach ( $user_posts as $post ) {
			$categories = get_the_category( $post->ID );
			foreach ( $categories as $category ) {
				if ( ! array_key_exists( $category->term_id, $user_categories ) ) {
					$user_categories[ $category->term_id ] = $category;
				}
			}
		}
	} else {
		// 구독자 권한이면 전체 발행된 글에서 카테고리 가져오기
		$all_posts = get_posts( array(
			'posts_per_page' => -1,
			'post_status' => 'publish', // 발행된 게시물만
		) );

		foreach ( $all_posts as $post ) {
			$categories = get_the_category( $post->ID );
			foreach ( $categories as $category ) {
				if ( ! array_key_exists( $category->term_id, $user_categories ) ) {
					$user_categories[ $category->term_id ] = $category;
				}
			}
		}
	}

	// 카테고리 목록 출력
	echo '<div class="category-list" style="margin-bottom: 40px;">';
	echo '<h3>Categories</h3>';

	if ( ! empty( $user_categories ) ) {
		foreach ( $user_categories as $category ) {
			echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="custom-category-button">' . esc_html( $category->name ) . '</a> ';
		}
	} else {
		echo '<p>작성된 카테고리가 없습니다.</p>';
	}
	echo '</div>';
}





// patterns 폴더 아래의 Custom Pattern을 일괄적으로 등록
function custom_register_block_patterns() {
    $patterns_dir = get_template_directory() . '/patterns/';
    $pattern_files = glob($patterns_dir . '*.php');

    // 각 패턴 파일에 대해 반복
    foreach ($pattern_files as $file) {
        $pattern_data = include $file;

        if (!is_array($pattern_data)) {
            continue; // 배열 형태가 아니면 건너뜀
        }

		// 패턴 카테고리 등록 (이미 등록된 경우 중복 방지)
		if (!empty($pattern_data['categories'])) {
			foreach ($pattern_data['categories'] as $category) {
				register_block_pattern_category($category, array('label' => ucfirst($category)));
			}
		}

        // 파일 이름에서 .php 확장자 제거
        $pattern_name = basename($file, '.php');
        
        // 슬러그 생성
        $pattern_name = basename($file, '.php');
        $slug = 'custom-' . strtolower(preg_replace('/[^a-z0-9-_]/', '', $pattern_name));

        register_block_pattern(
            $slug, // slug 필수!
            array(
                'title'       => __($pattern_data['title'], 'onepress'),
                'description' => __($pattern_data['description'], 'onepress'),
                'categories'  => $pattern_data['categories'] ?? array(),
                'content'     => $pattern_data['content'],
                'inserter'    => true,
            )
        );
    }
}
add_action('after_setup_theme', 'custom_register_block_patterns');



// patterns 폴더 아래의 커스텀 패턴을 일괄적으로 등록 해제
// function custom_unregister_dynamic_block_patterns() {
//     $patterns_dir = get_template_directory() . '/patterns/';
//     $pattern_files = glob($patterns_dir . '*.php');

//     // 패턴 등록 레지스트리 가져오기
//     $pattern_registry = WP_Block_Patterns_Registry::get_instance();

//     foreach ($pattern_files as $file) {
//         // 슬러그 생성 (등록 시와 동일하게 생성해야 함)
//         $pattern_name = basename($file, '.php');
//         $slug = 'custom-' . sanitize_title($pattern_name);

//         // 패턴이 등록되어 있는 경우만 삭제
//         if ($pattern_registry->is_registered($slug)) {
//             unregister_block_pattern($slug);
//         }
//     }
// }
// add_action('after_setup_theme', 'custom_unregister_dynamic_block_patterns');



// 글쓴이 권한에 카테고리 생성 권한을 추가
function allow_user_to_create_categories_but_not_delete() {
    $role = get_role( 'author' );

    if ( $role ) {
        $role->add_cap( 'manage_categories' );
        $role->remove_cap( 'delete_categories' );	// 카테고리 삭제 권한은 제거
    }
}
add_action( 'admin_init', 'allow_user_to_create_categories_but_not_delete' );



// 본문에서 첫 번째 이미지를 추출
function get_first_image_from_content( $content ) {
    // 정규 표현식을 사용하여 본문에서 첫 번째 이미지 태그를 찾음
    preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
    
    // 이미지가 있으면 그 URL 반환, 없으면 false 반환
    return isset($matches[1]) ? $matches[1] : false;
}



// 홈페이지로 리디렉션
function redirect_after_post_delete($post_id) {
    $redirect_url = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : home_url();

    // 삭제 후 리디렉션을 wp 훅에서 처리
    set_transient('redirect_after_post_delete', $redirect_url, 60);
}
add_action('delete_post', 'redirect_after_post_delete');

// wp 액션 훅에서 리디렉션 처리
function perform_redirect_after_post_delete() {
    $redirect_url = get_transient('redirect_after_post_delete');
    
    if ($redirect_url) {
        // 리디렉션 실행 후, 트랜지언트 삭제
        delete_transient('redirect_after_post_delete');
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('wp', 'perform_redirect_after_post_delete');



// 특정 사용자의 사이드바 구현
// <?php echo return_user_sidebar('사용자 별칭'); 으로 사용 
function return_user_sidebar($username) {
    
	$current_user = wp_get_current_user();
	
	// 사용자명으로 사용자 객체 얻기
    $user = get_user_by('login', $username);
    
    // 사용자가 존재하지 않으면 반환하지 않음
    if (!$user) {
        return '사용자를 찾을 수 없습니다.';
    }

    $user_avatar_url = get_user_meta($user->ID, 'user_avatar', true);
    $avatar_url = !empty($user_avatar_url) ? $user_avatar_url : get_template_directory_uri() . '/assets/images/custom_user_avatar.jpg';

    $first_name = !empty($user->user_firstname) ? $user->user_firstname : '';
    $last_name = !empty($user->user_lastname) ? $user->user_lastname : '';
    $full_name = $last_name . ' ' . $first_name;

    $user_email = !empty($user->user_email) ? $user->user_email : '';

    $github_url = get_user_meta($user->ID, 'github_url', true);
    $notion_url = get_user_meta($user->ID, 'user_notion_url', true);
	$blog_url = get_user_meta($user->ID, 'user_blog_url', true);

	$user_nickname = !empty($user->nickname) ? $user->nickname : $user->user_login;

	// html 반환
    ob_start();
    ?>
    <aside id="secondary" class="widget-area sidebar" role="complementary">
		<h3><?php echo esc_html($user_nickname); ?>'s Profile</h3>

        <img src="<?php echo esc_url($avatar_url); ?>" alt="사용자 아바타" class="custom-avatar-square" style="margin-bottom: 15px;">

        <h5><?php echo esc_html($full_name); ?></h5>

        <ul>
            <?php
            if (!empty($user_email)) {
                echo '<li>Email: ' . esc_html($user_email) . '</li>';
            }

            if (!empty($github_url)) {
                echo '<li>GitHub: <a href="' . esc_url($github_url) . '" target="_blank">' . esc_html($github_url) . '</a></li>';
            }

            if (!empty($notion_url)) {
                echo '<li>Notion: <a href="' . esc_url($notion_url) . '" target="_blank">' . esc_html($notion_url) . '</a></li>';
            }

			if (!empty($blog_url)) {
                echo '<li>Blog: <a href="' . esc_url($blog_url) . '" target="_blank">' . esc_html($blog_url) . '</a></li>';
            }
            ?>
        </ul>

		<?php if ( current_user_can( 'administrator' ) || current_user_can( 'author' ) ) : ?>
			<button class="custom-category-button" id="profileEditButton">
        		상세 프로필 편집
    		</button>
		<?php endif; ?>


		<div id="user_profile_edit_form" style="margin-top: 20px; display: none;">
        	<?php get_template_part( 'template-parts/content', 'profile-edit' ); ?>
    	</div>



    </aside>

    <script>
		document.addEventListener('DOMContentLoaded', function () {
			const editButton = document.getElementById('profileEditButton');
			const editForm = document.getElementById('user_profile_edit_form');

			editButton.addEventListener('click', function () {
				editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
			});
		});
	</script>

    <?php
    return ob_get_clean();
}





























/**
 * Config class
 *
 * @since 2.1.1
 */
require get_template_directory() . '/inc/class-config.php';

/**
 * Load Sanitize
 */
require get_template_directory() . '/inc/sanitize.php';

/**
 * Custom Metabox  for this theme.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Dots Navigation class
 *
 * @since 2.1.0
 */
require get_template_directory() . '/inc/class-sections-navigation.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add theme info page
 */
require get_template_directory() . '/inc/admin/dashboard.php';

/**
 * Editor Style
 *
 * @since 2.2.1
 */
require get_template_directory() . '/inc/admin/class-editor.php';
