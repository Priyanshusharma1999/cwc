<?php global $base_url; ?>
<div <?php print $attributes;?> class="<?php print $classes;?>">
  <?php if($section == 'frontend') :?>
    <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar tb-megamenu-button" type="button">
     .<img src="<?php echo $base_url.'/sites/all/themes/nexus/images/menu.png'?>" alt="menu">
    </button>
    <div class="nav-collapse <?php print $block_config['always-show-submenu'] ? ' always-show' : '';?>">
  <?php endif;?>
  <?php print $content;?>
  <?php if($section == 'frontend') :?>
    </div>
  <?php endif;?>
</div>
