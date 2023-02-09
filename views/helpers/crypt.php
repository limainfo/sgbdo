<?php 
//App::import('Vendor','tcpdf/tcpdf');
App::import('Vendor','crypt/crypt'); 
//
//class CryptHelper extends AppHelper {
class CryptHelper extends CRYPT {
      var $helpers = array();
	
        private $Crypt;

        /**
         * encrypt()
         *
         * @param mixed $data
         * @return string
         */
        function encrypt($data) {
                if(!$this->Crypt) {
                        $this->Crypt = new CRYPT(
                Configure::read('Cryptable.cipher'),
                Configure::read('Cryptable.key'),
                Configure::read('Cryptable.mode'),
                Configure::read('Cryptable.iv'
            ));
                }
                return $this->Crypt->encrypt($data);
        }
        
		function decrypt($data) {
		  return $this->Crypt->decrypt($data);
		}        
}
?> 