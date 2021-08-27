<?php
namespace Celf\UI\actions\abonados;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Abonado;
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
 * se elimina un abonado
 * 
 * @author Marcos
 * @since 04/05/2018
 * 
 * @Rasty\security\annotations\Secured( permission='ELIMINAR ABONADO' )
 */
class EliminarAbonado extends JsonAction{

	
	public function execute(){

		try {

			$abonadoOid = RastyUtils::getParamGET("abonadoOid");
			
			//obtenemos la abonado
			$abonado = UIServiceFactory::getUIAbonadoService()->get($abonadoOid);

			UIServiceFactory::getUIAbonadoService()->delete($abonado);
			
			$result["info"] = Locale::localize("abonado.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>