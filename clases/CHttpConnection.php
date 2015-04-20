<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/ACK.php");

class CHttpConnection {  
    public  $curl;  
    private $cookie;  
    private $cookie_path;  
    private $id;  
    var $ack = null;
      
    public function __construct($cookiePath) {  
        $this->id = getmypid();  
        $this->cookie_path = $cookiePath;
    }  
    /** 
     * Inicializa el objeto curl con las opciones por defecto. 
     * Si es null se crea 
     * @param string $cookie a usar para la conexion 
     */  
    public function init($cookie=null) {
        if($cookie)  
            $this->cookie = $cookie;  
        else  
            $this->cookie = $this->cookie_path ."/". $this->id;  
  
        $this->curl=curl_init();  
        curl_setopt($this->curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1");  
        curl_setopt($this->curl, CURLOPT_HEADER, false);  
        curl_setopt($this->curl, CURLOPT_COOKIEFILE,$this->cookie);  
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));  
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookie);  
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);  
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true);  
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 25);  
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 25);  
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, TRUE); 
    }  

    /** 
     * Envía una peticion GET a la URL especificada 
     * @param string $url 
     * @param bool $follow 
     * @return string Respuesta generada por el servidor 
     */  
    public function get($url, $get_elements=null, $follow=false, $headers=array()) {
        global $proxy;
        
        $this->ack = new ACK();
        $this->ack->resultado = true;
        if ($get_elements!=null) {
            $url= $url."?".http_build_query($get_elements);
        }  
        
        $this->init();  
        curl_setopt($this->curl, CURLOPT_URL, $url);  
        curl_setopt($this->curl, CURLOPT_POST,false);  
        curl_setopt($this->curl, CURLOPT_HEADER, $follow);  
        curl_setopt($this->curl, CURLOPT_REFERER, '');  
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, $follow);
        
        if(!empty($headers)){ curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers); }
        if($proxy!=null) {    curl_setopt($this->curl, CURLOPT_PROXY, $proxy); }

        $result=curl_exec($this->curl);  
        if($result === false){ 
            $this->ack->mensaje = "En este momento no se puede acceder a ".$url."<br/><br/> error:".curl_error($this->curl);
            $this->ack->resultado = false;          
        }  
        $this->_close();

        sleep(.2);

        return $result;  
    }  
    /** 
     * Envía una petición POST a la URL especificada 
     * @param string $url 
     * @param array $post_elements 
     * @param bool $follow 
     * @param bool $header 
     * @param string $to_file 
     * @return string Respuesta generada por el servidor 
     */  

    function post ($url, $post_elements, $referer='', $follow=false, $headers=array()) {
        global $proxy;

        print_r($post_elements);
        
        $this->ack = new ACK();
        $this->ack->resultado = true;
        
        $this->init();
        if(is_array($post_elements)){
            $elements=array();  
            foreach ($post_elements as $name=>$value) { $elements[] = "{$name}=".urlencode($value); }  
            $elements = join("&",$elements);              
        } else { $elements = $post_elements; }
        curl_setopt($this->curl, CURLOPT_URL, $url);  
        curl_setopt($this->curl, CURLOPT_POST,true);  
        curl_setopt($this->curl, CURLOPT_REFERER, $referer);  
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $elements);  

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);

        if(!empty($headers)){ curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers); }
        if ($proxy!=null) {   curl_setopt($this->curl, CURLOPT_PROXY, $proxy); }


        $headers = array(
            "POST /webservice/GtInterfaceWS.asmx HTTP/1.1",
            "Host: gtestimate.com",
            "Content-type: text/xml;charset=\"utf-8\"", 
            "Accept: text/xml", 
            "Cache-Control: no-cache", 
            "Pragma: no-cache", 
            "SOAPAction: \"http://gtmotive.com/GTIWS\"", 
            "Content-length: ".strlen($elements),
        ); 


        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers); 


        $result=curl_exec ($this->curl);
        if($result === false){
            print "TOMA COMO FALSE";
            $this->ack->mensaje = "En este momento no se puede acceder a ".$url."<br/><br/> error:".curl_error($this->curl);
            $this->ack->resultado = false;          
        }
        
        $this->_close();
 
        return $result;  
  
    } 
    /** 
     * Descarga un fichero binario en el buffer 
     * @param string $url 
     * @return string 
     */  
    public function getBinary($url){  
        $this->init();  
        curl_setopt($this->curl, CURLOPT_URL, $url);  
        curl_setopt($this->curl, CURLOPT_BINARYTRANSFER,1);  
        $result = curl_exec ($this->curl);  
        $this->_close();  
        return $result;  
    }  
    /** 
     * Cierra la conexión 
     */  
    private function _close() {  
        curl_close($this->curl);  
    }  
    public function close(){  
        if(file_exists($this->cookie))  
            unlink($this->cookie);  
    }  
}  
?>