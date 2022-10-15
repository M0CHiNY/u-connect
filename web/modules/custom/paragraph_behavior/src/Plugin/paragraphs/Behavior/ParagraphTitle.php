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
 *   id = "paragraph_behavior_title",
 *   label = @Translation("Allow change tags for title"),
 *   description = @Translation("Allow change tags for title"),
 *   weight = 0,
 * )
 */

class ParagraphTitle extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {

  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return TRUE;
  }
  public function preprocess(&$variables)
  {
    /**
     * @var ParagraphInterface $paragraph
     */
    $paragraph  = $variables['paragraph'];
    $variables['tags_title'] = $paragraph->getBehaviorSetting($this->getPluginId(), 'tags_title', 'div');

  }

  /**
   * {@inheritdoc}
   */
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state): array
  {
   $form['tags_title']=[
     '#type'=>'select',
     '#title'=>$this->t('change tags for title'),
     '#options'=>[
       'h2' => 'h2',
       'h3' => 'h3',
       'h4' => 'h4',
       'div' => 'div',
     ],
     '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'tags_title', 'div'),
   ];
   return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function settingsSummary(Paragraph $paragraph): array
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'tags_title', 'div');
    $summary = [];
    $summary[] = $this->t('Current tag:  @value', ['@value' => $getSettings]);
    return $summary;
  }

}
