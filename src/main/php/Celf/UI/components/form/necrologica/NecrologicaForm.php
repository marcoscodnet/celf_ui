<?php

namespace Celf\UI\components\form\necrologica;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Celf\UI\service\finder\NecrologicaFinder;

use Celf\UI\components\filter\model\UIArtistaCriteria;

use Celf\UI\service\finder\ArtistaFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Celf\Core\model\Necrologica;

use Celf\Core\model\Artista;


use Rasty\utils\LinkBuilder;

/**
 * Formulario para necrologica

 * @author Marcos
 * @since 16/03/2018
 */
class NecrologicaForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Necrologica
	 */
	private $necrologica;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("nombre");
		
		$this->addProperty("fecha");
		$this->addProperty("texto");
		
		
		
		
		
		
		$this->setBackToOnSuccess("Necrologicas");
		$this->setBackToOnCancel("Necrologicas");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "NecrologicaForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_nombre", $this->localize("necrologica.nombre") );
		$xtpl->assign("lbl_fecha", $this->localize("necrologica.fecha") );
		$xtpl->assign("lbl_texto", $this->localize("necrologica.texto") );
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getNecrologica()
	{
	    return $this->necrologica;
	}

	public function setNecrologica($necrologica)
	{
	    $this->necrologica = $necrologica;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	
	
	
}
?>