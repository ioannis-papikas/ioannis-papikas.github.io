<?php

namespace App\Html;

use Panda\Ui\Html\HTMLDocument;
use Panda\Ui\Html\HTMLElement;

/**
 * Class PageNavMenu
 * @package App\Html
 */
class PageNavMenu extends HTMLElement
{
    /**
     * PageFooter constructor.
     *
     * @param HTMLDocument $HTMLDocument
     */
    public function __construct(HTMLDocument $HTMLDocument)
    {
        // Create object
        parent::__construct($HTMLDocument, $name = 'div', $value = '', $id = '', $class = 'page-nav-menu');
    }

    /**
     * Build the page navigation menu
     *
     * @return $this
     */
    public function build()
    {
        $middleContainer = $this->getHTMLDocument()->getHTMLFactory()->buildElement('div', '', '', 'middleContainer');
        $this->append($middleContainer);

        // Menu toggler
        $toggleMenu = $this->getHTMLDocument()->getHTMLFactory()->buildElement('div', '', '', 'toggle_menu');
        $middleContainer->append($toggleMenu);

        // Main menu
        $menu = $this->getHTMLDocument()->getHTMLFactory()->buildElement('ul', '', '', 'navMenu toggle');
        $middleContainer->append($menu);

        // Add nav menu
        $wl = $this->getHTMLDocument()->getHTMLFactory()->buildWeblink('/about', '_self', 'About Me');
        $menuItem = $this->getHTMLDocument()->getHTMLFactory()->buildElement('li', $wl, '', 'menuItem');
        $menu->append($menuItem);

        $wl = $this->getHTMLDocument()->getHTMLFactory()->buildWeblink('/portfolio', '_self', 'Portfolio');
        $menuItem = $this->getHTMLDocument()->getHTMLFactory()->buildElement('li', $wl, '', 'menuItem');
        $menu->append($menuItem);

        $wl = $this->getHTMLDocument()->getHTMLFactory()->buildWeblink('/contact', '_self', 'Contact Me');
        $menuItem = $this->getHTMLDocument()->getHTMLFactory()->buildElement('li', $wl, '', 'menuItem');
        $menu->append($menuItem);

        return $this;
    }
}
