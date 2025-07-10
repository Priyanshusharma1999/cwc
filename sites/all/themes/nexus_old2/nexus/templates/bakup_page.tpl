<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
<div class="container-fluid topPan">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <p class="time">05 Feb, 2017 | 5:42 PM IST</p>
      </div>
      <div class="col-md-9 top_menu"> <div class="region region-top-menu">
  <div id="block-block-23" class="block block-block" role="navigation">

      
  <div class="content">
    <ul class="accblty"><li><a class="homeIcon" href="/" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
<li><span class="glyphicon glyphicon-arrow-down marRight"></span><a href="#main-content" title="Skip to main content">Skip to main content</a></li>
<li><span class="glyphicon glyphicon-arrow-down marRight"></span><a href="#topNav" title="Skip to navigation">Skip to navigation</a></li>
<li><span class="glyphicon glyphicon-volume-up marRight"></span><a href="screen-reader-access" title="Screen Reader Access">Screen Reader Access</a></li>
</ul>  </div>
  
</div> <!-- /.block -->
</div>
 <!-- /.region -->
 <div class="region region-style-switcher">
  <div id="block-styleswitcher-styleswitcher" class="block block-styleswitcher abs" role="complementary">

      
  <div class="content">
    <div class="item-list"><ul><li class="first"><a href="#" class="accbl style-switcher style-" data-rel="." title=".">A</a></li>
<li class="last"><a href="#" class="accbl style-switcher style-" data-rel="," title=",">A</a></li>
</ul></div>  </div>
  
</div> <!-- /.block -->
</div>
 <!-- /.region -->
 <div class="region region-text-size">
  <div id="block-textsize-form" class="block block-textsize" role="contentinfo">

      
  <div class="content">
    <?php print render($page['textsize']); ?>
</div>
  
</div> <!-- /.block -->
</div>
 <!-- /.region -->
 <div class="region region-language-menu">
  <div id="block-locale-language" class="block block-locale">

      
  <div class="content">
    <ul class="language-switcher-locale-url"><li class="en first active"><a href="/constitutional-provision" class="language-link active" xml:lang="en">English</a></li>
<li class="hi last"><a href="/hi/constitutional-provision-hindi" class="language-link" xml:lang="hi">हिन्दी</a></li>
</ul>  </div>
  
</div> <!-- /.block -->
</div>
 <!-- /.region -->
 </div>
    </div>
  </div>
</div>
<div class="top-wrap">
<header>
	<ul class="logo">
   logo
    </ul>
   
	<div class="top-header">
   		<img src="http://elevate-accounting.co.uk/og-content/themes/elevate/images/hom-top.jpg" alt="Cloud Based Accounting">
    </div>
    
    <a class="toggleMenu" href="#"><i class="fa fa-bars fa-4g"></i> &nbsp; </a>
    <div class="menu">
	menu
	</div>
</header> 
</div>   
<!--header-end-->
<div class=""><p>
<div class="banner">
	<div class="rslides_container">
		
slider		
	</div>
</div>
<div class="right-banner">
    <a href="contact-us"></a>
</div>
    
 <div class="clr"></div> 
   

<div class="box-hader">
> INSIGHTFUL BUSINESS INTELLIGENCE <
</div> </p>

</div> 
<div id="page">
  <header id="masthead" class="site-header container" role="banner">
    <div class="row">
      <div id="logo" class="col-md-8 col-sm-8 col-xs-12 animated fadeInDown delay-07s>
        <?php if ($logo): ?><div id="site-logo"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a></div>
		
		<?php endif; ?>
        
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 Search animated fadeInDown delay-07s"> 
<div class="region region-search">
  <div id="block-custom-search-blocks-1" class="block block-custom-search-blocks form-group has-feedback" role="search">

      
  <div class="content">
  <?php if ($front_page): ?>
           <?php print render($page['region_search']); ?>
          </div><?php endif; ?>
  
  
      </div>
  
</div> <!-- /.block -->
</div>
 <!-- /.region -->
 </div>
    </div>
  </header>


  
  <?php if($page['preface_first'] || $page['preface_middle'] || $page['preface_last']) : ?>
    <?php $preface_col = ( 12 / ( (bool) $page['preface_first'] + (bool) $page['preface_middle'] + (bool) $page['preface_last'] ) ); ?>
    <div id="preface-area">
      <div class="container">
        <div class="row">
          <?php if($page['preface_first']): ?><div class="preface-block col-sm-<?php print $preface_col; ?>">
            <?php print render ($page['preface_first']); ?>
          </div><?php endif; ?>
          <?php if($page['preface_middle']): ?><div class="preface-block col-sm-<?php print $preface_col; ?>">
            <?php print render ($page['preface_middle']); ?>
          </div><?php endif; ?>
          <?php if($page['preface_last']): ?><div class="preface-block col-sm-<?php print $preface_col; ?>">
            <?php print render ($page['preface_last']); ?>
          </div><?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

 
    <div id="header-block">
	<div class="container-fluid navWrap">
      <div class="container">
	  <div id="cssmenu">
          <div id="topNav">
            <?php print render($page['header']); ?>
          </div>
        </div>
      </div>
	  </div>
    </div>
  

    <div id="main-content">
    <div class="container"> 
      <div class="row">
        <?php if($page['sidebar_first']) { $primary_col = 8; } else { $primary_col = 12; } ?>
        <div id="primary" class="content-area col-sm-<?php print $primary_col; ?>">
          <section id="content" role="main" class="clearfix">
            <?php if (theme_get_setting('breadcrumbs')): ?><?php if ($breadcrumb): ?><div id="breadcrumbs"><?php print $breadcrumb; ?></div><?php endif;?><?php endif; ?>
            <?php print $messages; ?>
            <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
            <div id="content-wrap">
              <?php print render($title_prefix); ?>
              <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
              <?php print render($title_suffix); ?>
              <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
              <?php print render($page['content']); ?>
            </div>
          </section>
        </div>
        <?php if ($page['sidebar_first']): ?>
          <aside id="sidebar" class="col-sm-4" role="complementary">
           <?php print render($page['sidebar_first']); ?>
          </aside> 
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php if($page['footer']) : ?>
    <div id="footerWrap" class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <?php print render($page['footer']); ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']): ?>
    <?php $footer_col = ( 12 / ( (bool) $page['footer_first'] + (bool) $page['footer_second'] + (bool) $page['footer_third'] + (bool) $page['footer_fourth'] ) ); ?>
    <div id="bottom">
      <div class="container">
        <div class="row">
          <?php if($page['footer_first']): ?><div class="footer-block col-sm-<?php print $footer_col; ?>">
            <?php print render ($page['footer_first']); ?>
          </div><?php endif; ?>
          <?php if($page['footer_second']): ?><div class="footer-block col-sm-<?php print $footer_col; ?>">
            <?php print render ($page['footer_second']); ?>
          </div><?php endif; ?>
          <?php if($page['footer_third']): ?><div class="footer-block col-sm-<?php print $footer_col; ?>">
            <?php print render ($page['footer_third']); ?>
          </div><?php endif; ?>
          <?php if($page['footer_fourth']): ?><div class="footer-block col-sm-<?php print $footer_col; ?>">
            <?php print render ($page['footer_fourth']); ?>
          </div><?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
      <div class="row">
        <div class="fcred col-sm-12">
          <?php print t('Copyright'); ?> &copy; <?php echo date("Y"); ?>, <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a>. <?php print t('Theme by'); ?>  <a href="http://www.devsaran.com" target="_blank">Devsaran</a>.
        </div>
      </div>
    </div>
  </div>
</div>