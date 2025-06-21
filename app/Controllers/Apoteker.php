- Buat `application/controllers/Apoteker.php`:
  ```php
  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Apoteker extends CI_Controller {
      public function __construct()
      {
          parent::__construct();
          $this->load->model('Drug_model');
      }

      // Validasi interaksi obat
      public function check_interaction()
      {
          $drug_ids = $this->input->post('drug_ids');
          $this->load->library('Drug_interaction');
          $result = $this->drug_interaction->validate($drug_ids);
          echo json_encode($result);
      }

      // Daftar obat yang akan kadaluarsa
      public function expiring_soon($days = 30)
      {
          $data['drugs'] = $this->Drug_model->get_expiring_soon($days);
          $this->load->view('apoteker/expiry_report', $data);
      }
  }
  ```