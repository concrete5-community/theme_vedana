<?php

namespace Concrete\Package\ThemeVedana;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use \Concrete\Core\Backup\ContentImporter as ContentImporter;
use Concrete\Package\ThemeVedana\Src\Helper\MclInstaller;

defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_vedana';
	protected $appVersionRequired = '5.7.3';
	protected $pkgVersion = '1.2.2';
	protected $pkg;
	// protected $pkgAllowsFullContentSwap = true;


	public function getPackageDescription() {
		return t("A perfectly crafted template that use all the power of concret5.7");
	}

	public function getPackageName() {
		return t("Vedana Theme");
	}
 	public function on_start() {
 		$al = AssetList::getInstance();
 		$al->register( 'javascript', 'gridgallery', 'themes/vedana/js/gridgallery.js', array('version' => '1.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'classie', 'themes/vedana/js/classie.js', array('version' => '1.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'imagesloaded', 'themes/vedana/js/imagesloaded.pkgd.min.js', array('version' => '3.1.4', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'modernizr', 'themes/vedana/js/modernizr.js', array('version' => '2.7.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'masonry', 'themes/vedana/js/masonry.pkgd.min.js', array('version' => '3.1.4', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'scrollmonitor', 'themes/vedana/js/scrollmonitor.js', array('version' => '1.0.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'rcrumbs', 'themes/vedana/js/jquery.rcrumbs.min.js', array('version' => '1.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'breakpoint', 'themes/vedana/js/breakpoint.js', array('version' => '1.0', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'nprogress', 'themes/vedana/js/nprogress.js', array('version' => '0.1.6', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'autohidingnavbar', 'themes/vedana/js/jquery.autohidingnavbar.js', array('version' => '0.1.6', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'YTPlayer', 'themes/vedana/js/jquery.mb.YTPlayer.min.js', array('version' => '2.7.5', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );
 		$al->register( 'javascript', 'vedana.script', 'themes/vedana/js/script.js', array('version' => '0.1', 'position' => Asset::ASSET_POSITION_FOOTER, 'minify' => true, 'combine' => true), $this );

 		$al->register( 'css', 'YTPlayer', 'themes/vedana/css/addons/YTPlayer.css', array('version' => '2.7.5', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );
		$al->register( 'css', 'bootsrap-custom', 'themes/vedana/css/addons/bootstrap.custom.min.css', array('version' => '3.3.4', 'position' => Asset::ASSET_POSITION_HEADER, 'minify' => true, 'combine' => true), $this );

 	}
	public function install() {

	// Get the package object
		$this->pkg = parent::install();

	// Installing
		 $this->installOrUpgrade();
	}

	public function upgrade () {
		$this->pkg = $this;
		$this->installOrUpgrade();
	}

	private function installOrUpgrade() {

		$ci = new MclInstaller($this->pkg);
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/themes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_templates.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/blocktypes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/attributes.xml');


	}

}
