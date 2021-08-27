<?php
namespace Celf\UI\pages\facturas;

use Celf\UI\pages\CelfPage;

use Celf\UI\components\filter\model\UIFacturaCriteria;

use Celf\UI\components\grid\model\FacturaSinMenuGridModel;

use Celf\UI\service\UIFacturaService;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Celf\Core\model\Factura;
use Celf\Core\criteria\FacturaCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar las facturas.
 * 
 * @author Marcos
 * @since 27/11/2018
 * 
 */
class FacturasSinMenu extends CelfPage{

	public function isSecure(){
		return false;
	}
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "menu.facturas" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "FacturasSinMenu";
		
	}	

	public function getModelClazz(){
		return get_class( new FacturaSinMenuGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIFacturaCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("factura.agregar") );
	}
	
	

}
?>