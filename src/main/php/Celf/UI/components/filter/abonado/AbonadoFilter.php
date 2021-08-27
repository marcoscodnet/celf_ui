<?php

namespace Celf\UI\components\filter\abonado;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Celf\UI\components\grid\model\AbonadoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

use Celf\Core\model\Categoria;

use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar abonados
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class AbonadoFilter extends Filter{
		
	public function getType(){
		
		return "AbonadoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new AbonadoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIAbonadoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarAbonado");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("apellido");
		$this->addProperty("categoria");
		$this->addProperty("telefono");
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_apellido",  $this->localize("abonado.apellido") );
		$xtpl->assign("lbl_telefono",  $this->localize("abonado.telefono") );
		$xtpl->assign("lbl_categoria",  $this->localize("abonado.categoria") );
		
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "AbonadoModificar") );
		
		
	}
	
	public function getCategorias(){
		
		return CelfUIUtils::localizeEntities(Categoria::getItems());
	}
	
	
	
	
}
?>