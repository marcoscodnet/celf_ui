<?php
namespace Celf\UI\pages\necrologicas;

use Celf\UI\pages\CelfPage;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Celf\UI\components\grid\model\NecrologicaGridModel;

use Celf\UI\service\UINecrologicaService;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Celf\Core\model\Necrologica;
use Celf\Core\criteria\NecrologicaCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los necrologicas.
 * 
 * @author Marcos
 * @since 05/05/2018
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR NECROLÓGICAS' )
 */
class Necrologicas extends CelfPage{

	
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "necrologicas.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "necrologica.agregar") );
		$menuOption->setPageName("NecrologicaAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Necrologicas";
		
	}	

	public function getModelClazz(){
		return get_class( new NecrologicaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UINecrologicaCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("necrologica.agregar") );
	}

}
?>