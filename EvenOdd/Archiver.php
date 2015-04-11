<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\EvenOdd;

use Piwik\Metrics;
use Piwik\DataTable;
use Piwik\DataTable\Row;

class Archiver extends \Piwik\Plugin\Archiver
{
    const EVENODD_ARCHIVE_RECORD = "EvenOdd_archive_record";
    const EVENODD_DIM = 'MOD(HOUR(log_visit.visit_first_action_time), 2)';

	private static $opts = array('Even', 'Uneven');

    protected $dimensions = array(self::EVENODD_DIM);

    public function aggregateDayReport()
    {
		$data = new DataTable();
        $metrics = array(Metrics::INDEX_NB_VISITS);
        $query = $this->getLogAggregator()->queryVisitsByDimension($this->dimensions, $where = false, $additionalSelects = array(), $metrics);
        if ($query === false)
		{
            return;
        }

        while ($row = $query->fetch())
		{
			$data->addRowFromArray(array(Row::COLUMNS => array('label' => self::$opts[$row[self::EVENODD_DIM]], 'value' => $row[2])));
        }

        $report = $data->getSerialized($this->maximumRows, $this->maximumRows, Metrics::INDEX_NB_VISITS);
        $this->getProcessor()->insertBlobRecord(self::EVENODD_ARCHIVE_RECORD, $report);
    }

    public function aggregateMultipleReports()
    {
        $this->getProcessor()->aggregateDataTableRecords(self::EVENODD_ARCHIVE_RECORD);
    }
}