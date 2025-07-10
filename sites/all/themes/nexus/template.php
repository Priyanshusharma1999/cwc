<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function nexus_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function nexus_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
$breadcrumb[] = drupal_get_title();

 global $language;
$lang = $language->language;
$str=request_path();
$test =  explode("/",$str);
if($lang=="hi"){
 $getword = 220;
$rocwc='केन्द्रीय जल आयोग के क्षेत्रीय कार्यालय';
$lan="hi/";
 
 $userhomepath=$test[0].'/'.$test[1].'/about-basins';

}else{
	$userhomepath=$test[0].'/about-basins';
	$lan="";
$rocwc='Regional Offices of Central Water Commission';
 $getword = 80;
}
$mystring = variable_get('username',"virtual site name");
    $findme   = 'user';
    $pos = strpos($mystring, $findme);
 $site_slogan = variable_get('site_slogan', "Default site name");
 $parts = explode(',',$site_slogan);
  $str=request_path();
        


$breadcrumbcount = COUNT($breadcrumb)-1;
 if ($pos !== false && $breadcrumbcount=='1') {
	 $curls='<a href="'.$GLOBALS['base_url'].'/'.$lan.'regional-offices-of-central-water-commission">'.$rocwc.'</a> » 
     <a href="'.$GLOBALS['base_url'].'/'.$userhomepath.'">'.$parts[0].'</a> »'; 
       
    }
   
	else{
	  $curls="";	
	}
//echo "COUNT :".$breadcrumbcount;
for($i=0;$i<=$breadcrumbcount;$i++){
 //echo "$breadcrumb :".$breadcrumb[0]." get i :".$i;
 
 if($i == $breadcrumbcount){
	 
	
	 
  if (strlen($breadcrumb[$breadcrumbcount]) > $getword) {
   $getbreadcrumb .= get_truncate($breadcrumb[$i],$getword).'...';
  }else{
   $getbreadcrumb .= $breadcrumb[$i];
  }
 }else{
  $getbreadcrumb .= $breadcrumb[$i].' » '.$curls;
 }
}

$output .= '<nav class="breadcrumb"><div class="getbreadcrumbfont">' .$getbreadcrumb. '</div></nav>';

    //$output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}


function get_truncate($string,$length){
 
     $string = substr($string,0,$length);
     $string = substr($string,0,strrpos($string," "));
     return $string;
}

/**
 * Override or insert variables into the page template.
 */
function MYTHEME_preprocess_page(&$variables) {
  if (isset($variables['node']->type)) {
   $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->title;
   }
if (isset($variables['node']->type)) {
    $vars['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}
function nexus_preprocess_page(&$vars) {
if (isset($vars['node']->type)) {
    $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type; 
  }
  $vars['testvar'] = t('Lnews');
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function nexus_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function nexus_preprocess_node(&$variables) {
  $node = $variables['node'];
 
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  $variables['date'] = t('!datetime', array('!datetime' =>  date('j F Y', $variables['created'])));
}

function nexus_page_alter($page) {
  // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
    'name' =>  'viewport',
    'content' =>  'width=device-width, initial-scale=1, maximum-scale=1'
    )
  );
  drupal_add_html_head($viewport, 'viewport');
}


/**
 * Add javascript files for front-page jquery slideshow.
 */
if (drupal_is_front_page()) {
  drupal_add_js(drupal_get_path('theme', 'nexus') . '/js/jquery.flexslider.js');
  drupal_add_js(drupal_get_path('theme', 'nexus') . '/js/slide.js');
}

function yourtheme_get_node_count($content_type) {
     $query = "SELECT COUNT(*) amount FROM {node} n ".
              "WHERE n.type = :type";
     $result = db_query($query, array(':type' => $content_type))->fetch();
     return $result->amount;
}
/**
 * Theme the opening markeup a menu item's container.
 */
function afd_menu_site_map_item_container_open($depth, $is_first = FALSE) { 
  $output = '';
  
/*  $output .= sprintf("		<li class=\"level-%s%s\">", 
                     $depth,
                     $is_first ? ' first' : ''); 
*/
                     
    if ($depth == 0) {
		$output .= sprintf("		<li class=\"level-%s%s\">", 
								$depth,
								$is_first ? ' first' : ''); 
	}
    else if ($depth == 1) {
		$output .= sprintf("				<li class=\"level-%s%s\">", 
								$depth,
								$is_first ? ' first' : ''); 
	}
    else if ($depth == 2) {
		$output .= sprintf("						<li class=\"level-%s%s\">", 
								$depth,
								$is_first ? ' first' : ''); 
	}
    else {
      // $depth >= 3
		$output .= sprintf("								<li class=\"level-%s%s\">", 
								$depth,
								$is_first ? ' first' : ''); 
	}                    

                     
  return $output;
}

/** 
 * Theme the closing markup for a menu item's container.
 */
function afd_menu_site_map_item_container_close($depth) {
  $output = '';

  $output .= "</li>\n";

  return $output;
}

/**
 * Theme the opening markup for the container of a menu item's children.
 */
function afd_menu_site_map_children_container_open($depth) {
    $output = '';

    if ($depth == 0) {
      $output .= sprintf("\n	<ul class=\"container level-%s\">\n", $depth);
    }
    else if ($depth == 1) {
      $output .= sprintf("\n			<ul class=\"container level-%s\">\n", $depth);
    }
    else if ($depth == 2) {
      $output .= sprintf("\n					<ul class=\"container level-%s\">\n", $depth);
    }
    else {
      // $depth >= 3
      $output .= sprintf("\n							<ul class=\"container level-%s\">\n", $depth);
    }

    return $output;
}

/**
 * Theme the closing markup for the container of a menu item's children.
 */
function afd_menu_site_map_children_container_close($depth) {
    $output = '';

    if ($depth == 0) {
      $output .= "	</ul>\n";
    }
    else if ($depth == 1) {
      $output .= "			</ul>\n		";
    }
    else if ($depth == 2) {
      $output .= "					</ul>\n				";
    }
    else {
      // $depth >= 3
      $output .= "							</ul>\n						";
    }



    return $output;
}

/**
 * Theme the container

/**
 * Theme a single menu entry in the site map.
 */
function afd_menu_site_map_item($title, $link, $depth, $leaf=FALSE) {
  $output = '';
  $class = sprintf("item level-%s%s",
                   $depth,
                   $leaf ? " leaf" : "");
  if ($depth == 0) {
    $output .= sprintf("<a href=\"%s\">%s</a>", $link, $title); 
  }
  else if ($depth == 1) {
    $output .= sprintf("<a href=\"%s\">%s</a>", $link, $title); 
  }
  else if ($depth >= 2) {
    $output .= sprintf("<a href=\"%s\">%s</a>", $link, $title); 
  }

  return $output;
} // function afd_menu_site_map_item

function afd_menu_site_map_menu($menu_tree, $max_depth) {
  $output = '';
  
  $output .= "\n";
  $output .= "	<ul class=\"menu-site-map\">\n";
  $output .= theme('menu_site_map_menu_tree', $menu_tree, 0, $max_depth);
  $output .= "	</ul>\n";

  return $output;
}

function afd_menu_site_map_menu_tree($menu_tree, $current_depth, $max_depth) {
  $output = ''; 
  $delayed_output = '';

  if ($current_depth > $max_depth) {
    return NULL;
  }
  else {
    $is_first = TRUE;


    foreach ($menu_tree as $menu) {
      $smm_item = db_fetch_array(db_query("SELECT * FROM {menu_site_map_links} WHERE mlid = %d", $menu['link']['mlid']));  
      if (!$smm_item || $smm_item['included']) {
        // We haven't excluded this menu item from our site map.
        $delay_output = FALSE;
        if ($current_depth == 1 && !$menu['link']['has_children'] &&
          variable_get('menu_site_map_move_second_level_leafs', TRUE)) {
          $delay_output = TRUE;
        }

        if (!$delay_output) {
          $output .= theme('menu_site_map_item_container_open', $current_depth, $is_first);
        }

        // Is this menu item as deep as we're going to go down our menu tree?
        // This would be either because the item has no children or descending
        // further down the tree would result in exceeding the max depth.
        $leaf = !$menu['link']['has_children'] || $current_depth + 1 > $max_depth;
        $item_output = theme('menu_site_map_item', 
                             $menu['link']['link_title'], 
                             drupal_get_path_alias($menu['link']['link_path']), 
                             $current_depth, $leaf);
        if ($delay_output) {
          $delayed_output .= theme('menu_site_map_item_container_open', $current_depth, $is_first);
          $delayed_output .= $item_output; 
          $delayed_output .= theme('menu_site_map_item_container_close', $current_depth);
        }
        else {  
          $output .= $item_output; 
        }

        if ($menu['link']['has_children']) {
          $output .= theme('menu_site_map_children_container_open', $current_depth + 1);
          $output .= theme('menu_site_map_menu_tree', $menu['below'], $current_depth + 1, $max_depth);
          $output .= theme('menu_site_map_children_container_close', $current_depth + 1);
        }

        if (!$delay_output) {
          $output .= theme('menu_site_map_item_container_close', $current_depth);
        }

        if ($is_first) {
          $is_first = FALSE; 
        }
      }
    } // foreach
   
    $output .= $delayed_output;


    return $output;
  }
}
function nexus_form_alter(&$form, $form_state, $form_id) {
//print($form_id);
  if ($form_id == 'user-login') {
    $form['name']['#attributes']['autocomplete'] = 'off';
   
  }
}
function hook_preprocess_HOOK(&$variables) {

  $node = node_load(arg(1));
  $aa=$node->name;
return $aa;
 

}

function nexus_process_html_tag(&$vars) {
  $el = &$vars['element'];
 
  // Remove type="..." and CDATA prefix/suffix.
  unset($el['#attributes']['type'], $el['#value_prefix'], $el['#value_suffix']);
 
  // Remove media="all" but leave others unaffected.
  if (isset($el['#attributes']['media']) && $el['#attributes']['media'] === 'all') {
    unset($el['#attributes']['media']);
  }
}