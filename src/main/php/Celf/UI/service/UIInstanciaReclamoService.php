<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UIInstanciaReclamoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\InstanciaReclamo;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para instanciaInstanciaReclamos.
 * 
 * @author Marcos
 * @since 17/05/2020
 */
class UIInstanciaReclamoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIInstanciaReclamoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIInstanciaReclamoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getInstanciaReclamoService();
			
			$instanciaInstanciaReclamos = $service->getList( $criteria );
	
			return $instanciaInstanciaReclamos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getInstanciaReclamoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( InstanciaReclamo $instanciaInstanciaReclamo ){

		try{

			$service = ServiceFactory::getInstanciaReclamoService();
		
			return $service->add( $instanciaInstanciaReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( InstanciaReclamo $instanciaInstanciaReclamo ){

		try{

			$service = ServiceFactory::getInstanciaReclamoService();
		
			return $service->update( $instanciaInstanciaReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getInstanciaReclamoService();
			$instanciaInstanciaReclamos = $service->getCount( $criteria );
			
			return $instanciaInstanciaReclamos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(InstanciaReclamo $instanciaInstanciaReclamo){

		try {
			
			$service = ServiceFactory::getInstanciaReclamoService();
			
			return $service->delete($instanciaInstanciaReclamo->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>