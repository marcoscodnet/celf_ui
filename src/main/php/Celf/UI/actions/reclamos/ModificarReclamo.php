<?php
namespace Celf\UI\actions\reclamos;

use Celf\UI\components\form\reclamo\ReclamoForm;

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
 * se realiza la actualización de una reclamo.
 * 
 * @author Marcos
 * @since 17/05/2020
 */
class ModificarReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("ReclamoModificar");
		
		$reclamoForm = $page->getComponentById("reclamoForm");
			
		$oid = $reclamoForm->getOid();
						
		try {

			//obtenemos la reclamo.
			$reclamo = UIServiceFactory::getUIReclamoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$reclamoForm->fillEntity($reclamo);
			
			//guardamos los cambios.
			UIServiceFactory::getUIReclamoService()->update( $reclamo );
			
			$forward->setPageName( $reclamoForm->getBackToOnSuccess() );
			$forward->addParam( "reclamoOid", $reclamo->getOid() );
			
			$reclamoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ReclamoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$reclamoForm->save();
			
		}
		return $forward;
		
	}

}
?>