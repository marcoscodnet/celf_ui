<?php
namespace Celf\UI\pages\correos;



use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UICorreoCriteria;

use Celf\UI\components\grid\model\CorreoGridModel;



use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los correos.
 * 
 * @author Marcos
 * @since 04-05-2018
 * 
 * @Rasty\security\annotations\Secured( permission='CONSULTAR E-MAILS' )
 */
class Correos extends CelfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "correo.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "correo.agregar") );
		$menuOption->setPageName("CorreoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Correos";
		
	}	

	public function getModelClazz(){
		return get_class( new CorreoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UICorreoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("correo.agregar") );
	}


}
?>