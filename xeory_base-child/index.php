<?php get_header(); ?>

<div id="content">
	<div class="wrap">
		<?php if( !( is_home() || is_front_page() ) ){/* パンくず*/bzb_breadcrumb();} ?>
		<div id="main" class="index_php_a"<?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<div class="main-inner">
				<?php if( !( is_home() || is_front_page() ) ){?>
				<section class="catli-content">
					<header class="cat-header">
						<h1 class="post-title" ><?php bzb_title(); ?></h1>
					</header>
				</section>
				<?php } ?>

				<div class="hot top-section-wrap">
					<h2 class="top-section-title">
						人気の記事
					</h2>
					<div class="post-loop-wrap top-section">
						<?php		if ( have_posts() ) : 
						setPostViews(get_the_ID());
						query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=4&order=DESC'); while(have_posts()) : the_post(); ?>
						<div class="float_item_post" >
							<a href="<?php the_permalink(); ?>"> 

								<div  id="post-<?php echo the_ID(); ?>"<?php post_class(array('some_post')); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">


									<div class="post-content" itemprop="text">
										<?php
										single_tag_title( );
										// 												get_the_tags();
										?>
										<?php if( get_the_post_thumbnail() ) { ?>
										<div class="post-thumbnail">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->
											<?php the_post_thumbnail(full,array('class' => 'post_img')); ?>
											<!-- 									</a> -->
										</div>
										<?php } else {?>
										<div class="post-thumbnail">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->

											<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/default.png' . '"  alt="thumbnail"  class="post_img  post-thumbnail  left-aligned"/>';?>
											<!-- 								</a> -->
										</div>
										<?php } ?>

										<?php // the_content('続きを読む'); ?>
										<?php // the_excerpt(); ?>
										<!-- 		    <a href="<?php // the_permalink(); ?>" class="more-link" rel="nofollow">続きを読む</a> -->

									</div>
								</div>
							</a>
							<div class="post-header">
								<div class="post-header-content">
									<a href="<?php the_permalink(); ?>"> 
										<ul class="post-meta list-inline">
											<li class="date updated" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
										</ul>

										<h3 class="post-title " itemprop="headline">
											<?php 
											$title_str=esc_html(the_title('','' , FALSE)); 
											echo shorten_str($title_str, 50);
											// 											echo the_tags('','','');

											?>
										</h3>
									</a>

									<div class="post_writer">
										<?php
										global $user_id;
										?>

										<?php
										$target="class=\"";
										$replace="class=\"writer_author ";
										$author_login=get_the_author_meta("user_login");
										$author_link="<a href=\"". get_bloginfo('url')."/author/".$author_login. "\" >";
										echo $author_link;
										// 											$link= str_replace($target,$replace, $str); 
										// 																					echo $link;
										?> 


										<?php 
										$author_name = get_the_author_meta('display_name');


										$original_avatar = get_the_author_meta('original_avatar', $user_id);
										$avatar_image = '';

										if( isset($original_avatar) && $original_avatar !== '' ){
											$avatar_image = '<img  class ="avatar_image_icon"   src="'.$original_avatar .'" alt="アバター">';
										}else{
											$avatar_image = '<img class ="avatar_image_icon"  src="'.get_template_directory_uri().'/lib/images/masman.png" alt="masman" width="100" height="100" />';
										}
										echo '<div class="avatar_image writer_icon ">' .$avatar_image .'</div>';
										?>

										<?php
										// 										echo $author_link;
										echo '<span class="post_writer_name">';
										echo $author_name;
										echo '</span>';
										echo "</a>";
										?>
									</div>
									
									
									<div class="post_cat">
										<?php
										$cat_info=get_the_category();
										?>
										<?php if(FALSE): ?>
										
										<div class="cat_name">
											<a 
											   href="<?php echo $cat_info[0]->slug;?> "
											   >

												<?php echo $cat_info[0]->cat_name;?>												

											</a>
										</div>
										<?php endif;?>
										<?php echo  getPostViews(get_the_ID()); ?>											
										<?php if(TRUE): ?>
										<a
										   href=  "<?php echo site_url();?>/category/<?php echo $cat_info[0]->slug; ?>  " 
										   class="cat_info"
										   >



											<?php  	$cat='category_'.$cat_info[0]->cat_ID;
											// 										   echo $cat;
											$catimg = get_field('category_icon_small',$cat);
											// 											echo $catimg;
											$img = wp_get_attachment_image_src($catimg, 'full');
											// 											echo $img[0];
											?>
											<img
												 src="<?php echo $img[0]; ?>"
												 class="cat_icon"
												 />
										</a>
										<?php endif ;?>

									</div>
								</div>
							</div>



						</div>

						<?php
						endwhile;
						endif ;?>
					</div>
				</div>

				<div class="news top-section-wrap">
					<h2 class="top-section-title"> 最新の記事</h2>

					<div class="post-loop-wrap top-section">



						<?php if ( have_posts() ) : ?>
						<?php 
						query_posts(array(array('category__not_in' => array(1,12)),'posts_per_page'=>12)); 
// 						query_posts(array(array('category__not_in' => array(1,12)),'posts_per_page'=>12));
						?>
						<?php //query_posts('posts_per_page=3&cat=12&paged='.$paged); ?>

						<?php while ( have_posts() ) : the_post(); ?>
						<?php
						$cat=get_the_category();
						//
						// 			echo ($cat[0]->cat_ID);
// 						if($cat[0]->cat_ID==12)continue;
// 						if($cat[0]->cat_ID==1)continue;
						?>

						<div class="float_item_post" >
							<a href="<?php the_permalink(); ?>"> 

								<div  id="post-<?php echo the_ID(); ?>"<?php post_class(array('some_post')); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">


									<div class="post-content" itemprop="text">
										<?php
										single_tag_title( );
										// 												get_the_tags();
										?>
										<?php if( get_the_post_thumbnail() ) { ?>
										<div class="post-thumbnail phone_right">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->
											<?php the_post_thumbnail(full,array('class' => 'post_img')); ?>
											<!-- 									</a> -->
										</div>
										<?php } else {?>
										<div class="post-thumbnail">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->

											<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/default.png' . '"  alt="thumbnail"  class="post_img post-loop-wrap post-thumbnail  left-aligned"/>';?>
											<!-- 								</a> -->
										</div>
										<?php } ?>

										<?php // the_content('続きを読む'); ?>
										<?php // the_excerpt(); ?>
										<!-- 		    <a href="<?php // the_permalink(); ?>" class="more-link" rel="nofollow">続きを読む</a> -->

									</div>
								</div>
							</a>
							<div class="post-header phone_right">
								<div class="post-header-content">
									<a href="<?php the_permalink(); ?>"> 
										<ul class="post-meta list-inline">
											<li class="date updated" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
										</ul>

										<h3 class="post-title " itemprop="headline">
											<?php 
											$title_str=esc_html(the_title('','' , FALSE)); 
											echo shorten_str($title_str, 50);
											// 											echo the_tags('','','');

											?>
										</h3>
									</a>

									<div class="post_writer">
										<?php
										global $user_id;
										?>

										<?php
										$target="class=\"";
										$replace="class=\"writer_author ";
										$author_login=get_the_author_meta("user_login");
										$author_link="<a href=\"". get_bloginfo('url')."/author/".$author_login. "\" >";
										echo $author_link;
										// 											$link= str_replace($target,$replace, $str); 
										// 																					echo $link;
										?> 


										<?php 
										$author_name = get_the_author_meta('display_name');


										$original_avatar = get_the_author_meta('original_avatar', $user_id);
										$avatar_image = '';

										if( isset($original_avatar) && $original_avatar !== '' ){
											$avatar_image = '<img  class ="avatar_image_icon"   src="'.$original_avatar .'" alt="アバター">';
										}else{
											$avatar_image = '<img class ="avatar_image_icon"  src="'.get_template_directory_uri().'/lib/images/masman.png" alt="masman" width="100" height="100" />';
										}
										echo '<div class="avatar_image writer_icon ">' .$avatar_image .'</div>';
										?>

										<?php
										// 										echo $author_link;
										echo '<span class="post_writer_name">';
										echo $author_name;
										echo '</span>';
										echo "</a>";
										?>
									</div>
									<div class="post_cat">

										<?php
										$cat_info=get_the_category();
										?>
										<?php if(FALSE): ?>
										<div class="cat_name">

											<a 
											   href= "<?php echo $cat_info[0]->slug;?> "
											   >

												<?php echo $cat_info[0]->cat_name;?>												

											</a>
										</div>
										<?php endif;?>

										<?php if(TRUE): ?>
										<a
										   href= "<?php echo site_url();?>/category/<?php echo $cat_info[0]->slug; ?>  " 
										   class="cat_info"
										   >



											<?php  	$cat='category_'.$cat_info[0]->cat_ID;
											// 										   echo $cat;
											$catimg = get_field('category_icon_small',$cat);
											// 											echo $catimg;
											$img = wp_get_attachment_image_src($catimg, 'full');
											// 											echo $img[0];
											?>
											<img
												 src="<?php echo $img[0]; ?>"
												 class="cat_icon"
												 />
										</a>
										<?php endif ;?>

									</div>
								</div>
							</div>



						</div>
						<?php
						endwhile;
						else :
						?>

						<article id="post-404"class="cotent-none post" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
							<section class="post-content" itemprop="text">
								<?php echo get_template_part('content', 'none'); ?>
							</section>
						</article>

						<?php
						endif;
						?>



					</div><!-- /post-loop-wrap -->
					<div>

						<?php //if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?> 
					</div>

				</div>
				<div >

				</div>
				<div id="categories" class=" category top-section-wrap">

					<h2 class="top-section-title">登録団体一覧</h2>

					<div class="category top-section" style="text-align: center;">

						<div class="category-items post-loop-wrap">
							<?php
							//一番親階層のカテゴリをすべて取得
							$categories = get_categories('parent=0');

							//取得したカテゴリへの各種処理
							$category_num=0;
							foreach($categories as $val){

								//		echo $val->cat_ID;
								if($val->cat_ID==12)continue;
								if($val->cat_ID==1)continue;
								// 									$tag=get_the_tags();
								//カテゴリのリンクURLを取得
								$cat_link = get_category_link($val->cat_ID);
								//カスタムフィールドでアイコン取得する用のIDを取得
								$post_id = 'category_' . $val -> cat_ID;
								//アイコンのソース取得
								$attachment_id=get_field('category_icon_small',$post_id);
								$icon_src = wp_get_attachment_image($attachment_id,'full',false,array('class'=> 'cat_icon'));
								//親カテゴリのリスト出力
								echo '<div class="category float_item_org_wrap ';
								echo ($category_num%3==1 ? 'center_at3 ' : '' );
								echo ($category_num%2==0 ? 'right_at2 ' : '') ;
								echo ($category_num%4==1 ? 'right_top_at4 ' : '') ;
								echo ($category_num%4==2 ? 'left_bottom_at4 ' : '') ;
								echo '">';
								$category_num=$category_num+1;
								echo '<div class="category float_item_org">';
								echo '<a href="'.$cat_link.'" class="category_item">';

								echo '<p class="left icon_parent">' ;
								if($icon_src == ""){
									echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/default.png' . '"  alt="thumbnail"  class="post_img post-loop-wrap post-thumbnail  left-aligned"/>';
								}else{
									echo $icon_src; 
								}
								echo '</p>';
								echo '</a>';
								echo '<li class=" category_item ';

								echo '">';
								echo '<div class="overflow category_name post_title"><h3>' . $val -> name .'</h3></div>';

								echo '<p>';
								echo '<div class="overflow category_description" style="text-align:left;">';
								if(mb_strlen($val -> description, 'UTF-8')>200){
									$short_description= mb_substr($val -> description, 0, 200, 'UTF-8');
									echo $short_description.'……';
								}else{
									echo $val -> description;
								}
								echo '</p>';
								echo '</div>';
								echo '</div>';
								echo '</div>';


								//子カテゴリのIDを配列で取得。配列の長さを変数に格納
								$child_cat_num = count(get_term_children($val->cat_ID,'category'));

								//子カテゴリが存在する場合
								if($child_cat_num > 0){
									echo '<ul>';
									//子カテゴリの一覧取得条件
									$category_children_args = array('parent'=>$val->cat_ID);
									//子カテゴリの一覧取得
									$category_children = get_categories($category_children_args);
									//子カテゴリの数だけリスト出力
									foreach($category_children as $child_val){
										$cat_link = get_category_link($child_val -> cat_ID);
										echo '<li><a href="' . $cat_link . '">' . $child_val -> name . '</a>';
									}
									echo '</ul>';
								}
								echo '</li>';
							}
							?>
						</div>
						<!-- /category-items テスト-->
					</div>
				</div>

				<?php query_posts('posts_per_page=3&cat=12&paged='.$paged); ?>
				<?php if ( have_posts() ) :?>
				<div id="features" class=" features top-section-wrap">
					<h2 class="top-section-title">特集記事</h2>
					<h3>
						運営事務局が書いた特集記事
					</h3>

					<div class="features top-section" style="text-align: center;">
						<ul id="newscarousel" class="feature_article ">
							<div class="post-loop-wrap">

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<li class="float_item_feature button">
									<div class="left line_item">
										<a href="<?php the_permalink(); ?>" >
											<div class="phone_left post_img">
												<?php 
												$features_post_img=get_the_post_thumbnail($post->ID, array('class' => 'top-page  left-aligned'));
												if($features_post_img==""){
													echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/star.png' . '"  alt="thumbnail"  class="attachment-top-page  left-aligned size-top-page  left-aligned wp-post-image" >';
												}else{
													echo $features_post_img;
												}
												?>
											</div>
											<div class="phone_right post_str">
												<div class="news_date">
													<!-- // 													<?php the_time('n') ?>月 <span><?php the_time('d') ?>日</span> -->
												</div>
												<div class="news_t feature_title line_phone_title">
													<h3>
														<?php the_title();?>		
													</h3>
												</div>
												<div class="news_info"><?php the_excerpt(); ?> </div>
												<div class="clear"></div>
											</div>
										</a>
									</div>

								</li>
								<?php endwhile; endif; ?>
							</div>

							<?php wp_reset_query(); ?>
						</ul>
					</div><!-- /features-->

				</div>
				<?php endif; ?>

				<?php query_posts('posts_per_page=3&tag_id=14&paged='.$paged); ?>
				<?php if ( have_posts() ) :?>
				<div>

				</div>
				<div id="introductions" class=" introductions top-section-wrap">
					<h2 class="top-section-title">初めての方に</h2>
					<h3>
						BOARDWALKに初めて訪れた方にオススメしたい記事
					</h3>
					<div class="post-loop-wrap top-section">
						<?php		if ( have_posts() ) : 
						setPostViews(get_the_ID());
						// 						query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=4&order=DESC'); 
						while(have_posts()) : the_post(); ?>
						<div class="float_item_post" >
							<a href="<?php the_permalink(); ?>"> 

								<div  id="post-<?php echo the_ID(); ?>"<?php post_class(array('some_post')); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">


									<div class="post-content" itemprop="text">
										<?php
										// 										single_tag_title( );
										// 												get_the_tags();
										?>
										<?php if( get_the_post_thumbnail() ) { ?>
										<div class="post-thumbnail">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->
											<?php the_post_thumbnail(full,array('class' => 'post_img')); ?>
											<!-- 									</a> -->
										</div>
										<?php } else {?>
										<div class="post-thumbnail">
											<!-- 									<a href="<?php the_permalink(); ?>" rel="nofollow"> -->

											<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/newcomer.png' . '"  alt="thumbnail"  class="post_img  post-thumbnail  left-aligned"/>';?>
											<!-- 								</a> -->
										</div>
										<?php } ?>

										<?php // the_content('続きを読む'); ?>
										<?php // the_excerpt(); ?>
										<!-- 		    <a href="<?php // the_permalink(); ?>" class="more-link" rel="nofollow">続きを読む</a> -->

									</div>
								</div>
							</a>
							<div class="post-header">
								<div class="post-header-content">
									<a href="<?php the_permalink(); ?>"> 
										<ul class="post-meta list-inline">
											<li class="date updated" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
										</ul>

										<h3 class="post-title " itemprop="headline">
											<?php 
											$title_str=esc_html(the_title('','' , FALSE)); 
											echo shorten_str($title_str, 50);
											// 											echo the_tags('','','');

											?>
										</h3>
									</a>

									<div class="post_writer">
										<?php
										global $user_id;
										?>

										<?php
										$target="class=\"";
										$replace="class=\"writer_author ";
										$author_login=get_the_author_meta("user_login");
										$author_link="<a href=\"". get_bloginfo('url')."/author/".$author_login. "\" >";
										echo $author_link;
										// 											$link= str_replace($target,$replace, $str); 
										// 																					echo $link;
										?> 


										<?php 
										$author_name = get_the_author_meta('display_name');


										$original_avatar = get_the_author_meta('original_avatar', $user_id);
										$avatar_image = '';

										if( isset($original_avatar) && $original_avatar !== '' ){
											$avatar_image = '<img  class ="avatar_image_icon"   src="'.$original_avatar .'" alt="アバター">';
										}else{
											$avatar_image = '<img class ="avatar_image_icon"  src="'.get_template_directory_uri().'/lib/images/masman.png" alt="masman" width="100" height="100" />';
										}
										echo '<div class="avatar_image writer_icon ">' .$avatar_image .'</div>';
										?>

										<?php
										// 										echo $author_link;
										echo '<span class="post_writer_name">';
										echo $author_name;
										echo '</span>';
										echo "</a>";
										?>
									</div>
									<div class="post_cat">

										<?php
										$cat_info=get_the_category();
										?>
										<?php if(FALSE): ?>
										<div class="cat_name">

											<a 
											   href= "<?php echo $cat_info[0]->slug;?> "
											   >

												<?php echo $cat_info[0]->cat_name;?>												

											</a>
										</div>
										<?php endif;?>
 										<?php //echo  getPostViews(get_the_ID()); ?>											
										<?php if(TRUE): ?>
										<a
										   href= " <?php echo $cat_info[0]->slug; ?>  " 
										   class="cat_info"
										   >



											<?php  	$cat='category_'.$cat_info[0]->cat_ID;
											// 										   echo $cat;
											$catimg = get_field('category_icon_small',$cat);
											// 											echo $catimg;
											$img = wp_get_attachment_image_src($catimg, 'full');
											// 											echo $img[0];
											?>
											<img
												 src="<?php echo $img[0]; ?>"
												 class="cat_icon"
												 />
										</a>
										<?php endif ;?>

									</div>
								</div>
							</div>



						</div>

						<?php
						endwhile;
						endif ;?>
					</div>				</div>
				<?php endif; ?>
				<div class="top-section-wrap">
					<h2 class="top-section-title">
						団体の代表の方へ
					</h2>

					<div id="login_link" class="top-section">

						<?php if (is_user_logged_in()) : ?>
						<a href="<?php echo home_url('/')?>wp-admin/post-new.php" class="button_type2">
							<p style="display:inline" class="button_type2_text">
								記事投稿はこちら
							</p>
							<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/login.png' . '"  alt="thumbnail"  class="attachment-top-page  left-aligned size-top-page  left-aligned wp-post-image button_type2_icon upper_layer" style="display:inline">'; ?>
							<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/login_white_trans.png' . '"  alt="thumbnail"  class="attachment-top-page  left-aligned size-top-page  left-aligned wp-post-image button_type2_icon under_layer" style="display:inline">'; ?>
						</a>

						<?php else : ?>

						<a href="<?php echo home_url('/')?>wp-login.php" class="button_type2">
							<p style="display:inline" class="button_type2_text">
								ログインはこちら
							</p>
							<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/login.png' . '"  alt="thumbnail"  class="attachment-top-page  left-aligned size-top-page  left-aligned wp-post-image button_type2_icon upper_layer" style="display:inline">'; ?>
							<?php echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/login_white_trans.png' . '"  alt="thumbnail"  class="attachment-top-page  left-aligned size-top-page  left-aligned wp-post-image button_type2_icon under_layer" style="display:inline">'; ?>
						</a>

						<?php endif; ?>
					</div>
				</div>

			</div><!-- /main-inner -->

		</div><!-- /main -->


	</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>
