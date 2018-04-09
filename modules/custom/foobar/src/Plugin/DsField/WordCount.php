<?php

namespace Drupal\foobar\Plugin\DsField;

use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\Component\Render\FormattableMarkup;


/**
 * @DsField(
 *     id = "word_count",
 *     title = @Translation("DS: Word count"),
 *     provider = "foobar",
 *     entity_type = "node",
 *     ui_limit = {"article|full", "woodproduct|full"}
 * )
 *
 */

class WordCount extends DsFieldBase {

    public function build()
    {
        $entity = $this->entity();
        if ($body_value = $entity->body->value) {
            return [
                '#type' => 'markup',
                '#markup' => new FormattableMarkup('<strong>Count words in text content @word_count</strong>', [
                    '@word_count' => str_word_count(strip_tags($body_value))
                ])
            ];
        }
    }

}