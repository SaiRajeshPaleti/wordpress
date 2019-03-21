<?php
/**
 * salessite2 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package salessite2
 */

if ( ! function_exists( 'salessite2_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function salessite2_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on salessite2, use a find and replace
		 * to change 'salessite2' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'salessite2', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'salessite2' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'salessite2_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'salessite2_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function salessite2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'salessite2_content_width', 640 );
}
add_action( 'after_setup_theme', 'salessite2_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function salessite2_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'salessite2' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'salessite2' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'salessite2_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function salessite2_scripts() {
	wp_enqueue_style( 'salessite2-style', get_stylesheet_uri() );

	wp_enqueue_script( 'salessite2-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'salessite2-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'salessite2_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



?>



<!--Main Menu -->

<?php
function register_my_menuuu() {
  register_nav_menu('main-menu',__( 'Main menu' ));
}
add_action( 'init', 'register_my_menuuu' );

?>


<?php

function get_menu() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('main-menu');
}

add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/menu', array(
        'methods' => 'GET',
        'callback' => 'get_menu',
    ) );
} );

?>

<!-- End of Main Menu-->







<!--Hero Banner API Call--> 


<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/herobanner', array(
        
		
		'methods' => 'GET',
        'callback' => 'herobanner'
    ) );
} );
?>
<?php

function herobanner() {
    //$filter = $request->get_param( 'filter' );
    $data   = array();
	
//$data1=array();
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'ct',
    );

    //if ( is_array( $filter ) && array_key_exists( 'category', $filter ) ) {
     //   $args['category_name'] = $filter['category'];
    //}

    $files = get_posts( $args );

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {
		//$d=get_post($post->ID);
		
            $acf = get_fields( $post->ID );
			
			
            if ( ! empty( $acf ) ) {
               $data[] = array_merge($acf);
				
			//$data[]=$d;
				
            }
        }
    }

   
return $data;
}
?>

<!--End of Hero Banner API Call--> 



<!--POC Testing to display html tags in json-->

<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/poc', array(
        
		
		'methods' => 'GET',
        'callback' => 'poc'
    ) );
} );
?>
<?php

function poc() {
    //$filter = $request->get_param( 'filter' );
    $data   = array();
//$content=array();
	
	  $page = get_page_by_title( 'poc' );
//$g = get_post($page->ID); 
//$content[] = $g->post_content;
//$content=array_map("htmlspecialchars_decode", $content);
    $field= get_fields($page->ID);
$field=array_map("htmlspecialchars_decode", $field); 
//$field = str_replace('\n', '', $field);
$val = array("\n","\r");
$field = str_replace($val, "", $field);
    $data[]=array_merge($field);
//$v= str_replace('\n', '', $data);
      
return $data;
}
?>

<!--End of POC Testing to display html tags in json-->




<!-- Home Carousel API-->

<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/HomeCarousel', array(
        
		
		'methods' => 'GET',
        'callback' => 'homecarousel'
    ) );
} );
?>
<?php

function homecarousel() {
   
    $data   = array();
	

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'carousel_titles',
    );

    

    $files = get_posts( $args );
	

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {
		
		
            $acf = get_fields( $post->ID );
			
			
            if ( ! empty( $acf ) && $acf['page_location']=='Home' ) {
               $data[] = $acf;
				
			
				
            }
        }
    }

   
return $data;
}
?>

<!--End of Home Carousel API-->


<!--Browse in all category custom fields-->

<?php 
function browselink(){
$data=array();

    $args = array(
      'orderby' => 'id',
      'hide_empty'=> 0,
	  'parent'=>4,
      
  );?>
  
<?php
 $categories = get_categories($args);
 
  foreach ($categories as $cat) {
  
  
 $fields['term_id']=$cat->term_id;
  $fields['name']=$cat->name;
  
 $link= get_fields($cat->taxonomy . '_' . $cat->term_id);     
 
    $data[] = array_merge($fields,$link);
  
	}
	return $data;
	}
	
	
	
	
?>
<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/browselink', array(
        
		
		'methods' => 'GET',
        'callback' => 'browselink'
    ) );
} );
?>	
<!--End Browse in all category custom fields-->





<!--disable category description box for homecarousel--> 

<?php
add_action( 'admin_footer-edit-tags.php', 'wpse_56569_remove_cat_tag_description' );

function wpse_56569_remove_cat_tag_description(){
    ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
$(document).ready(function() {
$("#parent").on('change', function () {
    var parent=$(this).val();
	if(parent==4)
	{
	$('#tag-description').parent().hide();
	}
	else{
	$('#tag-description').parent().show();
	
	}
	
});
 
});
</script>

    <?php
}

?>
<!-- End of disabling category description box for homecarousel-->


<!--Hiding description tag of categories whose parent is home carousel-->
<?php
add_action( "category_edit_form", function( $tag, $taxonomy )
{ 

 if($tag->parent==4){

    ?><style>#description,.description,[for="description"]{display:none;} 
	</style><?php
}}, 10, 2 );?>
<!-- End of Hiding description tag of categories whose parent is home carousel-->


<!--Scripted Interactive Hero--> 


<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/scripted', array(
        
		
		'methods' => 'GET',
        'callback' => 'scripted'
    ) );
} );
?>
<?php

function scripted() {
 
    $data   = array();
	

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'bannerslider',
    );

   

    $files = get_posts( $args );

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {

		
            $acf = get_fields( $post->ID );
			
			
            if ( ! empty( $acf ) && $acf['programetype']=='Scripted') {
               $data[] = array_merge($acf);
				
		
				
            }
        }
    }

   
return $data;
}
?>

<!--End of Hero Banner API Call--> 


<!--API for Description field and browse all field other than home carousel -->

<?php 
function description(){
$data=array();

    $args = array(
      'orderby' => 'id',
      'hide_empty'=> 0,
	  'parent'=>4,
      
  );?>
  
<?php
 $categories = get_categories($args);
 
  foreach ($categories as $cat) {
  

  $d=$cat->parent;
 $fields['term_id']=$cat->term_id;
  $fields['name']=$cat->name;
  $fields['description']=$cat->description;
 $link= get_fields($cat->taxonomy . '_' . $cat->term_id);     
 if($d!=4){
    $data[] = array_merge($fields,$link);
    }
	}
	return $data;
	}
	
	
	
	
?>
<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/description', array(
        
		
		'methods' => 'GET',
        'callback' => 'description'
    ) );
} );
?>	
<!--End Browse in all category custom fields-->






<!--API for Factual Page Category and description-->

<?php 
function factual(){
$data=array();

    $args = array(
      'orderby' => 'id',
      'hide_empty'=> 0,
	  'parent'=>25,
      
  );?>
  
<?php
 $categories = get_categories($args);
 
  foreach ($categories as $cat) {
 
 
 $fields['term_id']=$cat->term_id;
  $fields['name']=$cat->name;
  $fields['description']=$cat->description;
 $link= get_fields($cat->taxonomy . '_' . $cat->term_id);     

    $data[] = array_merge($fields,$link);
  
	}
	return $data;
	}
	
	
	
	
?>
<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/factual', array(
        
		
		'methods' => 'GET',
        'callback' => 'factual'
    ) );
} );
?>	
<!--End of Factual Page Category and description-->


<!--Format Interactive Hero--> 


<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/format', array(
        
		
		'methods' => 'GET',
        'callback' => 'format'
    ) );
} );
?>
<?php

function format() {
   
    $data   = array();
	$sample1=array();

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'bannerslider',
    );

   

    $files = get_posts( $args );

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {
	D);
		
            $acf = get_fields( $post->ID );
			
			
            if ( ! empty( $acf ) && $acf['programetype']=='Formats') {
               $data[] = ($acf);
			   $sample['t']=$data;
			   
			  foreach($sample['t'] as $e){
			   $q['a']=$e;
			   }
			  $sample1[]=$q;
			   $gg['t']=$sample1;
			
            }
        }
    }

   
return $gg;
}
?>

<!--End of Hero Banner API Call--> 


<!--Carousel API-->

<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/homecarousel1/(?P<type>[\w-]+)', array(
        
		
		'methods' => 'GET',
        'callback' => 'homecarousel1'
    ) );
} );
?>
<?php

function homecarousel1(WP_REST_Request $request) {
   
    
	$id    = $request['type'];

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'carousel_titles',
		 'meta_key' => 'page_location',
         'meta_value' => $id

    );

    $files = get_posts( $args );
	

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {
            $acf = get_fields( $post->ID );
			 $acf     = array_map("htmlspecialchars_decode", $acf);
			$details[]=$acf;		
			
        }
    }

   
return $details;
}
?>

<!--End of Carousel API-->

<!--You May Be Interestedin-->

<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/interestedin/(?P<type>[\w-]+)', array(
        
		
		'methods' => 'GET',
        'callback' => 'interestedin'
    ) );
} );
?>
<?php

function interestedin(WP_REST_Request $request) {
   
    
	$id    = $request['type'];

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'interestedin',
		 'meta_key' => 'page_location',
         'meta_value' => $id

    );

    $files = get_posts( $args );
	

    if ( ! empty( $files ) ) {
        foreach( $files as $post ) {
            $acf = get_fields( $post->ID );
			 $acf     = array_map("htmlspecialchars_decode", $acf);
			$details[]=$acf;		
			
        }
    }

   
return $details;
}
?>

<!--End You May Be Interestedin-->



<!-- Taxnomy-->
<?php 

function carouseltaxonomy(){

$args = array(
        'taxonomy' => 'scriptedcarousels',
         'orderby' => 'id',
          'hide_empty'=> 0,
    );
$terms = get_terms($args);
if ( ! empty( $terms ) ) {
        foreach( $terms as $post ) 
		
		{
 $fields['term_id']=$post->term_id;
  $fields['name']=$post->name;
  $fields['description']=$post->description;
 $link= get_fields($post);     

    $data[] = array_merge($fields,$link);
  
	}
	return $data;
        }
    }


?>

<?php
add_action( 'rest_api_init', function () {
        register_rest_route( 'wp/v2', '/carouseltaxonomy', array(
        
		
		'methods' => 'GET',
        'callback' => 'carouseltaxonomy'
    ) );
} );

?>	
<!-- Taxnomy-->
