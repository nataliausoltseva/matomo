<?php

namespace Piwik\Plugins\CurrentLocalTime\Widgets;

use Piwik\Common;
use Piwik\Widget\WidgetConfig;
use Piwik\Site;
use Piwik\Translation\Translator;

class GetCurrentLocalTime extends \Piwik\Widget\Widget
{
    /**
     * @var Translator
     */
    private $translator;

    public static function getCategory()
    {
        return 'CurrentLocalTime';
    }

    public static function getName()
    {
        return 'Current local time in website\'s timezone';
    }

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId(self::getCategory());
        $config->setName(self::getName());
        $config->setOrder(10);
    }

    public function render()
    {
        $idSite = Common::getRequestVar('idSite');
        $site = new Site($idSite);

        $timezone = $site->getTimezone();

        return $this->renderTemplate('getCurrentLocalTime', array(
            'timezone' => $timezone,
        ));
    }
}
