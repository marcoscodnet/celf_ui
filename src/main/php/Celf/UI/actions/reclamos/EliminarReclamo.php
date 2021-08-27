<?php
namespace Celf\UI\actions\reclamos;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Reclamo;
use Celf\Core\utils\CelfUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Celf\UI\components\filter\model\UIInstanciaReclamoCriteria;


/**
 * se elimina un reclamo
 * 
 * @author Marcos
 * @since 17/05/2020
 * 
 * @Rasty\security\annotations\Secured( permission='ELIMINAR RECLAMO' )
 */
class EliminarReclamo extends JsonAction{

	
	public function execute(){

		try {

			$reclamoOid = RastyUtils::getParamGET("reclamoOid");
			
			//obtenemos la reclamo
			$reclamo = UIServiceFactory::getUIReclamoService()->get($reclamoOid);
			
			/*$criteria = new UIInstanciaReclamoCriteria();
			$criteria->setReclamo($reclamo);
			
			$intanciaReclamos = UIServiceFactory::getUIInstanciaReclamoService()->getList($criteria);
		
		
			foreach ($intanciaReclamos as $intanciaReclamo) {
					//print_r($intanciaReclamo);
					UIServiceFactory::getUIInstanciaReclamoService()->delete( $instanciaReclamo );
			}*/
		
		
		
		

			UIServiceFactory::getUIReclamoService()->delete($reclamo);
			
			$result["info"] = Locale::localize("reclamo.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>