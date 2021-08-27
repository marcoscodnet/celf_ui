<?php
namespace Celf\UI\pages;

use Celf\UI\utils\CelfUIUtils;

use Rasty\Security\conf\RastySecurityConfig;

use Rasty\components\RastyPage;
use Rasty\utils\LinkBuilder;

/**
 * página genérica para la app de celf
 * 
 * @author Marcos
 * @since 04/05/2018
 */
abstract class CelfPage extends RastyPage{

	private $mensajeError;
	
	
	public function getRastySecurityLayout(){
		
		return "TurnosMetroLayout";// RastySecurityConfig::getInstance()->getLayout();
		
	}
	
	public function getRastySecurityPublicLayout(){
		
		return RastySecurityConfig::getInstance()->getPublicLayout();
		
	}
	
	public function errorNoEsperado( $mensaje="", $pageName="ErrorNoEsperado" ){
		
		$forward = new Forward();
		$forward->setPageName( $pageName );
		$forward->addError( $mensaje );
		$forward->addParam("layout", $this->getLayoutType() );
				
		header ( 'Location: '.  $forward->buildForwardUrl() );
	}
	
	
	public function getTitle(){
		return $this->localize( "necrologicas_app.title" );
	}

	public function getMenuGroups(){

		return array();
	}

	public function getMensajeError()
	{
	    return $this->mensajeError;
	}

	public function setMensajeError($mensajeError)
	{
	    $this->mensajeError = $mensajeError;
	}
	
	
	
	public function getLinkAbonados(){
		
		return LinkBuilder::getPageUrl( "Abonados") ;
		
	}

	public function getLinkAbonadoAgregar(){
		
		return LinkBuilder::getPageUrl( "AbonadoAgregar") ;
		
	}
	
	public function getLinkActionAgregarAbonado(){
		
		return LinkBuilder::getActionUrl( "AgregarAbonado") ;
		
	}

	public function getLinkActionModificarAbonado(){
		
		return LinkBuilder::getActionUrl( "ModificarAbonado") ;
		
	}
	
	public function getLinkCorreos(){
		
		return LinkBuilder::getPageUrl( "Correos") ;
		
	}

	public function getLinkCorreoAgregar(){
		
		return LinkBuilder::getPageUrl( "CorreoAgregar") ;
		
	}
	
	public function getLinkActionAgregarCorreo(){
		
		return LinkBuilder::getActionUrl( "AgregarCorreo") ;
		
	}

	public function getLinkActionModificarCorreo(){
		
		return LinkBuilder::getActionUrl( "ModificarCorreo") ;
		
	}
		

	public function getLinkNecrologicas(){
		
		return LinkBuilder::getPageUrl( "Necrologicas") ;
		
	}
	
	public function getLinkNecrologicasSinMenu(){
		
		return LinkBuilder::getPageUrl( "NecrologicasSinMenu") ;
		
	}

	public function getLinkNecrologicaAgregar(){
		
		return LinkBuilder::getPageUrl( "NecrologicaAgregar") ;
		
	}
	
	public function getLinkActionAgregarNecrologica(){
		
		return LinkBuilder::getActionUrl( "AgregarNecrologica") ;
		
	}

	public function getLinkActionModificarNecrologica(){
		
		return LinkBuilder::getActionUrl( "ModificarNecrologica") ;
		
	}
	
	public function getLinkActionAgregarRegistracion(){
		
		return LinkBuilder::getActionUrl( "AgregarRegistracion") ;
		
	}
	
	public function getLinkActionConfirmarRegistracion(){
		
		return LinkBuilder::getActionUrl( "ConfirmarRegistracion") ;
		
	}
	
	
	public function getLinkActionConfirmarNuevaClave(){

		return LinkBuilder::getActionUrl( "ConfirmarNuevaClave") ;
		
	}
	
	public function getLinkLogin(){
		
		return LinkBuilder::getPageUrl( "Login") ;
		
	}
	
	
	public function getLinkAreas(){
		
		return LinkBuilder::getPageUrl( "Areas") ;
		
	}

	public function getLinkAreaAgregar(){
		
		return LinkBuilder::getPageUrl( "AreaAgregar") ;
		
	}
	
	public function getLinkActionAgregarArea(){
		
		return LinkBuilder::getActionUrl( "AgregarArea") ;
		
	}

	public function getLinkActionModificarArea(){
		
		return LinkBuilder::getActionUrl( "ModificarArea") ;
		
	}
	
	public function getLinkTipoReclamos(){
		
		return LinkBuilder::getPageUrl( "TipoReclamos") ;
		
	}

	public function getLinkTipoReclamoAgregar(){
		
		return LinkBuilder::getPageUrl( "TipoReclamoAgregar") ;
		
	}
	
	public function getLinkActionAgregarTipoReclamo(){
		
		return LinkBuilder::getActionUrl( "AgregarTipoReclamo") ;
		
	}

	public function getLinkActionModificarTipoReclamo(){
		
		return LinkBuilder::getActionUrl( "ModificarTipoReclamo") ;
		
	}
	
	public function getLinkEstadoReclamos(){
		
		return LinkBuilder::getPageUrl( "EstadoReclamos") ;
		
	}

	public function getLinkEstadoReclamoAgregar(){
		
		return LinkBuilder::getPageUrl( "EstadoReclamoAgregar") ;
		
	}
	
	public function getLinkActionAgregarEstadoReclamo(){
		
		return LinkBuilder::getActionUrl( "AgregarEstadoReclamo") ;
		
	}

	public function getLinkActionModificarEstadoReclamo(){
		
		return LinkBuilder::getActionUrl( "ModificarEstadoReclamo") ;
		
	}
	
	public function getLinkReclamos(){
		
		return LinkBuilder::getPageUrl( "Reclamos") ;
		
	}

	public function getLinkReclamoAgregar(){
		
		return LinkBuilder::getPageUrl( "ReclamoAgregar") ;
		
	}
	
	public function getLinkActionAgregarReclamo(){
		
		return LinkBuilder::getActionUrl( "AgregarReclamo") ;
		
	}

	public function getLinkActionModificarReclamo(){
		
		return LinkBuilder::getActionUrl( "ModificarReclamo") ;
		
	}
	
	
	
	
}
?>