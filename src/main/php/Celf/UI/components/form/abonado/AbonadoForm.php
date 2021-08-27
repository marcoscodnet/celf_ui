<?php

namespace Celf\UI\components\form\abonado;

use Celf\UI\components\filter\model\UIAbonadoCriteria;

use Celf\UI\service\finder\AbonadoFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Celf\Core\model\Categoria;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para abonado

 * @author Marcos
 * @since 04/05/2018
 */
class AbonadoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Abonado
	 */
	private $abonado;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("apellido");
		$this->addProperty("nombre");
		$this->addProperty("calle");
		$this->addProperty("numero");
		$this->addProperty("complemento");
		$this->addProperty("piso");
		$this->addProperty("depto");
		$this->addProperty("telefono");
		$this->addProperty("categoria");
		$this->addProperty("pbx");
		
		$this->setBackToOnSuccess("Abonados");
		$this->setBackToOnCancel("Abonados");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "AbonadoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_apellido", $this->localize("abonado.apellido") );
		$xtpl->assign("lbl_nombre", $this->localize("abonado.nombre") );
		$xtpl->assign("lbl_calle", $this->localize("abonado.calle") );
		$xtpl->assign("lbl_numero", $this->localize("abonado.numero") );
		$xtpl->assign("lbl_complemento", $this->localize("abonado.complemento") );
		$xtpl->assign("lbl_piso", $this->localize("abonado.piso") );
		$xtpl->assign("lbl_depto", $this->localize("abonado.depto") );
		$xtpl->assign("lbl_telefono", $this->localize("abonado.telefono") );
		$xtpl->assign("lbl_categoria", $this->localize("abonado.categoria") );
		$xtpl->assign("lbl_pbx", $this->localize("abonado.pbx") );
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getAbonado()
	{
	    return $this->abonado;
	}

	public function setAbonado($abonado)
	{
	    $this->abonado = $abonado;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	
	public function getCategorias(){
		
		return CelfUIUtils::localizeEntities(Categoria::getItems());
	}
	
}
?>