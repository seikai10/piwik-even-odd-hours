<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\EvenOdd\tests\Fixtures;


use Piwik\Tests\Framework\Fixture;
use Piwik\Date;

class EvenOddFixture extends Fixture
{
    public $dateTime = '2015-01-01 01:32:12';
    public $idSite = 1;

    public function setUp()
    {
        $this->setUpWebsite();
        $this->trackVisits();
    }

    public function tearDown()
    {

    }

    private function setUpWebsite()
    {
        if (!self::siteCreated($this->idSite))
		{
            $idSite = self::createWebsite($this->dateTime);
            $this->assertSame($this->idSite, $idSite);
        }
    }

    private function trackVisits()
	{

        $tracker = self::getTracker(
            $this->idSite,
            $this->dateTime,
            $defaultInit = false
        );
        $tracker->setTokenAuth(self::getTokenAuth());

        for ($i=0; $i<7; $i++)
		{
            $tracker->setForceVisitDateTime(
                Date::factory($this->dateTime)->addHour($i)->getDatetime()
            );
            self::checkResponse($tracker->doTrackPageView("Viewing homepage"));
        }
    }

}