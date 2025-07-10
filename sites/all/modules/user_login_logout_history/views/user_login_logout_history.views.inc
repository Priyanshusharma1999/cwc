<?php
  /**
  * Implement hook_views_data
  *
  */

   function user_login_logout_history_views_data() {
  $data = array();
    $data['user_login_logout_history']['table']['group'] = t('User Login Logout History');

     $data['user_login_logout_history']['table']['base'] = array(
      'field' => 'id', // This is the identifier field for the view.
      'title' => t('User Login Logout History'),
      'help' => t('User Login Logout History'),
      'weight' => -10,
      'description' => 'User Login Logout History.',
    );

      $data['user_login_logout_history']['uid'] = array(
          'title' => t('User Id'),
          'help' => t('Logged In User Id'),
          'filter' => array(
              'handler' => 'views_handler_filter_string',
          ),
          'field' => array(
              'handler' => 'views_handler_field',
              'click sortable' => TRUE,
          ),
          'sort' => array(
              'handler' => 'views_handler_sort',
          ),
          'argument' => array(
              'handler' => 'views_handler_argument',
          ),
      ); 
      
 $data['user_login_logout_history']['table']['join'] = array(
'users' => array(
'left_field' => 'uid', 
'field' => 'uid',
),
);

$data['user_login_logout_history']['uid'] = array(
'title' => t('Relationship with Users Table'), 
'help' => t('Some example content that references a node.'),
'relationship' => array(
'base' => 'users',
'base field' => 'uid', // The name of the field on the joined table.
// 'field' => 'nid' -- see hook_views_data_alter(); not needed here.
'handler' => 'views_handler_relationship', 
'label' => t('User Id'),
),
);
    $data['user_login_logout_history']['login_timestamp'] = array(
          'title' => t('User Login time stamp'),
          'help' => t('User Login time stamp'),
          'filter' => array(
              'handler' => 'views_handler_filter_string',
          ),
          'field' => array(
              'handler' => 'views_handler_field',
              'click sortable' => TRUE,
          ),
          'sort' => array(
              'handler' => 'views_handler_sort',
          ),
          'argument' => array(
              'handler' => 'views_handler_argument',
          ),
      ); 
    
    $data['user_login_logout_history']['logout_timestamp'] = array(
          'title' => t('User Logout Timestamp'),
          'help' => t('User Logout Timestamp'),
          'filter' => array(
              'handler' => 'views_handler_filter_string',
          ),
          'field' => array(
              'handler' => 'views_handler_field',
              'click sortable' => TRUE,
          ),
          'sort' => array(
              'handler' => 'views_handler_sort',
          ),
          'argument' => array(
              'handler' => 'views_handler_argument',
          ),
      ); 

     return $data;
  }