<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Encrypt {
    var $key;
    
	function __construct()
	{
		$this->ci =& get_instance();
		$this->key = substr(sha1(date('Ymd')."bL4ck0".$_SERVER['REMOTE_ADDR'].$this->ci->config->item('encryption_key')),0,24);
	}
	
    public  function safe_b64encode($string) {
    
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('_MMT_','_',''),$data);
        return $data;
    }
 
    public function safe_b64decode($string) {
        $data = str_replace(array('_MMT_','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
    
    public  function encode($value){ 
        
        if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decode($value){
        
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
}