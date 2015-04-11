<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\EvenOdd;

class Controller extends \Piwik\Plugin\Controller
{
	public function getReport()
	{
        $view = \Piwik\ViewDataTable\Factory::build(
            $defaultType = 'table',
            $apiAction = 'EvenOdd.getReport',
            $controllerMethod = 'EvenOdd.getReport'
        );
        $view->config->translations['label'] = 'Times';
        $view->config->translations['value'] = 'Visits';
        $view->requestConfig->filter_sort_column = 'value';
        $view->requestConfig->filter_sort_order = 'asc';
        $view->config->show_insights = false;
        $view->config->show_search = true;
        $view->config->show_goals = true;
        $view->config->show_limit_control = true;
        $view->config->show_footer_icons = true;
        $view->requestConfig->filter_limit = 25;

        return $view->render();
	}
}