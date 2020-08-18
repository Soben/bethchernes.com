<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Profix
 */

$footer_copyright_text = cs_get_option( 'footer_copyright_text' );

?>

<!-- START FOOTER DESIGN AREA -->
<footer id="colophon" class="copyright text-center site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?php
                    if ( ! empty( $footer_copyright_text ) ) {
                        echo profi_shovondesign_wp_kses( $footer_copyright_text );
                    } else {
                        printf( esc_html__( 'Copyright %s PROFIX - All Rights Reserved.', 'profix' ), date( 'Y' ) );
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- / END FOOTER DESIGN AREA -->

<?php wp_footer(); ?>

</body>
</html>