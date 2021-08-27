<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\Necrologica;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para necrologicas.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class UINecrologicaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UINecrologicaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UINecrologicaCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getNecrologicaService();
			
			$necrologicas = $service->getList( $criteria );
			//print_r($necrologicas);
			return $necrologicas;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getNecrologicaService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Necrologica $necrologica ){

		try{

			$service = ServiceFactory::getNecrologicaService();
		
			return $service->add( $necrologica );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Necrologica $necrologica ){

		try{

			$service = ServiceFactory::getNecrologicaService();
		
			return $service->update( $necrologica );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getNecrologicaService();
			$necrologicas = $service->getCount( $criteria );
			
			return $necrologicas;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	public function delete(Necrologica $necrologica){

		try {
			
			$service = ServiceFactory::getNecrologicaService();
			
			return $service->delete($necrologica->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
	
	
	
}
?>