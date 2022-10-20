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
 *   id = "custom_classes",
 *   label = @Translation("Allow to add own classes"),
 *   description = @Translation("Allow to add own classes and change css styles"),
 *   weight = 0,
 * )
 */

class CustomClasses extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'style_classes', '');
    $getClasses = explode(' ', $getSettings);

    foreach ($getClasses as $class){
      $build['#attributes']['class'][] = 'paragraph-class--'.$class;
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return  TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state): array
  {
   $form['style_classes']=[
     '#type'=>'textfield',
     '#title'=>$this->t('Allow to add own classes'),
     '#description'=> $this->t('Multiple classes seperated by space'),
     '#placeholder'=>$this->t('Example: active bold'),
     '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'style_classes', ''),
   ];
   return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function settingsSummary(Paragraph $paragraph): array
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'style_classes', '');
    $summary = [];
    if (!empty($getSettings)){
      $summary[] = $this->t('Name classes:  @value', ['@value' => $getSettings]);
    }
    return $summary;
  }

}
