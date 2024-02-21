<?php

namespace Drupal\additional_field\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
class AdditionalFieldController extends ControllerBase {
    public function saveFormAjax() {
        // Ваш код для сохранения конфигурации формы.
        // Пересобираем форму.
        $form = \Drupal::formBuilder()->getForm('Drupal\additional_field\Form\SettingsForm');
        // Возвращаем обновленную форму в формате JSON.
        return new JsonResponse($form);
    }
}