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
        $node = \Drupal::routeMatch()->getParameter('node');
        
        //print_r($node);
        //die();

        if(!is_null($node)){
            $nid = $node->id();
        }else{
            $nid = 0;
        }

        $form['email'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email address'),
            '#size' => 25,
            '#description' => $this->t('We will send you updates to the email you provide.') ,
            '#required' => TRUE,
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('RSVP'),
        ];
        $form['nid'] = [
            '#type' => 'hidden',
            '#value' => $nid,
        ];

        return $form; 
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
 	$submitted_email = $form_state->getValue('email');
        $this->messenger()->addMessage($this->t("The form is working! You entered @entry.", ['@entry'=> $submitted_email]));       
    }
    


    
 }
