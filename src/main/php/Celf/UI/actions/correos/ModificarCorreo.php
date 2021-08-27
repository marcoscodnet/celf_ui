<?php
namespace Celf\UI\actions\correos;

use Celf\UI\components\form\correo\CorreoForm;

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
 * se realiza la actualización de una correo.
 * 
 * @author Marcos
 * @since 08/05/2018
 */
class ModificarCorreo extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("CorreoModificar");
		
		$correoForm = $page->getComponentById("correoForm");
			
		$oid = $correoForm->getOid();
						
		try {

			//obtenemos la correo.
			$correo = UIServiceFactory::getUICorreoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$correoForm->fillEntity($correo);
			
			//guardamos los cambios.
			UIServiceFactory::getUICorreoService()->update( $correo );
			
			$forward->setPageName( $correoForm->getBackToOnSuccess() );
			$forward->addParam( "correoOid", $correo->getOid() );
			
			$correoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "CorreoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$correoForm->save();
			
		}
		return $forward;
		
	}

}
?>