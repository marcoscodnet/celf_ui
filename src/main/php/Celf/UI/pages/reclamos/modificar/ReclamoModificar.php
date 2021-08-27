<?php
namespace Celf\UI\pages\reclamos\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\Reclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar reclamos
 * 
 * @author Marcos
 * @since 17/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR RECLAMO' )
 */

class ReclamoModificar extends CelfPage{

	/**
	 * reclamo a modificar.
	 * @var Reclamo
	 */
	private $reclamo;

	
	public function __construct(){
		
		//inicializamos el reclamo.
		$reclamo = new Reclamo();
		$this->setReclamo($reclamo);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setReclamoOid($oid){
		
		//a partir del id buscamos el reclamo a modificar.
		$reclamo = UIServiceFactory::getUIReclamoService()->get($oid);
		
		$this->setReclamo($reclamo);
		
	}
	
	public function getTitle(){
		return $this->localize( "reclamo.modificar.title" );
	}

	public function getType(){
		
		return "ReclamoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getReclamo(){
		
	    return $this->reclamo;
	}

	public function setReclamo($reclamo)
	{
	    $this->reclamo = $reclamo;
	}
}
?>