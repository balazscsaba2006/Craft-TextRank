<?php

namespace Craft;

require_once(CRAFT_PLUGINS_PATH . 'hdtextrank/vendor/autoload.php');

use \crodas\TextRank\Config;
use \crodas\TextRank\TextRank;
use \crodas\TextRank\Summary;
use \crodas\TextRank\Stopword;

/**
 * HdTextRankVariable class
 *
 * @package   Craft
 * @author    Balazs Csaba <csaba.balazs@humandirect.eu>
 * @copyright 2015 Human Direct
 */
class HdTextRankVariable
{
    /**
     * Extract keywords from text
     *
     * @param string|null $text
     * @param bool|true   $withoutStopWords
     *
     * @return array
     */
    public function keywords($text = null, $withoutStopWords = true)
    {
        $config = new Config;
        if ($withoutStopWords) {
            $config->addListener(new Stopword);
        }
        $textRank = new TextRank($config);

        try {
            $keywords = $textRank->getKeywords(
                $this->cleanup($text)
            );
        } catch (\RuntimeException $e) {
            $keywords = null;
        }

        return (is_array($keywords)) ? array_keys($keywords) : $keywords;
    }

    /**
     * Extract relevant summary from text
     *
     * @param string|null $text
     * @param int|null    $limit
     * @param bool|true   $withoutStopWords
     *
     * @return string
     */
    public function summary($text = null, $limit = null, $withoutStopWords = true)
    {
        $config = new Config;
        if ($withoutStopWords) {
            $config->addListener(new Stopword);
        }
        $analyzer = new Summary($config);

        try {
            $summary = $analyzer->getSummary(
                $this->cleanup($text)
            );

            if ($summary && is_integer($limit)) {
                $summary = mb_strimwidth($summary, 0, $limit, "...");
            }
        } catch (\RuntimeException $e) {
            $summary = null;
        }

        return $summary;
    }

    /**
     * Cleanup text before extracting keywords/summary
     *
     * @param null $text
     *
     * @return mixed
     */
    private function cleanup($text = null)
    {
        // convert to UTF-8
        $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        // strip HTML tags
        $text = preg_replace('#<[^>]+>#', ' ', $text);
        // remove excess whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        return $text;
    }
}
