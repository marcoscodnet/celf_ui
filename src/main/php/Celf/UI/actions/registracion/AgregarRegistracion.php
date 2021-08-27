<?php
namespace Celf\UI\actions\registracion;


use Celf\UI\components\form\permiso\RegistracionForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Registracion;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Registracion.
 * 
 * @author Marcos
 * @since 09/05/2020
 */
class AgregarRegistracion extends Action{

	
	public function isSecure(){
		return false;
	}
	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("RegistracionAgregar");
		
		$registracionForm = $page->getComponentById("registracionForm");
		
		try {

			//creamos una nueva registración.
			$registracion = new Registracion();
			
			//completados con los datos del formulario.
			$registracionForm->fillEntity($registracion);

			//validamos el ingreso del email repetido.
			//hacerlo con js
			$email2 = $registracionForm->getEmailRepetir();
			if( $email2 != $registracion->getEmail() ){
				$registracionForm->save();
				throw new RastyException("registracion.emailRepetir.invalid");
			}
			
			//validamos el ingreso de la clave repetida.
			//hacerlo con js
			$clave2 = $registracionForm->getClaveRepetir();
			if( $clave2 != $registracion->getClave() ){
				$registracionForm->save();
				throw new RastyException("registracion.claveRepetir.invalid");
			}
			
			//agregamos la registracion.
			UIServiceFactory::getUIRegistracionService()->add( $registracion );
			
			$forward->setPageName( $registracionForm->getBackToOnSuccess() );
			$forward->addParam( "oid", $registracion->getOid() );			
		
			$registracionForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "RegistracionAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$registracionForm->save();
		}
		
		return $forward;
		
	}

}
?>