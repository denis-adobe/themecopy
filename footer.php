</div><!--#main-->
<div class="clear"></div>
<footer id="foot">
  
  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?><div class="clear"></div>
  <?php
 $options = get_option('kb_theme_options');
 echo $options['copyright'];
 echo $options['analytics'];
?>

</footer>
</body>
</html>