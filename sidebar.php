<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="left-sidebar">
    <?php if ( is_active_sidebar( 'sidebarmain' ) ) : ?>
            <?php dynamic_sidebar( 'sidebarmain' ); ?>
    <?php endif; ?>
</div>