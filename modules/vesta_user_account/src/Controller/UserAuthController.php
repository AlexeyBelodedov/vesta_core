<?php
namespace Drupal\vesta_user_account\Controller;

use Drupal\Core\Controller\ControllerBase;

class UserAuthController extends ControllerBase {
    public function authPage() {
        $build = [];
//
//        // Create the registration form
//        $user_create = \Drupal::entityTypeManager()->getStorage('user')->create();
//        $register_form = \Drupal::service('entity.form_builder')->getForm($user_create, 'register');
//        $login_form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
//        $password_form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserPasswordForm');
//
////        $build['register_form'] = \Drupal::service('renderer')->renderRoot($register_form);
////        $build['login_form'] = \Drupal::service('renderer')->renderRoot($login_form);
////        $build['password_form'] = \Drupal::service('renderer')->renderRoot($password_form);
//
//        $build['register_form'] = $register_form;
//        $build['login_form'] = $login_form;
//        $build['password_form'] = $password_form;

        return $build;
    }
    public function redirectToAuth() {
        $url = Url::fromRoute('vesta_user_account.user_auth');
        $response = new RedirectResponse($url->toString());
        $response->send();
        exit;
    }
}