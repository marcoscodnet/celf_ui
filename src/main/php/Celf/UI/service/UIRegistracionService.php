<?php
namespace Celf\UI\service;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Celf\Core\model\Registracion;

use Celf\Core\service\ServiceFactory;
use Cose\Security\model\User;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

use Cose\persistence\PersistenceContext;


/**
 * 
 * UI service para Registracion.
 * 
 * @author Marcos
 * @since 09/05/2020
 */
class UIRegistracionService{ // implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIRegistracionService();
			
		}
		return self::$instance; 
	}

	

	public function add( Registracion $registracion ){

		try{

			$service = ServiceFactory::getRegistracionService();
		
			return $service->add( $registracion );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	

	public function getByCodigoValidacion( $codigoValidacion ){

		try{

			$service = ServiceFactory::getRegistracionService();
		
			return $service->getByCodigoValidacion( $codigoValidacion );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}

	public function get( $oid ){

		try{

			$service = ServiceFactory::getRegistracionService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function confirmar( $codigoValidacion ){

		try{

			$this->persistenceContext =  PersistenceContext::getInstance();
			
			$this->persistenceContext->beginTransaction();

			$service = ServiceFactory::getRegistracionService();
		
			$cliente =  $service->confirmar( $codigoValidacion );

			$this->persistenceContext->commit();
			
			return $cliente;
			
		} catch (\Exception $e) {
			
			$this->persistenceContext->rollback();
			throw new RastyException($e->getMessage());
			
		}			

	}
	
}
?>