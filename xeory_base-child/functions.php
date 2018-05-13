<?php
include( get_stylesheet_directory().'/my_functions/sns_functions.php' );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

	wp_register_style('default_css', get_stylesheet_directory_uri().'/default.css');
	wp_enqueue_style('default_css', '', array(), '1.0', false);
	
	if(  is_home() || is_front_page() ){
		wp_register_style('toppage_css', get_stylesheet_directory_uri().'/toppage.css');
		wp_enqueue_style('toppage_css', '', array(), '1.0', false);
	}else{
		wp_register_style('not_toppage_css', get_stylesheet_directory_uri().'/not_toppage.css');
		wp_enqueue_style('not_toppage_css', '', array(), '1.0', false);
	}
	if( is_category() || is_tag()){
		wp_register_style('group_css', get_stylesheet_directory_uri().'/group.css');
		wp_enqueue_style('group_css', '', array(), '1.0', false);
	}
	if(is_author()){
		wp_register_style('group_css', get_stylesheet_directory_uri().'/group.css');
		wp_enqueue_style('group_css', '', array(), '1.0', false);
	}
	if( is_search() ){
		wp_register_style('group_css', get_stylesheet_directory_uri().'/group.css');
		wp_enqueue_style('group_css', '', array(), '1.0', false);
	}
	if( is_single() || is_singular()){
		wp_register_style('single_css', get_stylesheet_directory_uri().'/single.css');
		wp_enqueue_style('single_css', '', array(), '1.0', false);
	}
	
}



function my_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');

// Masonry
function enqueue_masonry_script() {
    wp_enqueue_script('masonry');
 
    if ( function_exists( 'wp_add_inline_script' ) ) {
        $data = "
          jQuery(function($){  
              $(window).on('load resize', function(){
                  $('.grid').masonry({
                      itemSelector: '.grid-item',    //整列対象
                      gutter: 10,    //余白
								columnHeight: 0,
								height: 100,
                  });
              });
          });
        ";
        wp_add_inline_script( "masonry", $data, 'after' ) ;
    }
}
add_action('wp_enqueue_scripts', 'enqueue_masonry_script');


if ( current_user_can('contributor') && !current_user_can('upload_files') ){
    add_action('admin_init', 'allow_contributor_uploads');
}

function allow_contributor_uploads() {
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
}


function shorten_str($str, $size){
	if(mb_strlen($str, 'UTF-8')>$size){
		$title= mb_substr($str, 0, $size, 'UTF-8');
		return $title.'…';
	}else{
		return $str;
	}
}



// 人気記事出力用
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
	}
	return $count.' Views';
}
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


// アイキャッチ画像デフォルト
add_action( 'save_post', 'save_default_thumbnail' );
function save_default_thumbnail( $post_id ) {
  $post_thumbnail = get_post_meta( $post_id, $key = '_thumbnail_id', $single = true );
  if ( !wp_is_post_revision( $post_id ) ) {
    if ( empty( $post_thumbnail ) ) {
      update_post_meta( $post_id, $meta_key = '_thumbnail_id', $meta_value = '709' );
    }
  }
}




//画像欄をカラムに追加
function add_thumbnail_columns( $columns ) {
    $columns = array_reverse($columns,true);
    //「Image」は任意のテキストに変更してください
    $columns['thumbnail'] = 'Image';
    $columns = array_reverse($columns,true);
    return $columns;
}
add_filter( 'manage_posts_columns', 'add_thumbnail_columns' );
 
//画像を出力
function add_thumbnail_postlist( $column_name, $post_id ) {
  if ( 'thumbnail' == $column_name ) {
    //サイズは任意のサイズに変更してください
    $thumbnail = get_the_post_thumbnail( $post_id, array( 80, 80 ) );
    //アイキャッチが設定されていない場合、空のdivを出力します
    echo ( $thumbnail ) ? $thumbnail : '<div class="noimage">&nbsp;</div>';
  }
}
add_action( 'manage_posts_custom_column', 'add_thumbnail_postlist' , 10 , 2 );


function custom_admin_style() {
echo <<<EOF
<style>
div#category-all {
　　//高さを決める場合は none →　高さpx
  //max-height:none;
}
#category-all input:checked {
    border:1px solid #000;
    background:#ccc;
}
//設定したサムネイルの幅に合わせて調整してください
.column-thumbnail {
    width:80px;
}
//空divのスタイル
.column-thumbnail .noimage {
    width:80px;
    height:80px;
    background:#f2f2f2;
}
div#bzb_post_layout {
	display: none;
}

</style>
EOF;
}
add_action( 'admin_print_styles', 'custom_admin_style' );

// 管理バーの非表示
// add_filter( 'show_admin_bar', '__return_false' );



//管理者以外はログイン成功後ダッシュボードではなくトップページへ飛ばす
function redirect_login_front_page() {
	if( !current_user_can('administrator') ){
		$home_url = "".home_url('/')."wp-admin/post-new.php";
		return wp_safe_redirect($home_url);
// 		exit();
	}else{
		$home_url = "".home_url('/')."wp-admin";
		return wp_safe_redirect($home_url);
	}
}
// add_filter('login_redirect', 'redirect_login_front_page');
// add_action( 'admin_init', 'redirect_login_front_page' );


//ログアウト時のリダイレクト先をトップページへ
function redirect_logout_front_page(){
	$home_url = site_url('', 'http');
	wp_safe_redirect($home_url);
	exit();
}
add_action('wp_logout','redirect_logout_front_page');


?>

