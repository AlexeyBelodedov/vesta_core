<?php

namespace Drupal\dynamic_twig_tokens\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
class DynamicTwigController extends ControllerBase {
    public function saveFormAjax() {
        // Ваш код для сохранения конфигурации формы.
        // Пересобираем форму.
        $form = \Drupal::formBuilder()->getForm('Drupal\dynamic_twig_tokens\Form\SettingsForm');
        // Возвращаем обновленную форму в формате JSON.
        return new JsonResponse($form);
    }
}