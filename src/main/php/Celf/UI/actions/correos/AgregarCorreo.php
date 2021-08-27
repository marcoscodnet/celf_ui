<?php
namespace Celf\UI\actions\correos;


use Celf\UI\components\form\correo\CorreoForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Correo;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Correo.
 * 
 * @author Marcos
 * @since 08/05/2018
 */
class AgregarCorreo extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("CorreoAgregar");
		
		$correoForm = $page->getComponentById("correoForm");
		
		try {

			//creamos una nueva correo.
			$correo = new Correo();
			
			//completados con los datos del formulario.
			$correoForm->fillEntity($correo);
			
			//agregamos el correo.
			UIServiceFactory::getUICorreoService()->add( $correo );
			
			$forward->setPageName( $correoForm->getBackToOnSuccess() );
			$forward->addParam( "correoOid", $correo->getOid() );			
		
			$correoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "CorreoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$correoForm->save();
		}
		
		return $forward;
		
	}

}
?>