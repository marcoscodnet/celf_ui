<?php
namespace Celf\UI\pages\areas;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UIAreaCriteria;

use Celf\UI\components\grid\model\AreaGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;


/**
 * Página para consultar los areas.
 * 
 * @author Marcos
 * @since 13-05-2020
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR AREAS' )
 */
class Areas extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "area.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "area.agregar") );
		$menuOption->setPageName("AreaAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
	
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Areas";
		
	}	

	public function getModelClazz(){
		return get_class( new AreaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIAreaCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("area.agregar") );
	}


}
?>