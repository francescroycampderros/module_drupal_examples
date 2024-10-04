<?php

namespace Drupal\migrate_api_cj\Plugin\migrate\source; //?

use Drupal\migrate\Annotation\MigrateSource;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
//use Drupal\migrate\Row;

/**
 * Minimalistic example for a SqlBase source plugin.
 *
 * @MigrateSource(
 *   id = "games",
 *   source_module = "migrate_api_cj",
 * )
 */
class Games extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Source data is queried from 'curling_games' table.
    $query = $this->select('field_data_body', 'fdb')
      ->fields('fdb', [
          'entity_id',
          'body_value',
          'body_summary',
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'entity_id' => $this->t('entity_id' ),
      'body_value'   => $this->t('body_value' ),
      'body_summary'   => $this->t('body_summary' ),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'entity_id' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }

//  /**
//   * {@inheritdoc}
//   */
//  public function prepareRow(Row $row) {
//    // This example shows how source properties can be added in
//    // prepareRow(). The source dates are stored as 2017-12-17
//    // and times as 16:00. Drupal 8 saves date and time fields
//    // in ISO8601 format 2017-01-15T16:00:00 on UTC.
//    // We concatenate source date and time and add the seconds.
//    // The same result could also be achieved using the 'concat'
//    // and 'format_date' process plugins in the migration
//    // definition.
//    $date = $row->getSourceProperty('date');
//    $time = $row->getSourceProperty('time');
//    $datetime = $date . 'T' . $time . ':00';
//    $row->setSourceProperty('datetime', $datetime);
//    return parent::prepareRow($row);
//  }
}
