<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

global $product;
if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
    $post_id = get_the_ID();
    if ( $post_id ) {
        $product = wc_get_product( $post_id );
    }
}
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="single-product-wrapper">
    <div class="single-product-container">
        
        <!-- Images Section (70%) -->
        <div class="product-images-section" id="productImageContainer">
            <?php
            // Output product image with click to expand
            if ( isset( $product ) && is_a( $product, 'WC_Product' ) ) {
                echo wp_kses_post( $product->get_image( 'full' ) );
            }
            ?>
        </div>

        <!-- Image Modal -->
        <div class="product-image-modal" id="productImageModal">
            <div class="product-image-modal-content">
                <img id="productImageModal-img" src="" alt="Product" />
            </div>
        </div>

        <!-- Details Section (30%) -->
        <div class="product-details-section">
            
            <!-- Category -->
            <div class="product-category-nav">
                <?php
                $categories = get_the_terms( get_the_ID(), 'product_cat' );
                if ( $categories && ! is_wp_error( $categories ) ) {
                    foreach ( $categories as $cat ) {
                        echo '<a href="' . esc_url( get_term_link( $cat ) ) . '" class="product-category-link">' . esc_html( $cat->name ) . '</a>';
                    }
                }
                ?>
            </div>

            <!-- Title -->
            <h1 class="product-title-single">
                <?php the_title(); ?>
            </h1>

            <!-- Price -->
            <div class="product-price-single">
                <?php woocommerce_template_single_price(); ?>
            </div>

            <!-- Short Description -->
            <div class="product-short-desc-single">
                <?php
                if ( isset( $product ) && is_a( $product, 'WC_Product' ) && $product->get_short_description() ) {
                    echo wp_kses_post( $product->get_short_description() );
                }
                ?>
            </div>

            <!-- Attributes (Size, Color, etc.) -->
            <div class="product-attributes-section">
                <?php
                /**
                 * Only render the add-to-cart template here. The full
                 * `woocommerce_single_product_summary` action would re-output
                 * title/price/description (causing duplication) so we avoid it.
                 */
                if ( function_exists( 'woocommerce_template_single_add_to_cart' ) ) {
                    woocommerce_template_single_add_to_cart();
                }
                ?>
            </div>

        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageContainer = document.getElementById('productImageContainer');
    const modal = document.getElementById('productImageModal');
    const modalImg = document.getElementById('productImageModal-img');
    
    // Get image inside container
    const img = imageContainer.querySelector('img');
    
    if (img) {
        // Open modal on image click
        img.addEventListener('click', function(e) {
            e.preventDefault();
            modalImg.src = this.src;
            modal.classList.add('active');
        });
    }
    
    // Close modal on click anywhere in modal
    modal.addEventListener('click', function() {
        this.classList.remove('active');
    });
    
    // Prevent closing when clicking on image
    modalImg.addEventListener('click', function(e) {
        e.stopPropagation();
        modal.classList.remove('active');
    });
});
</script>

    <?php
    endwhile; wp_reset_postdata(); endif;

    do_action( 'woocommerce_after_main_content' );

    get_footer( 'shop' );
