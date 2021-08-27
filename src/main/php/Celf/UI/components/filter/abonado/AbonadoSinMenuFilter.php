<?php

namespace Celf\UI\components\filter\abonado;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Celf\UI\components\grid\model\AbonadoSinMenuGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar abonados
 * 
 * @author Marcos
 * @since 16/03/2018
 */
class AbonadoSinMenuFilter extends Filter{
		
	
	
	public function getType(){
		
		return "AbonadoSinMenuFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new AbonadoSinMenuGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIAbonadoCriteria()) );
		
		
		
		$this->addProperty("apellido");
		$this->addProperty("nombre");
		$this->addProperty("calle");
		$this->addProperty("telefono");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		
		parent::parseXTemplate($xtpl);
		
	
		$xtpl->assign("lbl_volver",  $this->localize("form.volver") );
		
		$xtpl->assign("lbl_nombre",  $this->localize("abonado.nombre") );
		$xtpl->assign("lbl_apellido",  $this->localize("abonado.apellido") );
		$xtpl->assign("lbl_calle",  $this->localize("abonado.calle") );
		$xtpl->assign("lbl_telefono",  $this->localize("abonado.telefono") );
		
		
		
		
		
		
	}
}
?>