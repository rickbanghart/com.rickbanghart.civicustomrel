<?php

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Civicustomrel_Form_RegisterPet extends CRM_Core_Form {
  public function buildQuickForm() {
    $event = new CRM_Event_BAO_Event();
    $events = $event->getEvents();
      $props['field'] = 'Event';
      $props['multiple'] = 0;
    $options['1'] = 'Event 1';
    $options['2'] = 'Event 2';
      $props['options'] = $options;
    $this->add('select', 'event', 'Event', $events, 0 , $props);
    //$this->addSelect('Event');
    // add form elements
    $this->add(
      'text', // field type
      'first_name', // field name
      'First Name', // field label
      TRUE // is required
    );
    $this->add('text','last_name','Last Name',FALSE);
    $this->add('text','pet_name','Pet Name');
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Register'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $values = $this->exportValues();
    $options = $this->getColorOptions();
    CRM_Core_Session::setStatus(ts('You picked color "%1"', array(
      1 => $options[$values['favorite_color']],
    )));
    parent::postProcess();
  }

  public function getColorOptions() {
    $options = array(
      '' => ts('- select -'),
      '#f00' => ts('Red'),
      '#0f0' => ts('Green'),
      '#00f' => ts('Blue'),
      '#f0f' => ts('Purple'),
    );
    foreach (array('1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e') as $f) {
      $options["#{$f}{$f}{$f}"] = ts('Grey (%1)', array(1 => $f));
    }
    return $options;
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
