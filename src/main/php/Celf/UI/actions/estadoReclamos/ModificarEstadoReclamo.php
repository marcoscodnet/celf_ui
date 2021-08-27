<?php
namespace Celf\UI\actions\estadoReclamos;

use Celf\UI\components\form\estadoReclamo\EstadoReclamoForm;

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
 * se realiza la actualización de una estadoReclamo.
 * 
 * @author Marcos
 * @since 14/05/2020
 */
class ModificarEstadoReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("EstadoReclamoModificar");
		
		$estadoReclamoForm = $page->getComponentById("estadoReclamoForm");
			
		$oid = $estadoReclamoForm->getOid();
						
		try {

			//obtenemos la estadoReclamo.
			$estadoReclamo = UIServiceFactory::getUIEstadoReclamoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$estadoReclamoForm->fillEntity($estadoReclamo);
			
			//guardamos los cambios.
			UIServiceFactory::getUIEstadoReclamoService()->update( $estadoReclamo );
			
			$forward->setPageName( $estadoReclamoForm->getBackToOnSuccess() );
			$forward->addParam( "estadoReclamoOid", $estadoReclamo->getOid() );
			
			$estadoReclamoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "EstadoReclamoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$estadoReclamoForm->save();
			
		}
		return $forward;
		
	}

}
?>