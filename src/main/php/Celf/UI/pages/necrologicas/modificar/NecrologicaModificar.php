<?php
namespace Celf\UI\pages\necrologicas\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\Necrologica;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para consultar los necrologicas.
 * 
 * @author Marcos
 * @since 08/05/2018
 * 
 * @Rasty\security\annotations\Secured( permission='MODIFICAR NECROLÓGICA' )
 */

class NecrologicaModificar extends CelfPage{

	/**
	 * necrologica a modificar.
	 * @var Necrologica
	 */
	private $necrologica;

	
	public function __construct(){
		
		//inicializamos el necrologica.
		$necrologica = new Necrologica();
		$this->setNecrologica($necrologica);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setNecrologicaOid($oid){
		
		//a partir del id buscamos el necrologica a modificar.
		$necrologica = UIServiceFactory::getUINecrologicaService()->get($oid);
		
		$this->setNecrologica($necrologica);
		
	}
	
	public function getTitle(){
		return $this->localize( "necrologica.modificar.title" );
	}

	public function getType(){
		
		return "NecrologicaModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getNecrologica(){
		
	    return $this->necrologica;
	}

	public function setNecrologica($necrologica)
	{
	    $this->necrologica = $necrologica;
	}
}
?>