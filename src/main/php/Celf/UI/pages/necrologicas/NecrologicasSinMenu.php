<?php
namespace Celf\UI\pages\necrologicas;

use Celf\UI\pages\CelfPage;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Celf\UI\components\grid\model\NecrologicaSinMenuGridModel;

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
 * @since 19/03/2018
 * 
 */
class NecrologicasSinMenu extends CelfPage{

	public function isSecure(){
		return false;
	}
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "menu.necrologicas" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "NecrologicasSinMenu";
		
	}	

	public function getModelClazz(){
		return get_class( new NecrologicaSinMenuGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UINecrologicaCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("necrologica.agregar") );
	}
	
	

}
?>