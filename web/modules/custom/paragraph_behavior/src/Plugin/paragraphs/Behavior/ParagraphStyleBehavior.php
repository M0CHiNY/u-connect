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
 *   id = "paragraph_style_behavior",
 *   label = @Translation("Allow to choose style"),
 *   description = @Translation("Allow to choose style"),
 *   weight = 0,
 * )
 */

class ParagraphStyleBehavior extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {
   $getStyle = $paragraph->getBehaviorSetting($this->getPluginId(), 'styles', []);
   foreach ($getStyle as $style ) {
     $build['#attributes']['class'][] = 'paragraph_styles_' . $style;
   }
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return TRUE;
  }
  /**
   * {@inheritdoc}
   */
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state): array
  {
   $form['wrapper_style']=[
     '#type'=>'details',
     '#title'=>$this->t('Paragraph styles'),
     '#open'=>FALSE,
   ];
   $settingsStyle = $paragraph->getBehaviorSetting($this->getPluginId(), 'styles', []);
   $getCustomSettings = $this->getCustomStyle($paragraph);
   foreach ($getCustomSettings as $groups_id => $group){
     $form['wrapper_style'][$groups_id] = [
       '#type' => 'checkboxes',
       '#title'=> $group['label'],
       '#options'=>$group['options'],
       '#default_value' => $settingsStyle,
     ];
   }
   return $form;
  }
  public function submitBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state)
  {
    $styles = [];
    $filter_values = $this->filterBehaviorFormSubmitValues($paragraph,$form, $form_state);
    $style_groups = $filter_values['wrapper_style'];
    foreach ($style_groups as $group){
      foreach ($group as $style_name){
        $styles[] = $style_name;
      }
    }
    $paragraph->setBehaviorSettings($this->getPluginId(), ['styles'=>$styles]);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(Paragraph $paragraph): array
  {
    $getSettings = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $summary = [];
    $summary[] = $this->t('Position image @value', ['@value' => $getSettings]);
    return $summary;
  }

  /**
   * Get settings style custom function.
   */
  public function getCustomStyle(ParagraphInterface $paragraph): array
  {
    $style =[];

    if($paragraph->hasField('field_title')){
      $style['title'] = [
        'label'=>$this->t('Paragraph title'),
        'options' => [
          'title_bold' =>'Bold',
          'title_center'=>'Center',
        ]
      ];
    }
    $style['common'] = [
      'label' => $this->t('Paragraph common style'),
      'options' => [
        'style_black' => 'Black'
      ]
    ];

    return $style;
  }

}
