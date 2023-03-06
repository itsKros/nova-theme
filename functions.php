<?php

/**
 * Nova Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nova_Theme
 */

require_once get_template_directory() . '/inc/NovaThemeBase.php';

require_once( get_template_directory() . '/inc/framework/redux-framework.php' );
if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/inc/framework/redux-core/framework.php' ) ) {
    require_once( get_template_directory() . '/inc/framework/redux-core/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/inc/framework/sample/config.php' ) ) {
    require_once( get_template_directory() . '/inc/framework/sample/config.php' );
}

function um_remove_custom_css(){
    remove_action( 'wp_head' , 'nova_theme-dynamic-css' );
}
add_action( 'wp_head' , 'um_remove_custom_css' , 1 );



class NovaThemeEcommerce {
	public $plugin_file=__FILE__;
	public $responseObj;
	public $licenseMessage;
	public $showMessage=false;
	public $slug="nova-theme";
	function __construct() {
		add_action( 'admin_print_styles', [ $this, 'SetAdminStyle' ] );
		$licenseKey=get_option("NovaThemeEcommerce_lic_Key","");
		$liceEmail=get_option( "NovaThemeEcommerce_lic_email","");
		$templateDir=get_stylesheet_directory(); //or dirname(__FILE__);
		if(NovaThemeEcommerceBase::CheckWPPlugin($licenseKey,$liceEmail,$this->licenseMessage,$this->responseObj,$templateDir."/style.css")){
			add_action( 'admin_menu', [$this,'ActiveAdminMenu'],99999);
			add_action( 'admin_post_NovaThemeEcommerce_el_deactivate_license', [ $this, 'action_deactivate_license' ] );
			//$this->licenselMessage=$this->mess;
			require get_template_directory() . '/inc/tgmp/required-plugins.php';
            require get_template_directory() . '/inc/layout/layout.php';

		}else{
			if(!empty($licenseKey) && !empty($this->licenseMessage)){
				$this->showMessage=true;
			}
			update_option("NovaThemeEcommerce_lic_Key","") || add_option("NovaThemeEcommerce_lic_Key","");
			add_action( 'admin_post_NovaThemeEcommerce_el_activate_license', [ $this, 'action_activate_license' ] );
			add_action( 'admin_menu', [$this,'InactiveMenu']);
		}
        }
	function SetAdminStyle() {
		wp_register_style( "NovaThemeEcommerceLic", get_theme_file_uri("_lic_style.css"),10);
		wp_enqueue_style( "NovaThemeEcommerceLic" );
	}
	function ActiveAdminMenu(){
		 
		add_menu_page (  "NovaThemeEcommerce", "Nova Theme Ecommerce", "activate_plugins", $this->slug, [$this,"Activated"], " dashicons-star-filled ");
		//add_submenu_page(  $this->slug, "NovaThemeEcommerce License", "License Info", "activate_plugins",  $this->slug."_license", [$this,"Activated"] );

	}
	function InactiveMenu() {
		add_menu_page( "NovaThemeEcommerce", "Nova Theme Ecommerce", 'activate_plugins', $this->slug,  [$this,"LicenseForm"], " dashicons-star-filled " );
		
	}
	function action_activate_license(){
		check_admin_referer( 'el-license' );
		$licenseKey=!empty($_POST['el_license_key'])?$_POST['el_license_key']:"";
		$licenseEmail=!empty($_POST['el_license_email'])?$_POST['el_license_email']:"";
		update_option("NovaThemeEcommerce_lic_Key",$licenseKey) || add_option("NovaThemeEcommerce_lic_Key",$licenseKey);
		update_option("NovaThemeEcommerce_lic_email",$licenseEmail) || add_option("NovaThemeEcommerce_lic_email",$licenseEmail);
		update_option('_site_transient_update_themes','');
		wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
	}
	function action_deactivate_license() {
		check_admin_referer( 'el-license' );
		$message="";
		if(NovaThemeEcommerceBase::RemoveLicenseKey(__FILE__,$message)){
			update_option("NovaThemeEcommerce_lic_Key","") || add_option("NovaThemeEcommerce_lic_Key","");
			update_option('_site_transient_update_themes','');
		}
    	wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
    }
	function Activated(){
		?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="NovaThemeEcommerce_el_deactivate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php _e("Nova Theme Ecommerce License Info",$this->slug);?> </h3>
                <hr>
                <ul class="el-license-info">
                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Status",$this->slug);?></span>

                        <?php if ( $this->responseObj->is_valid ) : ?>
                            <span class="el-license-valid"><?php _e("Valid",$this->slug);?></span>
                        <?php else : ?>
                            <span class="el-license-valid"><?php _e("Invalid",$this->slug);?></span>
                        <?php endif; ?>
                    </div>
                </li>

                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("License Type",$this->slug);?></span>
                        <?php echo $this->responseObj->license_title; ?>
                    </div>
                </li>

               <li>
                   <div>
                       <span class="el-license-info-title"><?php _e("License Expired on",$this->slug);?></span>
                       <?php echo $this->responseObj->expire_date;
                       if(!empty($this->responseObj->expire_renew_link)){
                           ?>
                           <a target="_blank" class="el-blue-btn" href="<?php echo $this->responseObj->expire_renew_link; ?>">Renew</a>
                           <?php
                       }
                       ?>
                   </div>
               </li>

               <li>
                   <div>
                       <span class="el-license-info-title"><?php _e("Support Expired on",$this->slug);?></span>
                       <?php
                           echo $this->responseObj->support_end;
                        if(!empty($this->responseObj->support_renew_link)){
                            ?>
                               <a target="_blank" class="el-blue-btn" href="<?php echo $this->responseObj->support_renew_link; ?>">Renew</a>
                            <?php
                        }
                       ?>
                   </div>
               </li>
                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Your License Key",$this->slug);?></span>
                        <span class="el-license-key"><?php echo esc_attr( substr($this->responseObj->license_key,0,9)."XXXXXXXX-XXXXXXXX".substr($this->responseObj->license_key,-9) ); ?></span>
                    </div>
                </li>
                </ul>
                <div class="el-license-active-btn">
                    <?php wp_nonce_field( 'el-license' ); ?>
                    <?php submit_button('Deactivate'); ?>
                </div>
            </div>
        </form>
		<?php
	}
	
	function LicenseForm() {
		?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="NovaThemeEcommerce_el_activate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php _e("Nova Theme Ecommerce Theme Licensing",$this->slug);?></h3>
                <hr>
				<?php
					if(!empty($this->showMessage) && !empty($this->licenseMessage)){
						?>
                        <div class="notice notice-error is-dismissible">
                            <p><?php echo $this->licenseMessage; ?></p>
                        </div>
						<?php
					}
				?>
                <p><?php _e("Enter your license key here, to activate the product, and get full feature updates and premium support.",$this->slug);?></p>
<ol>
    <li><?php _e("Write your licnese key details",$this->slug);?></li>
    <li><?php _e("How buyer will get this license key?",$this->slug);?></li>
    <li><?php _e("Describe other info about licensing if required",$this->slug);?></li>
    <li>. ...</li>
</ol>
    		    <div class="el-license-field">
    			    <label for="el_license_key"><?php _e("License code",$this->slug);?></label>
    			    <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
    		    </div>
                <div class="el-license-field">
                    <label for="el_license_key"><?php _e("Email Address",$this->slug);?></label>
                    <?php
                        $purchaseEmail   = get_option( "NovaThemeEcommerce_lic_email", get_bloginfo( 'admin_email' ));
                    ?>
                    <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo $purchaseEmail; ?>" placeholder="" required="required">
                    <div><small><?php _e("We will send update news of this product by this email address, don't worry, we hate spam",$this->slug);?></small></div>
                </div>
                <div class="el-license-active-btn">
					<?php wp_nonce_field( 'el-license' ); ?>
					<?php submit_button('Activate'); ?>
                </div>
            </div>
        </form>
		<?php
	}
}

new NovaThemeEcommerce();


if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nova_theme_setup() {
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Nova Theme, use a find and replace
        * to change 'nova-theme' to the name of your theme in all the template files.
        */
    load_theme_textdomain( 'nova-theme', get_template_directory() . '/languages' );

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
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'nova-theme' ),
        )
    );

    /*Navigation Menus*/
    function register_nova_menu() {
        register_nav_menu('header-menu',__( 'Header Menu', 'nova-theme' ));
    }
    add_action( 'init', 'register_nova_menu' );

    /**
     * Register Custom Navigation Walker
     */
    // Register custom navigation walker
    require_once('inc/class-wp-bootstrap-navwalker.php');


    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'nova_theme_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action( 'after_setup_theme', 'nova_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nova_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'nova_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'nova_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nova_theme_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'nova-theme' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'nova-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Shop Sidebar', 'nova-theme' ),
            'id'            => 'shop-sidebar',
            'description'   => esc_html__( 'Add widgets here.', 'nova-theme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'nova_theme_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function nova_theme_scripts() {
    wp_enqueue_style( 'nova-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'nova-theme-style', 'rtl', 'replace' );
    
    wp_enqueue_style( 'nova-theme-main-style', get_template_directory_uri() . '/inc/assets/bootstrap.min.css', array(), _S_VERSION );
    wp_style_add_data( 'nova-theme-main-style', 'rtl', 'replace' );

    wp_enqueue_style( 'nova-theme-base-style', get_template_directory_uri() . '/inc/assets/base.css', array(), _S_VERSION );
    wp_style_add_data( 'nova-theme-base-style', 'rtl', 'replace' );

    wp_enqueue_script( 'nova-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'nova-theme-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), _S_VERSION, false );

    
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nova_theme_scripts' );



// add bootstrap classes to checkout page
add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );
function addBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}



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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

function nt_add_woocommerce_support() {


    add_theme_support( 'woocommerce' );
    
    add_theme_support( 'woocommerce', array(


        'thumbnail_image_width' => 255,
        'single_image_width'	=> 255,
        'product_grid' 			=> array(
            'default_rows'          => 10,
            'min_rows'              => 5,
            'max_rows'              => 10,
            'default_columns'       => 1,
            'min_columns'           => 1,
            'max_columns'           => 3,	
        )


    ) );

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    if ( ! isset( $content_width ) ) {
        $content_width = 600;
    }	
    
}
add_action( 'after_setup_theme', 'nt_add_woocommerce_support' );


