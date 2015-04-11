<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\EvenOdd;

use Piwik\DataTable;
use Piwik\Archive;
use Piwik\Metrics;
use Piwik\Piwik;

class API extends \Piwik\Plugin\API
{
    protected function getDataTable($name, $idSite, $period, $date, $segment)
    {
        Piwik::checkUserHasViewAccess($idSite);
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable($name);
        return $dataTable;
    }

    public function getReport($idSite, $period, $date, $segment = false)
    {
		$table = $this->getDataTable(Archiver::EVENODD_ARCHIVE_RECORD, $idSite, $period, $date, $segment);
        return $table;
    }
}