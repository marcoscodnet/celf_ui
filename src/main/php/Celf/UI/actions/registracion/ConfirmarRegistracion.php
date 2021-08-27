<?php
namespace Celf\UI\actions\registracion;




use Celf\UI\utils\CelfUIUtils;

use Celf\UI\utils\Securimage;

use Celf\UI\components\form\permiso\RegistracionConfirmarForm;

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

use Cose\Security\utils\SecurityUtils;

/**
 * se realiza la confirmación de una Registracion.
 * 
 * @author Marcos
 * @since 02/01/2015
 */
class ConfirmarRegistracion extends Action{

	public function isSecure(){
		return false;
	}
	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("RegistracionConfirmar");
		
		$registracionConfirmarForm = $page->getComponentById("registracionConfirmarForm");
		
		try {

			
			//creamos una nueva registración.
			$registracion = new Registracion();
			
			//completados con los datos del formulario.
			$registracionConfirmarForm->fillEntity($registracion);

			CelfUIUtils::log("confirmando registración");
			
			
			//validamos el captcha.
			$img = new Securimage();
			$valid = $img->check( $registracionConfirmarForm->getCaptcha() );
			if(!$valid)
				throw new RastyException("registracion.captcha.invalido");
			
			//confirmamos la registracion.
			$asociado = UIServiceFactory::getUIRegistracionService()->confirmar( $registracion->getCodigoValidacion() );
			$usuario = $asociado->getUsuario();
			
			CelfUIUtils::log("registración confirmada");
			
			//logueamos al asociado.
			
			$password = $usuario->getPassword();
			$password = SecurityUtils::aesDecrypt($password);
			
			
			RastySecurityContext::login( $usuario->getUsername(), $password );
			CelfUIUtils::loginAsociado($asociado);

			CelfUIUtils::log("nuevo usuario logueado");
			
			$forward->setPageName( "Login" );	
		
			CelfUIUtils::log("nuevo forwared");
			
			$registracionConfirmarForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "RegistracionConfirmar" );
			if( $registracion )
				$forward->addParam( "codigoValidacion", $registracion->getCodigoValidacion() );			
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$registracionConfirmarForm->save();
		}
		
		return $forward;
		
	}

}
?>