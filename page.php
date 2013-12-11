<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php get_header(); ?>
<div class="page">
    <div class="container">
        <?php get_sidebar(); ?>
        <div class="content">
            <div class="data">
                <?php while ( have_posts() ) : the_post(); ?>
		<strong id="title"><h1><?php the_title(); ?></h1></strong>
                <hr/>
                <?php if ( has_post_thumbnail() ): ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endif ?>
		<div id="textpreview"><?php the_content(); ?></div>
		<?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
