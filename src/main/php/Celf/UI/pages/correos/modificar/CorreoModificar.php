<?php
namespace Celf\UI\pages\correos\modificar;

use Celf\UI\pages\CelfPage;

use Celf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Celf\Core\model\Correo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar e-mails
 * 
 * @author Marcos
 * @since 08/05/2018
 *
 * @Rasty\security\annotations\Secured( permission='MODIFICAR E-MAIL' )
 */


class CorreoModificar extends CelfPage{

	/**
	 * correo a modificar.
	 * @var Correo
	 */
	private $correo;

	
	public function __construct(){
		
		//inicializamos el correo.
		$correo = new Correo();
		$this->setCorreo($correo);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setCorreoOid($oid){
		
		//a partir del id buscamos el correo a modificar.
		$correo = UIServiceFactory::getUICorreoService()->get($oid);
		
		$this->setCorreo($correo);
		
	}
	
	public function getTitle(){
		return $this->localize( "correo.modificar.title" );
	}

	public function getType(){
		
		return "CorreoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getCorreo(){
		
	    return $this->correo;
	}

	public function setCorreo($correo)
	{
	    $this->correo = $correo;
	}
}
?>