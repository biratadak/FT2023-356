<?php

/**
 * @file
 * Defines a custom hook to show visit count in each node.
 */

/**
 * Defines hook for count nodes visits.
 */
function hook_counter($current_count, \Drupal\node\NodeInterface $node) {
  if ($current_count === 1) {
    \Drupal::messenger()->addMessage(t('This node visited for first time.'));
  }
}
