<?php
namespace Celf\UI\pages\areas\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\Area;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar areas
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR AREA' )
 */

class AreaModificar extends CelfPage{

	/**
	 * area a modificar.
	 * @var Area
	 */
	private $area;

	
	public function __construct(){
		
		//inicializamos el area.
		$area = new Area();
		$this->setArea($area);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setAreaOid($oid){
		
		//a partir del id buscamos el area a modificar.
		$area = UIServiceFactory::getUIAreaService()->get($oid);
		
		$this->setArea($area);
		
	}
	
	public function getTitle(){
		return $this->localize( "area.modificar.title" );
	}

	public function getType(){
		
		return "AreaModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getArea(){
		
	    return $this->area;
	}

	public function setArea($area)
	{
	    $this->area = $area;
	}
}
?>