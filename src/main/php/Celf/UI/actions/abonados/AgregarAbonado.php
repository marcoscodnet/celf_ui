<?php
namespace Celf\UI\actions\abonados;


use Celf\UI\components\form\abonado\AbonadoForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Abonado;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Abonado.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class AgregarAbonado extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("AbonadoAgregar");
		
		$abonadoForm = $page->getComponentById("abonadoForm");
		
		try {

			//creamos una nueva abonado.
			$abonado = new Abonado();
			
			//completados con los datos del formulario.
			$abonadoForm->fillEntity($abonado);
			
			//agregamos el abonado.
			UIServiceFactory::getUIAbonadoService()->add( $abonado );
			
			$forward->setPageName( $abonadoForm->getBackToOnSuccess() );
			$forward->addParam( "abonadoOid", $abonado->getOid() );			
		
			$abonadoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "AbonadoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$abonadoForm->save();
		}
		
		return $forward;
		
	}

}
?>