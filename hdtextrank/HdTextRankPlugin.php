<?php

namespace Craft;

/**
 * HdTextRankPlugin class
 *
 * @package   Craft
 * @author    Balazs Csaba <csaba.balazs@humandirect.eu>
 * @copyright 2015 Human Direct
 */
class HdTextRankPlugin extends BasePlugin
{
    /**
     * @return null|string
     */
    function getName()
    {
        return Craft::t('HD Text Rank');
    }

    /**
     * @return string
     */
    function getVersion()
    {
        return '0.1.0';
    }

    /**
     * @return string
     */
    function getDeveloper()
    {
        return 'Balazs Csaba';
    }

    /**
     * @return string
     */
    function getDeveloperUrl()
    {
        return 'http://www.humandirect.eu';
    }
}
