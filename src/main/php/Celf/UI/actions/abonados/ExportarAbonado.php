<?php
namespace Celf\UI\actions\abonados;


use Celf\UI\components\filter\model\UIAbonadoCriteria;

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
 * se realiza la exportación de todos los abonados.
 * 
 * @author Marcos
 * @since 05/06/2018
 */
class ExportarAbonado extends Action{

	
	public function execute(){

		$forward = new Forward();
		$content_file="";
		$sep="	";
		$sep_linea="\n";
		
		//Variables Auxiliares para la salida al navegador
		
		$hoy = date('d-m-Y');
		//$filename = 'abonados_'.$hoy.'.txt';
		$filename = 'abonados'.$hoy.'.txt';
		$mime_type = 'application/octetstream';
		
		$now = gmdate('D, d M Y H:i:s') . ' GMT';
		
		//*****************************************************************************
		
		// Send headers
		header('Content-Type: ' . $mime_type);
		header('Expires: ' . $now);								
		// lem9 & loic1: IE need specific headers
		header("Content-Disposition: attachment; filename=\"$filename\"\n");
		header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		$abonados = UIServiceFactory::getUIAbonadoService()->getList(new UIAbonadoCriteria());
		//-----------------------------------------------------------------------------------------------
		//Voy imprimiendo los datos en el documento de texto generado con los headers enviados al navegador
		//-----------------------------------------------------------------------------------------------
		
		foreach ($abonados as $abonado) {
		
			$nu_telefono=str_pad($abonado->getTelefono(), 8, " ", STR_PAD_LEFT);
			$cd_categoria=str_pad($abonado->getCategoria(), 1, " ", STR_PAD_RIGHT);
			$ds_ape_razsoc=str_pad(utf8_decode($abonado->getApellido()), 55, " ", STR_PAD_RIGHT);
			$ds_nombre=str_pad(utf8_decode($abonado->getNombre()), 43, " ", STR_PAD_RIGHT);
			$ds_calle=str_pad(utf8_decode($abonado->getCalle()), 20, " ", STR_PAD_RIGHT);
			$nu_numero=str_pad($abonado->getNumero(), 5, " ", STR_PAD_RIGHT);
			$ds_complemento=str_pad(utf8_decode($abonado->getComplemento()), 35, " ", STR_PAD_RIGHT);
			$nu_piso=str_pad($abonado->getPiso(), 2, " ", STR_PAD_RIGHT);
			$ds_dpto=str_pad($abonado->getDepto(), 4, " ", STR_PAD_RIGHT);
			$bl_pbx = ($abonado->getPbx())?"P":" ";
			
			
			$content_file.=$nu_telefono.$sep.
						   $cd_categoria.$sep.
						   $ds_ape_razsoc.$sep.
						   $ds_nombre.$sep.
						   $ds_calle.$sep.
						   $nu_numero.$sep.
						   $ds_complemento.$sep.
						   $nu_piso.$sep.
						   $ds_dpto.$sep.
						   $bl_pbx.$sep_linea;
		}
		
		echo $content_file;
		exit;
		
		
	}

}
?>