<?php
namespace Waliba\UI\actions\registracion;


use Waliba\UI\actions\prestamos\ContinuarSolicitudPrestamo;

use Waliba\UI\utils\WalibaUIUtils;

use Waliba\UI\service\UIPrestamoService;

use Waliba\UI\components\form\permiso\RegistracionForm;

use Waliba\UI\service\UIServiceFactory;
use Waliba\Core\model\Registracion;
use Waliba\Core\model\Prestamo;
use Waliba\Core\model\EstadoPrestamo;
use Waliba\Core\utils\WalibaUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;


use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el login desde una Registracion.
 * 
 * @author Bernardo
 * @since 11/03/2015
 */
class LoginRegistracion extends Action{

	public function isSecure(){
		return false;
	}
	
	public function execute(){

		WalibaUIUtils::logout();
		
		$forward = new Forward();

		$page = PageFactory::build("RegistracionAgregar");
		
		$registracionForm = $page->getComponentById("registracionLoginForm");
		
		try {

			//creamos una nueva registración.
			$registracion = new Registracion();
			
			//completados con los datos del formulario.
			$registracionForm->fillEntity($registracion);

			RastySecurityContext::login( $registracion->getEmail(), $registracion->getClave() );
			$user = RastySecurityContext::getUser();
			$user = WalibaUtils::getUserByUsername($user->getUsername());
			
			if( WalibaUtils::isCliente($user)){
				
				try {
					
					$cliente = UIServiceFactory::getUIClienteService()->getByUser( $user );
					WalibaUIUtils::loginCliente($cliente);
					
					UIServiceFactory::getUIPrestamoService()->iniciarSolicitudPrestamo($cliente, 
											$registracion->getDineroSolicitado(), 
											$registracion->getDiasDevolver(), 
											$registracion->getCantidadCuotas(), 
											$registracion->getProductoCodigo(), 
											$registracion->getPromocionCodigo());
					
					
											
											
				} catch (RastyException $e) {
					WalibaUIUtils::log("no hay cliente para el usuario", __CLASS__);
				}
			}
			
			
			if( WalibaUtils::isAdmin($user)){
				
				WalibaUIUtils::loginAdmin($user);
				
			}
			
			//TODO oficial de cuentas
			
			if(  WalibaUIUtils::isAdminLogged()  )
				$forward->setPageName( $this->getForwardAdmin() );
				
			elseif( WalibaUIUtils::isClienteLogged() ){
				
				$continuar = new ContinuarSolicitudPrestamo();
				$forward = $continuar->execute();
				
			}else  	
				$forward->setPageName( $this->getErrorForward() );
			
				
		
			$registracionForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "RegistracionAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$registracionForm->save();
		}
		
		return $forward;
		
	}

	protected function getForwardCliente(){
		
		$cliente = WalibaUIUtils::getClienteLogged();
		if(UIServiceFactory::getUIClienteService()->hasPrestamoPendiente($cliente))
			$forwardPage = "SolicitarPrestamoDatosAdicionales";
		else
			$forwardPage = "ClientePrestamos";
		
		return $forwardPage;
	}
}
?>