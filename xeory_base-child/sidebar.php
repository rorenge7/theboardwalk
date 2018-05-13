<div id="side" <?php bzb_layout_side(); ?> role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<div class="side-inner">
		<div class="side-widget-area">

			<?php
			if( FALSE ):
			// 			if( dynamic_sidebar('sidebar') ):
			dynamic_sidebar();
			else:
			?>
			<?php if(is_category()){
//	$category=get_the_category()[0];
	$category=get_query_var('cat'); 
	// 	echo $category->name;
	
	if(get_twitter_ID($category)!=""){
			?>
			<div id="twi-posts-3" class="widget_twi side-widget">
				<div class="side-widget-inner">
					<a class="twitter-timeline" data-width="649" data-height="480" href="https://twitter.com/<?php echo get_twitter_ID($category)?>?ref_src=twsrc%5Etfw" style='max-width="440px" max-height="960px"'>Tweets by <?php echo$category->name; ?></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
			<?php 
	}
}?>


			<div id="hot-posts-3" class="widget_hot_entries side-widget">
				<div class="side-widget-inner">
					<?php
					// views post metaで記事のPV情報を取得する
					setPostViews(get_the_ID());
					?>
					<h4 class="side-title"><span class="widget-title-inner">人気の投稿</span></h4>
					<ul>
						<?php
						// ループ開始
						query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=5&order=DESC'); while(have_posts()) : the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<div class="side_content">

									<!-- サムネイルの表示 -->
									<div class="col-sm-4 col-xs-4 side_content_thumbnail_wrap">

										<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-thumbnail', array('class' => 'side_content_thumbnail')); } ?>
									</div>

									<!-- タイトルの表示 -->
									<div class="col-sm-8 col-xs-8 side_content_title_wrap">
										<p class="side_content_title">
											<?php
											$side_content_title_str=get_the_title();
											echo $side_content_title_str;
											// 										echo str_replace('class="','class="side_content_title "',$side_content_title_str);
											?>
										</p>
										<p class="side_content_PV">
											<?php echo  getPostViews(get_the_ID()); ?>											
										</p>
									</div>
								</div>
							</a>
						</li>
						<?php endwhile;
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>



			<?php
			$args = array(
				'post_type' => 'post',
				'post_count' => 5
			);
			// クエリ
			$the_query = new WP_Query( $args );
			?>
			<div id="recent-posts-3" class="widget_recent_entries side-widget">
				<div class="side-widget-inner">
					<h4 class="side-title"><span class="widget-title-inner">最新の投稿</span></h4>
					<ul>
						<?php
						// ループ

						while ( $the_query->have_posts() ) : $the_query->the_post();?>
						<li>
							<a href="<?php echo get_post_permalink() ?>">
								<div class="side_content">
									<div class="side_content_thumbnail_wrap">
										<?php if ( has_post_thumbnail() ) :
							   the_post_thumbnail( 'post-thumbnail',array('class'=>'side_content_thumbnail'));
							   endif;
										?>
									</div>
									<div class="side_content_title_wrap">
										<p class="side_content_title">

											<?php
											$side_content_title_str = get_the_title();
											echo $side_content_title_str;
											// 									echo str_replace('class="','class="side_content_title "',$side_content_title_str);
											?>
										</p>
									</div>
								</div>
							</a>
						</li>
						<?php
						endwhile;
						?>
					</ul>
				</div>
			</div>
			<?php

			wp_reset_postdata();
			?>
			<div id="recent-posts-3" class="widget_categories side-widget">
				<div class="side-widget-inner">
					<h4 class="side-title"><span class="widget-title-inner">団体</span></h4>
					<ul>
						<?php
						//一番親階層のカテゴリをすべて取得
						$categories = get_categories('parent=0');
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

						?>
						<li>
							<a href="<?php echo  get_category_link($val->cat_ID) ?>">
								<div class="side_content">
									<div class="side_content_thumbnail_wrap">
										<?php
							if($icon_src == ""){
								echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/default.png' . '"  alt="thumbnail"  class="side_content_thumbnail post_img post-loop-wrap post-thumbnail  left-aligned"/>';
							}else{
								echo str_replace('class="', 'class="side_content_thumbnail ',$icon_src);
							}
										?>
									</div>
									<div class="side_content_title_wrap">
										<p class="side_content_title">

											<?php
							echo $val -> name ;
							//echo str_replace('class="','class="side_content_title "',$side_content_title_str);
											?>
										</p>
									</div>
								</div>

							</a>
						</li>
						<?php } ?>

					</ul>
				</div>
			</div>
			<div>
				<div id="search-box" class="widget_box side-widget">
					<div class="side-widget-inner">
						<h4 class="side-title"><span class="widget-title-inner">検索</span></h4>
						<div class="search_wrap">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div><!-- //side-widget-area -->
	</div>
</div><!-- /side -->
