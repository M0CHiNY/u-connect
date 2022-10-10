<?php
namespace Drupal\paragraph_begavior\Plugin\paragraphs\Behavior;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * @ParagraphsBehavior(
 *   id = "paragraph_begavior_images",
 *   label = @Translation("Paragraph images element"),
 *   description = @Translation("Allows to select number of pictures in a row."),
 *   weight = 0,
 * )
 */

class ParagraphForImages extends ParagraphsBehaviorBase {

  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode)
  {
    // TODO: Implement view() method.
  }

  public static function isApplicable(ParagraphsType $paragraphs_type): bool
  {
    return TRUE;
  }
}
