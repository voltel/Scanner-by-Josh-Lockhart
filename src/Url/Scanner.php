<?php
/*
 * Class Scanner
 * It's just a slightly refactored replica of an example from Josh Lockhart's book
 * "Modern PHP" by O'Reilly (2015)
 * For original code see https://github.com/modern-php/scanner
 * and its forked version: https://github.com/frankperez87/scanner/blob/master/src/Url/Scanner.php
 */
namespace Oreilly\ModernPhp\Url;

use GuzzleHttp\Client as HttpClient;

class Scanner
{

const STATUS_ERROR_500 = 500;

// an array of strings with urls to test
protected $a_urls;

// an object of server client - GuzzleHttp\Client
protected $o_http_client;

/**
 * Create a new Scanner Instance
 * @param - optional - array - $a_urls - an array of strings with urls to test
 * @return - void 
 */
public function __construct(array $a_urls=array())
{
    //
    if (!empty($a_urls)) $this->a_urls = $a_urls;
    
    $this->o_http_client = new HttpClient();

}//end of funciton __construct

/**
 * 
 *
 * @param - none
 *
 * @return array $a_invalid_urls - an array of urls that were detected as invalid
 */
public function getInvalidUrls()
{
    $a_invalid_urls = array();
    
    if (empty($this->a_urls)) {
        throw new \Exception("Empty array of urls to test in " . __METHOD__);
    }//endif
    
    $n_status_code = null;
    foreach($this->a_urls as $c_url) {
        $n_status_code = $this->getStatusCodeForUrl($c_url);
        if ($this->isStatusCodeInvalid($n_status_code)) {
            $a_invalid_urls[] = array(
                'url' => $c_url,
                'status_code' => $n_status_code,
            );
        }//endif
    }//endforeach;
        
    return $a_invalid_urls;
}//end of function getInvalidUrls




/**
 *
 * @return integer - status code of http response
 */
protected function getStatusCodeForUrl($c_url){
   
    $n_status_code = null;
    
    try{
        if (strpos($c_url, 'https:\\') !== false) {
            $o_http_response = $this->o_http_client->get($c_url);
        } else {
            $o_http_response = $this->o_http_client->get($c_url);//->options($c_url)
        }//endif
        
        $n_status_code = $o_http_response->getStatusCode();
 
    } catch (\Exception $e){
        $n_status_code = "Error code: " . $e->getCode() 
                        . "; Message: " . $e->getMessage();
        //$n_status_code = self::STATUS_ERROR_500;        
    }//end try
    
    return $n_status_code;
 
}//end of function getStatusCodeForUrl



/**
 * Returns true is the status code in the parameters is invalid (>= 400)
 *
 * @return boolean - true if the status code is invalid 
 */
protected function isStatusCodeInvalid($n_status_code){
    
    if (!is_numeric($n_status_code)) return true;
    
    return $n_status_code >= 400;
    
}//end of function isStatusCodeInvalid

}//end of class - requires one empty line after this before end of file
