<?php
namespace Celf\UI\pages\reclamos\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Reclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar reclamos
 * 
 * @author Marcos
 * @since 15/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR RECLAMO' )
 */

class ReclamoAgregar extends CelfPage{

	/**
	 * Reclamo a agregar.
	 * @var Reclamo
	 */
	private $Reclamo;

	
	
	public function __construct(){
		
		//inicializamos el Reclamo.
		$Reclamo = new Reclamo();
		
		//$Reclamo->setNombre("Bernardo");
		//$Reclamo->setEmail("ber@mail.com");
		$this->setReclamo($Reclamo);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Reclamos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "reclamo.agregar.title" );
	}

	public function getType(){
		
		return "ReclamoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$reclamoForm = $this->getComponentById("reclamoForm");
		$reclamoForm->fillFromSaved( $this->getReclamo() );
		
	}


	public function getReclamo()
	{
	    return $this->Reclamo;
	}

	public function setReclamo($Reclamo)
	{
	    $this->Reclamo = $Reclamo;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>