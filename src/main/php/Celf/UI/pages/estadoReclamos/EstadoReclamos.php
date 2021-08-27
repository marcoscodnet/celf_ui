<?php
namespace Celf\UI\pages\estadoReclamos;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Celf\UI\components\grid\model\EstadoReclamoGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;


/**
 * Página para consultar los estadoReclamos.
 * 
 * @author Marcos
 * @since 14-05-2020
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR ESTADOS DE RECLAMOS' )
 */
class EstadoReclamos extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "estadoReclamo.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "estadoReclamo.agregar") );
		$menuOption->setPageName("EstadoReclamoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
	
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "EstadoReclamos";
		
	}	

	public function getModelClazz(){
		return get_class( new EstadoReclamoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIEstadoReclamoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("estadoReclamo.agregar") );
	}


}
?>