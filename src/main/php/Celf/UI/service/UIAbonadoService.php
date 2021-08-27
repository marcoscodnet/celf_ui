<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\Abonado;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para abonados.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class UIAbonadoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIAbonadoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIAbonadoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getAbonadoService();
			
			$abonados = $service->getList( $criteria );
	
			return $abonados;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getAbonadoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Abonado $abonado ){

		try{

			$service = ServiceFactory::getAbonadoService();
		
			return $service->add( $abonado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Abonado $abonado ){

		try{

			$service = ServiceFactory::getAbonadoService();
		
			return $service->update( $abonado );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getAbonadoService();
			$abonados = $service->getCount( $criteria );
			
			return $abonados;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(Abonado $abonado){

		try {
			
			$service = ServiceFactory::getAbonadoService();
			
			return $service->delete($abonado->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>