<?php

namespace Drupal\dynamic_tokens\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
class DynamicTokenController extends ControllerBase {
    public function saveFormAjax() {
        // ��� ��� ��� ���������� ������������ �����.
        // ������������ �����.
        $form = \Drupal::formBuilder()->getForm('Drupal\dynamic_tokens\Form\SettingsForm');
        // ���������� ����������� ����� � ������� JSON.
        return new JsonResponse($form);
    }
}