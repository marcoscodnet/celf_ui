<?php
namespace Celf\UI\actions\areas;


use Celf\UI\components\form\area\AreaForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Area;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Area.
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class AgregarArea extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("AreaAgregar");
		
		$areaForm = $page->getComponentById("areaForm");
		
		try {

			//creamos una nueva area.
			$area = new Area();
			
			//completados con los datos del formulario.
			$areaForm->fillEntity($area);
			
			//agregamos el area.
			UIServiceFactory::getUIAreaService()->add( $area );
			
			$forward->setPageName( $areaForm->getBackToOnSuccess() );
			$forward->addParam( "areaOid", $area->getOid() );			
		
			$areaForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "AreaAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$areaForm->save();
		}
		
		return $forward;
		
	}

}
?>