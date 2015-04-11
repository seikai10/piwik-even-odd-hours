<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\EvenOdd;

use Piwik\Menu\MenuAdmin;
use Piwik\Menu\MenuReporting;
use Piwik\Menu\MenuTop;
use Piwik\Menu\MenuUser;

class Menu extends \Piwik\Plugin\Menu
{
    public function configureReportingMenu(MenuReporting $menu)
    {
         $menu->addVisitorsItem('Even/Odd Report', $this->urlForAction('getReport'), $orderId = 80);
    }
}
