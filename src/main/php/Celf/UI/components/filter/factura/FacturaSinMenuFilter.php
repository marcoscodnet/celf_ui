<?php

namespace Celf\UI\components\filter\factura;

use Celf\UI\components\filter\model\UIFacturaCriteria;

use Celf\UI\components\grid\model\FacturaSinMenuGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar facturas
 * 
 * @author Marcos
 * @since 27/11/2018
 */
class FacturaSinMenuFilter extends Filter{
		
	
	
	public function getType(){
		
		return "FacturaSinMenuFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new FacturaSinMenuGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIFacturaCriteria()) );
		
		
		
		$this->addProperty("suministro");
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		
		parent::parseXTemplate($xtpl);
		
	
		
		
		
		$xtpl->assign("lbl_suministro",  $this->localize("factura.suministro") );
		
		
		
		
		
		
		
	}
}
?>