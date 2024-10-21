<?php

namespace Drupal\migrate_api_cj5\Plugin\migrate\source; //?

use Drupal\migrate\Annotation\MigrateSource;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "games",
 *   source_module = "migrate_api_cj5",
 * )
 */
class Games extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Source data is queried from 'curling_games' table.
    $query = $this->select('file_managed', 'fm')
      ->fields('fm', [
          'fid',
          'filename',
          'uri',
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'fid' => $this->t('fid' ),
      'filename' => $this->t('filename' ),
      'uri'   => $this->t('uri' ),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'fid' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // This example shows how source properties can be added in
    // prepareRow(). The source dates are stored as 2017-12-17
    // and times as 16:00. Drupal 8 saves date and time fields
    // in ISO8601 format 2017-01-15T16:00:00 on UTC.
    // We concatenate source date and time and add the seconds.
    // The same result could also be achieved using the 'concat'
    // and 'format_date' process plugins in the migration
    // definition.
    $uri = $row->getSourceProperty('uri');
    $path = substr($uri,9,null);
    $row->setSourceProperty('path', $path);
    return parent::prepareRow($row);
  }
}
