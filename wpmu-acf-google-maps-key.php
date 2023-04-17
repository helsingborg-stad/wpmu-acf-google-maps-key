<?php

/*
Plugin Name:    WPMU Google Maps Key
Description:    Adds input field for a google maps api key.
Version:        1.0
Author:         Sebastian Thulin
*/

namespace WPMUAcfGoogleMapsKey;

class WPMUAcfGoogleMapsKey
{

  private $fieldOptionName = 'acf_google_api_key';

  public function __construct()
  {
      add_action('init', [$this, 'addOptionsPage']);
      add_filter('acf/fields/google_map/api', [$this, 'filterOption'], 10, 1);
  }

  public function addOptionsPage($data)
  {
    acf_add_options_page(array(
      'page_title'    => 'ACF Google Maps Key',
      'menu_title'    => 'ACF Google Maps Key',
      'menu_slug'     => 'acf-google-maps-key',
      'capability'    => 'edit_posts',
      'redirect'      => false
    ));
  }

  public function filterOption($api) {
    if ($apiKeySetting = get_field($this->fieldOptionName, 'option')) {
      $api['key'] = $apiKeySetting;
    }
    return $api;
  }
}

new \WPMUAcfGoogleMapsKey\WPMUAcfGoogleMapsKey();