<?php

namespace Drupal\dynamic_twig_tokens\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
class DynamicTwigController extends ControllerBase {
    public function saveFormAjax() {
        // ��� ��� ��� ���������� ������������ �����.
        // ������������ �����.
        $form = \Drupal::formBuilder()->getForm('Drupal\dynamic_twig_tokens\Form\SettingsForm');
        // ���������� ����������� ����� � ������� JSON.
        return new JsonResponse($form);
    }
}