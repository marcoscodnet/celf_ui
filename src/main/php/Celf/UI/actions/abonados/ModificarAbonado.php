<?php
namespace Celf\UI\actions\abonados;

use Celf\UI\components\form\abonado\AbonadoForm;

use Celf\UI\service\UIServiceFactory;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de una abonado.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class ModificarAbonado extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("AbonadoModificar");
		
		$abonadoForm = $page->getComponentById("abonadoForm");
			
		$oid = $abonadoForm->getOid();
						
		try {

			//obtenemos la abonado.
			$abonado = UIServiceFactory::getUIAbonadoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$abonadoForm->fillEntity($abonado);
			
			//guardamos los cambios.
			UIServiceFactory::getUIAbonadoService()->update( $abonado );
			
			$forward->setPageName( $abonadoForm->getBackToOnSuccess() );
			$forward->addParam( "abonadoOid", $abonado->getOid() );
			
			$abonadoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "AbonadoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$abonadoForm->save();
			
		}
		return $forward;
		
	}

}
?>