<?php

namespace Drupal\foobar\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * @Block(
 *  id = "foobar_contribute_form_block",
 *  admin_label = @Translation("Foobar Contribute form block"),
 * )
 */

class ContributeFormBlock extends BlockBase
{
    public function build()
    {
        $form = \Drupal::formBuilder()->getForm('Drupal\foobar\Form\ContributeForm');
        $form_markup = render($form);

        $block = [
            '#type' => 'markup',
            '#markup' => $form_markup
        ];
        return $block;
    }
}