<?php

/**
 * @file
 * Contains \Drupal\composer_deploy\ComposerDeployHanlder.
 */

namespace Drupal\composer_deploy;

class ComposerDeployHandler {

  protected $packages = [];

  public function __construct($path) {
    $packages = json_decode(file_get_contents($path), TRUE);
    $this->packages = is_array($packages) ? $packages : [];
  }

  public function getPackage($projectName) {
    foreach ($this->packages as $package) {
      if ($package['name'] == 'drupal/' . $projectName) {
        return $package;
      }
    }
    return FALSE;
  }

  public static function fromVendorDir($vendor_dir) {
    return new static($vendor_dir . '/composer/installed.json');
  }

}
