<?php
namespace Celf\UI\actions\correos;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Correo;
use Celf\Core\utils\CelfUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se elimina un correo
 * 
 * @author Marcos
 * @since 08/05/2018
 */
class EliminarCorreo extends JsonAction{

	
	public function execute(){

		try {

			$correoOid = RastyUtils::getParamGET("correoOid");
			
			//obtenemos la correo
			$correo = UIServiceFactory::getUICorreoService()->get($correoOid);

			UIServiceFactory::getUICorreoService()->delete($correo);
			
			$result["info"] = Locale::localize("correo.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>