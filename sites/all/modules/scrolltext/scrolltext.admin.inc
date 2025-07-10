<?php
/**
 * @file
 * Menu builder functions for ScrollText menu.
 */
function scrolltext_settings_form($form, &$form_state) {
  $form['scrolltext_general'] = array(
    '#type' => 'fieldset',
    '#title' => t('General settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description' => t('Remember to enable the ScrollText on Drupal !blocks . CSS id is "scrolltext" to theming ScrollText.', array('!blocks' => l('blocks', 'admin/structure/block'))),
  );
  $form['scrolltext_general']['scrolltext_direction'] = array(
    '#type' => 'select',
    '#title' => t('Scroll Direction'),
    '#default_value' => variable_get('scrolltext_direction', 'Left'),
    '#options' => array(
      'Left' => 'Left',
      'Right' => 'Right',
      'Up' => 'Up',
      'Down' => 'Down',
    ),
  );
  $form['scrolltext_general']['scrolltext_behavior'] = array(
    '#type' => 'select',
    '#title' => t('Scroll Type'),
    '#default_value' => variable_get('scrolltext_behavior', 'Scroll'),
    '#options' => array(
      'Scroll' => 'Scroll',
      'Slide' => 'Slide',
      'Alternate' => 'Bouncing',
    ),
    '#description' => t('Bouncing will not run if scrol text wider than scroll width.'),
  );
  $form['scrolltext_general']['scrolltext_speed'] = array(
    '#type' => 'textfield',
    '#title' => t('Scroll Speed'),
    '#default_value' => variable_get('scrolltext_speed', '10'),
  );
  $form['scrolltext_general']['scrolltext_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('Scroll Delay (milisecond)'),
    '#default_value' => variable_get('scrolltext_delay', '100'),
  );

  $form['scrolltext_general']['scrolltext_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Scroll Width'),
    '#default_value' => variable_get('scrolltext_width', '100%'),
  );

  $form['scrolltext_general']['scrolltext_height'] = array(
    '#type' => 'textfield',
    '#title' => t('Scroll Height'),
    '#default_value' => variable_get('scrolltext_height', '0'),
    '#description' => t('HEIGHT depends on scroll text length, try use 0 if the ScrollText DIRECTION does not work!'),
  );

  $form['scrolltext_source'] = array(
    '#type' => 'fieldset',
    '#title' => t('Source settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['scrolltext_source']['scrolltext_source_type'] = array(
    '#type' => 'select',
    '#title' => t('ScrollText Source Type'),
    '#options' => array(
      'content_type' => 'Content Type',
      'views' => 'Views',
    ),
    '#default_value' => variable_get('scrolltext_source_type', 'content_type')
  );
    $form['scrolltext_source']['scrolltext_source_value'] = array(
    '#type' => 'textfield',
    '#title' => t('ScrollText Source Value'),
    '#default_value' => variable_get('scrolltext_source_value', 'article'),
    '#description' => t('Enter Content Type or Views name.'),
  );
    $form['scrolltext_source']['scrolltext_count'] = array(
    '#type' => 'textfield',
    '#title' => t('Title Count'),
    '#default_value' => variable_get('scrolltext_count', '10'),
    '#description' => t('<p>How many new title would you like to scrol? NOTE: greater number will cause you website slowly! <b>This value has no effect if you use Views as source</b></p>'),
  );

  return system_settings_form($form);
}
