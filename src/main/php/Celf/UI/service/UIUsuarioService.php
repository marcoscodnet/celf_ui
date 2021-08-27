<?php
namespace Celf\UI\service;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\components\filter\model\UIUsuarioCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Cose\Security\model\User;

use Celf\Core\service\ServiceFactory;
use Celf\Core\utils\CelfUtils;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

use Cose\Security\model\listeners\INewPasswordRequestListener;
use Cose\Security\model\NewPasswordRequest;

use Rasty\utils\LinkBuilder;

/**
 * 
 * UI service para Usuario.
 * 
 * @author Marcos
 * @since 12/05/2020
 */
class UIUsuarioService   implements IEntityGridService, INewPasswordRequestListener{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIUsuarioService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIUsuarioCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$criteria->addOrder("username", "ASC");
			
			$service = \Cose\Security\service\ServiceFactory::getUserService();
			
			$usuarios = $service->getList( $criteria );
	
			return $usuarios;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = \Cose\Security\service\ServiceFactory::getUserService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	public function add( User $usuario ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
		
			return $service->add( $usuario );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( User $usuario ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
		
			return $service->update( $usuario );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			    	
	    	///mostramos todos a excepción de los usuarios con rol "cliente"
	    	$rolClienteOid = CelfUtils::WLB_USERGROUP_CLIENTE;
	    	$uiCriteria->setUsergroupNotIn(array($rolClienteOid));	
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = \Cose\Security\service\ServiceFactory::getUserService();
			$usuarios = $service->getCount( $criteria );
			
			return $usuarios;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		    	
    	///mostramos todos a excepción de los usuarios con rol "cliente"
    	$rolClienteOid = CelfUtils::WLB_USERGROUP_CLIENTE;
    	$uiCriteria->setUsergroupNotIn(array($rolClienteOid));
		
		return $this->getList($uiCriteria);
	}
	

	public function cambiarClave( $username, $newPassword, $oldPassword ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
			
			
			return $service->updatePassword( $username, $newPassword, $oldPassword  );			
			

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}


	public function solicitarNuevaClave( $username ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
			
			
			return $service->getNewPassword( $username, $this  );
			

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	
	public function sendNewPasswordRequestEmail(NewPasswordRequest $request){
		
		//armamos el email con el código de validación.
		$template = new XTemplate( dirname(__FILE__) . "/templates/emailSolicitudNuevaClave.htm" );
		$template->assign("linkValidacion", LinkBuilder::getPageUrl( "NuevaClaveConfirmar", array( "code"=>$request->getValidationCode() )) );
		$template->assign("nombre", $request->getUser()->getName() );
		$template->parse("main");
		$mensaje = $template->text("main");		
		
		$asunto = "Celf - Solicitud de nueva clave";
		
		//lo enviamos.
		$emailTo =  $request->getUser()->getEmail();
		//$emailTo =  "ber.iribarne@gmail.com";
		
		CelfUtils::sendMail($request->getUser()->getName(),$emailTo, $asunto, $mensaje);
		
		
	}
	

	public function getSolicitudNuevaClaveByCodigoValidacion( $codigoValidacion ){

		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
					
			return $service->getNewPasswordRequestByValidationCode( $codigoValidacion );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function confirmarCambioClave( $codigoValidacion, $clave1 ){
		try{

			$service = \Cose\Security\service\ServiceFactory::getUserService();
					
			return $service->confirmNewPasswordRequest( $codigoValidacion, $clave1 );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}	
	}
	
	public function sendNewPasswordConfirmedEmail(NewPasswordRequest $request){
		//TODO nada por ahora.	
	}
	
	public function delete( $oid ){

		try{
			
			$service = \Cose\Security\service\ServiceFactory::getUserService();
		
			//TODO podríamos hacer algunas validaciones (p.ej que no sean un cliente).
			
			//valido que no sea un cliente.
			$userToDelete = $service->get( $oid );
			if( CelfUtils::isCliente($userToDelete)){
				throw new RastyException("usuario.eliminar.cliente.exception");				
			}
		
			//valido que no sea el mismo que está logueado.
			$user = CelfUIUtils::getUserLogged();
			if($user->getOid() == $oid )
				throw new RastyException("usuario.eliminar.usuario.logueado.exception");
				
			return $service->delete( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	

	
}
?>