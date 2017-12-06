<?php

class CRM_Civicustomrel_Page_CstmRel extends CRM_Core_Page {

  public function run() {
      $servername = "localhost";
      $username = "rickbang_root";
      $password = "23rickbang";
      $dbname = "rickbang_ebspca_drupal";
      print_r('Something to print');
      // Civi::log()->debug('An error message here');

// Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('Owners/Pets'));
      
    $qry = "SELECT r.contact_id_a, r.contact_id_b, a.first_name as first_name, a.last_name as last_name, b.nick_name as pet_name,
      cv.breed_3 as breed 
      FROM civicrm_relationship r
      LEFT JOIN civicrm_contact a ON a.id = r.contact_id_a
      LEFT JOIN civicrm_contact b ON b.id = r.contact_id_b
      LEFT JOIN civicrm_value_animal_fields_1 cv ON cv.entity_id = b.id
      WHERE r.relationship_type_id = 11
      ORDER BY a.last_name, a.first_name";
      $result = $conn->query($qry);
      while($row = $result->fetch_assoc()) {
          $contacts[] = $row;
      }
      $results = civicrm_api3('Relationship', 'get', array(
          'relationship_type_id' => 11,
          'return' => array("contact_id_a.first_name", "contact_id_a.last_name",
              "contact_id_b.nick_name"),
          'sequential' => 1,
          'options' => array('limit' => 100),
      ));
    $this->assign('num_rows', count($contacts));
    $this->assign('contacts', $contacts);
    //var_dump($results);
    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));

    parent::run();
  }
    public function buildQuickForm() {

        // add form elements
        $this->add(
            'select', // field type
            'favorite_color', // field name
            'Favorite Color', // field label
            $this->getColorOptions(), // list of options
            TRUE // is required
        );
        $this->addButtons(array(
            array(
                'type' => 'submit',
                'name' => ts('Submit'),
                'isDefault' => TRUE,
            ),
        ));

        // export form elements
        $this->assign('elementNames', $this->getRenderableElementNames());
        parent::buildQuickForm();
    }


  public function save() {
      CRM_Core_Error::debug_log_message('In the save function of cstmrel.php');

  }

}
