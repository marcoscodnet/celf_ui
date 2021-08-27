<?php
namespace Celf\UI\components\grid\model;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Celf\Core\utils\CelfUtils;

use Celf\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Celf\UI\components\grid\formats\GridCategoriaFormat;
/**
 * Model para la grilla de abonados.
 * 
 * @author Marcos
 * @since 09/05/2018
 */
class AbonadoSinMenuGridModel extends EntityGridModel{

	
	
	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIAbonadoService();
    }
    
    public function getFilter(){
    	
    	$filter = new UIAbonadoCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		
		
		$column = GridModelBuilder::buildColumn( "apellido", "abonado.apellido", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "nombre", "abonado.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "domicilio", "abonado.domicilio", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "telefono", "abonado.telefono", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "categoria", "abonado.categoria", 30, EntityGrid::TEXT_ALIGN_LEFT, new GridCategoriaFormat() ) ;
		$this->addColumn( $column );
		
		
		
	
		
	}

	public function getDefaultFilterField() {
        return "apellido";
    }

	public function getDefaultOrderField(){
		return "apellido";
	}    

    
    
    
}
?>