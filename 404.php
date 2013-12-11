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
		<strong id="title"><h1><?php _e( 'Not found', 'emerico' ); ?></h1></strong>
                <hr/>
                <div class="text-content">
                    <?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'emerico' ); ?><br/>
                    <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'emerico' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
