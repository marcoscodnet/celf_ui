<?php
namespace Celf\UI\actions\areas;

use Celf\UI\components\form\area\AreaForm;

use Celf\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de una area.
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class ModificarArea extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("AreaModificar");
		
		$areaForm = $page->getComponentById("areaForm");
			
		$oid = $areaForm->getOid();
						
		try {

			//obtenemos la area.
			$area = UIServiceFactory::getUIAreaService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$areaForm->fillEntity($area);
			
			//guardamos los cambios.
			UIServiceFactory::getUIAreaService()->update( $area );
			
			$forward->setPageName( $areaForm->getBackToOnSuccess() );
			$forward->addParam( "areaOid", $area->getOid() );
			
			$areaForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "AreaModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$areaForm->save();
			
		}
		return $forward;
		
	}

}
?>