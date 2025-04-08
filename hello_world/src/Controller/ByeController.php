<?php
/**
 * @file
 * Contains \Drupal\hello_world\Controller\HelloController.
 */
namespace Drupal\hello_world\Controller;

require __DIR__ . '/../../../vendor/autoload.php';

use Drupal\Core\Controller\ControllerBase;

class ByeController extends ControllerBase {

  public function __construct(){
  }

  public function content() {
    return [
    '#theme' => 'my_template',
    '#test_var' => $this->t('Test Value'),
    ];
  }

}
