<?php
namespace Celf\UI\actions\necrologicas;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Necrologica;
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
 * se elimina una necrológica
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class EliminarNecrologica extends JsonAction{

	
	public function execute(){

		try {

			$necrologicaOid = RastyUtils::getParamGET("necrologicaOid");
			
			//obtenemos la necrologica
			$necrologica = UIServiceFactory::getUINecrologicaService()->get($necrologicaOid);

			UIServiceFactory::getUINecrologicaService()->delete($necrologica);
			
			$result["info"] = Locale::localize("necrologica.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>