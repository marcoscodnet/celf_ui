<?php
namespace Celf\UI\pages\estadoReclamos\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\EstadoReclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar estadoReclamos
 * 
 * @author Marcos
 * @since 14/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR ESTADO DE RECLAMO' )
 */

class EstadoReclamoModificar extends CelfPage{

	/**
	 * estadoReclamo a modificar.
	 * @var EstadoReclamo
	 */
	private $estadoReclamo;

	
	public function __construct(){
		
		//inicializamos el estadoReclamo.
		$estadoReclamo = new EstadoReclamo();
		$this->setEstadoReclamo($estadoReclamo);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setEstadoReclamoOid($oid){
		
		//a partir del id buscamos el estadoReclamo a modificar.
		$estadoReclamo = UIServiceFactory::getUIEstadoReclamoService()->get($oid);
		
		$this->setEstadoReclamo($estadoReclamo);
		
	}
	
	public function getTitle(){
		return $this->localize( "estadoReclamo.modificar.title" );
	}

	public function getType(){
		
		return "EstadoReclamoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getEstadoReclamo(){
		
	    return $this->estadoReclamo;
	}

	public function setEstadoReclamo($estadoReclamo)
	{
	    $this->estadoReclamo = $estadoReclamo;
	}
}
?>