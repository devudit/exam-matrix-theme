<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php 
    global $current_user;
    get_currentuserinfo();
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link href="<?php bloginfo('template_directory'); ?>/style.css" media="screen" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="wrapper">
        <div id="main">
            <!-- Header start -->
            <div class="header">
                <div class="container">
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" />
                        </a>
                    </div>
                        <?php
                            $defaults = array(
                                    'theme_location'  => 'top',
                                    'menu'            => '',
                                    'container'       => 'div',
                                    'container_class' => 'nav',
                                    'container_id'    => 'main_nav',
                                    'menu_class'      => 'nav',
                                    'menu_id'         => 'menu-header',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_page_menu',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth'           => 0,
                                    'walker'          => ''
                            );
                            wp_nav_menu( $defaults );
                        ?>
                    <?php if ( !is_user_logged_in() ) { ?>
                    <div class="user-login">
                        <form>
                            <input class="field" type="text" placeholder="User Name" />
                            <input class="field" type="password" placeholder="Password"/>
                            <input class="btngo" type="submit" value="GO" />
                        </form>
                    </div>
                    <?php } else { ?>
                    <ul class="nav user">
                        <li class="menu menu-base">
                          <a class="menu menu-a" href="#" onclick="return false;">
                            <div class="avatar">
                              <?php echo get_avatar( $current_user->user_email , 24 ); ?>
                            </div>
                            <span> <?php echo $current_user->user_firstname ?> <?php echo $current_user->user_lastname ?> </span>
                          </a>
                        </li>
                      </ul>
                    <?php } ?>
                </div>
            </div>
            <!-- Header ends -->
