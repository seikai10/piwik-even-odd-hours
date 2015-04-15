<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOdd\tests\System;

use Piwik\Plugins\EvenOdd\tests\Fixtures\EvenOddFixture;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

class EvenOddSystemTest extends SystemTestCase
{
    public static $fixture = null;

    public function getApiForTesting()
    {
        $apiToTest = array();
        $apiToCall = array();

        $apiToCall[] = "EvenOdd.getReport";

        $apiToTest[] = array(
			$apiToCall,
			array(
				'idSite'  => self::$fixture->idSite,
				'date'    => self::$fixture->dateTime,
				'periods' => array('day')
			)
		);

        return $apiToTest;
    }

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
		$this->runApiTests($api, $params);
    }

}

EvenOddSystemTest::$fixture = new EvenOddFixture();