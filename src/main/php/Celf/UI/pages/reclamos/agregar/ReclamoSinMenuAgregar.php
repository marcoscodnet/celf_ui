<?php
namespace Celf\UI\pages\reclamos\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Reclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Celf\UI\service\UIServiceFactory;

/**
 * Página para agregar reclamos
 * 
 * @author Marcos
 * @since 18/05/2020
 *
 * 
 */

class ReclamoSinMenuAgregar extends CelfPage{

	/**
	 * Reclamo a agregar.
	 * @var Reclamo
	 */
	private $Reclamo;

	
	
	public function __construct(){
		
		//inicializamos el Reclamo.
		$Reclamo = new Reclamo();
		
		$estadoReclamo = UIServiceFactory::getUIEstadoReclamoService()->get( 1 );
		
		
	
			$Reclamo->setEstadoReclamo($estadoReclamo);
			
	
		
		$this->setReclamo($Reclamo);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("ReclamosSinMenu");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "reclamo.agregar.title" );
	}

	public function getType(){
		
		return "ReclamoSinMenuAgregar";
		
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