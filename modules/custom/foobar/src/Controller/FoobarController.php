<?php
/**
 * @file
 * Contains \Drupal\helloworld\Controller\HelloWorldController.
 * ^ Пишется по следующему типу:
 *  - \Drupal - это указывает что данный файл относится к ядру Drupal, ведь
 *    теперь там еще есть Symfony.
 *  - helloworld - название модуля.
 *  - Controller - тип файла. Папка src опускается всегда.
 *  - HelloWorldController - название нашего класса.
 */

/**
 * Пространство имен нашего контроллера. Обратите внимание что оно схоже с тем
 * что описано выше, только опускается название нашего класса.
 */
namespace Drupal\foobar\Controller;
/**
 * Используем друпальный класс ControllerBase. Мы будем от него наследоваться,
 * а он за нас сделает все обязательные вещи которые присущи всем контроллерам.
 */

use Drupal\block_content\Entity\BlockContent;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBuilder;


class FoobarController extends ControllerBase {

    /**
     * {@inheritdoc}
     */
    public function foobarStartPage() {
        $out = array();
        $out['#title']  = 'Test 007 title';

        $block = \Drupal::service('plugin.manager.block')
            ->createInstance('foobar_contribute_form_block', [])
            ->build();

        $blockOutput = render($block);

        $out['#markup'] = $blockOutput;
        return $out;
    }
}