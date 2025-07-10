<?php 

/**
 * Implementation of hook_views_default_views().
 */
function user_login_logout_history_views_default_views() {
 
$view = new view();
$view->name = 'user_login_logout_history';
$view->description = '';
$view->tag = 'default';
$view->base_table = 'user_login_logout_history';
$view->human_name = 'User Login Logout History';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'User Login Logout History';
$handler->display->display_options['use_ajax'] = TRUE;
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'none';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '25';
$handler->display->display_options['pager']['options']['offset'] = '0';
$handler->display->display_options['pager']['options']['id'] = '0';
$handler->display->display_options['pager']['options']['quantity'] = '9';
$handler->display->display_options['style_plugin'] = 'table';
$handler->display->display_options['style_options']['columns'] = array(
  'name' => 'name',
  'mail' => 'mail',
  'login_timestamp' => 'login_timestamp',
  'logout_timestamp' => 'logout_timestamp',
);
$handler->display->display_options['style_options']['default'] = '-1';
$handler->display->display_options['style_options']['info'] = array(
  'name' => array(
    'sortable' => 1,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'mail' => array(
    'sortable' => 1,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'login_timestamp' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'logout_timestamp' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
);
$handler->display->display_options['style_options']['empty_table'] = TRUE;
/* No results behavior: Global: Text area */
$handler->display->display_options['empty']['area']['id'] = 'area';
$handler->display->display_options['empty']['area']['table'] = 'views';
$handler->display->display_options['empty']['area']['field'] = 'area';
$handler->display->display_options['empty']['area']['empty'] = TRUE;
$handler->display->display_options['empty']['area']['content'] = 'No result found in User login logout history';
$handler->display->display_options['empty']['area']['format'] = 'filtered_html';
/* Relationship: User Login Logout History: Relationship with Users Table */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'user_login_logout_history';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
/* Field: Global: View result counter */
$handler->display->display_options['fields']['counter']['id'] = 'counter';
$handler->display->display_options['fields']['counter']['table'] = 'views';
$handler->display->display_options['fields']['counter']['field'] = 'counter';
$handler->display->display_options['fields']['counter']['label'] = '#';
$handler->display->display_options['fields']['counter']['counter_start'] = '1';
$handler->display->display_options['fields']['counter']['reverse'] = 0;
/* Field: User: Name */
$handler->display->display_options['fields']['name']['id'] = 'name';
$handler->display->display_options['fields']['name']['table'] = 'users';
$handler->display->display_options['fields']['name']['field'] = 'name';
$handler->display->display_options['fields']['name']['relationship'] = 'uid';
$handler->display->display_options['fields']['name']['label'] = 'User Name';
$handler->display->display_options['fields']['name']['link_to_user'] = FALSE;
/* Field: User: E-mail */
$handler->display->display_options['fields']['mail']['id'] = 'mail';
$handler->display->display_options['fields']['mail']['table'] = 'users';
$handler->display->display_options['fields']['mail']['field'] = 'mail';
$handler->display->display_options['fields']['mail']['relationship'] = 'uid';
$handler->display->display_options['fields']['mail']['label'] = 'E-Mail';
$handler->display->display_options['fields']['mail']['link_to_user'] = '0';
/* Field: User Login Logout History: User Login time stamp */
$handler->display->display_options['fields']['login_timestamp']['id'] = 'login_timestamp';
$handler->display->display_options['fields']['login_timestamp']['table'] = 'user_login_logout_history';
$handler->display->display_options['fields']['login_timestamp']['field'] = 'login_timestamp';
$handler->display->display_options['fields']['login_timestamp']['label'] = 'Last Login Time';
/* Field: User Login Logout History: User Logout Timestamp */
$handler->display->display_options['fields']['logout_timestamp']['id'] = 'logout_timestamp';
$handler->display->display_options['fields']['logout_timestamp']['table'] = 'user_login_logout_history';
$handler->display->display_options['fields']['logout_timestamp']['field'] = 'logout_timestamp';
$handler->display->display_options['fields']['logout_timestamp']['label'] = 'Last Logout Time';
/* Sort criterion: User Login Logout History: User Login time stamp */
$handler->display->display_options['sorts']['login_timestamp']['id'] = 'login_timestamp';
$handler->display->display_options['sorts']['login_timestamp']['table'] = 'user_login_logout_history';
$handler->display->display_options['sorts']['login_timestamp']['field'] = 'login_timestamp';
$handler->display->display_options['sorts']['login_timestamp']['order'] = 'DESC';

/* Display: User Login Logout History */
$handler = $view->new_display('page', 'User Login Logout History', 'page');
$handler->display->display_options['path'] = 'user-login-logout-history';

$views[$view->name] = $view;
  return $views;
}