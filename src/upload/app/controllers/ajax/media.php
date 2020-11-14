<?php
/**
 * Media Controller
 *
 * @category Controller
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.0.0
 */
namespace App\controllers\ajax;

use App\core\BaseController;

/**
 * Media Class
 */
class Media extends BaseController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // load Language
        parent::loadLang(['ajax/media']);

        // build the page
        $this->buildPage();
    }

    /**
     * Build the page
     *
     * @return void
     */
    private function buildPage()
    {
        parent::$page->display(
            $this->getTemplate()->set('ajax/media_view', $this->langs->language),
            false,
            '',
            false
        );
    }
}
