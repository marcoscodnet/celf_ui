<?php
namespace Celf\UI\service;



use Celf\UI\components\filter\model\UIAsociadoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\Asociado;


use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para asociados.
 * 
 * @author Marcos
 * @since 12/05/2020
 */
class UIAsociadoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIAsociadoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIAsociadoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getAsociadoService();
			
			$asociados = $service->getList( $criteria );
	
			return $asociados;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getAsociadoService();
		
			$asociado = $service->get( $oid );

			//$asociado->decrypt();
			
			return $asociado;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Asociado $asociado ){

		try{

			$service = ServiceFactory::getAsociadoService();
		
			return $service->add( $asociado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Asociado $asociado ){

		try{

			$service = ServiceFactory::getAsociadoService();
		
			return $service->update( $asociado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getAsociadoService();
			$asociados = $service->getCount( $criteria );
			
			return $asociados;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	

	public function getByUser(User $user){
		
		try{

			$service = ServiceFactory::getAsociadoService();
			
			$asociado = $service->getByUser($user);
	
			return $asociado;

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			
	}
	
	
}
?>