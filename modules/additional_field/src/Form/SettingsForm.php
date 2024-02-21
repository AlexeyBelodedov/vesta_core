<?php

namespace Drupal\additional_field\Form;

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
        return 'additional_field_settings';
    }

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['additional_field.settings'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state): array {

        $config = $this->config('additional_field.settings');
        $table_values = $config->get('table') ?: [1 => ['variable_name' => '', 'variable_value' => '']];
        $config->set('table', $table_values);

        $form['phone_number'] = [
            '#type' => 'textfield',
            '#description' => "Использование для php print_field_info('phone_number') <br> Использование для Twig {{get_phone}}",
            '#title' => $this->t('Номер телефона'),
            '#default_value' => $this->config('additional_field.settings')->get('phone_number'),
            '#attributes' =>array(
                'placeholder' => t('Введите номер телефона'),
            ),
        ];
        $form['mail'] = [
            '#type' => 'textfield',
            '#description' => "Использование для php print_field_info('mail') <br> Использование для Twig {{get_mail}}",
            '#title' => $this->t('Адрес электронной почты'),
            '#default_value' => $this->config('additional_field.settings')->get('mail'),
            '#attributes' =>array(
                'placeholder' => t('Введите адрес электронной почты'),
            ),
        ];
        $form['viber'] = [
            '#type' => 'textfield',
            '#description' => "Использование для php print_field_info('viber') <br> Использование для Twig {{get_viber}}",
            '#title' => $this->t('Номер Viber'),
            '#default_value' => $this->config('additional_field.settings')->get('viber'),
            '#attributes' =>array(
                'placeholder' => t('Введите номер Viber'),
            ),
        ];
        $form['whatsapp'] = [
            '#type' => 'textfield',
            '#description' => "Использование для php print_field_info('whatsapp') <br> Использование для Twig {{get_whatsapp}}",
            '#title' => $this->t('Номер Whatsapp'),
            '#default_value' => $this->config('additional_field.settings')->get('whatsapp'),
            '#attributes' =>array(
                'placeholder' => t('Введите номер Whatsapp'),
            ),
        ];
        $form['vk'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Адрес VK'),
            '#description' => "Использование для php print_field_info('vk') <br> Использование для Twig {{get_vk}}",
            '#default_value' => $this->config('additional_field.settings')->get('vk'),
            '#attributes' =>array(
                'placeholder' => t('Введите адрес VK'),
            ),
        ];
        $form['telegram'] = [
            '#type' => 'textfield',
            '#title' => $this->t('ID или Номер Telegram'),
            '#description' => "Использование для php print_field_info('telegram') <br> Использование для Twig {{get_tg}}",
            '#default_value' => $this->config('additional_field.settings')->get('telegram'),
            '#attributes' =>array(
                'placeholder' => t('Введите ID или Номер Telegram'),
            ),
        ];
        $form['index'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Индекс'),
            '#description' => "Использование для php print_field_info('index') <br> Использование для Twig {{get_index}}",
            '#default_value' => $this->config('additional_field.settings')->get('index'),
            '#attributes' =>array(
                'placeholder' => t('Введите индекс'),
            ),
        ];
        $form['city'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Город'),
            '#description' => "Использование для php print_field_info('city') <br> Использование для Twig {{get_city}}",
            '#default_value' => $this->config('additional_field.settings')->get('city'),
            '#attributes' =>array(
                'placeholder' => t('Введите город'),
            ),
        ];
        $form['street'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Улица'),
            '#description' => "Использование для php print_field_info('street') <br> Использование для Twig {{get_street}}",
            '#default_value' => $this->config('additional_field.settings')->get('street'),
            '#attributes' =>array(
                'placeholder' => t('Введите улицу'),
            ),
        ];
        $form['house'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Дом'),
            '#description' => "Использование для php print_field_info('house') <br> Использование для Twig {{get_house}}",
            '#default_value' => $this->config('additional_field.settings')->get('house'),
            '#attributes' =>array(
                'placeholder' => t('Введите дом'),
            ),
        ];
        $form['additional_info'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Дополнительная информация'),
            '#description' => "Использование для php print_field_info('additional_info') <br> Использование для Twig {{get_additional}}",
            '#default_value' => $this->config('additional_field.settings')->get('additional_info'),
            '#attributes' =>array(
                'placeholder' => t('Укажите необходимую информацию'),
            ),
        ];

        $form['info'] = [
            '#markup' => '<h3>Для вывода переменной в PHP использовать "<?php print_field_info("variable_name"); ?>"</h3><h3>Для вывода переменной в Twig использовать "{{variable_name}}"</h3>',
        ];
        $form['table'] = [
            '#type' => 'table',
            '#header' => [$this->t('Название переменной'), $this->t('Значение переменной')],
            '#empty' => $this->t('Нет данных'),
        ];
        foreach ($table_values as $key => $value) {
            $form['table'][$key]['variable_name'] = [
                '#type' => 'textfield',
                //'#title' => $this->t('Название переменной'),
                '#default_value' => isset($value['variable_name']) ? $value['variable_name'] : '',
            ];
            $form['table'][$key]['variable_value'] = [
                '#type' => 'textfield',
                //'#title' => $this->t('Значение переменной'),
                '#default_value' => isset($value['variable_value']) ? $value['variable_value'] : '',
            ];
        }
        $form['actions']['add_row'] = [
            '#type' => 'submit',
            '#value' => $this->t('Добавить строку'),
            '#submit' => ['::addRow'],
//            '#ajax' => [
//                'callback' => '::updAjaxCallback',//updAjaxCallback
//                'event' => 'click',
//                'wrapper' => 'table-wrapper',
//            ],
        ];

        $form['actions']['del_row'] = [
            '#type' => 'submit',
            '#value' => $this->t('Удалить строку'),
            '#submit' => ['::delRow'],
//            '#ajax' => [
//                'callback' => '::updAjaxCallback',//updAjaxCallback
//                'event' => 'click',
//                'wrapper' => 'table-wrapper',
//            ],
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

        $table_values = [];

        foreach ($form_state->getValue('table') as $value) {
            $table_values[] = [
                'variable_name' => $value['variable_name'],
                'variable_value' => $value['variable_value'],
            ];
        }

        $this->config('additional_field.settings')
            ->set('phone_number', $form_state->getValue('phone_number'))
            ->set('mail', $form_state->getValue('mail'))
            ->set('viber', $form_state->getValue('viber'))
            ->set('whatsapp', $form_state->getValue('whatsapp'))
            ->set('vk', $form_state->getValue('vk'))
            ->set('telegram', $form_state->getValue('telegram'))
            ->set('index', $form_state->getValue('index'))
            ->set('city', $form_state->getValue('city'))
            ->set('street', $form_state->getValue('street'))
            ->set('house', $form_state->getValue('house'))
            ->set('additional_info', $form_state->getValue('additional_info'))
            ->set('table', $table_values)
            ->save();

        $this->messenger()->addStatus($this->t('Данные успешно сохранены!'));

        parent::submitForm($form, $form_state);
    }


    /**
     * Submit callback for adding a new row to the table.
     */
    public function addRow(array &$form, FormStateInterface $form_state) {

        $config = $this->config('additional_field.settings');
        $table_values = $form_state->getValue('table');
        $current_count = count($table_values) + 1;
        $table_values[] = [$current_count => ['variable_name' => '', 'variable_value' => '']];
        $config->set('table', $table_values);
        $config->save();
        $form_state->setRebuild();


        parent::submitForm($form, $form_state);
    }
    public function delRow(array &$form, FormStateInterface $form_state) {

        $config = $this->config('additional_field.settings');
        $table_values = $form_state->getValue('table');
        $current_count = count($table_values) - 1;
        unset($table_values[$current_count]);
        $config->set('table', $table_values);
        $config->save();
        $form_state->setRebuild();


        parent::submitForm($form, $form_state);
    }
    /**
     * Ajax callback for adding a new row to the table.
     */
    public function updAjaxCallback(array &$form, FormStateInterface $form_state) {
        return $form['table'];
    }

}
