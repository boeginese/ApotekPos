##Buat `application/models/Drug_model.php`:
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Drug_model extends CI_Model {
      public function get_expiring_soon($days = 30)
      {
          $threshold_date = date('Y-m-d', strtotime("+$days days"));
          return $this->db->where('expiry_date <=', $threshold_date)
                          ->where('expiry_date >=', date('Y-m-d'))
                          ->get('items')
                          ->result();
      }
  }