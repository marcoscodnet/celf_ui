<?php
namespace Celf\UI\utils;

use Celf\Core\model\Asociado;

use Celf\Core\utils\CelfUtils;

use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\i18n\Locale;
use Rasty\conf\RastyConfig;

use Cose\Security\model\Usergroup;
use Cose\Security\model\User;

use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\factory\PageFactory;

use Newsletter\Core\model\Categoria;


/**
 * Utilidades para el sistema Celf.
 *
 * @author Marcos
 * @since 04-05-2018
 */
class CelfUIUtils {

	const DATE_FORMAT = 'd/m/Y';
	const DATETIME_FORMAT = 'd/m/y H:i:s';
	const TIME_FORMAT = 'H:i';
	
	//números
	const DECIMALES = '2';
	const SEPARADOR_DECIMAL = ',';
	const SEPARADOR_MILES = '.';

	//moneda.
	const MONEDA_SIMBOLO = '€';
	const MONEDA_ISO = 'EUR';
	const MONEDA_NOMBRE = 'Euros';
	const MONEDA_POSICION_IZQ = 1;

	
	public static function getWebPath(){
	
		return RastyConfig::getInstance()->getWebPath();
		
	}
	
	public static function getAppPath(){
	
		return RastyConfig::getInstance()->getAppPath();
		
	}
	
	public static function getChartsWebPath(){
	
		return RastyConfig::getInstance()->getWebPath() . "/tmp/";
		
	}
	
	public static function getChartsAppPath(){
	
		return RastyConfig::getInstance()->getAppPath() . "/tmp/";
		
	}
	
	public static function getChartsFontPath(){
	
		return "vendor/realityking/pchart/Fonts/";
	}
	
	/**
	 * se formateo un monto a visualizar
	 * @param $monto
	 * @return string
	 */
	public static function formatMontoToView( $monto ){
	
		if( empty($monto) )
		$monto = 0;

		$res = $monto;
		//si es negativo, le quito el signo para agregarlo antes de la moneda.
		if( $monto < 0 ){
			$res = $res * (-1);
		}
			
		$res = number_format ( $res ,  self::DECIMALES , self::SEPARADOR_DECIMAL, self::SEPARADOR_MILES );



		if( self::MONEDA_POSICION_IZQ ){
			$res = self::MONEDA_SIMBOLO . $res;
				
		}else
		$res = $res. self::MONEDA_SIMBOLO ;

		//si es negativo lo mostramos rojo y le agrego el signo.
		if( $monto < 0 ){
			$res = "<span style='color:red;'>- $res</span>";
		}

		return $res;
	}


	//Formato fecha yyyy-mm-dd
	public static function differenceBetweenDates($fecha_fin, $fecha_Ini, $formato_salida = "d") {
		$valueFI = str_replace('/', '-', $fecha_Ini);
		$valueFF = str_replace('/', '-', $fecha_fin);
		$f0 = strtotime($valueFF);
		$f1 = strtotime($valueFI);
		if ($f0 < $f1) {
			$tmp = $f1;
			$f1 = $f0;
			$f0 = $tmp;
		}
		return date($formato_salida, $f0 - $f1);
	}

	
	public static function formatMesToView( $mes ){
	
		$meses = array (
			"1" => "Enero",
			"2" => "Febrero",
			"3" => "Marzo",
			"4" => "Abril",
			"5" => "Mayo",
			"6" => "Junio",
			"7" => "Julio",
			"8" => "Agosto",
			"9" => "Septiembre",
			"10" => "Octubre",
			"11" => "Noviembre",
			"12" => "Diciembre"
		);
		
		return $meses[$mes];
	}
	
	public static function formatDateToView($value, $format=self::DATE_FORMAT) {
		
		$res = "";
		if( !empty( $value) )
			$res = $value->format($format);
		else $res = "";
		
		$meses = array (
			"January" => "Enero",
			"Febraury" => "Febrero",
			"March" => "Marzo",
			"April" => "Abril",
			"May" => "Mayo",
			"June" => "Junio",
			"July" => "Julio",
			"August" => "Agosto",
			"September" => "Septiembre",
			"October" => "Octubre",
			"November" => "Noviembre",
			"December" => "Diciembre",
			"Jan" => "Ene",
			"Feb" => "Feb",
			"Mar" => "Mar",
			"Apr" => "Abr",
			"May" => "May",
			"Jun" => "Jun",
			"Jul" => "Jul",
			"Aug" => "Ago",
			"Sep" => "Sep",
			"Oct" => "Oct",
			"Nov" => "Nov",
			"Dec" => "Dic"
		);
		
		$dias = array(
			'Monday' => 'Lunes',
			'Tuesday' => 'Martes',
			'Wednesday' => 'Miércoles',
			'Thursday' => 'Jueves',
			'Friday' => 'Viernes',
			'Saturday' => 'Sábado',
			'Sunday' => 'Domingo',
			'Mon' => 'Lun',
			'Tue' => 'Mar',
			'Wed' => 'Mie',
			'Thu' => 'Jue',
			'Fri' => 'Vie',
			'Sat' => 'Sab',
			'Sun' => 'Dom',
		);
		foreach ($meses as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		foreach ($dias as $key => $value) {
			$res = str_replace($key, $value, $res);
		}
		
		return $res ;
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date($format, strtotime($value));
		}else
		$dt = "";

		return $dt;
		*/
	}

	public static function formatDateToPersist($value) {

		return $value->format("Y-m-d");
		
		/*		
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d", strtotime($value));
		else
		$dt = "";
		return $dt;*/
	}

	public static function formatDateTimeToView($value) {
		
		if(!empty($value))
			return $value->format(self::DATETIME_FORMAT);
		else
			return "";
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:DATE_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function formatDateTimeToPersist($value) {
		
		return $value->format("Y-m-d H:i:s");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value))
		$dt = date("Y-m-d H:i:s", strtotime($value));
		else
		$dt = "";

		return $dt;*/
	}

	public static function addDays($date, $dateFormat="", $days){

		$date->modify("+$days day");
		return $date;
		/*
		$newDate = strtotime ( "+$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
		*/
	}

	public static function substractDays($date, $dateFormat, $days){

		$date->modify("-$days day");
		return $date;
		/*
		$newDate = strtotime ( "-$days day" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );

		return $newDate;
		*/
	}

	public static function addMinutes($date, $dateFormat, $minutes){
		
		//$date->modify("+$minutes minutes");
		//return $date;
		
		$newDate = strtotime ( "+$minutes minutes" , strtotime ( $date ) ) ;
		$newDate = date ( $dateFormat , $newDate );
		
		return $newDate;
	}
	
	public static function isSameDay( $dt_date, $dt_another){

		return $dt_date->format("Ymd") == $dt_another->format("Ymd");
		 
		/*
		$dt_dateAux = strtotime ( $dt_date ) ;
		$dt_dateAux = date ( "Ymd" , $dt_dateAux );

		$dt_anotherAux = strtotime ( $dt_another ) ;
		$dt_anotherAux = date ( "Ymd" , $dt_anotherAux );

		return $dt_dateAux == $dt_anotherAux ;*/
	}


	public static function formatTimeToView($value, $format=self::TIME_FORMAT) {
		
		if(!empty($value))
		
			return $value->format($format);

		else return "";	
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date(self:TIME_FORMAT, strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function getHorasItems() {
		
		$desde = new \DateTime();
		$desde->setTime(0,0,0);
		$duracion = 15;
		$i=0;
		while( $i<97 ){
			
			$items[$desde->format("H:i")] = $desde->format("H:i");
			
			$desde->modify("+$duracion minutes");
			
			$i++;	
			
		}
		
		return $items;
		
	}

	public static function formatEdad( $edad ){
	
		if( !empty($edad) ){
		
			if( $edad > 1)
				return "$edad años";
			else
				return "$edad año";
		}return "";
	}
	
	public static function getEdad( $fecha ){

		$fechaNac = $fecha;
		
		if ($fechaNac != null ){
			
			$hoy = new \DateTime();
			
			$dia = $hoy->format("d");
			$mes = $hoy->format("m");
			$anio = $hoy->format("Y");
			 
			//fecha de nacimiento
			$dia_nac = $fechaNac->format("d");
			$mes_nac = $fechaNac->format("m");
			$anio_nac = $fechaNac->format("Y");
			
			//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
			 
			if (($mes_nac == $mes) && ($dia_nac > $dia)) {
				$anio=($anio-1); 
			}
			 
			//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
			 
			if ($mes_nac > $mes) {
				$anio=($anio-1);
			}
			 
			//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
			 
			$edad=($anio-$anio_nac);    	    
				
		}
		else
			$edad = "";
		
    	return $edad;
	}
	
	

	
	public static function dayOfDate(\DateTime $value) {
		
		return $value->format("d");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("d", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}

	public static function monthOfDate($value) {
		
		return $value->format("m");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("m", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function yearOfDate($value) {
		
		return $value->format("Y");
		
		/*
		$value = str_replace('/', '-', $value);
		
		if (!empty($value)) {
			$dt = date("Y", strtotime($value));
		}else
		$dt = "";

		return $dt;*/
	}
	
	public static function strtotime($value) {
		
		$value = str_replace('/', '-', $value);
		
		return strtotime($value);
	}


	public static function newDateTime($value) {
		
		$value = str_replace('/', '-', $value);
		$time = strtotime($value);
		
		$dateTime = new \DateTime();
		$dateTime->setDate(date("Y", $time), date("m", $time), date("d", $time));
		$dateTime->setTime(date("H", $time), date("i", $time), date("s", $time));
		
		return $dateTime;
	}
	
	
	public static function localize($keyMessage){
	
		return Locale::localize( $keyMessage );
	}
	
	
	public static function localizeEntities($enumeratedEntities){
		
		$items = array();
		
		foreach ($enumeratedEntities as $key => $keyMessage) {
			$items[$key] = self::localize($keyMessage);
		}
		
		return $items;
	}
	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}
	
	
	public static function getNewDate($dia,$mes,$anio){
	
		$date = new \DateTime();
		$date->setDate($anio, $mes, $dia);
		return $date;
	}
	
	
	public static function getFirstDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	
		//si es lunes, no hacemos nada, sino, buscamos el lunes anterior.
		if( $f->format("N") > 1 )
			$f->modify("last monday");
    	
    	return $f;
	}
	
	
	public static function getLastDayOfWeek(\Datetime $fecha){
	
		$f = new \Datetime();
		$f->setTimestamp( $fecha->getTimestamp() );
    	$f->modify("next monday");
    	
    	//si no es lunes, restamos un día.
    	if( $fecha->format("N") > 1 )
			$f->sub(new \DateInterval('P1D'));
    	
    	return $f;
	}
	
	public static function fechasIguales(\Datetime $fecha1, \Datetime $fecha2){
		return $fecha1->format("Ymd") == $fecha2->format("Ymd");
	}
	
	public static function horaSuperpuesta( $hora, $desde, $hasta  ){
	
		$superpuesta = false;
		
		if( empty($hora)  || empty($desde)  || empty($hasta) )
			$superpuesta = false;
			
		$timeHora = strtotime($hora);
		$timeDesde = strtotime($desde);
		$timeHasta = strtotime($hasta);
		
		
			
		if( ($timeDesde <= $timeHora)  && ($timeHasta > $timeHora) )
			$superpuesta = true;

		//Logger::log( " horaSuperpuesta( $hora, $desde, $hasta ) = $superpuesta");		
		
		return $superpuesta;
	}
	
   	/**
	 * registramos la sesión del admin
	 * @param User $user
	 */
	public static function loginAdmin(User $user) {
		
		$appName = RastyConfig::getInstance()->getAppName();
		
        $_SESSION [$appName]["admin_oid"] = $user->getOid();
		$_SESSION [$appName]["admin_name"] = $user->getName();
		$_SESSION [$appName]["admin_username"] = $user->getUsername();
        
    }
   	
	/**
     * @return true si hay un asociado logueado.
     */
    public static function isAsociadoLogged() {
    	
    	$appName = RastyConfig::getInstance()->getAppName();
    	
    	$data = RastyUtils::getParamSESSION($appName);
		
		$logueado =  ($data != "");
		
		if( $logueado ){
			$logueado = isset($data["asociado_oid"]) && !empty($data["asociado_oid"]); 
		}
		return $logueado;
    }
    
	
	/**
     * @return true si hay un admin logueado.
     */
    public static function isAdminLogged() {
    	
    	$appName = RastyConfig::getInstance()->getAppName();
    	
    	$data = RastyUtils::getParamSESSION($appName);
		
		$logueado =  ($data != "");
		
		if( $logueado ){
			$logueado = isset($data["admin_oid"]) && !empty($data["admin_oid"]); 
		}
		return $logueado;
    }
    
    /**
     * @return admin logueado
     */
    public static function getAdminLogged() {
        
    	$appName = RastyConfig::getInstance()->getAppName();
    	
    	$data = RastyUtils::getParamSESSION( $appName );
    	
    	
    	if( !self::isAdminLogged() )
    		return null;
    	
    	$user = new User();
        $user->setOid($data["admin_oid"]);
        $user->setName($data["admin_name"]);
        $user->setUsername($data["admin_username"]);
       
        return $user;
    }
	

    /**
	 * se formateo un número a visualizar como porcentaje
	 * @param $numero
	 * @return string
	 */
	public static function formatPorcentajeToView( $numero ){
	
		if( empty($numero) )
		$numero = 0;

		$res = $numero;
		//si es negativo, le quito el signo para agregarlo antes de la moneda.
		if( $numero < 0 ){
			$res = $res * (-1);
		}
			
		$res = number_format ( $res ,  2 , self::SEPARADOR_DECIMAL, self::SEPARADOR_MILES );

		$res = $res. "%" ;

		return $res;
	}

	public static function getOpcionesBooleanasEmpty(){
		
		$items = array();
		
		$items[-1] = self::localize("criteria.sin_especificar");
		$items[1] = self::localize("criteria.si");
		$items[2] = self::localize("criteria.no");
		
		return $items;
		
	}

	public static function getOpcionesBooleanas(){
		
		$items = array();
		
		$items[2] = self::localize("criteria.no");
		$items[1] = self::localize("criteria.si");
		
		return $items;
		
	}

    /**
     * finalizamos la sesión
     */
    public static function logout() {
    	
    	$appName = RastyConfig::getInstance()->getAppName();
		
        $_SESSION [$appName]["admin_oid"] = null;
		$_SESSION [$appName]["admin_name"] = null;
		$_SESSION [$appName]["admin_username"] = null;
		unset($_SESSION [$appName]["admin_oid"]);
		unset($_SESSION [$appName]["admin_name"]);
		unset($_SESSION [$appName]["admin_username"]);
    }
	

    /**
     * @return true si hay un usuario logueado.
     */
    public static function isUserLogged() {
    	
    	$user = RastySecurityContext::getUser();
    	
    	$logueado =  ($user != null);
		
		return $logueado;
    }
    
    public static function getUserLogged(){
    
    	$user = RastySecurityContext::getUser();
			
		//$user = WalibaUtils::getUserByUsername($user->getUsername());
		return $user;
    }
    
	public static function log($msg, $clazz=__CLASS__){
    	Logger::log($msg, $clazz);
    }

    public static function logObject($obj, $clazz=__CLASS__){
    	Logger::logObject($obj, $clazz);
    }
    
	
 	public static function is_empty($var, $allow_false = false, $allow_ws = false) {
	    if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {   
	        return true;
	    } else {
	        return false;
	    }
	}

	
	public static function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
	public static function addMenuOptionToGroup(MenuOption $menuOption, $menuGroup){

		//si tiene permisos agrego el menú.
		if( self::tienePermisoAPagina( $menuOption->getPageName() )){
			$menuGroup->addMenuOption( $menuOption );
		}
			
	}
	
	/**
	 * chequea si el usuario logueado tiene acceso a una página
	 * @param string $pageName
	 */
	public static function tienePermisoAPagina($pageName){

		//si tiene permisos agrego el menú.
		CelfUIUtils::log("autorizando la page $pageName");
		
		$page = PageFactory::build( $pageName );
		
		try {

			if( !empty($page)){
				RastySecurityContext::authorize($page);
				return true;
			}
			
							
			
		} catch (UserRequiredException $e) {
			
		} catch (UserPermissionException $e) {
			
		}
		
		return false;
			
	}
	
	public static function startsWith($haystack, $needle) {
	    // search backwards starting from haystack length characters from the end
	    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	public static function endsWith($haystack, $needle) {
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}	
	
	public static function addCategoriaContactoSession(Categoria $categoria) {
		
		$categorias = self::getCategoriasContactoSession();

		//si ya estaba incremento la cantidad
		$existe = false;
		$indexExistente = 0;
		$index = 0;
		foreach ($categorias as $categoriajson) {
			//mismo categoria
			if(( $categoria->getOid() == $categoriajson["categoria_oid"] ) ){
				$existe = true;
				
				$indexExistente = $index;
			}
			$index++;
		}
		
		$categoriajson = array();
		$categoriajson["categoria_oid"] = $categoria->getOid();
		$categoriajson["categoria_nombre"] = $categoria->getNombre();
	    
	        
		if($existe){
	        
			//unset($categorias[$indexExistente]);
        	//$categorias = array_values($categorias);
        	
		}else{
			$categorias[] = $categoriajson;
		}
		
		
		self::setCategoriasContactoSession($categorias);
    }
    
	public static function deleteCategoriaContactoSession( $index=0 ) {
		
		$categorias = self::getCategoriasContactoSession();

		unset($categorias[$index]);
        $categorias = array_values($categorias);
        
		self::setCategoriasContactoSession($categorias);
    }
    
    public static function getCategoriasContactoSession() {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
    	$data = RastyUtils::getParamSESSION($appName);
	
		if( isset( $data['categoriasContacto_session']) )
			$categorias = unserialize( $data['categoriasContacto_session']);
		else 
			$categorias = array();
			
		return $categorias;
   	}
 
   	public static function setCategoriasContactoSession( $categorias ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		$_SESSION[$appName]['categoriasContacto_session'] = serialize($categorias);
		
			
   	}
   	
	public static function vaciarCategoriasContactoSession(  ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		unset($_SESSION[$appName]['categoriasContacto_session']);
		
			
   	}
   	
	public static function setVariableSession( $nameVar, $var ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		$_SESSION[$appName][$nameVar] = $var;
		
			
   	}
   	
	public static function getVariableSession( $nameVar ) {
    
    	$appName = RastyConfig::getInstance()->getAppName();
		
		
		 return $_SESSION[$appName][$nameVar];
			
   	}
   	
	public static function getUploadPathFile(){
   	
   		return self::getAppPath() . "/tmp/"; 
   	
   	}
   	
	public static function getPathImagenItems(){
   	
   		return self::getAppPath() . "/css/images/items/"; 
   	
   	}
   	
   	public static function getWebPathImagenItems(){
   	
   		return self::getWebPath() . "/css/images/items/"; 
   	
   	}
   	
   	public static function getImagenItem( $item ){
   	
   		return self::getWebPathImagenItems() . "/". $item->getImagen(); 
   	
   	}

   	public static function getThumbImagenItem( $item ){
   	
   		return self::getWebPathImagenItems() . "/thumbnail_". $item->getImagen(); 
   	
   	}
   	
	public static function getUploadPathImagenItems(){
   	
   		return self::getAppPath() . "/css/images/image/tmp/"; 
   	
   	}

   	public static function getUploadWebPathImagenItems(){
   	
   		return self::getWebPath() . "/css/images/image/tmp/"; 
   	
   	}
   	
/**
	 * registramos la sesión del asociado
	 * @param Asociado $asociado
	 */
	public static function loginAsociado(Asociado $asociado) {
		
		$appName = RastyConfig::getInstance()->getAppName();
		
        $_SESSION [$appName]["asociado_oid"] = $asociado->getOid();
		$_SESSION [$appName]["asociado_nombre"] = $asociado->getNombre();
        
    }

}