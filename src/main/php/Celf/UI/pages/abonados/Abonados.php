<?php
namespace Celf\UI\pages\abonados;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Celf\UI\components\grid\model\AbonadoGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;


/**
 * Página para consultar los abonados.
 * 
 * @author Marcos
 * @since 04-05-2018
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR ABONADOS' )
 */
class Abonados extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "abonado.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "abonado.agregar") );
		$menuOption->setPageName("AbonadoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		$menuOption = new MenuActionOption();
		$menuOption->setLabel( $this->localize( "abonado.exportar") );
		$menuOption->setActionName("ExportarAbonado");
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Abonados";
		
	}	

	public function getModelClazz(){
		return get_class( new AbonadoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIAbonadoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("abonado.agregar") );
	}


}
?>