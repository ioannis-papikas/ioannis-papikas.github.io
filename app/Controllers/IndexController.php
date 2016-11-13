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

/**
 * Class IndexController
 *
 * @package App\Controllers
 *
 * @version 0.1
 */
class IndexController extends PageController
{
    /**
     * @return mixed
     */
    public function index()
    {
        // Create the page template
        $this->buildPage('Ioannis Papikas', 'index');
        $this->getPage()->addStyle('/assets/me/css/index.css');

        return $this->getPage()->getHTML();
    }
}
