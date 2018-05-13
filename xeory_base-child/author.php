<?php get_header(); ?>

<div id="content">
	<div class="wrap">
		<div id="main">
			<div class="main-inner" >


				<div class="post-loop-wrap">

					<?php $userId = get_query_var('author'); ?>
					<?php $user = get_userdata($userId); ?>
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

					
					<?php //<h1>?>
					<?php //echo $user->display_name; ?>
					<?php //<span> の投稿一覧</span></h1>?>
					

					<?php $posts = get_posts("author=$userId&orderby=date&post_type=post&numberposts=1000"); ?>
					<?php if (!empty($posts)) { 
	// 					if ( have_posts() ) :
	// 					while ( have_posts() ) : the_post();
					?>
					<ul> 
						<?php foreach( $posts as $post ) : setup_postdata($post); ?>
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
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
					<?php } ?>
				</div>
			</div><!-- /main-inner -->
		</div><!-- /main -->

		<?php get_sidebar(); ?>

	</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>