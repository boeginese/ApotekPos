```php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Migration_Add_pharmacy_schema extends CI_Migration {

      public function up()
      {
          // Tambahkan kolom ke tabel items
          $fields = array(
              'expiry_date' => array('type' => 'DATE', 'null' => TRUE),
              'drug_category' => array('type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE),
              'prescription_required' => array('type' => 'TINYINT', 'constraint' => 1, 'default' => 0)
          );
          $this->dbforge->add_column('items', $fields);

          // Buat tabel prescriptions
          $this->dbforge->add_field(array(
              'prescription_id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE),
              'customer_id' => array('type' => 'INT', 'constraint' => 11),
              'doctor_name' => array('type' => 'VARCHAR', 'constraint' => 100),
              'issue_date' => array('type' => 'DATE'),
              'expiry_date' => array('type' => 'DATE')
          ));
          $this->dbforge->add_key('prescription_id', TRUE);
          $this->dbforge->create_table('prescriptions');

          // Buat tabel prescription_items
          $this->dbforge->add_field(array(
              'prescription_item_id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE),
              'prescription_id' => array('type' => 'INT', 'constraint' => 11),
              'item_id' => array('type' => 'INT', 'constraint' => 11),
              'quantity' => array('type' => 'DECIMAL', 'constraint' => '15,3')
          ));
          $this->dbforge->add_key('prescription_item_id', TRUE);
          $this->dbforge->create_table('prescription_items');
      }

      public function down()
      {
          $this->dbforge->drop_column('items', 'expiry_date');
          $this->dbforge->drop_column('items', 'drug_category');
          $this->dbforge->drop_column('items', 'prescription_required');
          $this->dbforge->drop_table('prescriptions');
          $this->dbforge->drop_table('prescription_items');
      }
  }
  ```