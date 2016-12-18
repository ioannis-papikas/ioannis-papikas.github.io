<?php

namespace App\Html;

use Panda\Foundation\Application;
use Panda\Http\Response;
use Panda\Ui\Html\HTMLElement;
use Panda\Ui\Html\HTMLPage;
use Panda\Ui\Html\Views\ViewElement;

/**
 * Class PageTemplate
 * @package App\Html
 */
class PageTemplate extends HTMLPage
{
    /**
     * @type bool
     */
    protected $showMenu = true;

    /**
     * @type Application
     */
    protected $app;

    /**
     * @type HTMLElement
     */
    protected $viewContainer;

    /**
     * @param string $title
     * @param string $loadViewName
     * @param string $id
     * @param string $class
     *
     * @return $this
     */
    public function build($title = '', $loadViewName = '', $id = '', $class = '')
    {
        // Build page
        parent::build($title, $description = '', $keywords = '');

        // Add head resources
        $this->addHeadResources();

        // Add loading bar
        $loadingBar = $this->create('div', '', '', 'loadingBar');
        $this->appendToBody($loadingBar);

        // Add navigation menu
        if ($this->showMenu) {
            $this->buildNavMenu();
        }

        // Add view container
        $this->buildView($loadViewName, $id, $class);

        // Add page footer
        $this->buildFooter();

        return $this;
    }

    /**
     * Add papge template head resources
     */
    private function addHeadResources()
    {
        // Set favicon
        $this->addIcon('/favicon.ico');

        // Add meta
        $this->addMeta('viewport', 'width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0');
        $this->addMeta('google-site-verification', 'KCITfMPmuC_Ewj1wBM7Wxy36eGzT87wMqiHYpdEK41s');

        // Add font
        $this->addStyle('https://fonts.googleapis.com/css?family=Lato:100');

        // jQuery
        $this->addScript('/assets/jquery/jquery-2.1.4.min.js');
        $this->addScript('/assets/jquery/jquery-ui-1.11.4/jquery-ui.min.js');

        // Website theme and template
        $this->addStyle('/assets/me/css/theme.css');
        $this->addStyle('/assets/me/css/template.css');

        $this->addScript('/assets/me/js/main.js');
        $this->addScript('/assets/me/js/ga.js');
    }

    /**
     * Build the main navigation menu.
     */
    private function buildNavMenu()
    {
        $navMenu = (new PageNavMenu($this))->build();
        $this->appendToBody($navMenu);
    }

    /**
     * Build the page view content.
     *
     * @param string $viewName
     * @param string $id
     * @param string $class
     */
    private function buildView($viewName = '', $id = '', $class = '')
    {
        // Build view outer container
        $this->viewContainer = $this->create('div', '', '', 'page-view-container');
        $this->appendToBody($this->viewContainer);

        // Get view and append
        if (!empty($viewName)) {
            $this->appendToViewContainer((new ViewElement($this))->build($viewName, $id, $class));
        }
    }

    /**
     * Build the page footer.
     */
    private function buildFooter()
    {
        $footer = (new PageFooter($this))->build();
        $this->appendToBody($footer);
    }

    /**
     * Append an item to the view container.
     *
     * @param $item
     */
    private function appendToViewContainer($item)
    {
        $this->viewContainer->append($item);
    }

    /**
     * @param boolean $showMenu
     */
    public function setShowMenu($showMenu)
    {
        $this->showMenu = $showMenu;
    }

    /**
     * Get the HTML page in a response object.
     *
     * @param Response $response
     *
     * @return Response
     */
    public function getResponseWithHtml($response = null)
    {
        // Get or create the response
        $response = ($response ?: new Response());

        // Get the page content
        $responseContent = $this->getHTML();

        // Set the response content
        $response->setContent($responseContent);

        // Send back the response
        return $response;
    }

    /**
     * @return Application
     */
    public function getApp()
    {
        return $this->app ?: Application::getInstance();
    }

    /**
     * @param Application $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @return HTMLElement
     */
    public function getViewContainer(): HTMLElement
    {
        return $this->viewContainer;
    }
}
