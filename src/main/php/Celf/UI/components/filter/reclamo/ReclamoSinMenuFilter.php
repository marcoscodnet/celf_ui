<?php

namespace Celf\UI\components\filter\reclamo;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Celf\UI\components\grid\model\ReclamoSinMenuGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

use Rasty\security\RastySecurityContext;

/**
 * Filtro para buscar reclamos
 * 
 * @author Marcos
 * @since 18/05/2020
 */
class ReclamoSinMenuFilter extends Filter{
		
	
	
	public function getType(){
		
		return "ReclamoSinMenuFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new ReclamoSinMenuGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIReclamoCriteria()) );
		
		
		
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		
		parent::parseXTemplate($xtpl);
		
	
		$xtpl->assign("lbl_submit",  $this->localize("menu.reclamos.iniciar") );
		
		$xtpl->assign("linkAgregarReclamo", LinkBuilder::getPageUrl( "ReclamoSinMenuAgregar") );
		
		
		
		
		
		
	}
	
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		$user = RastySecurityContext::getUser();
		$user = \Cose\Security\service\ServiceFactory::getUserService()->getUserByUsername($user->getUsername());
		$entity->setUsuario( $user );
		
	}
	
}
?>