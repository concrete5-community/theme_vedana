<?php
namespace Concrete\Package\ThemeVedana\Theme\Vedana;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

        $this->requireAsset('javascript', 'jquery');
        $this->requireAsset('javascript', 'modernizr');
        $this->requireAsset('javascript', 'classie');
        $this->requireAsset('javascript', 'bootstrap/dropdown');
        $this->requireAsset('javascript', 'masonry');
        $this->requireAsset('javascript', 'rcrumbs');
        $this->requireAsset('javascript', 'scrollmonitor');
        $this->requireAsset('javascript', 'breakpoint');
        $this->requireAsset('javascript', 'nprogress');
        $this->requireAsset('javascript', 'imagesloaded');
        $this->requireAsset('javascript', 'gridgallery');
        $this->requireAsset('javascript', 'autohidingnavbar');
        $this->requireAsset('javascript', 'YTPlayer');
        $this->requireAsset('javascript', 'vedana.script');


        $this->requireAsset('css', 'font-awesome');
        $this->requireAsset('css', 'YTPlayer');
        $this->requireAsset('css', 'bootsrap-custom');
	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
        return array(
            'page_list' => array('simple-block'),
            'feature' => array('block-primary', 'block-secondary', 'block-tertiary', 'block-quaternary','thin-primary', 'thin-secondary', 'thin-tertiary', 'thin-quaternary', 'thin-white', 'thin-black'),
            'content' => array('white-block', 'primary-block', 'secondary-block', 'tertiary-block', 'quaternary-block','collapse-top-margin'),
            'autonav' => array('small-text-size'),
            'horizontal_rule' => array('space-s','space-m','space-l','space-xl','primary','secondary','tertiary','quaternary'),
            'testimonial' => array ('primary','secondary','tertiary','quaternary','white'),
            'image' => array('responsive', 'svg-primary','svg-quaternary',),
            'image_slider' => array('into-columns'),
            'page_title' => array('shadow'),
            'core_stack_display' => array('accordion-primary','accordion-secondary','accordion-tertiary','accordion-quaternary','accordion-light')
        );
    }

    public function getThemeAreaClasses()
    {
        // For multiple area
        $main_area = array('Main');
        $area_classes = array('primary','secondary','tertiary','quaternary','white','black');
        for ($i=1; $i < 8; $i++) {
            $main_area['Main - ' . $i] = $area_classes;
        }
        // Default array
        $other_area = array(
            'Header Info' => array('header-info-wrapped'),
            'Header Social' => array('header-social-wrapped'),
            'Header Image' => $area_classes,
            'Header Content' => $area_classes,
            'Main' => $area_classes,
            'Page Footer' => $area_classes
        );

        return array_merge($main_area,$other_area);
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Button Primary'), 'menuClass' => '', 'spanClass' => 'btn btn-primary'),
            array('title' => t('Button Primary Large'), 'menuClass' => '', 'spanClass' => 'btn btn-primary btn-lg'),
            array('title' => t('Button Default'), 'menuClass' => '', 'spanClass' => 'btn btn-default'),
            array('title' => t('Button Default Large'), 'menuClass' => '', 'spanClass' => 'btn btn-default btn-lg'),
            array('title' => t('Button 3D'), 'menuClass' => '', 'spanClass' => 'outline-button default'),
            array('title' => t('Button 3D Primary'), 'menuClass' => '', 'spanClass' => 'outline-button primary'),
            array('title' => t('Button 3D Secondary'), 'menuClass' => '', 'spanClass' => 'outline-button secondary'),
            array('title' => t('Lead'), 'menuClass' => '', 'spanClass' => 'lead'),
            array('title' => t('Decorative Header'), 'menuClass' => '', 'spanClass' => 'head-1'),
            array('title' => t('Shadow'), 'menuClass' => '', 'spanClass' => 'shadow'),
            array('title' => t('Hero'), 'menuClass' => '', 'spanClass' => 'hero'),
            array('title' => t('Code'), 'menuClass' => '', 'spanClass' => 'code')
        );
    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '900px',
            'medium' => '768px',
            'small' => '0'
        );
    }
		
		public function nl2p($string)
		{
		    $paragraphs = '';

		    foreach (explode("\n", $string) as $line) {
		        if (trim($line)) {
		            $paragraphs .= '<p>' . $line . '</p>';
		        }
		    }

		    return $paragraphs;
		}
}
