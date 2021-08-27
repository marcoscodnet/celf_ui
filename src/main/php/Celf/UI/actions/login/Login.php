<?php
namespace Celf\UI\actions\login;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;

use Celf\Core\utils\CelfUtils;


use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;



/**
 * se realiza el login contra el core.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class Login extends Action{

	public function isSecure(){
		return false;
	}
	
	public function execute(){

		$forward = new Forward();			
		try {

			
			RastySecurityContext::login( RastyUtils::getParamPOST("username"), RastyUtils::getParamPOST("password") );
			
			//CelfUIUtils::setSucursal( CelfUtils::getSucursalDefault() );
		
			$user = RastySecurityContext::getUser();
			
			$user = CelfUtils::getUserByUsername($user->getUsername());
		
			if( CelfUtils::isAsociado($user)){
				
				try {
					$asociado = UIServiceFactory::getUIAsociadoService()->getByUser( $user );
					CelfUIUtils::loginAsociado($asociado);
				} catch (RastyException $e) {
					CelfUIUtils::log("no hay asociado para el usuario", __CLASS__);
				}
			}
			
			
			if( CelfUtils::isAdmin($user)){
				
				CelfUIUtils::loginAdmin($user);
				
			}
			
			
			if(  CelfUIUtils::isAdminLogged()  )
				$forward->setPageName( $this->getForwardAdmin() );
				
			elseif( CelfUIUtils::isAsociadoLogged() ){

				/*$continuar = new ContinuarSolicitudPrestamo();
				$forward = $continuar->execute();
				//$forward->setPageName( $this->getForwardCliente() );*/
				$forward->setPageName( $this->getForwardAsociado() );
			}
			else  	
				$forward->setPageName( $this->getForwardBackOffice() );
			
				
		} catch (RastyException $e) {
		
			$forward->setPageName( $this->getErrorForward() );
			$forward->addError( $e->getMessage() );
			
		}
		
		return $forward;
		
	}
	
	protected function getForwardAdmin(){
		return "Abonados";
	}
	
	protected function getForwardAsociado(){
		return "ReclamosSinMenu";
	}
	
	protected function getForwardBackOffice(){
		return "Reclamos";
	}
	
	protected function getErrorForward(){
		return "Login";
	}
}
?>