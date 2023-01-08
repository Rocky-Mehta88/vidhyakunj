<?php
add_filter( 'template_redirect', 'skilled_search_template', 20 );
add_filter( 'pre_get_posts', 'skilled_add_custom_types' );
add_filter( 'sensei_login_logout_menu_title', 'skilled_filter_login_menu_item_label' );
add_filter( 'pre_get_document_title', 'skilled_sensei_search_title', 100 );
add_filter( 'sensei_wc_paid_courses_add_to_cart_button_text', 'skilled_single_add_to_cart_text', 100 );
add_filter( 'body_class', 'skilled_sensei_filter_body_class' );

add_action( 'sensei_after_main_content', 'skilled_sensei_add_similar_courses', 9 );

remove_action( 'sensei_single_course_content_inside_before', array( 'Sensei_Course', 'the_title' ), 10 );
remove_action( 'sensei_single_course_content_inside_before', array( 'Sensei_Course', 'the_course_video' ), 40 );

/**
 * Sensei Support Declaration
 */
add_action( 'after_setup_theme', 'skilled_declare_sensei_support' );
function skilled_declare_sensei_support() {
	add_theme_support( 'sensei' );
}

function skilled_sensei_filter_body_class( $body_classes ) {
	if ( skilled_sensei_is_paid_courses() ) {
		$body_classes[] = 'skilled-sensei-paid_courses';
	}

	return $body_classes;
}

function skilled_sensei_search_title( $title ) {

	if ( skilled_is_search_courses() ) {
		$search_page_id  = skilled_get_option( 'sensei-course-search-page', false );
		if ( $search_page_id ) {
			$search_page_title = get_the_title( $search_page_id );
			$site_title = get_bloginfo( 'name' );

			return "{$search_page_title} - {$site_title}";
		}
	}
	return $title;
}

if ( function_exists( 'Sensei' ) ) {
	remove_action( 'sensei_single_course_content_inside_before', array(
		Sensei()->post_types->course,
		'the_progress_statement'
	), 15 );
	remove_action( 'sensei_single_course_content_inside_before', array(
		Sensei()->post_types->course,
		'the_progress_meter'
	), 16 );
	add_action( 'sensei_single_course_content_inside_before', array(
		Sensei()->post_types->course,
		'the_progress_statement'
	), 35 );
	add_action( 'sensei_single_course_content_inside_before', array(
		Sensei()->post_types->course,
		'the_progress_meter'
	), 36 );
}

/**
 * This is used only if a search page is not set in Theme Options
 * If it is set then the url of the page is set as form action
 */
function skilled_search_template() {
	if ( skilled_is_search_courses() ) {

		include_once get_template_directory() . '/search-courses.php';
		exit;
	}
}

function skilled_is_search_courses() {
	return isset( $_GET['s'] ) && isset( $_GET['search-type'] ) && $_GET['search-type'] == 'courses';
}

/**
 * This enables Courses to turn up in post by author listing
 */
function skilled_add_custom_types( $query ) {

	if ( is_author() && $query->is_main_query() ) {

		$query->set( 'post_type', array(
			'post',
			'course'
		) );

	}
	return $query;
}

function skilled_single_add_to_cart_text( $text ) {

	if ( is_single() && get_post_type() == 'course' ) {
		$product_ids = skilled_sensei_get_course_product_ids( get_the_ID() );
		if ( count( $product_ids ) === 1 ) {
			return esc_html__( 'Take this course', 'skilled' );
		}
	}
	return $text;
}

function skilled_filter_login_menu_item_label( $menu_title ) {

	if ( $menu_title == 'Login' ) {
		$menu_title = esc_html__( 'Sign In/Sign Up', 'skilled' );
	}
	return $menu_title;
}

function skilled_course_print_stars( $id = '', $permalink = false, $newwindow = true, $alttext = true ) {

	if ( class_exists( 'WooCommerce' ) && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

		global $wpdb;

		if ( empty( $id ) ) {
			global $post;
			$id = $post->ID;
		}

		if ( is_bool( $permalink ) ) {
			if ( $permalink ) {
				$link_escaped = esc_url( get_permalink( $id ) );
			}
		} else {
			$link_escaped = esc_url( $permalink );
			$permalink = true;
		}

		$target = "";
		if ( $newwindow ) {
			$target = "target='_blank' ";
		}


		if ( get_post_type( $id ) == 'product' ) {
			$count = $wpdb->get_var( "
			SELECT COUNT(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $id
			AND comment_approved = '1'
			AND meta_value > 0
		" );

			$rating = $wpdb->get_var( "
			SELECT SUM(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = $id
			AND comment_approved = '1'
		" );

			$out = '';
			if ( $permalink ) {
				$out .= "<a href='{$link_escaped}' {$target}>";
			}

			$out .= '<span class="starwrapper" itemscope itemtype="http://schema.org/AggregateRating">';

			if ( $count > 0 ) {
				$average = number_format( $rating / $count, 2 );

				$out .= '<span class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'skilled' ), $average ) . '"><span style="width:' . ( $average * 16 ) . 'px"><span itemprop="ratingValue" class="rating">' . $average
				     . '</span> </span></span>';

			} else {
				if ( $alttext ) {
					$out .= '<span class="star-rating-alt-text">' . esc_html__( 'Be the first to rate', 'skilled' ) . '</span>';
				} else {
					return '';
				}
			}

			$out .= '</span>';

			if ( $permalink ) {
				$out .= '</a>';
			}

			return $out;
		}
	}
}

function skilled_get_teacher_thumb( $user_id = 0 ) {
	if ( $user_id ) {

		$meta_key = 'sensei-teacher';
		$args     = array(
			'numberposts' => 1,
			'post_type'   => 'teacher',
			'author'      => $user_id,
		);
		// get product ids
		$teachers = new WP_Query( $args );
		$teacher = null;

		if ( $teachers->posts && count( $teachers->posts ) ) {

			$teacher = $teachers->posts[0];
		}

		if ($teacher) {

			$img_url = '';
			if ( has_post_thumbnail( $teacher->ID ) ) {
				$img_url = get_the_post_thumbnail( $teacher->ID, 'thumbnail' );
			}
			if ( '' != $img_url ) {
				return '<a href="' . get_permalink( $teacher->ID ) . '" title="' . esc_attr( get_post_field( 'post_title', $teacher->ID ) ) . '">' . $img_url . '</a>';
			}
		}
	}
	return false;
}

function skilled_sensei_get_course_product_ids( $post_id = 0 ) {

	if ( $post_id && skilled_sensei_is_paid_courses() && class_exists( 'Sensei_WC' ) ) {
		$cache_key = 'skilled_sensei_course_product_ids_' . $post_id;
		$result = wp_cache_get( $cache_key );
		if ( false === $result ) {
			$result = Sensei_WC::get_course_product_ids( $post_id );
			wp_cache_set( $cache_key, $result );
		}
		return $result;
	}
	return array();
}

function skilled_sensei_simple_course_price( $post_id ) {

	if ( skilled_sensei_is_paid_courses() && class_exists( 'Sensei_WC' ) ) {

		$product_ids = skilled_sensei_get_course_product_ids( $post_id );

		if ( ! $product_ids ) {
			return;
		}

		$products = array();

		foreach ( $product_ids as $product_id ) {
			$product = Sensei_WC::get_product_object( $product_id );

			if (
				! $product ||
				! $product->is_purchasable() ||
				! $product->is_in_stock() ||
				Sensei_WC::is_product_in_cart( $product_id )
			) {
				continue;
			}
			$products[] = $product;
			
		}

		if ( empty( $products ) ) {
			return;
		}

		$lowest = $products[0];
		$from = '';
		if ( count( $products ) > 1 ) {
			$from = '<em>' . esc_html__( 'From', 'skilled' ) . '</em>';
			foreach ( $products as $product ) {
				if ( $product->get_price() < $lowest->get_price() ) {
					$lowest = $product;
				}
			}
		}

		return "<span class=\"course-price\">{$from}" . $lowest->get_price_html() . '</span>';


	} elseif ( version_compare( skilled_sensei_get_version(), '2.0', '<' ) 
		&& function_exists( 'sensei_simple_course_price' ) ) {

		ob_start();

		sensei_simple_course_price( $post_id );

		$content = ob_get_clean();

		if ( $content ) {
			return $content;
		}
	}
	return false;
}

function skilled_sensei_add_similar_courses() {
	get_template_part( 'sensei/custom/similar-courses' );
}

function skilled_sensei_get_version() {
	if ( function_exists( 'Sensei') ) {
		return Sensei()->version;
	}
	return 0;
}

function skilled_sensei_is_2x() {
	return version_compare( skilled_sensei_get_version(), '2.0', '>=' );
}

function skilled_sensei_is_paid_courses() {
	return defined( 'SENSEI_WC_PAID_COURSES_VERSION' );
}
