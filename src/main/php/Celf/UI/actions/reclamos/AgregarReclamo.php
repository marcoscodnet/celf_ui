<?php
namespace Celf\UI\actions\reclamos;


use Celf\UI\components\form\reclamo\ReclamoForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Reclamo;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Reclamo.
 * 
 * @author Marcos
 * @since 15/05/2020
 */
class AgregarReclamo extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("ReclamoAgregar");
		
		$reclamoForm = $page->getComponentById("reclamoForm");
		
		try {

			//creamos una nueva reclamo.
			$reclamo = new Reclamo();
			
			//completados con los datos del formulario.
			$reclamoForm->fillEntity($reclamo);
			
			$user = RastySecurityContext::getUser();
			$user = \Cose\Security\service\ServiceFactory::getUserService()->getUserByUsername($user->getUsername());
			$reclamo->setUsuario( $user );
			$reclamo->setFecha( new \Datetime() );
			
			
			//agregamos el reclamo.
			UIServiceFactory::getUIReclamoService()->add( $reclamo );
			
			$forward->setPageName( $reclamoForm->getBackToOnSuccess() );
			$forward->addParam( "reclamoOid", $reclamo->getOid() );			
		
			$reclamoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "ReclamoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$reclamoForm->save();
		}
		
		return $forward;
		
	}

}
?>