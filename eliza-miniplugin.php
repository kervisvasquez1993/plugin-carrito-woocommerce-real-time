<?php 
/*
    Plugin Name: Eliza Mini plugin 
    Plugin URI: 
    Description: slider de categoria 
    version:1.0
    Author: Eliza Salcedo
    Autor URI: 
    License: GPL2
    License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

function funcion_slider()
{
  
    function categorias_productos_woocommerce( $args = array() )
    {
        $parentid = 0; 
        $args = array(
            'parent' => $parentid
        );
         
        $terms = get_terms( 'product_cat', $args );
         
        
                 
            echo '<div class="category_slider_eliza swiper-container">';
                echo '<ul class="swiper-wrapper">';
                foreach ( $terms as $term ) :
                    echo '<li class="category_eliza swiper-slide">';
                            echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="ancla_menus ' . $term->slug . '">';
                                echo $term->name;
                            echo '</a>';
                    echo '</li>';
                endforeach;
                echo '</ul>';
             
            echo '</div>';
         
        
    }
    add_action( 'woocommerce_before_shop_loop', 'categorias_productos_woocommerce', 1 );
    
    ?>
    <!--
<div class="cart-box">
    <ul class="d-flex justify-content-sm-between  align-items-center">
		<?php global $woocommerce; ?>                                          
		<ul class="ht-dropdown cart-box-width flyout">
            <li>
               <?php 
		       //lista del producto del carrito
               $items = $woocommerce->cart->get_cart();
		       foreach($items as $item => $values) :
		       $productDetail = wc_get_product( $values['product_id'] ); 
		       ?>
		            
		             <div class="single-cart-box">
                             <div class="cart-img">
                                 <a href="#"><?php echo $productDetail->get_image(); ?></a>
                                 <span class="pro-quantity"><?php echo $values['quantity'] ?></span>
                             </div>
                             <div class="cart-content">
                                 <h6><a href="product.html"><?php echo $productDetail->get_title(); ?></a></h6>
                                 <span class="cart-price"><?php echo get_post_meta($values['product_id'] , '_price', true); ?>S</span>
                             </div>
                             <a class="del-icone" href="<?php echo WC()->cart->get_remove_url( $item ); ?>"><i class="ion-close"></i></a>
                     </div>
                 <?php endforeach;?>
                    
                     <div class="cart-footer">
                         <ul class="price-content">
                             <li>Total <span><?php echo WC()->cart->get_cart_total(); ?></span></li>
                         </ul>
                         <div class="cart-actions text-center">
                             <a class="cart-checkout" href="http://localhost/tienda2/carrito/">Finalizar Compra</a>
                         </div>
                     </div>
                      <!-- Cart Footer Inner End -->
            </li>
        </ul>
    </ul>
</div>

<div class="container">
    <div class="row">
        <!-- Elementos generados a partir del JSON -->
        <main id="items" class="col-sm-8 row"></main>
        <!-- Carrito -->
        <aside class="col-sm-4">
            <h2>Carrito</h2>
            <!-- Elementos del carrito -->
            <ul id="carrito" class="list-group"></ul>
            <hr>
            <!-- Precio total -->
            <p class="text-right">Total: <span id="total"></span>&euro;</p>
            <button id="boton-vaciar" class="btn btn-danger">Vaciar</button>
        </aside>
    </div>
</div>
<?php
    

}
// Incluir Bootstrap CSS
function slider_categorias() {
    wp_enqueue_style( 'swipper_css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.3.3');
    wp_enqueue_style( 'css_slider', plugins_url('eliza-miniplugin/css/style.css',  dirname(__FILE__) ), array(), '1.0.0'); 
    wp_enqueue_script( 'swipper_js','https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.3.3', true);
    wp_enqueue_script( 'script_slider', plugins_url('eliza-miniplugin/js/script.js',  dirname(__FILE__) ) ,array('jquery'), '1.0.0', true); 
}
add_action( 'wp_enqueue_scripts', 'slider_categorias');
add_shortcode( 'slider_eliza', 'funcion_slider' );



