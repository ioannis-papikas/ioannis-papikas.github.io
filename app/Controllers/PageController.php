<?php

/*
 * This file is part of the Panda framework.
 *
 * (c) Ioannis Papikas <papikas.ioan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controllers;

use App\Html\PageTemplate;
use Panda\Support\Facades\Route;
use Panda\Support\Facades\View;

/**
 * Class PageController
 *
 * @package App\Controllers
 */
class PageController extends BaseController
{
    /**
     * @var PageTemplate
     */
    protected $page;

    /**
     * @var string[]
     */
    protected $titles = [
        'about' => 'About Me',
        'portfolio' => 'Portfolio',
        'contact' => 'Contact Me'
    ];

    /**
     * @return mixed
     */
    public function page()
    {
        // Get page section
        $section = Route::parameter('section');

        // Create the page template
        $this->buildPage($this->getPageTitle($section), $section);
        $this->getPage()->addStyle('/assets/me/css/' . $section . '.css');

        return $this->getPage()->getHTML();
    }

    /**
     * @param string $title
     * @param string $viewName
     */
    protected function buildPage($title, $viewName = '')
    {
        // Create the page template
        /** @type PageTemplate $page */
        $this->page = $this->getApp()->make(PageTemplate::class);
        $this->page->build($title);

        // Get footer to insert main before
        $viewContainer = $this->page->getViewContainer();

        // Load view html
        $viewHtml = View::load($viewName)->getOutput();
        $this->page->getHTMLHandler()->innerHTML($viewContainer, $viewHtml);
    }

    /**
     * Get the title for the given page
     *
     * @param string $page
     *
     * @return mixed
     */
    protected function getPageTitle($page)
    {
        return $this->titles[$page];
    }

    /**
     * @return PageTemplate
     */
    public function getPage(): PageTemplate
    {
        return $this->page;
    }
}
