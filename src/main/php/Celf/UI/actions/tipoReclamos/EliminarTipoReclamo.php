<?php
namespace Celf\UI\actions\tipoReclamos;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\TipoReclamo;
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
 * se elimina un tipoReclamo
 * 
 * @author Marcos
 * @since 13/05/2020
 * 
 * @Rasty\security\annotations\Secured( permission='ELIMINAR TIPO DE RECLAMO' )
 */
class EliminarTipoReclamo extends JsonAction{

	
	public function execute(){

		try {

			$tipoReclamoOid = RastyUtils::getParamGET("tipoReclamoOid");
			
			//obtenemos la tipoReclamo
			$tipoReclamo = UIServiceFactory::getUITipoReclamoService()->get($tipoReclamoOid);

			UIServiceFactory::getUITipoReclamoService()->delete($tipoReclamo);
			
			$result["info"] = Locale::localize("tipoReclamo.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>