<?php

namespace App\Controllers\Game;

use App\Core\BaseController;
use App\Libraries\Functions;
use App\Libraries\TimingLibrary as Timing;
use App\Libraries\Users;

class Changelog extends BaseController
{
    public const MODULE_ID = 0;

    protected $changelogModel;

    public function __construct()
    {
        parent::__construct();

        // check if session is active
        Users::checkSession();

        // load Model
        parent::loadModel('game/changelog');

        // load Language
        parent::loadLang(['game/changelog']);
    }

    public function index(): void
    {
        // Check module access
        Functions::moduleMessage(Functions::isModuleAccesible(self::MODULE_ID));

        // build the page
        $this->buildPage();
    }

    private function buildPage(): void
    {
        $changes = [];
        $entries = $this->changelogModel->getAllChangelogEntries();

        if ($entries) {
            foreach ($entries as $entry) {
                $changes[] = [
                    'version_number' => $entry['changelog_version'],
                    'description' => nl2br(
                        Timing::formatShortDate($entry['changelog_date']) . '<br>' . $entry['changelog_description']
                    ),
                ];
            }
        }

        $this->page->display(
            $this->template->set('game/changelog_view', array_merge(
                $this->langs->language,
                ['list_of_changes' => $changes]
            ))
        );
    }
}
