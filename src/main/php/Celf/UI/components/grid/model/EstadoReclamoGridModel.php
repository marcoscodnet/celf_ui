<?php
namespace Celf\UI\components\grid\model;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

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




/**
 * Model para la grilla de estadoReclamos.
 * 
 * @author Marcos
 * @since 14/05/2020
 */
class EstadoReclamoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIEstadoReclamoService();
    }
    
    public function getFilter(){
    	
    	$filter = new UIEstadoReclamoCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "estadoReclamo.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		
		
		$column = GridModelBuilder::buildColumn( "nombre", "estadoReclamo.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "orden", "estadoReclamo.orden", 10, EntityGrid::TEXT_ALIGN_CENTER ) ;
		$this->addColumn( $column );
		
		
		
		
		
	}

	public function getDefaultFilterField() {
        return "orden";
    }

	public function getDefaultOrderField(){
		return "orden";
	}    

    
    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){
	
		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.estadoReclamos.modificar") );
		$menuOption->setPageName( "EstadoReclamoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;

		
		
						
		
		if( CelfUIUtils::tienePermisoAPagina( 'EstadoReclamoEliminar' )){
			$menuOption = new MenuActionAjaxOption();
			$menuOption->setLabel( $this->localize( "menu.estadoReclamo.eliminar") );
			$menuOption->setActionName( "EliminarEstadoReclamo" );
			$menuOption->setConfirmMessage( $this->localize( "estadoReclamo.eliminar.confirm.msg") );
			$menuOption->setConfirmTitle( $this->localize( "estadoReclamo.eliminar.confirm.title") );
			$menuOption->setOnSuccessCallback( "eliminarCallback" );
			$menuOption->addParam("estadoReclamoOid",$item->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
			$options[] = $menuOption ;
		}
			$group->setMenuOptions( $options );
		
		
		return array( $group );
		
	} 
    
}
?>