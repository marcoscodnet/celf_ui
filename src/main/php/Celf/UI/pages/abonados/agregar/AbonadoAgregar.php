<?php
namespace Celf\UI\pages\abonados\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Abonado;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar abonados
 * 
 * @author Marcos
 * @since 08/05/2018
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR ABONADO' )
 */

class AbonadoAgregar extends CelfPage{

	/**
	 * Abonado a agregar.
	 * @var Abonado
	 */
	private $Abonado;

	
	
	public function __construct(){
		
		//inicializamos el Abonado.
		$Abonado = new Abonado();
		
		//$Abonado->setNombre("Bernardo");
		//$Abonado->setEmail("ber@mail.com");
		$this->setAbonado($Abonado);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Abonados");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "abonado.agregar.title" );
	}

	public function getType(){
		
		return "AbonadoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$abonadoForm = $this->getComponentById("abonadoForm");
		$abonadoForm->fillFromSaved( $this->getAbonado() );
		
	}


	public function getAbonado()
	{
	    return $this->Abonado;
	}

	public function setAbonado($Abonado)
	{
	    $this->Abonado = $Abonado;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>