<?php

namespace Celf\UI\components\filter\correo;

use Celf\UI\components\filter\model\UICorreoCriteria;

use Celf\UI\components\filter\model\UICelfCriteria;

use Celf\UI\components\grid\model\CorreoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;



use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar correos
 * 
 * @author Marcos
 * @since 08/05/2018
 */
class CorreoFilter extends Filter{
		
	public function getType(){
		
		return "CorreoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new CorreoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UICorreoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarCorreo");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("email");
		$this->addProperty("nombre");
		$this->addProperty("activo");
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_email",  $this->localize("correo.email") );
		$xtpl->assign("lbl_activo",  $this->localize("correo.activo") );
		$xtpl->assign("lbl_nombre",  $this->localize("correo.nombre") );
		
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "CorreoModificar") );
		
		
	}
	
	public function getFiltrosSINO(){
		
		$items = array();
		$items[ 0 ] = $this->localize("criteria.sin_especificar");
		$items[ UICelfCriteria::NO ] = $this->localize("criteria.no");
		$items[ UICelfCriteria::SI ] = $this->localize("criteria.si");
		
		
		return $items;
		
	}
	
	public function getCorreo(){
		
	}
	
	
}
?>