<?php
namespace Celf\UI\actions\estadoReclamos;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\EstadoReclamo;
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
 * se elimina un estadoReclamo
 * 
 * @author Marcos
 * @since 14/05/2020
 * 
 * @Rasty\security\annotations\Secured( permission='ELIMINAR ESTADO DE RECLAMO' )
 */
class EliminarEstadoReclamo extends JsonAction{

	
	public function execute(){

		try {

			$estadoReclamoOid = RastyUtils::getParamGET("estadoReclamoOid");
			
			//obtenemos la estadoReclamo
			$estadoReclamo = UIServiceFactory::getUIEstadoReclamoService()->get($estadoReclamoOid);

			UIServiceFactory::getUIEstadoReclamoService()->delete($estadoReclamo);
			
			$result["info"] = Locale::localize("estadoReclamo.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>