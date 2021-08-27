<?php
namespace Celf\UI\pages\tipoReclamos\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\TipoReclamo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar tipoReclamos
 * 
 * @author Marcos
 * @since 13/05/2020
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR TIPO DE RECLAMO' )
 */

class TipoReclamoModificar extends CelfPage{

	/**
	 * tipoReclamo a modificar.
	 * @var TipoReclamo
	 */
	private $tipoReclamo;

	
	public function __construct(){
		
		//inicializamos el tipoReclamo.
		$tipoReclamo = new TipoReclamo();
		$this->setTipoReclamo($tipoReclamo);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setTipoReclamoOid($oid){
		
		//a partir del id buscamos el tipoReclamo a modificar.
		$tipoReclamo = UIServiceFactory::getUITipoReclamoService()->get($oid);
		
		$this->setTipoReclamo($tipoReclamo);
		
	}
	
	public function getTitle(){
		return $this->localize( "tipoReclamo.modificar.title" );
	}

	public function getType(){
		
		return "TipoReclamoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getTipoReclamo(){
		
	    return $this->tipoReclamo;
	}

	public function setTipoReclamo($tipoReclamo)
	{
	    $this->tipoReclamo = $tipoReclamo;
	}
}
?>