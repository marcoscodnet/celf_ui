<?php
namespace Celf\UI\actions\tipoReclamos;


use Celf\UI\components\form\tipoReclamo\TipoReclamoForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\TipoReclamo;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una TipoReclamo.
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class AgregarTipoReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("TipoReclamoAgregar");
		
		$tipoReclamoForm = $page->getComponentById("tipoReclamoForm");
		
		try {

			//creamos una nueva tipoReclamo.
			$tipoReclamo = new TipoReclamo();
			
			//completados con los datos del formulario.
			$tipoReclamoForm->fillEntity($tipoReclamo);
			
			//agregamos el tipoReclamo.
			UIServiceFactory::getUITipoReclamoService()->add( $tipoReclamo );
			
			$forward->setPageName( $tipoReclamoForm->getBackToOnSuccess() );
			$forward->addParam( "tipoReclamoOid", $tipoReclamo->getOid() );			
		
			$tipoReclamoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "TipoReclamoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$tipoReclamoForm->save();
		}
		
		return $forward;
		
	}

}
?>