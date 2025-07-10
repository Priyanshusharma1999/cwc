<div class="btm-bg">
<div class="container">
<div class="row">
  <?php print render($page['footer']); ?>
</div>
</div>
</div>
<!-- footer-section-starts-here -->
	<div class="footer">
		<div class="footer-top">
			<div class="wrap">
				
				<div class="col-md-4 footer-grid">
             <h4 class="footer-head"><?php echo $ilink;?></h4>
					<?php print render($page['footer_first']); ?>
				</div>
				<div class="col-md-4 footer-grid external-link">
				<?php print render($page['footer_third']); ?>
				</div>

				<div class="col-md-4 footer-grid">
					<?php print render($page['footer_second']); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
				<div class="copyrights col-md-9">
			<?php print render($page['copy_right']); ?>

				</div>
				<div class="footer-social-icons col-md-3">
					<?php print render($page['social_link']); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- footer-section-ends-here -->

<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>