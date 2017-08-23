<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */



?>



<div class="site-info">
    <p>
    <a class="button-a" href="tel:+380974876771">Call Us</a>
    </p>
    <p>
    <a class="button-a" href="mailto:testdomain@mail.to">Email Us</a>
    </p>
    <p>
    <button class="contact-us-button">Contact Us</button>
    </p>
    <p>
    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyseventeen' ) ); ?>">
        <?php printf( __( 'Proudly powered by %s', 'twentyseventeen' ), 'WordPress' ); ?>
    </a>
    </p>
</div><!-- .site-info -->


