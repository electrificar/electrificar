<?
    require_once ($_SERVER[DOCUMENT_ROOT]."/comun/comun.php");
    require_once ($_SERVER[DOCUMENT_ROOT]."/comun/utiles.php");

    // Requiere la uri codificada con el nombre de parametro key
    $uri = decrypt($_REQUEST[key]);
    
    $uri = explode("@@", $uri);
    
    $search = array (" ","á","é","í","ó","ú","ñ","A","É","Í","Ó","Ú","Ñ");
    $replace = array ("_","a","e","i","o","u","n","A","E","I","O","U","N");
    
    $name = str_replace($search, $replace, $uri[1]);
    $uri = $uri[0];
    
    // Si localizamos el nombre original lo recuperamos, sino sera automatico
    $file = $repository."/".$uri;

    //First, see if the file exists
    if (!is_file($file)) { die("<b>404 File not found!</b>"); }

    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
    
    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "docx": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "xlsx": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
    
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html":
        case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;
    
        default: $ctype="application/force-download";
    }

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");

    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");

    //Force the download
    if($name==null){
        $name="documento.".$file_extension;
    }else{
    	$name = $name.".".$file_extension;
    }
    
    $header="Content-Disposition: attachment; filename=".$name.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    @readfile($file);
    exit;
    
?>
