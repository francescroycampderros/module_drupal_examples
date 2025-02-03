<?php
/**
 * @file
 * Contains \Drupal\hello_world\Controller\HelloController.
 */
namespace Drupal\hello_world\Controller;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Drupal\Core\Render\HtmlResponse;
use Drupal\Core\Database\Connection;
use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {


  protected $dbConnection;


  public function __construct(Connection $connectionService){
    $this->dbConnection = $connectionService;
  }

  public function content() {
  
    // create a log channel
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler('example.log', Level::Warning));
    // add records to the log
    $log->warning('Foo');
    $log->error('Bar');


    // Si vols que es vegi amb el mateix tema:
    #return array(
    #  '#type' => 'markup',
    #  '#markup' => ('Hello, World!'),
    #);
  
    // Si no:
    $query = $this->dbConnection->select('node', 'n')->fields('n', ['nid'])->condition('nid', ['100003'], 'IN');;
    $result = $query->execute();
    $array_with_results = array_values($result->fetchAllAssoc('nid'));

    return new HtmlResponse("Hola: ".json_encode($array_with_results).".");
  }
}