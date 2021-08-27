<?php
namespace Celf\UI\pages\abonados\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\Abonado;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para modificar abonados
 * 
 * @author Marcos
 * @since 08/05/2018
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR ABONADO' )
 */

class AbonadoModificar extends CelfPage{

	/**
	 * abonado a modificar.
	 * @var Abonado
	 */
	private $abonado;

	
	public function __construct(){
		
		//inicializamos el abonado.
		$abonado = new Abonado();
		$this->setAbonado($abonado);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setAbonadoOid($oid){
		
		//a partir del id buscamos el abonado a modificar.
		$abonado = UIServiceFactory::getUIAbonadoService()->get($oid);
		
		$this->setAbonado($abonado);
		
	}
	
	public function getTitle(){
		return $this->localize( "abonado.modificar.title" );
	}

	public function getType(){
		
		return "AbonadoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getAbonado(){
		
	    return $this->abonado;
	}

	public function setAbonado($abonado)
	{
	    $this->abonado = $abonado;
	}
}
?>