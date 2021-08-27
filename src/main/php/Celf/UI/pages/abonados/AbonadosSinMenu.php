<?php
namespace Celf\UI\pages\abonados;

use Celf\UI\pages\CelfPage;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Celf\UI\components\grid\model\AbonadoSinMenuGridModel;

use Celf\UI\service\UIAbonadoService;

use Celf\UI\utils\CelfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Celf\Core\model\Abonado;
use Celf\Core\criteria\AbonadoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los abonados.
 * 
 * @author Marcos
 * @since 19/03/2018
 * 
 */
class AbonadosSinMenu extends CelfPage{

	public function isSecure(){
		return false;
	}
	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "guiaTelefonica.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "AbonadosSinMenu";
		
	}	

	public function getModelClazz(){
		return get_class( new AbonadoSinMenuGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIAbonadoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("abonado.agregar") );
	}
	
	

}
?>