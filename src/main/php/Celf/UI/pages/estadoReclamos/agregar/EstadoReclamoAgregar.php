<?php
namespace Celf\UI\pages\estadoReclamos\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\EstadoReclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar estadoReclamos
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR ESTADO DE RECLAMO' )
 */

class EstadoReclamoAgregar extends CelfPage{

	/**
	 * EstadoReclamo a agregar.
	 * @var EstadoReclamo
	 */
	private $EstadoReclamo;

	
	
	public function __construct(){
		
		//inicializamos el EstadoReclamo.
		$EstadoReclamo = new EstadoReclamo();
		
		//$EstadoReclamo->setNombre("Bernardo");
		//$EstadoReclamo->setEmail("ber@mail.com");
		$this->setEstadoReclamo($EstadoReclamo);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("EstadoReclamos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "estadoReclamo.agregar.title" );
	}

	public function getType(){
		
		return "EstadoReclamoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$estadoReclamoForm = $this->getComponentById("estadoReclamoForm");
		$estadoReclamoForm->fillFromSaved( $this->getEstadoReclamo() );
		
	}


	public function getEstadoReclamo()
	{
	    return $this->EstadoReclamo;
	}

	public function setEstadoReclamo($EstadoReclamo)
	{
	    $this->EstadoReclamo = $EstadoReclamo;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>