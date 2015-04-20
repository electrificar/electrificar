<?
function tree($matriz, $content, $template, &$repeat,$id = null,$path=null,$prim=null){
    if($matriz['path'] != null){
        $path = $matriz['path'];
    }
	
    if($prim !=1){
        if($matriz['text']){
          $matriz = $matriz['text'];
        }else{
          $matriz = "";
        }
        
        $cadena.= '<div class="span2 main-menu-span"><div class="well nav-collapse sidebar-nav"><ul id="sitemap" class="nav nav-tabs nav-stacked main-menu draggable" pid=""><li  style="height: 35px;background: none repeat scroll 0% 0% rgb(229, 229, 229); border-radius: 3px 3px 0px 0px;" class="nav-header hidden-tablet"><i class="icon-home" style="margin-left:15px;margin-top: 10px;"></i>&nbsp;Mapa del sitio</li>';
    }else{
        if(is_array($path)){
            if(array_search($id, $path) > 0){
                $cadena.= '<div class="span2 main-menu-span"><div class="nav-collapse sidebar-nav"><ul id="tree_'.$id.'" pid="'.$id.'" deployed="true" class="nav nav-tabs nav-stacked main-menu draggable">';
            }else{
                $cadena.= '<div class="span2 main-menu-span"><div class="nav-collapse sidebar-nav"><ul id="tree_'.$id.'" pid="'.$id.'" class="nav nav-tabs nav-stacked main-menu draggable">';
            }
        }else{
            $cadena.= '<div class="span2 main-menu-span"><div class=""><ul id="tree_'.$id.'" pid="'.$id.'" class="nav nav-tabs nav-stacked main-menu draggable">';
        }
        
    }
    
    // Controlo la apertura de tag para no tenerla en cuenta
    if($repeat==true){
        return "";
    }

    if(($matriz)){
        foreach($matriz as $value){
            $class_name = "";
            if(is_array($path) && $path[0] == $value->id_categorias){
                $class_name = "color:#52CFEB;";
            }
            
            if($value->SUB_CATEGORY != null){
            	$padding = "padding-bottom:10px;";
            	$href="href='javascript:void $(\"#span_tree_".$value->id_categorias."\").click();'";
            }else{
            	if($value->PARENT_ID !=0){
	            	$padding = "";
	            	$href = 'href="index.php?controller=products&action=get_products&id='.encrypt($value->id_categorias).'"';
            	}else{
            		$padding = "padding-bottom:10px;";
            		$href="href='javascript:'";
            	}
            }
            
            $cadena.=__('<li style="float:left;width: 262px;'.$padding.'" id="'.$value->id_categorias.'" pid="'.$value->PARENT_ID.'"><div><div class="li_title"><a style="'.$class_name.'" '.$href.'>{lang text="'.$value->dc_categoria.'"}</a></div><div style="float:right;padding-top:10px;"><img src="/tpl_admin/img/actions/delete.gif" class="img_menu" title="eliminar" onClick="eliminar_categoria(\''.encrypt($value->id_categorias).'\')"><img src="/tpl_admin/img/actions/edit.gif" class="img_menu" title="editar" onClick="editar_categoria(\''.encrypt($value->id_categorias).'\')"></div></div>');
            if($value){
              foreach ($value as $key => $row) {
                  if (is_array($row)){ 
                      //si es un array sigo recorriendo
                      $cadena .=tree($row,$content, $template, $repeat,$value->id_categorias,$path,'1'); 
                  }
              }
            }
            
            $cadena.= '</li>';
        }
    }
    
    if($prim!=1){
    	$cadena.= __('<li><a style="padding-left: 13px;float: left; width: 235px;" class="ajax-link" href="javascript: anadir_categoria(\'\')"><i class="icon-plus-sign"></i>&nbsp;Añadir Categoría</a></li>');
    }
    
    $cadena.= '</ul></div></div>';
    return $cadena;
} 
function do_translation ($params, $content=null) {
  if (!is_object($GLOBALS['_NG_LANGUAGE_'])) {
    die("Error loading Multilanguage Support");
  } else {
    // load translations (if needed)
    $GLOBALS['_NG_LANGUAGE_']->loadCurrentTranslationTable();

    $traslation = $GLOBALS['_NG_LANGUAGE_']->getTranslation($params["text"]);
    if(trim($traslation)!=""){
      return $traslation;
    } else {
      return $params["text"];
    }
  }
}

function do_translation_pre ($text){    
  return do_translation(array("text"=>$text[1]));
}

function __($text){
  return preg_replace_callback('/{lang text="(.+?)"}/', 'do_translation_pre', $text);
}

function smarty_block_php($params, $content, $template, &$repeat){
  // print $content;
  eval($content);
  return '';
}
function money ($params, $content, $template, &$repeat){
    // Controlo la apertura de tag para no tenerla en cuenta
    if($repeat==true){
        return "";
    }
    if(trim($content)==""){
      return "";
    }
    print money_format('%!.0i', $content)."&euro;";
    // print $content;
}
// Visita virtual
function vv($params, $content, $template, &$repeat){
  // Controlo la apertura de tag para no tenerla en cuenta
  if($repeat==true){
      return "";
  }
  // return var_export($params);
  return visitas_virtuales($params);
}

function show_actions ($params, $content){
  // print_r($params);
  $data = $params["data"];
  $cid  = $params["cid"];

  $output = "";
  foreach ($data as $cmd=>$action){
    if($action->javascript==false){
      if($cmd == "delete"){
        $output .= '<a href="javascript:get_url(\''.$action->source.'&id='.$cid.'\',\'null\',\'¿Estás seguro de que deseas borrar?\')"><img src="/tpl_admin/images/actions/'.$cmd.'.gif" class="action-img"></a>';
      }else{
        $output .= '<a href="'.$action->source.'&id='.$cid.'" onClick="'.$action->validators.'"><img src="/tpl_admin/images/actions/'.$cmd.'.gif" class="action-img"></a>';
      }
      
    } else {
      $params = "'".$cid."'";
      if($action->js_params!=null && sizeof($action->js_params)>0){
        foreach($action->js_params as $param){
          $params .= ", '".$param."'";
        }
      }
      $output .= '<a href="javascript:'.$action->validators.' void '.$action->source.'('.$params.');"><img src="/tpl_admin/images/actions/'.$cmd.'.gif" class="action-img"></a>';
    }
  }
  return __($output);
}

/**
 * _compile_lang
 * Called by smarty_prefilter_i18n function it processes every language
 * identifier, and inserts the language string in its place.
 *
 */
function _compile_lang($key) {
  return $GLOBALS['_NG_LANGUAGE_']->getTranslation($key[1]);
}


class smartyML extends Smarty {
    var $language;

    function smartyML ($locale="") {
      $this->__construct();
      // $this->Smarty();


      $this->compile_check = true;
      $this->debugging = false;

      // Multilanguage Support
      // use $smarty->language->setLocale() to change the language of your template
      //     $smarty->loadTranslationTable() to load custom translation tables
      $this->language = new ngLanguage($locale); // create a new language object
      $GLOBALS['_NG_LANGUAGE_'] =& $this->language;
      
      // Nuevo tag para Languaje
      $this->registerPlugin("function", "lang", "do_translation");
      $this->registerPlugin("function", "actions", "show_actions");
      // Nuevo tag para permitir php tags
      $this->registerPlugin("block", "php", "smarty_block_php");
      $this->registerPlugin("block", "money", "money");
      $this->registerPlugin("block", "vv", "vv");
      $this->registerPlugin("block", "tree", "tree");
    }

  /**
   * test to see if valid cache exists for this template
   *
   * @param string $tpl_file name of template file
   * @param string $cache_id
   * @param string $compile_id
   * @return string|false results of {@link _read_cache_file()}
   */
   function is_cached($tpl_file, $cache_id = null, $compile_id = null)
   {
      if (!$this->caching)
          return false;

      if (!isset($compile_id)) {
               $compile_id = $this->language->getCurrentLanguage().'-'.$this->compile_id;
               $cache_id = $compile_id;
      }

      return parent::is_cached($tpl_file, $cache_id, $compile_id);
   }

  }

  class ngLanguage {
    var $_translationTable;        // currently loaded translation table
    var $_supportedLanguages;      // array of all supported languages
    var $_defaultLocale;           // the default language
    var $_currentLocale;           // currently set locale
    var $_currentLanguage;         // currently loaded language
    var $_languageTable;           // array of language to file associations
    var $_loadedTranslationTables; // array of all loaded translation tables

    function ngLanguage($locale="") {
      $this->_languageTable = Array(
        "de" => "de",
        "en" => "en",
        "nl" => "nl",
        "es" => "es",
        "fr" => "fr",
        "it" => "it",
        "eu" => "eu",
        "pt" => "pt"
      ); // to be continued ...
      $this->_translationTable = Array();
      $this->_loadedTranslationTables = Array();
      foreach ($this->_languageTable as $lang)
        $this->_translationTable[$lang] = Array();

      $this->_defaultLocale = 'en';
      if (empty($locale))
        $locale = $this->getHTTPAcceptLanguage();
      $this->setCurrentLocale($locale);
    }

    function getAvailableLocales() {
      return array_keys($this->_languageTable);
    }

    function getAvailableLanguages() {
      return array_unique(array_values($this->_languageTable));
    }

    function getCurrentLanguage() {
      return $this->_currentLanguage;
    }

    function setCurrentLanguage($language) {
      $this->_currentLanguage = $language;
    }

    function getCurrentLocale() {
      return $this->_currentLocale;
    }

    function setCurrentLocale($locale) {
      $language = $this->_languageTable[$locale];
      if (empty($language)) {
        die ("LANGUAGE Error: Unsupported locale '$locale'");
      }
      $this->_currentLocale = $locale;
      return $this->setCurrentLanguage($language);
    }

    function getDefaultLocale() {
      return $this->_defaultLocale;
    }

    function getHTTPAcceptLanguage() {
      $langs = explode(';', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
      $locales = $this->getAvailableLocales();
      foreach ($langs as $value_and_quality) {
          // Loop through all the languages, to see if any match our supported ones
          $values = explode(',', $value_and_quality);
          foreach ($values as $value) {
            if (in_array($value, $locales)){
                // If found, return the language
                return $value;
            }
          }
      }
      // If we can't find a supported language, we use the default
      return $this->getDefaultLocale();
    }

    // Warning: parameter positions are changed!
    function _loadTranslationTable($locale, $path='') {
      global $_SERVER;
      if (empty($locale))
        $locale = $this->getDefaultLocale();
      $language = $this->_languageTable[$locale];
      if (empty($language)) {
        die ("LANGUAGE Error: Unsupported locale '$locale'");
      }
      if (!is_array($this->_translationTable[$language])) {
        die ("LANGUAGE Error: Language '$language' not available");
      }
      if(empty($path))
        $path = $_SERVER["DOCUMENT_ROOT"].'/languages/'.$this->_languageTable[$locale].'/global.lng';
        if (isset($this->_loadedTranslationTables[$language])) {
          if (in_array($path, $this->_loadedTranslationTables[$language])) {
            // Translation table was already loaded
            return true;
          }
      }
      if (file_exists($path)) {
        $entries = file($path);
        $this->_translationTable[$language][$path] = Array();
        $this->_loadedTranslationTables[$language][] = $path;
        foreach ($entries as $row) {
          if (substr(ltrim($row),0,2) == '//') // ignore comments
            continue;
          $keyValuePair = explode('=',$row);
          // multiline values: the first line with an equal sign '=' will start a new key=value pair
          if(sizeof($keyValuePair) == 1) {
            $this->_translationTable[$language][$path][$key] .= ' ' . chop($keyValuePair[0]);
            continue;
          }
          $key = trim($keyValuePair[0]);
          $value = $keyValuePair[1];
          if (!empty($key)) {
            $this->_translationTable[$language][$path][$key] = chop($value);
          }
        }
        return true;
      }
      return false;
    }

    // Warning: parameter positions are changed!
    function _unloadTranslationTable($locale, $path) {
      $language = $this->_languageTable[$locale];
      if (empty($language)) {
        die ("LANGUAGE Error: Unsupported locale '$locale'");
      }
      unset($this->_translationTable[$language][$path]);
      foreach($this->_loadedTranslationTables[$language] as $key => $value) {
        if ($value == $path) {
          unset($this->_loadedTranslationTables[$language][$key]);
          break;
        }
      }
      return true;
    }

    function loadCurrentTranslationTable() {
      $this->_loadTranslationTable($this->getCurrentLocale());
    }

    // Warning: parameter positions are changed!
    function loadTranslationTable($locale, $path) {
      // This method is only a placeholder and wants to be overwritten by YOU! ;-)
      // Here's a example how it could look:
      if (empty($locale)) {
        // Load default locale of no one has been specified
        $locale = $this->getDefaultLocale();
      }
      // Select corresponding language
      $language = $this->_languageTable[$locale];
      // Set path and filename of the language file
      $path = "languages/$language/$path.lng";
      // _loadTranslationTable() does the rest
      $this->_loadTranslationTable($locale, $path);
    }

    // Warning: parameter positions are changed!
    function unloadTranslationTable($locale, $path) {
      // This method is only a placeholder and wants to be overwritten by YOU! ;-)
      $this->_unloadTranslationTable($locale, $path);
    }

    function getTranslation($key) {
      $trans = $this->_translationTable[$this->_currentLanguage];
      if (is_array($trans)) {
        foreach ($this->_loadedTranslationTables[$this->_currentLanguage] as $table) {
          if (isset($trans[$table][$key])) {
            return $trans[$table][$key];
          }
        }
      }
      return $key;
    }

}
?>