
<?php
function lr_theme_enqueue_scripts() {
    wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'lr-style', get_stylesheet_directory_uri() . '/css/lrpoc.css');
    wp_enqueue_style( 'lr-font', 'https://fonts.googleapis.com/css?family=Raleway|Roboto+Condensed|Montserrat&display=swap');
    wp_enqueue_style('bootstrap-style','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css');
    //wp_enqueue_script( 'lr-script', get_stylesheet_directory_uri() . '/assets/js/lr.js');
    wp_enqueue_script( 'lr-script', 'https://code.jquery.com/jquery-3.4.1.min.js');
    wp_enqueue_script('bootstrap-js','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap-js','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_style('fontawesome-style','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
    //wp_enqueue_style('animate-style', get_stylesheet_directory_uri() . '/assets/css/animate.min.css');
    wp_enqueue_style('animate-css','https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css');
    //wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js');
    //wp_enqueue_script('jquery-js', get_stylesheet_directory_uri() . '/assets/js/jquery.js');
    wp_enqueue_script('scrollspy-js', 'https://gitcdn.xyz/repo/thesmart/jquery-scrollspy/0.1.3/scrollspy.js');
    //wp_enqueue_script('wow-js', get_stylesheet_directory_uri() . '/assets/js/wow.min.js');
    //wp_enqueue_script('scroll-js', get_stylesheet_directory_uri() . '/assets/js/animate-on-scroll.min.js');
    
    

 
}
add_action( 'wp_enqueue_scripts', 'lr_theme_enqueue_scripts' );

function header_cart_remove(){
	remove_action('storefront_header', 'storefront_skip_links', 5);
	remove_action('storefront_header', 'storefront_social_icons', 10);
	remove_action('storefront_header', 'storefront_secondary_navigation', 30);
	remove_action('storefront_header', 'storefront_product_search', 40);
	remove_action('storefront_header', 'storefront_header_cart', 60);
  remove_action('storefront_page','storefront_edit_post_link', 30);
  remove_action('storefront_page','storefront_page_header', 10);
  remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
}
add_action('init', 'header_cart_remove');

// function remove_breadcrumbs() {
// 	remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10);
// }
// add_action( 'init', 'remove_breadcrumbs');

// add_action('storefront_header', 'storefront_product_search', 30);
add_action('storefront_header', 'storefront_custom_search', 30);
function storefront_custom_search()
{
  if ( function_exists( 'aws_get_search_form' ) ) { aws_get_search_form(); }  
}

function footer_links()
{
  remove_action('storefront_footer',  'storefront_credit',20);
}
add_action('init', 'footer_links');

add_action('storefront_footer','custom_credit',20);
function custom_credit()
{ ?>
  <div class="site-info">
    <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
  </div><!-- .site-info -->
  <?php
}
function homepage_banner()
{ ?>
    <div class="banner">
      <img src="<?php the_field('banner'); ?>">
    </div>
<?php}
add_action('storefront_page','homepage_banner', 10);


/******************************************************************************************************/

/***** REMOVING HEADER CONTAINER OPEN & CLOSE *****/
add_action('init', 'header_container_open_remove');
function header_container_open_remove(){
	remove_action('storefront_header','storefront_header_container', 0);
	remove_action('storefront_header','storefront_header_container_close', 41);
}

add_action('storefront_header', 'lr_hamberger_section', 15);
function lr_hamberger_section(){?>
  <div class="mobile-menu-block">
    <div class="hamberger">
      <button class="btn hamberger-btn">
        <i class="fas fa-bars fa-2x"></i>
        <i class="far fa-times-circle fa-2x"></i>
      </button>
    </div>
    <div class="mobile-dropdown-menu">
     <?php  
      $args = array(
        'theme_location'=>'primary',
        'container' =>'div',
        'container_class'=>'lr-mobile-menu',
        'container_id'=>'lr-mobile-menu'
      );
      wp_nav_menu($args); ?>
    </div>
  </div>
<?php }

/***** ADDING HEADER CONTAINER OPEN *****/
add_action('storefront_header', 'lr_storefront_header_container',0);
function lr_storefront_header_container(){
	//echo '<div class="col-full">';
	echo '<div class="top-header">';
}

//**** ADDING HEADER CONTAINER CLOSE ****
add_action('storefront_header', 'lr_storefront_header_container_close',41);
function lr_storefront_header_container_close(){
	//echo '</div>';
	echo '</div>';
}

/***** DISPLAYING TOP HEADER MENU *****/
//add_action('storefront_header','lr_top_menu',35);
function lr_top_menu (){
	$args = array(
		'theme_location'=>'top-menu',
		'container' =>'div',
		'container_class'=>'lr-utility-menu',
		'container_id'=>'lr-utility-menu'
	);
	wp_nav_menu($args);
}

// /***** REGISTERING TOP HEADER MENU *****/
//add_action('init','lr_top_menu_area');
function lr_top_menu_area(){

	register_nav_menus(array(

		'top-menu'=>_('Top Menu')
		));
}

/***** DISPLAYING HEADER CART ICON FOR MOBILE VERSION *****/
//add_action('storefront_header', 'lr_storefront_header_cart_mobile', 37);
function lr_storefront_header_cart_mobile(){
  if ( storefront_is_woocommerce_activated() ) {
    if ( is_cart() ) {
      $class = 'current-menu-item';
    } else {
      $class = '';
    } ?>
    
    <ul class="site-header-cart mobile-menu">
      <li class="<?php echo esc_attr( $class ); ?>"><?php lr_cart_icon_mobile(); ?></li>
      <li><?php the_widget( 'WC_Widget_Cart', 'title=' ); ?></li>
    </ul>
  <?php }
}

//add_action('storefront_header','lr_cart_icon_mobile', 37);
function lr_cart_icon_mobile(){ ?>
    <a class="cart-contents-mobile" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?> "> 
    <i class="fas fa-shopping-bag"></i>
    Basket
    <span class="count">
      <?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) ); ?>
    </span></a>
<?php }

/***** CALLING FUNCTION FOR AJAX PURPOSE HEADER CART ICON FOR MOBILE VERSION *****/
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
  add_filter( 'woocommerce_add_to_cart_fragments', 'lr_storefront_cart_link_fragment_mobile', 50, 1);
} else {
  add_filter( 'add_to_cart_fragments', 'lr_storefront_cart_link_fragment_mobile', 50, 1);
}

function lr_storefront_cart_link_fragment_mobile($fragments){
    global $woocommerce;

    ob_start();
    lr_cart_icon_mobile();
    $fragments['a.cart-contents-mobile'] = ob_get_clean();

    // ob_start();
    // storefront_handheld_footer_bar_cart_link();
    // $fragments['a.footer-cart-contents'] = ob_get_clean();

    return $fragments;
  }

/***** DISPLAYING HEADER CART ICON FOR DESKTOP VERSION *****/




/*******************************************************************************************************/


function london_cat_list() 
{
  ob_start();
  $taxonomy     = 'product_cat'; 
  $empty        = 0;

  $args = array(
    'taxonomy'     => $taxonomy,
  );
  $product_categories = get_categories( $args );
  ?>
  <div class="featured">
  	<?php
    $c=1;
    ?>
    <ul class="featured-cat">
      <?php foreach( $product_categories as $category ) :

        $check= get_field('featured', 'product_cat_'.$category->term_id)[0];
        if($check=='yes'){ 
        	$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        	
        	if( $c<=6 ){?>
	            <li class="category" id="<?php echo $category->term_id; ?>">
		            <div class="cat-content">
		               <h3><?php echo $category->name; ?></h3>
		               <p><?php echo $category->description; ?></p>
		            </div>
	            	<div class="imgbox" id="img">
	            		<img src="<?php echo wp_get_attachment_image_url( $thumbnail_id, 'full' ); ?>">
	            	</div>
	            	<div class="btn-info" id="btn_info">
	              	<a href="<?php echo get_category_link($category->term_id); ?>" class="btn">View Details</a>
	          	  </div>
	            </li>
            <?php 
            $c++;
        }
          }          
          //else{ 
          	//echo 'No category found ';
          //}
      endforeach;
      ?>
    </ul>
  </div>
  <?php  
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'categorylist', 'london_cat_list' );

include("shortcodes.php");


function default_filter_remove() {
  remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
}
add_action( 'init', 'default_filter_remove');
 
//turn off product pagination
add_filter( 'theme_mod_storefront_product_pagination', '__return_false');

// size option
function variation_radio_buttons($html, $args) {
  $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
    'options'          => false,
    'attribute'        => false,
    'product'          => false,
    'selected'         => false,
    'name'             => '',
    'id'               => '',
    'class'            => '',
    'show_option_none' => __('Choose an option', 'woocommerce'),
 ));

  if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
    $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
    $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
  }


  $options               = $args['options'];
  $product               = $args['product'];
  $attribute             = $args['attribute'];
  $name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
  $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
  $class                 = $args['class'];
  $show_option_none      = (bool)$args['show_option_none'];
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

  if(empty($options) && !empty($product) && !empty($attribute)) {
    $attributes = $product->get_variation_attributes();
    $options   = $attributes[$attribute];
  }
  $i = 0;
  $myattributes = $product->get_available_variations();

  // print_r($myattributes);
  foreach ($myattributes as $attr) {
    //print_r($attr);
    $custom_var[$attr['attributes']['attribute_pa_size']] = $attr['price_html'];
    $availability[$attr['attributes']['attribute_pa_size']]['stock'] = $attr['availability_html'];
    $custom_qty[$attr['attributes']['attribute_pa_size']]['quantity'] = $attr['max_qty'];
    $custom_qty[$attr['attributes']['attribute_pa_size']]['display_regular_price'] = $attr['display_regular_price'];
    $custom_qty[$attr['attributes']['attribute_pa_size']]['display_price'] = $attr['display_price'];
    $custom_qty[$attr['attributes']['attribute_pa_size']]['price_diff'] = $attr['display_regular_price'] - $attr['display_price'];
    $custom_var[$i]['price'] = is_in_stock;
    $i++;
  }
  //print_r($custom_var);
  //echo("AFTER custom var");
  //print_r($availability);
  $radios = '<div class="variation-radios"><table>';
  $radios = $radios . '<tr><td><input type="hidden" name="related_product" id="related_product" value=""></td></tr><tr><td><span class="variation-title">Select Size</span></td></tr>';
  if(!empty($options)) {
    
      foreach($options as $option) {
        if($custom_qty[$option]['quantity'] >4 )
        {
          $class = "qty-green";
          $msg = '<p class="stock in-stock">In stock</p>';
        }else if($custom_qty[$option]['quantity'] >=1){
          $class = "";
          $msg = '<p class="stock in-stock">Only '.$custom_qty[$option]['quantity'].' left in stock!</p>';
        }else{
          $class = "";
          $msg = $availability[$option]['stock'];
        }

        $youSave = '';
        if($custom_qty[$option]['price_diff'] > 0 )
        {
          $youSave = '<span class="lnrg-price-diff">(You Save : £'.number_format((float)$custom_qty[$option]['price_diff'], 2, ".", "").')</span>';
        }

        
        $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
        $radios    .= '<tr><td><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><label for="'.sanitize_title($option).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)). ' - '. $custom_var[$option]. $youSave. ' <span class='.$class.'>'.$msg.'</span></label></td></tr>';
      }
    
  }

  $radios .= '</table></div>';

  return '<div style="display:none">'.$html.'</div>'.$radios;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);
// size option end

//for reviews
function woocommerce_output_product_data_tabs_remove() {
  remove_action( 'woocommerce_single_product_summary','storefront_edit_post_link', 60 );
}

//adding more-details after add-to-cart
function more_details()
{?>
  
  <div class='atc-wrapper'>
      <p class='atc-wrapper-text'>More Details</p>
      <i class='fa fa-angle-down'></i>
      <i class='fa fa-angle-up' style='display: none'></i>
  </div>
  <div class='more-details'>
      <div class="product-detalis-block">
          <img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/free-del.png' ?>" >
          <p class="icon-text">FREE UK DELIVERY</p>
      </div>
      <div class="product-detalis-block">
          <img class="icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Guarantee_Best_price.png">
          <p class="icon-text">BEST PRICES GUARANTEED</p>
      </div>
      <div class="product-detalis-block">
          <img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/fuss.png' ?>" >
          <p class="icon-text">NO FUSS RETURNS</p>
      </div>
      <div class="product-detalis-block">
          <img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/secure.png' ?>" >
          <p class="icon-text">SECURE CHECKOUT</p>
      </div>
  </div>

<?php 
}
//add_action('woocommerce_after_add_to_cart_form','more_details',5);

function featured_products()
{?>
  
  <div class='featured-products'>
    <?php the_field('featured');?>
  </div>

<?php }
add_action('storefront_page','featured_products',30);


function featured_categories()
{?>
  
  <div class='featured_categories'>
    <?php $cat = get_term(42, 'product_cat', ARRAY_A);?>
    <h2 class="section-title"><?php echo $cat['name']; ?></h2>
    <p><?php echo $cat['description']; ?></p>
    <a href="<?php echo get_category_link($cat['term_id']); ?>">READ MORE</a>
  </div>

<?php }
add_action('storefront_page','featured_categories',40);


function upsell_column_count( $args )
{
  $args['columns'] = 6;
  return $args;  
}
add_filter( 'woocommerce_upsell_display_args', 'upsell_column_count');

  
function upsell_heading( $translated_text, $text, $domain )
{ 
  if( $translated_text == 'You may also like&hellip;' && $domain == 'woocommerce' && is_product() )
  {
    $translated_text = 'Customers who bought this item also bought these digital items';
  }
  return $translated_text;
}
add_filter( 'gettext', 'upsell_heading', 15, 3 );

//[recent_post_carousel slides_to_show="3" slides_to_scroll="1" post_type="industry" dots="false" show_author="false" show_date="false" show_content="false"]

add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
      global $wp_query;
      $cat = $wp_query->get_queried_object();
      $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
      $image = wp_get_attachment_url( $thumbnail_id );
      if ( $image ) {
        echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
    }
  }
}