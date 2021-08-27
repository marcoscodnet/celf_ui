<?php

namespace Celf\UI\components\header;

use Celf\UI\utils\CelfUIUtils;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\SubmenuOption;

class HeaderNav extends RastyComponent{

	private $title;
	
	private $pageMenuGroups;

	public function __construct(){
		$this->pageMenuGroups = array();
		//$this->setTitle($this->localize("app.title"));
	}
	
	public function getType(){
		
		return "HeaderNav";
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		//$xtpl->assign("cuentas_titulo", $this->localize("app.title"));
		$titles = array();
		$titles[] = $this->localize("app.title");
		$titles[] = $this->getTitle();
		
		$xtpl->assign("cuentas_titulo", implode(" / ", $titles));
		
		$xtpl->assign("menu_page", $this->localize("menu.page"));
		$xtpl->assign("menu_main", $this->localize("menu.main"));
		
	}
	
	public function getMainMenuGroups(){
		
		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		//$menuGroup = new MenuGroup();
		$menuGroups=array();
		if( CelfUIUtils::isAdminLogged()) {

			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.admin_home") );
			$menuOption->setPageName( "AdminHome" );
			//$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );
			$menuOption->setIconClass("icon-admin_home");
			
			//$menuGroup->addMenuOption( $menuOption );
//			$menuGroups[] = $menuOption;
			
		}

		
		
		if( CelfUIUtils::isAdminLogged() ){
			
			$menu = $this->getMenuSeguridad() ;
			if($menu)
				$menuGroups[] =  $menu;
			
			//$menuGroup->addMenuOption( $this->getMenuAdmin() );
			
			
			
			
			
			
		}
		$menuGroups[] =  $this->getMenuAdmin() ;
		
		//return array($menuGroup);
		return $menuGroups;
	}
	
	public function getPageMenuGroups(){
		
		return $this->pageMenuGroups;
	}

	public function setPageMenuGroups($pageMenuGroups)
	{
	    $this->pageMenuGroups = $pageMenuGroups;
	}

	public function getTitle()
	{
	    return $this->title;
	}

	public function setTitle($title)
	{
		if(!empty($title))
	    	$this->title = $title;
	}
	
	public function getMenuSeguridad(){
		
		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.seguridad") );
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios") );
		$menuOption->setPageName( "Usuarios" );
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/movimientos_32.png" );
		$menuOption->setIconClass("icon-user");
		//$menuGroup->addMenuOption( $menuOption );
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.roles") );
		$menuOption->setIconClass("icon-roles");
		$menuOption->setPageName( "Roles");
		//$menuGroup->addMenuOption( $menuOption );
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
			
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.permisos") );
		$menuOption->setPageName( "Permisos" );
		$menuOption->setIconClass("icon-permisos");
		//$menuGroup->addMenuOption( $menuOption );
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		

			$submenu = new SubmenuOption($menuGroup);
			$submenu->setIconClass("icon-seguridad");
			return $submenu;
			
		
		
		
	}
	
	

	public function getMenuAdmin(){
		
		$menuGroup = new MenuGroup();
		$menuGroup->setLabel( $this->localize( "menu.admin") );
		
		
		
		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.abonados") );
		$menuOption->setPageName( "Abonados" );
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.areas") );
		$menuOption->setPageName( "Areas" );
		
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.correos") );
		$menuOption->setPageName( "Correos" );
		
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.estadoReclamos") );
		$menuOption->setPageName( "EstadoReclamos" );
		
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.necrologicas") );
		$menuOption->setPageName( "Necrologicas" );
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.reclamos") );
		$menuOption->setPageName( "Reclamos" );
		
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.tipoReclamos") );
		$menuOption->setPageName( "TipoReclamos" );
		
		
		CelfUIUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		
		
		$submenu = new SubmenuOption($menuGroup);
		
		return $submenu;
	}
	
	
}
?>