<div id="secondary">
<?php 
if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
        <div id="left-sidebar" class="widget-area">    
            <ul class="sidebar">  
                <?php dynamic_sidebar( 'left-sidebar' ); ?> 
            </ul>     
        </div> 
<?php endif; ?>

</div>