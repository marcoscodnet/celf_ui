<?php
namespace Celf\UI\actions\necrologicas;

use Celf\UI\utils\CelfUIUtils;

use Celf\UI\components\form\necrologica\NecrologicaForm;

use Celf\UI\service\UIServiceFactory;
use Celf\Core\model\Necrologica;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una necrologica.
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class AgregarNecrologica extends Action{

	
	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("NecrologicaAgregar");
		
		$necrologicaForm = $page->getComponentById("necrologicaForm");
		
		try {

			//creamos un nuevo necrologica.
			$necrologica = new Necrologica();
			
			//completados con los datos del formulario.
			$necrologicaForm->fillEntity($necrologica);
			
			//agregamos el necrologica.
			UIServiceFactory::getUINecrologicaService()->add( $necrologica );
			
			$forward->setPageName( $necrologicaForm->getBackToOnSuccess() );
			$forward->addParam( "necrologicaOid", $necrologica->getOid() );			
		
			$necrologicaForm->cleanSavedProperties();
			
		} catch (RastyDuplicatedException $e) {
		
			$forward->setPageName( "NecrologicaAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
						
			//guardamos lo ingresado en el form.
			$necrologicaForm->save();
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "NecrologicaAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
						
			//guardamos lo ingresado en el form.
			$necrologicaForm->save();
		}
		
		return $forward;
		
	}

}
?>