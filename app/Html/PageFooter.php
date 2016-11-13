<?php

namespace App\Html;

use Panda\Ui\Html\HTMLDocument;
use Panda\Ui\Html\HTMLElement;

/**
 * Class PageFooter
 * @package App\Html
 */
class PageFooter extends HTMLElement
{
    /**
     * PageFooter constructor.
     *
     * @param HTMLDocument $HTMLDocument
     */
    public function __construct(HTMLDocument $HTMLDocument)
    {
        // Create object
        parent::__construct($HTMLDocument, $name = 'div', $value = '', $id = '', $class = 'page-footer');
    }

    /**
     * Build the page footer
     *
     * @return $this
     */
    public function build()
    {
        $item = $this->getHTMLDocument()->getHTMLFactory()->buildElement('div', '', '', 'signature');
        $item->innerHTML('&copy; Ioannis Papikas, 20[0-9]{2}');
        $this->append($item);

        $bull = $this->separator();
        $this->append($bull);

        $item = $this->getHTMLDocument()->getHTMLFactory()->buildWeblink('mailto:ioannis@ipapikas.me?Subject=Hello', '_self', 'Say Hello', '', '');
        $this->append($item);

        return $this;
    }

    /**
     * Creates a span with &bull; as value.
     *
     * @return HTMLElement
     */
    private function separator()
    {
        return $this->getHTMLDocument()->getHTMLFactory()->buildElement('span')->innerHTML(' • ');
    }
}
