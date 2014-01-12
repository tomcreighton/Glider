<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php echo get_bloginfo('name'); ?></title>

<link href='http://fonts.googleapis.com/css?family=Alegreya:400italic,700italic,400,700' rel='stylesheet' type='text/css'>


<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />

<script>
	if(window.location.hash) {
		var hash = window.location.hash;
		var hashtourl = hash.substring(2)
		window.location.href = "/"+hashtourl;
	}
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="shift" id="goarchive">&rarr;</a>
<a class="shift" id="gopost">&larr;</a>


<ul id="content">
	<li id="post">

		<div class="content">
            <?php the_post(); $do_not_duplicate = get_the_ID(); ?>
            <!-- Top navigation bar -->
            <div id="hello">
                <nav>
                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </nav>
            </div>

            <h1><?php the_title(); ?></h1>
            <h3 class="subtitle"><?php echo get_bloginfo('description'); ?></h3>
            
            <?php the_content(); ?>
		</div>

		<div id="footer">
			<?php if ( dynamic_sidebar('footer') ) : else : endif; ?>
		</div>

	</li>

	<li id="archive">

		<div class="content">

			<ul>
				<?php
				$my_query = new WP_Query( array( "nopaging"=>true ) );
				while ($my_query->have_posts()) :
					$my_query->the_post();
				?>
					<li><h2><a rel="<?php the_permalink(); ?>" id="<?php the_id(); ?>" title="<?php echo( basename( get_permalink() ) ); ?>"><?php the_title(); ?></a></h2> <span><?php the_time('F j Y') ?></span></li>
				<?php endwhile; wp_reset_postdata(); ?>
			</ul>

		</div>

	</li>

</ul>



<script>
	$(document).ready(function () {
		// Cached DOM references
		var $goarchive = $('#goarchive'),
			$gopost = $('#gopost'),
			$archive = $('#archive'),
			$post = $('#post');

		function goarchive() {
			$goarchive.fadeOut(300);
			$post.hide('slide', {
				direction: 'left'
			}, 600, function () {
				$archive.scrollTop(0);
				$archive.show('slide', {
					direction: 'right'
				}, 600);
				$gopost.fadeIn(300);
			});
		};

		function gopost() {
			$gopost.fadeOut(300);
			$archive.hide('slide', {
				direction: 'right'
			}, 600, function () {
				$post.scrollTop(0);
				$post.show('slide', {
					direction: 'left'
				}, 600);
				$goarchive.fadeIn(300);
			});
		};

		function loadpost() {

			var perma = $(this).attr('rel'),
				postid = $(this).attr('id'),
				postitle = $(this).attr('title');

			$(this).parent().parent().addClass('loader');

			$post.load(perma + ' #post', function () {
				$gopost.fadeOut(300);
				$archive.hide('slide', {
					direction: 'right'
				}, 600, function () {
					$post.scrollTop(0);
					$goarchive.fadeIn(300);
					$post.show('slide', {
						direction: 'left'
					}, 600, function () {
						$('#' + postid).parent().parent().removeClass('loader');
						window.location.hash = '/' + postitle;
						if (typeof twttr != 'undefined') {
							twttr.widgets.load()
						}
					});
				});
			});
		}

		$goarchive.on('click',$goarchive,goarchive);

		$gopost.on('click',$gopost,gopost);

		$archive.find('a').on('click',$archive.find('a'),loadpost);


		/* arrow key navigation */

		$(document).keydown(function(ev) {
			if(ev.which === 39) {
				if ( $post.is(':visible') ) {
					goarchive();
				}
				return false;
			}

			if(ev.which === 37) {
				if ( $archive.is(':visible') ) {
					gopost();
				}
				return false;
			}
		});


	});

</script>

<?php wp_footer(); ?>

</body>
</html>
