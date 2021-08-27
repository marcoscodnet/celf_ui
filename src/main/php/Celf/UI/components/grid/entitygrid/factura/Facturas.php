<?php
namespace Celf\UI\components\grid\entitygrid\factura;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\GridActionModel;
use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\utils\Logger;
use Rasty\utils\XTemplate;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\i18n\Locale;
use Rasty\app\RastyMapHelper;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\exception\RastyException;

/**
 * componente listado para las facturass.
 *
 * @author Marcos Piñero (marcosp@codnet.com.ar)
 * @since 27-11-2018
 *
 */
class Facturas extends EntityGrid{

	public function isSecure(){
		return false;
	}
	
	public function getType(){
		return "Facturas";
	}
}