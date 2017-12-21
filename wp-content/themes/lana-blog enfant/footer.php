</div>
</div>
<div class="clearfix"></div>
</div>

<div <?php lana_blog_pre_footer_class( 'pre-footer' ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-left' ); ?>
            </div>
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-middle' ); ?>
            </div>
            <div class="col-md-4">
				<?php dynamic_sidebar( 'footer-right' ); ?>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <p class="footer-text pull-right">
			<?php echo esc_html( get_theme_mod( 'lana_blog_footer_text' ) ); ?>
        </p>

        <p>
			<?php _e( 'Copyright', 'lana-blog' ); ?>
            &copy;
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php echo date_i18n( __( 'Y', 'lana-blog' ) ); ?>
        </p>
    </div>
</div>
<!-- modale qui va permettre l'affichage et le lancement de l'app silex -->
<div class="modal fade" id="modalidee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog" role="document">    
   <div class="modal-content">      
     <div class="modal-header">        
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>        
     </div>      
     <div class="modal-body"><iframe class="frameidee" src="http://localhost/indemodable/bai/boite-a-idee" frameBorder="0"></iframe>
     </div>
   </div>  
 </div> 
</div>
<!-- code d'ouverture de la modale depuis un click de l'interface du site  -->
<script type="text/javascript">
    jQuery('#boiteaidee').on('click', function() {
        jQuery('#modalidee').modal('show');
    })
</script>

<?php wp_footer(); ?>
</body>
</html>