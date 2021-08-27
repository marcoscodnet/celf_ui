<?php
namespace Celf\UI\service;

use Celf\UI\components\filter\model\UIFacturaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

use Rasty\utils\Logger;

use Celf\Core\model\Factura;

use Celf\UI\utils\CelfUIUtils;

/**
 * 
 * UI service para facturas.
 * 
 * @author Marcos
 * @since 27/11/2018
 */
class UIFacturaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIFacturaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIFacturaCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			//Logger::log("Criteria: ".$criteria->getSuministro());
			
			
			
			$facturas = array();
			
			
	    	
	    	if ($criteria->getSuministro()) {
	    		$suministro = str_pad($criteria->getSuministro(), 8, "0", STR_PAD_LEFT);
		

				$dir ="D:\\Documents\\Mis Webs\\coopelf\\facturas\\";
				$dirREL = 'http://localhost/coopelf/facturas/'; 
				$handle=opendir($dir);
				while ($archivo = readdir($handle))
				{
			       
					if ((is_file($dir.$archivo))&&(stristr($archivo,$suministro)))
			         {
			         	$factura = new Factura();
			         	$factura->setSuministro( '<a href="'.$dirREL.$archivo.'" target="_blank"><img class="hrefImg" src="'.CelfUIUtils::getWebPath().'css/images/pdf.jpg" title="'.$archivo.'" />'.$archivo.'</a>' );
			         	$facturas[]=$factura;
			         }
					
			         
				}
				
				closedir($handle);
	    	}
			
			
			if (!count($facturas)) {
				$factura = new Factura();
				$factura->setSuministro( 'No se encontraron resultados' );
				$facturas[]=$factura;
			}
			
			
			return $facturas;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getFacturaService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Factura $factura ){

		try{

			$service = ServiceFactory::getFacturaService();
		
			return $service->add( $factura );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Factura $factura ){

		try{

			$service = ServiceFactory::getFacturaService();
		
			return $service->update( $factura );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			/*$service = ServiceFactory::getFacturaService();
			$facturas = $service->getCount( $criteria );*/
			//Logger::log("Criteria: ".$criteria->getSuministro());
			return 1;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	public function delete(Factura $factura){

		try {
			
			$service = ServiceFactory::getFacturaService();
			
			return $service->delete($factura->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
	
	
	
}
?>