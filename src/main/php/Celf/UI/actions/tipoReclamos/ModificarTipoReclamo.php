<?php
namespace Celf\UI\actions\tipoReclamos;

use Celf\UI\components\form\tipoReclamo\TipoReclamoForm;

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
 * se realiza la actualización de una tipoReclamo.
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class ModificarTipoReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("TipoReclamoModificar");
		
		$tipoReclamoForm = $page->getComponentById("tipoReclamoForm");
			
		$oid = $tipoReclamoForm->getOid();
						
		try {

			//obtenemos la tipoReclamo.
			$tipoReclamo = UIServiceFactory::getUITipoReclamoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$tipoReclamoForm->fillEntity($tipoReclamo);
			
			//guardamos los cambios.
			UIServiceFactory::getUITipoReclamoService()->update( $tipoReclamo );
			
			$forward->setPageName( $tipoReclamoForm->getBackToOnSuccess() );
			$forward->addParam( "tipoReclamoOid", $tipoReclamo->getOid() );
			
			$tipoReclamoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "TipoReclamoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$tipoReclamoForm->save();
			
		}
		return $forward;
		
	}

}
?>