<?php

namespace Drupal\cities_subdomains\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Дополнительные поля settings for this site.
 */
class SettingsForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'cities_subdomains_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['cities_subdomains.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state): array {

        $config = $this->config('cities_subdomains.settings');

        $form['taxonomy_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Машинное имя словаря таксономии'),
            '#default_value' => $this->config('cities_subdomains.settings')->get('taxonomy_name'),
            '#attributes' =>array(
                'placeholder' => t('Введите машинное имя словаря таксономии'),
            ),
        ];
        $form['name_field_city'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Машинное имя поля "название города для контактов"'),
            '#default_value' => $this->config('cities_subdomains.settings')->get('name_field_city'),
            '#attributes' =>array(
                'placeholder' => t('Введите машинное имя поля "название города для контактов"'),
            ),
        ];
        $form['name_field_title_index'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Машинное имя поля "H1 на главной"'),
            '#default_value' => $this->config('cities_subdomains.settings')->get('name_field_title_index'),
            '#attributes' =>array(
                'placeholder' => t('Введите машинное имя поля "H1 на главной"'),
            ),
        ];
        $form['name_site_title_index'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Машинное имя поля "title на главной"'),
            '#default_value' => $this->config('cities_subdomains.settings')->get('name_site_title_index'),
            '#attributes' =>array(
                'placeholder' => t('Введите машинное имя поля "title на главной"'),
            ),
        ];
        $form['name_field_title_banner_category'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Машинное имя поля "H1 на странице категории"'),
            '#default_value' => $this->config('cities_subdomains.settings')->get('name_field_title_banner_category'),
            '#attributes' =>array(
                'placeholder' => t('Введите машинное имя поля "H1 на странице категории"'),
            ),
        ];

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Сохранить'),
        ];
        $form['#tree'] = TRUE;

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state): void {

        $this->config('cities_subdomains.settings')
            ->set('taxonomy_name', $form_state->getValue('taxonomy_name'))
            ->set('name_field_city', $form_state->getValue('name_field_city'))
            ->set('name_field_title_index', $form_state->getValue('name_field_title_index'))
            ->set('name_site_title_index', $form_state->getValue('name_site_title_index'))
            ->set('name_field_title_banner_category', $form_state->getValue('name_field_title_banner_category'))
            ->save();

        $this->messenger()->addStatus($this->t('Данные успешно сохранены!'));

        parent::submitForm($form, $form_state);
    }


}
