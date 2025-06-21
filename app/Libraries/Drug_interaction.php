- Buat `application/libraries/Drug_interaction.php`:
  ```php
  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Drug_interaction {
      private $api_url = 'https://api.drugbank.com/v1/'; // Contoh, ganti dengan API sebenarnya

      public function validate($drug_ids)
      {
          // Contoh: kirim request ke API untuk cek interaksi
          $combo = implode(',', $drug_ids);
          $ch = curl_init($this->api_url . "interactions?drugs=$combo");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          curl_close($ch);

          return json_decode($response, true);
      }
  }
  ```