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
                <div class="widget-top-left">
                    <?php if ( is_active_sidebar( 'hometopleft' ) ) : ?>
                        <?php dynamic_sidebar( 'hometopleft' ); ?>
                    <?php endif; ?>
                </div>
                <div class="widget-top-right">
                    <?php if ( is_active_sidebar( 'hometopright' ) ) : ?>
                        <?php dynamic_sidebar( 'hometopright' ); ?>
                    <?php endif; ?>
                </div>
                <div class="widget-bottom">
                    <?php if ( is_active_sidebar( 'homebottom' ) ) : ?>
                        <?php dynamic_sidebar( 'homebottom' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>