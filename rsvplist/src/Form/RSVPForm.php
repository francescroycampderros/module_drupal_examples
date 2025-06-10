<?php

/**
 * @file
 * A form to collect an email address for RSVP details.
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RSVPForm extends FormBase {

   /**
   * {@inheritdoc}
   */
    public function getFormId()
    {
        return 'rsvplist_email_form';
    }

    //
    //
    // IMPORTANT, NO ESTEM USANT WEBFORM MODULE SINO QUE USEM LA API!!!!
    //
    //

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){
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

    public function validateForm(array &$form, FormStateInterface $form_state){
        $submitted_email = $form_state->getValue('email');
        if(!\Drupal::service('email.validator')->isValid($submitted_email)){
            $form_state->setErrorByName('email',$this->t("It is not a valid email: %mail",["%mail"=> $submitted_email]));
        }
    
    }

    public function submitForm(array &$form, FormStateInterface $form_state){
 	    $submitted_email = $form_state->getValue('email');
        $this->messenger()->addMessage($this->t("The form is working! You entered @entry.", ['@entry'=> $submitted_email]));       

        // Entec que aquí posarem el insert a la bbdd...
        
        
        $database = \Drupal::database();
        $query = $database->select('users','u');
        $query->condition('u.uid',0,'=');
        $query->fields('u',['uid','langcode']);

        $result = $query->execute();

        

        $this->messenger()->addMessage($result->fetchAllAssoc('uid'));       


    }
    


    
 }
