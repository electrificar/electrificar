<?php
require_once ("class.phpmailer.php");

class CCorreo{
    function CCorreo (){
       global $repository;
       $this->ruta=$repository;
    }
           
   function enviar ($Correo){
        global $log;
            
        ini_set('memory_limit', '64M');
            
       $mail= new PHPMailer();
       $mail ->Mailer = "smtp";
       $mail ->IsSMTP();
       $mail ->SMTPAuth   = true;                        // enable SMTP authentication
       $mail ->SMTPSecure = "ssl";                       // sets the prefix to the servier
       $mail ->Host       = "smtp.gmail.com";            // sets GMAIL as the SMTP server
       $mail ->Port       = 465;                         // set the SMTP port
       $mail ->Username   = "javier.djt.sjb@gmail.com"; // GMAIL username
       $mail ->Password   = "bride_one_04";                // GMAIL password
       $mail ->From       = "javier.djt.sjb@gmail.com";
       $mail ->FromName   = "Javier de Juan Trujillo";
       
        if($Correo->para!=""){
            $arr_paras = explode (";", $Correo->para);
            if(sizeof($arr_paras)>0){
                foreach ($arr_paras as $valor){
                    if(trim($valor)!=""){
                        $mail ->AddAddress (trim($valor));
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        $mail ->IsHTML(true);
        $mail ->Timeout = 120;
        $mail ->Subject = utf2iso($Correo->asunto);
        $mail ->Body    = utf2iso($Correo->cuerpo);    // send as HTML
        if($Correo->de!=null){
            $mail->From     = $Correo->de;
            $mail->FromName = $Correo->de;
            $mail ->AddReplyTo($Correo->de,"TusAdhesivos");
        } else {
            $mail ->AddReplyTo("soporte@tusadhesivos.com","TusAdhesivos");
        }
        $ok=false;
        
        if($Correo->attach!=null){
            foreach ($Correo->attach as $attach) {
                $mail ->AddAttachment($attach[file], $attach[file_name]); // attachment
            }
        }
        $ok = $mail -> Send ();
        $intentos=1;
        while ((!$ok) && ($intentos < 3)) {
                  $ok = $mail ->Send();
                  $intentos = $intentos+1;
        }
        if (!$ok)
           {
                $log->output("","","","","","PROBLEMAS ENVIANDO CORREO ELECTRONICO A [".$Correo->para."] ");
            //print "<br/>".$mail ->ErrorInfo;
        }
         else {
            $log->output("","","","","", " CORREO ELECTRONICO ENVIADO CORRECTAMENTE A [".$Correo->para."]");
        }
        return $ok;
   }
}
?>
