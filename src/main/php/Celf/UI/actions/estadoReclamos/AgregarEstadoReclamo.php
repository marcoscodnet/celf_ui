<?php
namespace Celf\UI\actions\estadoReclamos;


use Celf\UI\components\form\estadoReclamo\EstadoReclamoForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\EstadoReclamo;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una EstadoReclamo.
 * 
 * @author Marcos
 * @since 14/05/2020
 */
class AgregarEstadoReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("EstadoReclamoAgregar");
		
		$estadoReclamoForm = $page->getComponentById("estadoReclamoForm");
		
		try {

			//creamos una nueva estadoReclamo.
			$estadoReclamo = new EstadoReclamo();
			
			//completados con los datos del formulario.
			$estadoReclamoForm->fillEntity($estadoReclamo);
			
			//agregamos el estadoReclamo.
			UIServiceFactory::getUIEstadoReclamoService()->add( $estadoReclamo );
			
			$forward->setPageName( $estadoReclamoForm->getBackToOnSuccess() );
			$forward->addParam( "estadoReclamoOid", $estadoReclamo->getOid() );			
		
			$estadoReclamoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "EstadoReclamoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$estadoReclamoForm->save();
		}
		
		return $forward;
		
	}

}
?>