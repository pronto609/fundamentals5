<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var MarkdownParserInterface
     */
    private $markdownParser;
    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(
        CacheInterface $cache,
        MarkdownParserInterface $markdownParser,
        bool $isDebug
    ) {
        $this->cache = $cache;
        $this->markdownParser = $markdownParser;
        $this->isDebug = $isDebug;
        dump($this->isDebug);
    }

    public function parce(string $source): string
    {
        if ($this->isDebug) {
            return $this->cache->get('macdown_'.md5($source), function () use ($source) {
                return $this->markdownParser->transformMarkdown($source);
            });
        }
    }
}