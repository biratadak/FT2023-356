<?php

namespace Drupal\database_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for DB Test routes.
 */
class DatabaseTestController extends ControllerBase {

  /**
   * Stores the connenction object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Initialize the services using constructor.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   Stores the connection object.
   *
   * @return void
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * Getting the services using container.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   Initialize container object.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Method __invoke Builds the response.
   *
   * @return array
   *   Returns the render response.
   */
  public function __invoke() {
    $data = $this->getData();
    return [
      '#theme' => 'dashboard',
      '#data'  => $data,
      '#title' => 'Dashboard',
    ];
  }

  /**
   * Get the data from database.
   *
   * @return array
   *   Returns the data and count arrays from database
   */
  public function getData() {
    try {
      // This table has title values of event.
      $query = $this->connection->select('node_field_data', 'n');
      // This table has description values of event.
      $query->join('node__body', 'nb', 'nb.entity_id=n.nid');
      // This table has event date values of event.
      $query->join('node__field_event_date', 'nfed', 'nfed.entity_id=n.nid');
      // This table has event type values of event.
      $query->join('node__field_type', 'nft', 'nft.entity_id=n.nid');
      $query->join('taxonomy_term_field_data', 'ttfd', 'ttfd.tid=nft.field_type_target_id');

      // Add Fields to show().
      $query
        ->fields('n', ['title'])
        ->addField('ttfd', 'name', 'eventType');

      $query->addExpression('YEAR(field_event_date_value)', 'year');
      $query->addExpression('QUARTER(field_event_date_value)', 'quarter');

      $result = $query->execute()->fetchAll();
    }
    catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }

    $index       = 1;
    $dataCounter = [];
    foreach ($result as $row) {
      foreach ($row as $key => $val) {
        $data[$index][$key] = $val;
        // Select fields to get count values.
        if ($key == 'year' || $key == 'quarter' || $key == 'eventType') {
          // If the value is not set initialize
          // array key and assign 1 else increment the value.
          isset($dataCounter[$key . 'Count'][$val]) ? $dataCounter[$key . 'Count'][$val]++ : $dataCounter[$key . 'Count'][$val] = 1;
        }
      }
      $index++;
    }

    // Return the data and there counts combined together.
    return $data + $dataCounter;
  }

}
