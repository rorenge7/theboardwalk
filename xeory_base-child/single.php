<?php get_header(); ?>

<div id="content">

	<div class="wrap">

		<?php bzb_breadcrumb(); ?>
		<div id="main" <?php bzb_layout_main(); ?> role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<div class="main-inner">

				<?php
				if ( have_posts() ) :

				while ( have_posts() ) : the_post();
				?>

				<?php 
				global $post;
				$cf = get_post_meta($post->ID);
				?>
				<article id="post-<?php the_id(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

					<header class="post-header">
						<ul class="post-meta list-inline">
							<li class="date updated" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
						</ul>
						<h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
						<div class="post-header-meta">
							<?php bzb_social_buttons();?>
						</div>
					</header>

					<section class="post-content" itemprop="text">

						<?php if( get_the_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
						<?php the_content(); ?>
					</section>
					<footer class="post-footer">

						<h4 class="post-share-title recruitment">サークルへの応募はこちら！</h4>

						<?php if(  is_active_sidebar('under_post_area') ){
	dynamic_sidebar('under_post_area');
} ?>

						<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


						<?php bzb_social_buttons();?>

						<ul class="post-footer-list">
							<li class="cat"><i class="fa fa-folder"></i> <?php the_category(', ');?></li>
							<?php 
							$posttags = get_the_tags();
							if($posttags){ ?>
							<li class="tag"><i class="fa fa-tag"></i> <?php the_tags('');?></li>
							<?php } ?>
						</ul>
					</footer>

					<?php echo bzb_get_cta($post->ID); ?>

					<div class="post-share">

						<?php
						//       $twitter_from_db = "https://twitter.com/" . esc_html(get_option('twitter_id'));
						//       $feedly_url = "http://cloud.feedly.com/#subscription%2Ffeed%2F" . urlencode(get_bloginfo('rss2_url'));
						?>

						<!--         <aside class="post-sns"> -->
						<!--           <ul> -->
						<!--             <li class="post-sns-twitter"><a href="<?php echo $twitter_from_db;?>"><span>Twitter</span>でフォローする</a></li> -->
						<!--             <li class="post-sns-feedly"><a href="<?php echo $feedly_url;?>"><span>Feedly</span>でフォローする</a></li> -->
						<!--           </ul> -->
						<!--         </aside> -->
						<?php //bzb_show_avatar();?>
						<?php 
						global $user_id;
						$original_avatar = get_the_author_meta('original_avatar', $user_id);
						$avatar_image = '';
						$author_login=get_the_author_meta("user_login");
						$author_link_src="". get_bloginfo('url')."/author/".$author_login;

						if( isset($original_avatar) && $original_avatar !== '' ){
							$avatar_image = '<img src="'.$original_avatar .'" alt="アバター">';
						}else{
							$avatar_image = '<img src="'.get_template_directory_uri().'/lib/images/masman.png" alt="masman" width="100" height="100" />';
						}

						$author_meta_name = get_the_author_meta('display_name');
						$googleplus = get_the_author_meta('googleplus');
						$disp_author_description = get_the_author_meta('description');

						$disp_avatar =<<<eof
							<aside class="post-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
							<div class="clearfix">
							<div class="post-author-img">
							<div class="inner">
														<a href="{$author_link_src}">
						{$avatar_image}
						</a>
						</div>
							</div>
							<div class="post-author-meta">
							<h4 itemprop="name" class="author vcard author">{$author_meta_name}</h4>
							<p>{$disp_author_description}</p>
							</div>
							</div>
							</aside>
eof;

						echo $disp_avatar;
						?>
						<aside class="post_cat">
							<div>
								<div class="post_cat_img">
									<div class="inner">

										<?php 
										$cat=get_the_category();
										$post_id = 'category_' . $cat[0] -> cat_ID;
										// 						echo $post_id;
										//アイコンのソース取得
										$attachment_id=get_field('category_icon_small',$post_id);
										$icon_src = wp_get_attachment_image($attachment_id,'full',false,array('class'=> 'cat_icon'));
										echo '<a href="'.$cat_link.'" class="category_item">';

										if($icon_src == ""){
											echo '<img src="' . get_bloginfo('url') . '/wp-content/uploads/common/default.png' . '"  alt="thumbnail"  class="post_img post-loop-wrap post-thumbnail  left-aligned"/>';
										}else{
											echo $icon_src; 
										}
										echo '</a>';
										?>
									</div><!-- /inner-->

								</div><!-- /post_cat_img-->

								<div class="post_cat_meta">
									<h4 itemprop="name" class="author vcard author"><?php echo $cat[0] -> name; ?></h4>
									<p class="cat_description"><?php echo $cat[0] -> description; ?></p>
								</div><!-- /post_cat_meta -->
							</div>

						</aside><!-- post_cat -->

					</div>

					<?php comments_template( '', true ); ?>

				</article>


				<?php

				endwhile;

				else :
				?>

				<p>投稿が見つかりません。</p>

				<?php
				endif;
				?>


			</div><!-- /main-inner -->
		</div><!-- /main -->

		<?php get_sidebar(); ?>

	</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>


