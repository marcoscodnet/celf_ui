<?php
namespace Celf\UI\pages\reclamos;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Celf\UI\components\grid\model\ReclamoGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;


/**
 * Página para consultar los reclamos.
 * 
 * @author Marcos
 * @since 15-05-2020
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR RECLAMOS' )
 */
class Reclamos extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "reclamo.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "reclamo.agregar") );
		$menuOption->setPageName("ReclamoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
	
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Reclamos";
		
	}	

	public function getModelClazz(){
		return get_class( new ReclamoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIReclamoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("reclamo.agregar") );
	}


}
?>