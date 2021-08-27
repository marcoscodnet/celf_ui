<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UITipoReclamoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\TipoReclamo;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para tipoReclamos.
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class UITipoReclamoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UITipoReclamoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UITipoReclamoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTipoReclamoService();
			
			$tipoReclamos = $service->getList( $criteria );
	
			return $tipoReclamos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getTipoReclamoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( TipoReclamo $tipoReclamo ){

		try{

			$service = ServiceFactory::getTipoReclamoService();
		
			return $service->add( $tipoReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( TipoReclamo $tipoReclamo ){

		try{

			$service = ServiceFactory::getTipoReclamoService();
		
			return $service->update( $tipoReclamo );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getTipoReclamoService();
			$tipoReclamos = $service->getCount( $criteria );
			
			return $tipoReclamos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(TipoReclamo $tipoReclamo){

		try {
			
			$service = ServiceFactory::getTipoReclamoService();
			
			return $service->delete($tipoReclamo->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>