<?php
namespace Concrete\Package\ThemeVedana\Block\MylabTyper;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btTable = 'btMylabTyper';
    protected $btInterfaceWidth = "600";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "465";
    protected $btCacheBlockRecord = false;
    protected $btCacheBlockOutput = false;
    protected $btCacheBlockOutputOnPost = false;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btDefaultSet = 'basic';    

    public function getBlockTypeDescription()
    {
        return t("Add a nice typer");
    }

    public function getBlockTypeName()
    {
        return t("Typer");
    }


    public function view()
    {
        // this doesn't work for now, it need to adapt the javascript to display html element
        $comaSeparatedSentence = preg_replace('#\*{2}(.*?)\*{2}#', '<strong>$1</strong>', $this->comaSeparatedSentence);
        $firstSentence = explode(',', $comaSeparatedSentence);
        $comaSeparatedSentence = json_encode($comaSeparatedSentence = explode(',', $comaSeparatedSentence));
        $firstSentence = count($firstSentence) ? $firstSentence[0] : "";

        $this->set('comaSeparatedSentence', $comaSeparatedSentence);
        $this->set('firstSentence', $firstSentence );
    }



    public function save($args)
    {
        parent::save($args);
    }

}
