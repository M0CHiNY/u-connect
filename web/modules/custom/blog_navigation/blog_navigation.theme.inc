<?php
/**
 * @file
 * Main file for preprocessing custom theme hooks.
 */

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Implements template_preprocess_HOOK() for blog navigation.
 */

function template_preprocess_blog_navigation(&$variables)
{
  /**
   * @var EntityInterface $entity ;
   */
  $entity = $variables['entity'];
  $variables['next'] = [];
  $variables['prev'] = [];

  /**
   * @var EntityStorageInterface $entity_storage .
   */
  $entity_storage = \Drupal::entityTypeManager()->getStorage($entity->getEntityTypeId());

  /**
   * Getting next entity ID.
   */
//  $next_entity_id = $entity_storage->getQuery()
//    ->condition('type', $entity->bundle())
//    ->condition('created', $entity->getCreatedTime(), '>')
//    ->range(0, 1)
//    ->sort('created', 'ASC')
//    ->execute();
//  $next_entity_id = toString($next_entity_id);
//  if (!empty($next_entity_id)) {
//    $next_entity = $entity_storage->load($next_entity_id);
//    $variables['next']['label'] = $next_entity->label();
//    $variables['next']['url'] = $next_entity->toUrl()->toString(TRUE)->getGeneratedUrl();
//  }
  /**
   * Getting prev entity ID.
   */
//  $prev_entity_id = $entity_storage->getQuery()
//    ->condition('type', $entity->bundle())
//    ->condition('created', $entity->getCreatedTime(), '<')
//    ->sort('created', 'DESC')
//    ->range(0, 1)
//    ->execute();
//  if (!empty($prev_entity_id)) {
//    $prev_entity = $entity->load($prev_entity_id);
//    $variables['prev']['label'] = $prev_entity->label();
//    $variables['prev']['url'] = $prev_entity->toUrl()->toString(TRUE)->getGeneratedUrl();
//  }
}


