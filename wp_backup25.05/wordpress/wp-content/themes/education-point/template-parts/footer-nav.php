<?php
if( has_nav_menu( 'epfooter' ) ) {
?>
<div class="container-fluid footercnav">
	<div class="row">
		<div class="col-md-12">
			<div class="contents">
				<nav class="navbar navbar-expand-md navbar-light bg-light epfooternav">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#collapse-epfooter">
								<span class="navbar-toggler-icon"></span>
							</button>
						</div>
								
						<?php
						wp_nav_menu( array(
							'theme_location'	=> 'epfooter',
							'depth'				=>  1,
							'container'			=> 'div',
							'container_id'		=> 'collapse-epfooter',
							'container_class'	=> 'collapse navbar-collapse',
							'menu_id'			=> 'epfooter',
							'menu_class'		=> 'nav navbar-nav epfooter'
							));
						?>

					</div>
				</nav>
			</div>
		</div>
	</div>
</div>
<?php
}
