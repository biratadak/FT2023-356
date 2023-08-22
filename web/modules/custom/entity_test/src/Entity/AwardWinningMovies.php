<?php

namespace Drupal\entity_test\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\entity_test\AwardWinningMoviesInterface;

/**
 * Defines the award winning movies entity type.
 *
 * @ConfigEntityType(
 *   id = "award_winning_movies",
 *   label = @Translation("Award winning movie"),
 *   label_collection = @Translation("Award winning movies"),
 *   label_singular = @Translation("award winning movie"),
 *   label_plural = @Translation("award winning movies"),
 *   label_count = @PluralTranslation(
 *     singular = "@count award winning movie",
 *     plural = "@count award winning movies",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\entity_test\AwardWinningMoviesListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entity_test\Form\AwardWinningMoviesForm",
 *       "edit" = "Drupal\entity_test\Form\AwardWinningMoviesForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   config_prefix = "award_winning_movies",
 *   admin_permission = "administer award_winning_movies",
 *   links = {
 *     "collection" = "/admin/structure/award-winning-movies",
 *     "add-form" = "/admin/structure/award-winning-movies/add",
 *     "edit-form" = "/admin/structure/award-winning-movies/{award_winning_movies}",
 *     "delete-form" = "/admin/structure/award-winning-movies/{award_winning_movies}/delete",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "movie",
 *     "movie_year",
 *   },
 * )
 */
final class AwardWinningMovies extends ConfigEntityBase implements AwardWinningMoviesInterface {

  /**
   * The config ID.
   *
   * @var id
   */
  protected string $id;

  /**
   * The award title.
   *
   * @var label
   */
  protected string $label;

  /**
   * The movie reference.
   *
   * @var movie
   */
  protected string $movie;

  /**
   * The year of award.
   *
   * @var movieYear
   */
  protected string $movieYear;

}
