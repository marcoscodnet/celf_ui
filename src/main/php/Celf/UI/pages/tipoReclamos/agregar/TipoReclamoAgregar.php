<?php
namespace Celf\UI\pages\tipoReclamos\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\TipoReclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar tipoReclamos
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR TIPO DE RECLAMO' )
 */

class TipoReclamoAgregar extends CelfPage{

	/**
	 * TipoReclamo a agregar.
	 * @var TipoReclamo
	 */
	private $TipoReclamo;

	
	
	public function __construct(){
		
		//inicializamos el TipoReclamo.
		$TipoReclamo = new TipoReclamo();
		
		//$TipoReclamo->setNombre("Bernardo");
		//$TipoReclamo->setEmail("ber@mail.com");
		$this->setTipoReclamo($TipoReclamo);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("TipoReclamos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "tipoReclamo.agregar.title" );
	}

	public function getType(){
		
		return "TipoReclamoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$tipoReclamoForm = $this->getComponentById("tipoReclamoForm");
		$tipoReclamoForm->fillFromSaved( $this->getTipoReclamo() );
		
	}


	public function getTipoReclamo()
	{
	    return $this->TipoReclamo;
	}

	public function setTipoReclamo($TipoReclamo)
	{
	    $this->TipoReclamo = $TipoReclamo;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>