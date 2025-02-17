<?php

/**
 * @file
 * A form to collect an email address for RSVP details.
 */

 namespace Drupal\rsvplist\Form;

 use Drupal\Core\Form\FormBase;
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Core\StringTranslation\StringTranslationTrait;

 class RSVPForm extends FormBase {

   /**
   * {@inheritdoc}
   */
    public function getFormId()
    {
        return 'rsvplist_email_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['email'] = [
            '#type' => 'textfield',
            '#title' => StringTranslationTrait::t('Email address'),
            '#size' => 25,
            '#description' => StringTranslationTrait::t('We will send you updates to the email you provide.') ,
            '#required' => TRUE,
        ];
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        
    }
    


    
 }