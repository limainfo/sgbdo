<?php

// D�finition du chemin absolu du dossier openoffice. Comme ce fichier se trouve dans calc/classes, on
// fait 2x le array_pop
/*
$_openoffice_path = str_replace('\\', '/', dirname(__FILE__));
$_openoffice_path = explode('/', $_openoffice_path);
array_pop($_openoffice_path);
array_pop($_openoffice_path);
$_openoffice_path = implode('/', $_openoffice_path);
*/
/**
 * D�finition du chemin du dossier principal o� se situent les documents g�n�r�s et les scripts et tout, en fait
 *
 * @var 	string		PATH_ROOT					Le chemin depuis la racine vers le dossier openoffice
 */
//define ('PATH_ROOT',							$_openoffice_path.'/');
$caminho = substr(__FILE__, 0, strrpos(__FILE__, '/'));
$caminho = str_replace('calc/classes','',$caminho);
//echo $caminho;

define ('PATH_ROOT',			$caminho);

/**
 * Les chemins par d�faut bas�s sur le PATH_ROOT
 *
 * @var 	string		PATH_CALC					Le chemin depuis la racine vers le dossier calc
 * @var 	string		SAVE_FILE_PATH_CALC			Le chemin depuis la racine vers le dossier des zip g�n�r�s
 * @var 	string		TEMPLATE_FILE_PATH_CALC		Le chemin depuis la racine vers le dossier de template (pour la cr�ation des zip)
 */
define ('PATH_CALC',							PATH_ROOT.'calc/');
define ('SAVE_FILE_PATH_CALC',					PATH_CALC.'generated/');
define ('TEMPLATE_FILE_PATH_CALC',				PATH_CALC.'templates/');

/**
 * Insertion des classes requises
 */
require_once ('EasyZIP.class.php');
require_once ('Fonction.class.php');
require_once ('Manifest.class.php');
require_once ('Meta.class.php');
require_once ('Settings.class.php');
require_once ('Styles.class.php');
require_once ('Content.class.php');

/**
 * OpenOfficeSpreadsheet est un ensemble de classes permettant de g�n�rer un document OpenOffice
 * Spreadsheet (feuille de calcul ou tableur). Ces classes contiennent un certain nombre de
 * fonctions permettant la mise en page et le remplissage de cellules. Euh, sinon c'est tout.
 * Mais il y a de quoi faire, notamment au niveau des classes Settings et Styles, mais �a
 * viendra (peut-�tre) plus tard.
 *
 * Sinon, c'est gratuit, c'est sympa, et m�me si �a ne sert pas � grand chose, �a sert quand
 * m�me � quelque chose. Donc finalement, c'est cool. Alors enjoy!
 *
 * @package		OpenOfficeGeneration
 * @version		0.1
 * @copyright	(C) 2006 Tafel. All rights reserved
 * @license		http://www.gnu.org/copyleft/lesser.html LGPL License
 * @author		Tafel <fab_tafelmak@hotmail.com>
 *
 * Programme sous licence GPL. Toute reproduction, m�me patielle, est autoris�e, avec ou sans le
 * consentement du programmeur principal (avec, c'est mieux, quand m�me ;) ...)
 */
class OpenOfficeSpreadsheet {
	
	/**
	 *-------------------------------------------------------------------------------
	 * Propri�t�s
	 *-------------------------------------------------------------------------------
	 */	
	
	/**
	 * @access	public
	 * @var 	object			$manifest				L'objet DOMDocument du Manifest
	 */
	public $manifest;
	
	/**
	 * @access	public
	 * @var 	object			$meta					L'objet DOMDocument du Meta
	 */
	public $meta;
	
	/**
	 * @access	public
	 * @var 	object			$settings				L'objet DOMDocument des Settings
	 */
	public $settings;
	
	/**
	 * @access	public
	 * @var 	object			$styles					L'objet DOMDocument des Styles
	 */
	public $styles;
	
	/**
	 * @access	public
	 * @var 	object			$content				L'objet DOMDocument du Content
	 */
	public $content;
	
	/**
	 * @access	protected
	 * @var 	string			$pathTemplates			Le chemin vers les templates
	 */
	protected $pathTemplates;
	
	/**
	 * @access	protected
	 * @var 	string			$pathSave				Le chemin vers le dossier de sauvegarde
	 */
	protected $pathSave;
	
	/**
	 * @access	protected
	 * @var 	string			$documentName			Le nom du document OpenOffice cr��
	 */
	protected $documentName;
	
	/**
	 * @access	protected
	 * @var 	string			$extension				L'extension du fichier
	 */
	protected $extension;
	
	/**
	 * @access	protected
	 * @var 	string			$contentType			Le type de fichier
	 */
	protected $contentType;
	
	/**
	 * @access	protected
	 * @var 	boolean			$keepGeneratedRep		False pour effacer le dossier g�n�r�, True pour le conserver
	 */
	protected $keepGeneratedRep;
	
	
	/**
	 *-------------------------------------------------------------------------------
	 * Constructeur
	 *-------------------------------------------------------------------------------
	 */	
	
	/**
	 * Constructeur de classe
	 *
	 * @access 	public
	 * @param 	string			$document_name			Le nom du document � cr�er
	 * @param 	string			$path_save				Le chemin vers le dossier de sauvegarde
	 * @param 	string			$path_templates			Le chemin vers les templates
	 * @return 	object									L'objet de classe
	 */
	public function __construct($document_name, $path_save = '', $path_templates = '') {
		$docSave                = $this->_setTempDirName();
		$path_templates         = ($path_templates == '') ? TEMPLATE_FILE_PATH_CALC : $path_templates;
		$path_save              = ($path_save == '') ? SAVE_FILE_PATH_CALC : $path_save;
		$this->extension        = 'ods';
		$this->contentType      = 'application/vnd.oasis.opendocument.spreadsheet';
		$this->keepGeneratedRep = false;
		
		$this->pathTemplates    = Fonction::removeLastSlash($path_templates);
		$this->pathSave         = Fonction::removeLastSlash($path_save).'/'.$docSave;
		$this->documentName     = Fonction::checkFileName($document_name, $this->extension);
		
		try {
			$this->manifest = new Manifest($this->pathSave.'/META-INF', $this->pathTemplates.'/META-INF', true, false);
			$this->meta     = new Meta($this->pathSave, $this->pathTemplates, true, false);
			$this->settings = new Settings($this->pathSave, $this->pathTemplates, true, false);
			$this->styles   = new Styles($this->pathSave, $this->pathTemplates, true, false);
			$this->content  = new Content($this->pathSave, $this->pathTemplates, true, false);
		} catch (Exception $e) {
			echo '<br><b>Notice : </b>'.$e->getMessage().'<br>';
		}
	}
	
	
	/**
	 *-------------------------------------------------------------------------------
	 * M�thodes publiques de gestion de contenu
	 *-------------------------------------------------------------------------------
	 */
	
	/**
	 * Fonction qui cr�� une nouvelle feuille
	 *
	 * @access 	public
	 * @param 	string			$sheet					Le nom de la feuille
	 * @return 	object									L'objet Sheet
	 */
	public function addSheet($sheet) {
		return $this->content->addSheet($sheet);
	}
	
	
	/**
	 *-------------------------------------------------------------------------------
	 * M�thodes publiques de sauvegarde et affichage
	 *-------------------------------------------------------------------------------
	 */
	
	/**
	 * Fonction qui cr�� un ZIP avec tous les fichiers n�cessaires
	 *
	 * @access 	public
	 * @param 	boolean			$in_file				True pour cr�er un fichier, false pour renvoyer un flux
	 * @return 	object|boolean							True ou le pack des fichiers EasyZIP
	 */
	public function save($in_file = true) {
		$this->_saveFile();
		$zip = new EasyZIP();
		// On ajoute tous les fichiers au ZIP
		if ($handle = opendir($this->pathSave)) { 
			while (false !== ($filename = readdir($handle))) {
				if ($filename != '.' && $filename != '..'){
					if (is_dir($this->pathSave.'/'.$filename))
						$zip->addDir($this->pathSave, $filename);
					else
						$zip->addFile($filename, $this->pathSave.'/');
				}
			}
			closedir($handle);
		}
		$fileName = ($in_file) ? $this->documentName : '';
		$result = $zip->zipFile($fileName);
		// On supprime le r�pertoire g�n�r�
		if (!$this->keepGeneratedRep)
			Fonction::delDir($this->pathSave);
		// On retourne le fichier ZIP
		return $result;
	}
	
	/**
	 * Fonction qui cr�� l'output du fichier avec headers et tutti quanti
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function output() {
		/*
		header('Content-type: '.$this->contentType);
		header('Content-Disposition: attachment; filename='.$this->documentName);
		header('Cache-control: no-store, no-cache, must-revalidate');
		header('Pragma: no-cache');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Expires: 0');
		*/
		echo $this->save(false);
	}
	
	/**
	 * Fonction qui retourne le flux XML du ou des fichiers composant le document
	 *
	 * @access 	public
	 * @param 	string			$file					Le fichier dont on veut voir le flux
	 * @param 	boolean			$xmp					True pour afficher le flux entre des balises <xmp>
	 * @return 	string									Le flux XML du fichier
	 */
	public function saveXML($file = '', $xmp = false) {
		$xml = (!$xmp) ? '' : '<xmp>';
		switch ($file) {
			case 'manifest': $xml .= $this->manifest->saveXML(); break;
			case 'meta':     $xml .= $this->meta->saveXML();     break;
			case 'settings': $xml .= $this->settings->saveXML(); break;
			case 'styles':   $xml .= $this->styles->saveXML();   break;
			case 'content':  $xml .= $this->content->saveXML();  break;
			default:
				$xml .= $this->manifest->saveXML();	
				$xml .= $this->meta->saveXML();
				$xml .= $this->settings->saveXML();
				$xml .= $this->styles->saveXML();
				$xml .= $this->content->saveXML();
		}
		$xml .= (!$xmp) ? '' : '</xmp>';
		return $xml;
	}
	
	
	/**
	 *-------------------------------------------------------------------------------
	 * M�thodes getters et setters
	 *-------------------------------------------------------------------------------
	 */
	
	/**
	 * Fonction qui d�termine si on veut garder le dossier g�n�r� ou non
	 *
	 * @access 	public
	 * @param 	boolean			$choix					True pour le garder, false pour l'effacer
	 * @return 	void
	 */
	public function keepGeneratedDir($choix) {
		if ($choix)
			$this->keepGeneratedRep = true;
		else 
			$this->keepGeneratedRep = false;	
	}
	
	/**
	 * Fonction qui retourne le nom du dossier g�n�r� pour la sauvegarde
	 *
	 * @access 	public
	 * @return 	string									Le nom du dossier g�n�r�
	 */
	public function getGeneratedDirName() {
		return $this->pathSave;	
	}
	
	/**
	 * Fonction qui retourne le nom du dossier de templates
	 *
	 * @access 	public
	 * @return 	string									Le nom du dossier de templates
	 */
	public function getTemplatesDirName() {
		return $this->pathTemplates;	
	}
	
	/**
	 * Fonction qui retourne l'extension du document g�n�r�
	 *
	 * @access 	public
	 * @return 	string									L'extension du document g�n�r�
	 */
	public function getExtensionFile() {
		return $this->extension;	
	}
	
	/**
	 * Fonction qui retourne le type de contenu du document g�n�r� (content-type)
	 *
	 * @access 	public
	 * @return 	string									Le type de contenu (content-type)
	 */
	public function getContentTypeFile() {
		return $this->contentType;	
	}
	
	
	/**
	 *-------------------------------------------------------------------------------
	 * M�thodes priv�es
	 *-------------------------------------------------------------------------------
	 */
	
	/**
	 * Fonction qui sauvegarde les fichiers dans le dossier de sauvegarde
	 *
	 * @access 	protected
	 * @return 	void
	 */
	protected function _saveFile() {
		if (!is_dir($this->pathSave))
			mkdir($this->pathSave, 0777);
		if (!is_dir($this->pathSave.'/Configurations2'))
			mkdir($this->pathSave.'/Configurations2', 0777);
		if (!is_dir($this->pathSave.'/Pictures'))
			mkdir($this->pathSave.'/Pictures', 0777);
		if (!is_dir($this->pathSave.'/Thumbnails'))
			mkdir($this->pathSave.'/Thumbnails', 0777);
		copy($this->pathTemplates.'/Thumbnails/thumbnail.png', $this->pathSave.'/Thumbnails/thumbnail.png');
		copy($this->pathTemplates.'/Configurations2/EMPTY.log', $this->pathSave.'/Configurations2/EMPTY.log');
		copy($this->pathTemplates.'/Pictures/EMPTY.log', $this->pathSave.'/Pictures/EMPTY.log');
		$this->manifest->saveFile();
		$this->meta->saveFile();
		$this->settings->saveFile();
		$this->styles->saveFile();
		$this->content->saveFile();
	}
	
	/**
	 * Fonction qui cr�� un nom de r�pertoire temporaire
	 *
	 * @access 	protected
	 * @return 	string									Le nom du r�pertoire temporaire
	 */
	protected function _setTempDirName() {
		// Cr�ation du dossier temporaire pour la sauvegarde
		if (function_exists('microtime'))
			// Format du nom : temp_{timestamp Unix}{2 digit microsecondes}
			$docSave = 'temp_'.str_replace('.', '', microtime(true));
		else
			// Format du nom : temp_{timestamp Unix}
			$docSave = 'temp_'.date('U');
		return $docSave;
	}
	
}

?>