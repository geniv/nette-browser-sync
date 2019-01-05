<?php declare(strict_types=1);

use Nette\Application\UI\Control;


/**
 * Class BrowserSync
 *
 * @author  geniv, MartinFugess
 */
class BrowserSync extends Control implements IBrowserSync
{
    // define constant url
    const
        BROWSER_SYNC_URL = 'REQUEST_SCHEME://HTTP_HOST:3000/browser-sync/browser-sync-client.js',
        CHECK_URL = 'http://localhost:3001';

    /** @var string */
    private $browserSyncUrl, $checkUrl;
    /** @var string */
    private $templatePath;
    /** @var bool */
    private $isCheckByUrl = false;


    /**
     * BrowserSync constructor.
     *
     * @param string      $browserSyncUrl
     * @param string|null $checkUrl
     */
    public function __construct(string $browserSyncUrl = null, string $checkUrl = null)
    {
        parent::__construct();

        $replace = [
            'HTTP_HOST'      => $_SERVER['HTTP_HOST'],
            'REQUEST_SCHEME' => $_SERVER['REQUEST_SCHEME'] ?? (isset($_SERVER['HTTPS']) ? 'https' : 'http'),
        ];
        $this->browserSyncUrl = str_replace(array_keys($replace), $replace, $browserSyncUrl ?: self::BROWSER_SYNC_URL);
        $this->checkUrl = $checkUrl ?: self::CHECK_URL;

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
     * Set check by url.
     *
     * @param bool $state
     */
    public function setCheckByUrl(bool $state)
    {
        $this->isCheckByUrl = $state;
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

        $arrContextOptions = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
        // danger on hosting: file_get_contents is disable on server!!
        $template->enable = ($this->presenter->context->parameters['environment'] == 'development' &&
            @file_get_contents($this->isCheckByUrl ? $this->checkUrl : $this->browserSyncUrl, false, $arrContextOptions));
        $template->browserSyncUrl = $this->browserSyncUrl;

        $template->setFile($this->templatePath);
        $template->render();
    }
}
