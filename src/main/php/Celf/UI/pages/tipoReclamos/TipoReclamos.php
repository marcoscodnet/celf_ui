<?php
namespace Celf\UI\pages\tipoReclamos;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UITipoReclamoCriteria;

use Celf\UI\components\grid\model\TipoReclamoGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;


/**
 * Página para consultar los tipoReclamos.
 * 
 * @author Marcos
 * @since 13-05-2020
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR TIPOS DE RECLAMOS' )
 */
class TipoReclamos extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "tipoReclamo.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "tipoReclamo.agregar") );
		$menuOption->setPageName("TipoReclamoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
	
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "TipoReclamos";
		
	}	

	public function getModelClazz(){
		return get_class( new TipoReclamoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UITipoReclamoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("tipoReclamo.agregar") );
	}


}
?>