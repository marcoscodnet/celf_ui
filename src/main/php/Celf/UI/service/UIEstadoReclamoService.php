<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\EstadoReclamo;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para estadoReclamos.
 * 
 * @author Marcos
 * @since 14/05/2020
 */
class UIEstadoReclamoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIEstadoReclamoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIEstadoReclamoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getEstadoReclamoService();
			
			$estadoReclamos = $service->getList( $criteria );
	
			return $estadoReclamos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getEstadoReclamoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( EstadoReclamo $estadoReclamo ){

		try{

			$service = ServiceFactory::getEstadoReclamoService();
		
			return $service->add( $estadoReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( EstadoReclamo $estadoReclamo ){

		try{

			$service = ServiceFactory::getEstadoReclamoService();
		
			return $service->update( $estadoReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getEstadoReclamoService();
			$estadoReclamos = $service->getCount( $criteria );
			
			return $estadoReclamos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(EstadoReclamo $estadoReclamo){

		try {
			
			$service = ServiceFactory::getEstadoReclamoService();
			
			return $service->delete($estadoReclamo->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>