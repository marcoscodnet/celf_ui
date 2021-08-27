<?php
namespace Celf\UI\pages\reclamos;

use Celf\UI\pages\CelfPage;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Celf\UI\components\grid\model\ReclamoSinMenuGridModel;

use Celf\UI\service\UIReclamoService;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Celf\Core\model\Reclamo;
use Celf\Core\criteria\ReclamoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los reclamos.
 * 
 * @author Marcos
 * @since 18/05/2020
 * 
 */
class ReclamosSinMenu extends CelfPage{

	
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "reclamo.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "ReclamosSinMenu";
		
	}	

	public function getModelClazz(){
		return get_class( new ReclamoSinMenuGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIReclamoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("reclamo.agregar") );
	}
	
	

}
?>