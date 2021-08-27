<?php
namespace Celf\UI\actions\necrologicas;

use Celf\UI\components\form\necrologica\NecrologicaForm;

use Celf\UI\service\UIServiceFactory;
use Celf\UI\utils\CelfUtils;

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
 * se realiza la actualización de una necrológica.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class ModificarNecrologica extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("NecrologicaModificar");
		
		$necrologicaForm = $page->getComponentById("necrologicaForm");
			
		$oid = $necrologicaForm->getOid();
						
		try {

			//obtenemos el necrologica.
			$necrologica = UIServiceFactory::getUINecrologicaService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$necrologicaForm->fillEntity($necrologica);
			
			//guardamos los cambios.
			UIServiceFactory::getUINecrologicaService()->update( $necrologica );
			
			$forward->setPageName( $necrologicaForm->getBackToOnSuccess() );
			$forward->addParam( "necrologicaOid", $necrologica->getOid() );
			
			$necrologicaForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "NecrologicaModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$necrologicaForm->save();
			
		}
		return $forward;
		
	}

}
?>