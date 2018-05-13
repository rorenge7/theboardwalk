<?php get_header(); ?>

<?php
global $wp_query;
$total_results = $wp_query->found_posts;
$search_query = get_search_query();
?>
<div id="content">
	<div class="wrap">
		<div id="main">
			<div class="main-inner" >


				<div class="post-loop-wrap">


					<section class="cat-content">
						<header class="cat-header">
							<h1 class="post-title"><?php bzb_title(); ?></h1>
						</header>
						<?php if (!empty($user->description)) { ?>
						<div class="cat-content-area">
							<p><?php echo $user->description; ?></p>
						</div>
						<?php } ?>
					</section>

					<?php $userId = get_query_var('author'); ?>
					<?php $user = get_userdata($userId); ?>
					<h1><?php echo $search_query; ?>の検索結果<span>（<?php echo $total_results; ?>件）</span></h1>
					<?php
					if( $total_results >0 ):
					if(have_posts()):
					while(have_posts()): the_post();
					?>

					<ul> 
						<article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

							<header class="post-header">
								<ul class="post-meta list-inline">
									<li class="date updated" itemprop="datePublished" datetime="<?php the_time('c');?>"><i class="fa fa-clock-o"></i> <?php the_time('Y.m.d');?></li>
								</ul>
								<h2 class="post-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</header>

							<section class="post-content" itemprop="text">

								<?php if( get_the_post_thumbnail() ) { ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail(); ?></a>
								</div>
								<?php } ?>      

								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="more-link" rel="nofollow">続きを読む</a>
							</section>
						</article>
					</ul>
					<?php endwhile; endif; else: ?>
					<?php echo $search_query; ?> に一致する情報は見つかりませんでした。
					<?php endif; ?>
						<?php wp_reset_postdata(); ?>

				</div>
			</div><!-- /main-inner -->
		</div><!-- /main -->

		<?php get_sidebar(); ?>

	</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>