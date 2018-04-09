<?php

/**
 * @file
 * Contains \Drupal\foobar\Plugin\Block\FoobarBlock
 */


namespace Drupal\foobar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Menu\MenuTreeParameters;

/**
 * @Block(
 *  id = "foobar_example_block",
 *  admin_label = @Translation("Foobar example block"),
 * )
 */

class FoobarBlock extends BlockBase {

    public function build() {
        $message = '';
        $conf = $this->getConfiguration();

        for($i = 0; $i < $conf['count']; $i ++) {
            $message .= $conf['message'];
        }

        // Menu output
        $menu_tree_parameters = new MenuTreeParameters();
        $tree = \Drupal::menuTree()->load('main', $menu_tree_parameters);
        $tree_array = \Drupal::menuTree()->build($tree);
        $menu_output = drupal_render($tree_array);

        $message = $menu_output
            . '<p>'
            . $message
            . '</p>';

        $block = [
            '#type' => 'markup',
            '#markup' => $message,
        ];
        return $block;
    }

    public function defaultConfiguration() {
        return [
            'count' => 1,
            'message' => 'Test message.',
        ];
    }

    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);
        $config = $this->getConfiguration();

        $form['message'] = [
            '#title' => $this->t('Message to printing'),
            '#type' => 'textfield',
            '#default_value' => $config['message'],
        ];
        $form['count'] = [
            '#title' => $this->t('How many times print msg'),
            '#type' => 'number',
            '#min' => 1,
            '#default_value' => $config['count'],
        ];
        return $form;
    }

    public function blockValidate($form, FormStateInterface $form_state) {
        $count = $form_state->getValue('count');
        $message = $form_state->getValue('message');

        // Check for count range
        if (!is_numeric($count) || $count < 1) {
            $form_state->setErrorByName('count', 'Needs to be an integer and more or equal 1');
        }

        // Check for the message field
        if (strlen($message) < 5) {
            $form_state->setErrorByName('message', 'Message must contain 5 or more than 5 letters');
        }
    }

    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['count'] = $form_state->getValue('count');
        $this->configuration['message'] = $form_state->getValue('message');
    }
}