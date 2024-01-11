<?php

namespace Drupal\dynamic_twig_tokens\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
class SettingsForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'dynamic_twig_tokens.settings',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'dynamic_twig_tokens_settings_form';
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('dynamic_twig_tokens.settings');
        $table_values = $config->get('table') ?: [1 => ['variable_name' => '', 'variable_value' => '']];
        $config->set('table', $table_values);
        $form['info'] = [
            '#markup' => '<h3>Для вывода переменной в PHP использовать "<?php print_token("variable_name"); ?>"</h3><h3>Для вывода переменной в Twig использовать "{{variable_name}}"</h3>',
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
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Сохранить'),
        ];
        $form['#tree'] = TRUE;
        return parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('dynamic_twig_tokens.settings');
        $table_values = [];
        foreach ($form_state->getValue('table') as $value) {
            $table_values[] = [
                'variable_name' => $value['variable_name'],
                'variable_value' => $value['variable_value'],
            ];
            //$variables[$value['variable_name']] = $value['variable_value'];
        }
        $config->set('table', $table_values);
        $config->save();
        parent::submitForm($form, $form_state);
    }
    /**
     * Submit callback for adding a new row to the table.
     */
    public function addRow(array &$form, FormStateInterface $form_state) {

        $config = $this->config('dynamic_twig_tokens.settings');
        $table_values = $form_state->getValue('table');
        $current_count = count($table_values) + 1;
        $table_values[] = [$current_count => ['variable_name' => '', 'variable_value' => '']];
        $config->set('table', $table_values);
        $config->save();
        $form_state->setRebuild();


        parent::submitForm($form, $form_state);
    }
    public function delRow(array &$form, FormStateInterface $form_state) {

        $config = $this->config('dynamic_twig_tokens.settings');
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