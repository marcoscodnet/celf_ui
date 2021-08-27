<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\Reclamo;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para reclamos.
 * 
 * @author Marcos
 * @since 15/05/2020
 */
class UIReclamoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIReclamoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIReclamoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getReclamoService();
			
			$reclamos = $service->getList( $criteria );
	
			return $reclamos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getReclamoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Reclamo $reclamo ){

		try{

			$service = ServiceFactory::getReclamoService();
		
			return $service->add( $reclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Reclamo $reclamo ){

		try{

			$service = ServiceFactory::getReclamoService();
		
			return $service->update( $reclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getReclamoService();
			$reclamos = $service->getCount( $criteria );
			
			return $reclamos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(Reclamo $reclamo){

		try {
			
			$service = ServiceFactory::getReclamoService();
			
			return $service->delete($reclamo->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>