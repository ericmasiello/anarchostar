
	<div id="footer" class="clearfix">

		<?php if ( is_admin() ): ?>
			<div class="main clearfix">
				<?php
					if(is_front_page() && is_active_sidebar('footer_home')) : dynamic_sidebar('footer_home');
					else : ?>
						<?php if (!dynamic_sidebar('footer_default') && is_user_logged_in()) : ?>
							<div class = "miniFeature32 oneThird widget_tia_mini_feature footerBox">
								<?php include( TEMPLATEPATH . '/includes/no_widgets.php'); ?>
							</div><!-- end footer box -->
						<?php endif; ?>
					<?php endif; ?>
			</div><!-- /.main -->

			<div class="secondary clearfix">
				<?php $footer_left = tia_get_option('tia_footer_left'); ?>
				<?php $footer_right = tia_get_option('tia_footer_right'); ?>
			</div><!-- /.secondary -->
		<?php endif; ?>

    <nav id="footerNav" class="nav-collapse  nav--footer">
      <div class="nav-collapse__content">
        <?php wp_nav_menu( array('menu_class' => 'sf-menu', 'theme_location' => 'main', 'fallback_cb' => 'default_nav' )); ?>
        <?php include 'includes/socialNetworks.php'; ?>
      </div>
		</nav>

	</div><!-- /#footer -->
</div>
<?php wp_footer(); ?>
</body>
</html>