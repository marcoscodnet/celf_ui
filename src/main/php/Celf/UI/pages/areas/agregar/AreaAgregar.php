<?php
namespace Celf\UI\pages\areas\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Area;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar areas
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR AREA' )
 */

class AreaAgregar extends CelfPage{

	/**
	 * Area a agregar.
	 * @var Area
	 */
	private $Area;

	
	
	public function __construct(){
		
		//inicializamos el Area.
		$Area = new Area();
		
		//$Area->setNombre("Bernardo");
		//$Area->setEmail("ber@mail.com");
		$this->setArea($Area);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Areas");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "area.agregar.title" );
	}

	public function getType(){
		
		return "AreaAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$areaForm = $this->getComponentById("areaForm");
		$areaForm->fillFromSaved( $this->getArea() );
		
	}


	public function getArea()
	{
	    return $this->Area;
	}

	public function setArea($Area)
	{
	    $this->Area = $Area;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>