<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;
use Nette\Application\UI\Control;


/**
 * Class BrowserSync
 *
 * @author  geniv, MartinFugess
 */
class BrowserSync extends Control implements ITemplatePath
{
    // define constant url
    const
        BROWSER_SYNC_URL = 'http://HTTP_HOST:3000/browser-sync/browser-sync-client.js';

    /** @var string */
    private $browserSyncUrl;
    /** @var string */
    private $templatePath;


    /**
     * BrowserSync constructor.
     *
     * @param string $browserSyncUrl
     */
    public function __construct(string $browserSyncUrl = '')
    {
        parent::__construct();

        $this->browserSyncUrl = str_replace('HTTP_HOST', $_SERVER['HTTP_HOST'], $browserSyncUrl ?: self::BROWSER_SYNC_URL);

        $this->templatePath = __DIR__ . '/BrowserSync.latte'; // set path
    }


    /**
     * Set template path.
     *
     * @param string $path
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

        // danger on hosting: file_get_contents is disable on server!!
        $template->enable = ($this->presenter->context->parameters['environment'] == 'development' && @file_get_contents($this->browserSyncUrl));
        $template->browserSyncUrl = $this->browserSyncUrl;

        $template->setFile($this->templatePath);
        $template->render();
    }
}
