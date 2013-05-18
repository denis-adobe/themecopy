<?php 

//Navigationsmenus erstellen und initialisieren
add_action ('init', 'register_my_menus');

function register_my_menus() {

  register_nav_menus(

   array( 'header-menu' => __( 'Header Menu' ),

          'extra-menu' => __( 'Extra Menu' ),

			 'footer-menu' => __( 'Footer Menu' ))

  );

}


// Widgets-Sidebars erstellen/initialisieren
function firsttec_widgets_init() {
  register_sidebar( array(    
  'name' => __( 'Left Hand Sidebar' ),
  'id' => 'left-sidebar',
  'description' => __( 'Widgets in this area will be shown on the left-hand side.' ),
  'before_title' => '<h1>',
  'after_title' => '</h1>'
) );
  
}
add_action( 'widgets_init', 'firsttec_widgets_init' );









// check ID post and child-post
function has_parent( $post, $post_id ) {
	if ($post->ID == $post_id)
		return true;
	elseif ($post->post_parent == 0)
		return false;
	else
		return has_parent( get_post($post->post_parent), $post_id );
}




//require_once ( get_stylesheet_directory() . '/menu.php' );




//Themeoptions Page erstelle/Initialisieren

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

// Einstellungen registrieren (http://codex.wordpress.org/Function_Reference/register_setting)
function theme_options_init(){
	register_setting( 'kb_options', 'kb_theme_options', 'kb_validate_options' );
}

// Seite in der Dashboard-Navigation erstellen
function theme_options_add_page() {
	add_theme_page('Optionen', 'Optionen', 'edit_theme_options', 'theme-optionen', 'kb_theme_options_page' ); // Seitentitel, Titel in der Navi, Berechtigung zum Editieren (http://codex.wordpress.org/Roles_and_Capabilities) , Slug, Funktion 
}

// Optionen-Seite erstellen
function kb_theme_options_page() {
global $select_options, $radio_options;
if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false; ?>

<div class="wrap"> 
<?php screen_icon(); ?><h2>Theme-Optionen für <?php bloginfo('name'); ?></h2> 

<?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
<div class="updated fade">
	<p><strong>Einstellungen gespeichert!</strong></p>
</div>
<?php endif; ?>

  <form method="post" action="options.php">
	<?php settings_fields( 'kb_options' ); ?>
    <?php $options = get_option( 'kb_theme_options' ); ?>

    <table class="form-table">
      <tr valign="top">
        <th scope="row">Copyright</th>
        <td><input id="kb_theme_options[copyright]" class="regular-text" type="text" name="kb_theme_options[copyright]" value="<?php esc_attr_e( $options['copyright'] ); ?>" /></td>
      </tr>  
      <tr valign="top">
        <th scope="row">Google Analytics</th>
        <td><textarea id="kb_theme_options[analytics]" class="large-text" cols="50" rows="10" name="kb_theme_options[analytics]"><?php echo esc_textarea( $options['analytics'] ); ?></textarea></td>
      </tr>
    </table>
    
    <!-- submit -->
    <p class="submit"><input type="submit" class="button-primary" value="Einstellungen speichern" /></p>
  </form>
</div>
<?php }

// Strip HTML-Code:
// Hier kann definiert werden, ob HTML-Code in einem Eingabefeld 
// automatisch entfernt werden soll. Soll beispielsweise im 
// Copyright-Feld KEIN HTML-Code erlaubt werden, kommentiert die Zeile 
// unten wieder ein. http://codex.wordpress.org/Function_Reference/wp_filter_nohtml_kses
function kb_validate_options( $input ) {
	// $input['copyright'] = wp_filter_nohtml_kses( $input['copyright'] );
	return $input;
}



?>