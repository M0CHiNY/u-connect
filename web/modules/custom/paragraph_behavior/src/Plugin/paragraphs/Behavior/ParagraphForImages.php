<?php

namespace Drupal\paragraph_behavior\Plugin\paragraphs\Behavior;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @ParagraphsBehavior(
 *   id = "paragraph_begavior_images",
 *   label = @Translation("Paragraph images per row"),
 *   description = @Translation("Allows to select how much of pictures in a row."),
 *   weight = 0,
 * )
 */
class ParagraphForImages extends ParagraphsBehaviorBase
{

  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'photos_per_row', '4');
    $build['#attributes']['class'][] = 'paragraph_behavior_' . $getSettings;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return $paragraphs_type->id() == "more_images";
  }

  /**
   * {@inheritdoc}
   */

  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state): array
  {
    $form['photos_per_row'] = [
      '#type' => 'select',
      '#title' => $this->t('The number of pictures per line'),
      '#description' => $this->t('The number of pictures per line '),
      '#options' => [
        '2' => $this->formatPlural('2', '1 photo per row', '@count photos per row'),
        '3' => $this->formatPlural('3', '1 photo per row', '@count photos per row'),
        '4' => $this->formatPlural('4', '1 photo per row', '@count photos per row'),
      ],
      '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'photos_per_row', '4'),
    ];
    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(Paragraph $paragraph): array
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'photos_per_row', '4');
    $summary = [];
    $summary[] = $this->t('images per row @value', ['@value' => $getSettings]);
    return $summary;
  }

}
