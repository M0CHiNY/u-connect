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
 *   id = "paragraph_image_positions",
 *   label = @Translation("Allow is postions image"),
 *   description = @Translation("Allow is postions image to the left or to the right"),
 *   weight = 0,
 * )
 */

class ImagePositions extends ParagraphsBehaviorBase {

  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $build['#attributes']['class'][] = 'paragraph-position-'.$getSettings;
  }

  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return  $paragraphs_type->id() == 'text_and_image';
  }
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state): array
  {
   $form['image_position']=[
     '#type'=>'select',
     '#title'=>$this->t('Change position images'),
     '#options'=>[
       'left' => 'Image left',
       'right' => 'Image right'
     ],
     '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left'),
   ];
   return $form;
  }
  public function settingsSummary(Paragraph $paragraph): array
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $summary = [];
    $summary[] = $this->t('Position image @value', ['@value' => $getSettings]);
    return $summary;
  }

}
