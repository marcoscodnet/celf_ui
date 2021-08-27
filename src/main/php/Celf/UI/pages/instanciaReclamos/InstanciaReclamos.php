<?php
namespace Celf\UI\pages\instanciaReclamos;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;

use Celf\UI\components\filter\model\UIInstanciaReclamoCriteria;

use Celf\UI\components\grid\model\InstanciaReclamoGridModel;

use Celf\UI\pages\CelfPage;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar las instancias de los reclamos.
 * 
 * @author Marcos
 * @since 17-05-2020
 * 
 */
class InstanciaReclamos extends CelfPage{

	private $reclamo;
	
	public function __construct(){
		
		//buscamos la cuenta corriente dado el oid
		$oid = RastyUtils::getParamGET("reclamoOid");
		$reclamo = UIServiceFactory::getUIReclamoService()->get( $oid );
		
		$this->setReclamo($reclamo);
		
	}
	
	public function getTitle(){
		return $this->localize( "instanciaReclamos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Reclamos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "InstanciaReclamos";
		
	}	

	public function getModelClazz(){
		return get_class( new InstanciaReclamoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIInstanciaReclamoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

	
	
	public function getLegend(){
		
		$nombre = $this->getReclamo();
		
		return CelfUIUtils::formatMessage( $this->localize("instanciaReclamos.buscar"), array($nombre)) ;
	}
	

	

	public function getReclamo()
	{
	    return $this->reclamo;
	}

	public function setReclamo($reclamo)
	{
	    $this->reclamo = $reclamo;
	}
}
?>