<?php

/*
 *  Initialize theme
 *
 */

add_action( 'after_setup_theme', 'ropecon_after_setup_theme' );

function ropecon_after_setup_theme( ) {
	/*  Load text domain  */
	load_theme_textdomain( 'ropecon', get_template_directory( ) . '/languages' );

	/*  HTML5 support  */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	/*  Wide/full aligned Gutenberg blocks  */
	add_theme_support( 'align-wide' );

	/*  Featured images  */
	add_theme_support( 'post-thumbnails' );


	/*  Excerpts for pages  */
	add_post_type_support( 'page', 'excerpt' );

	/*  Hide core block patterns  */
	remove_theme_support( 'core-block-patterns' ); 

	/*  Sidebars  */
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'ropecon' ),
		'id' => 'footer_widgets',
		'before_widget' => '<div class="widget" role="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	) );

	/*  Menus  */
	register_nav_menus( array(
		'navi_main' => __( 'Main navigation', 'ropecon' )
	) );

	/*  Custom color palette  */
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Black', 'ropecon' ),
			'slug' => 'black',
			'color' => '#000000'
		),
		array(
			'name' => __( 'Dark Gray', 'ropecon' ),
			'slug' => 'dark-gray',
			'color' => '#232323'
		),
		array(
			'name' => __( 'Light Gray', 'ropecon' ),
			'slug' => 'light-gray',
			'color' => '#f4f4f4'
		),
		array(
			'name' => __( 'White', 'ropecon' ),
			'slug' => 'white',
			'color' => '#ffffff'
		),
		array(
			'name' => __( 'Ropecon Highlight #1', 'ropecon' ),
			'slug' => 'ropecon-highlight-one',
			'color' => '#5472d2'
		),
	) );

	/*  Options  */
}

/*
 *  Include stylesheets and scripts
 *
 */

add_action( 'init', 'ropecon_google_fonts_init' );

function ropecon_google_fonts_init( ) {
	// Fonts from Google Fonts
	wp_register_style( get_template( ) . '-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Lora:400,500' );
}


add_action( 'wp_enqueue_scripts', 'ropecon_styles_scripts' );

function ropecon_styles_scripts( ) {
	// Eric Meyer: CSS reset | http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/
	wp_enqueue_style( 'css-reset', get_template_directory_uri( ) . '/reset.css' );

	// Main style sheets
	wp_enqueue_style( get_template( ), get_template_directory_uri( ) . '/style.css', array( 'css-reset' ) );
	wp_enqueue_style( get_template( ) . '-layout', get_template_directory_uri( ) . '/style-layout.css', array( get_template( ) ) );
	wp_enqueue_style( get_template( ) . '-common', get_template_directory_uri( ) . '/style-common.css', array( get_template( ) ) );
	wp_enqueue_style( get_template( ) . '-fonts', get_template_directory_uri( ) . '/style-fonts.css', array( get_template( ) ) );

	wp_enqueue_style( get_template( ) . '-temp', get_template_directory_uri( ) . '/style-temp.css', array( get_template( ) ) );

	// Responsive design
	// wp_enqueue_style( get_template( ) . '-resp-xxx', get_template_directory_uri( ) . '/style-resp-xxx.css', array( get_template( ) ), null, 'only screen and (min-width: xxxpx)' ); 

	// Fonts from Google Fonts
	wp_enqueue_style( get_template( ) . '-google-fonts' );

	// jQuery plugins
	wp_register_script( 'jquery-browser-mobile', get_template_directory_uri( ) . '/lib/jquery.browser.mobile.js', array( 'jquery' ), '2014-08-01' );
	wp_register_script( 'jquery-parallax', get_template_directory_uri( ) . '/lib/jquery.parallax.min.js', array( 'jquery' ), '1.5.0' );
	wp_register_script( 'jquery-waitforimages', get_template_directory_uri( ) . '/lib/jquery.waitforimages.min.js', array( 'jquery' ), '2.4.0' );

	// Javascript
	wp_enqueue_script( get_template( ), get_template_directory_uri( ) . '/script.js', array( 'jquery', 'jquery-browser-mobile', 'jquery-parallax' ) );

	// Dynamic menu
	wp_enqueue_script( get_template( ) . '-menu', get_template_directory_uri( ) . '/script-menu.js', array( 'jquery', 'jquery-waitforimages', 'wp-i18n' ) );
	wp_set_script_translations( get_template( ) . '-menu', 'ropecon', get_template_directory( ) . '/languages' );
	wp_localize_script( get_template( ) . '-menu', 'theme', array( 'template_directory_uri' => get_template_directory_uri( ) ) );

	wp_enqueue_style( get_template( ) . '-menu', get_template_directory_uri( ) . '/style-menu.css', array( get_template( ) ) );
}

/*
 *  Gutenberg
 *
 */

add_action( 'enqueue_block_editor_assets', 'ropecon_block_editor_assets', 10000 );

function ropecon_block_editor_assets( ) {
//	wp_enqueue_style( get_template( ) . '-common', get_template_directory_uri( ) . '/style-common.css' );
	wp_enqueue_style( get_template( ) . '-gutenberg', get_template_directory_uri( ) . '/style-gutenberg.css' );
	wp_enqueue_style( get_template( ) . '-fonts', get_template_directory_uri( ) . '/style-fonts.css' );

	wp_enqueue_style( get_template( ) . '-gutenberg-temp', get_template_directory_uri( ) . '/style-gutenberg-temp.css' );
	wp_enqueue_style( get_template( ) . '-google-fonts' );

	wp_enqueue_script( get_template( ) . '-gutenberg', get_template_directory_uri( ) . '/script-gutenberg.js', array( 'wp-blocks', 'wp-dom', 'wp-i18n' ), time( ), true );
	wp_enqueue_script( get_template( ) . '-gutenberg-block-icon', get_template_directory_uri( ) . '/script-gutenberg-block-icon.js', array( 'wp-blocks', 'wp-dom', 'wp-i18n' ), time( ), true );
}

add_action( 'init', 'ropecon_init_gutenberg' );

function ropecon_init_gutenberg( ) {
	register_block_type(
		'ropecon/icon',
		array(
			'editor_script' => get_template( ) . '-gutenberg-block-icon',
			'attributes' => array(
				'icon' => array( 'type' => 'string', 'default' => '' )
			)
		)
	);
}

/*  Modify output for currency block  */

add_filter( 'render_block', 'ropecon_render_block_paragraph_currency', 10, 2 );

function ropecon_render_block_paragraph_currency( $content, $block ) {
	if( $block['blockName'] != 'core/paragraph' ) {
		return $content;
	}

	if( !isset( $block['attrs']['className'] ) || !in_array( 'is-style-currency', explode( ' ', $block['attrs']['className'] ) ) ) {
		return $content;
	}

	$content = substr_replace( $content, '><span class="currency">&euro;</span>', strpos( $content, '>' ), 1 );
	return $content;
}


/*  Block patterns  */

add_action( 'init', 'ropecon_init_block_patterns' );

function ropecon_init_block_patterns( ) {
	register_block_pattern_category(
		'ropecon',
		array( 'label' => 'Ropecon' )
	);

	$patterns = array(
		'title-cover' => array(
			'title' => __( 'Title cover', 'ropecon' ),
			'description' => __( 'Centered title on top of image.', 'ropecon' )
		),
		'three-icon-boxes' => array(
			'title' => __( 'Three icon boxes', 'ropecon' ),
			'description' => __( 'Three columns with icons and varying background colors.', 'ropecon' )
		),
	);

	foreach( $patterns as $slug => $labels ) {
		$content_raw = file_get_contents( get_template_directory_uri( ) . '/block-patterns/' . $slug . '.gb.html' ); 
		$content = str_replace( 'IMG_ROOT', get_template_directory_uri( ) . '/images/block-pattern-preview', $content_raw );
		register_block_pattern(
			'ropecon/' . $slug,
			array(
				'title' => $labels['title'],
				'content' => $content,
				'description' => $labels['description'],
				'categories' => array( 'ropecon' ),
				'viewportWidth' => 1200
			)
		);
	}

}

/*  Show image information  */

add_filter( 'render_block', 'ropecon_render_block_image_information', 10, 2 );

function ropecon_render_block_image_information( $content, $block ) {
	if( $block['blockName'] == 'core/media-text' ) {
		$media = $block['attrs']['mediaId'];
	}

	if( $block['blockName'] == 'core/cover' ) {
		if( $block['attrs']['url'] ) {
			$media = $block['attrs']['id'];
		}
	}

	if( isset( $media ) ) {
		$media = get_post( $media );

		if( strlen( $media->post_content ) < 1 ) {
			return $content;
		}

		$markup = '<div class="image-information">' .
			'<span class="icon icon-Information" title="' . $media->post_content . '"></span>' .
			'<span class="info">' . $media->post_content . '</span>' .
			'</div>';

		$img_end = strpos( $content, '>', strpos( $content, '<img' ) ); // + strpos( $content, '<img' );

		return substr_replace( $content, $markup, $img_end + 1, 0 );
	}

	return $content;
}

?>
