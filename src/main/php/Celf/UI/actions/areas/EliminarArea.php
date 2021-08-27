<?php
namespace Celf\UI\actions\areas;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Area;
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
 * se elimina un area
 * 
 * @author Marcos
 * @since 13/05/2020
 * 
 * @Rasty\security\annotations\Secured( permission='ELIMINAR AREA' )
 */
class EliminarArea extends JsonAction{

	
	public function execute(){

		try {

			$areaOid = RastyUtils::getParamGET("areaOid");
			
			//obtenemos la area
			$area = UIServiceFactory::getUIAreaService()->get($areaOid);

			UIServiceFactory::getUIAreaService()->delete($area);
			
			$result["info"] = Locale::localize("area.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>