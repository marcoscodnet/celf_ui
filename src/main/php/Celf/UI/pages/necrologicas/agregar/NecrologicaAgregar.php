<?php
namespace Celf\UI\pages\necrologicas\agregar;

use Celf\UI\pages\CelfPage;

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
 * @Rasty\security\annotations\Secured( permission='AGREGAR NECROLÓGICA' )
 */

class NecrologicaAgregar extends CelfPage{

	/**
	 * necrologica a agregar.
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
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Necrologicas");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "necrologica.agregar.title" );
	}

	public function getType(){
		
		return "NecrologicaAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$necrologicaForm = $this->getComponentById("necrologicaForm");
		$necrologicaForm->fillFromSaved( $this->getNecrologica() );
		
	}


	public function getNecrologica()
	{
	    return $this->necrologica;
	}

	public function setNecrologica($necrologica)
	{
	    $this->necrologica = $necrologica;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>