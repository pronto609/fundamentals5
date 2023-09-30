<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
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
    /**
     * @var LoggerInterface
     */
    private $mdLogger;

    public function __construct(
        CacheInterface $cache,
        MarkdownParserInterface $markdownParser,
        LoggerInterface $mdLogger,
        bool $isDebug
    ) {
        $this->cache = $cache;
        $this->markdownParser = $markdownParser;
        $this->isDebug = $isDebug;
        $this->logger = $mdLogger;
    }

    public function parce(string $source): string
    {
        if (strpos($source, 'cat')) {
            $this->logger->info('May');
        }

        if ($this->isDebug) {
            return $this->cache->get('macdown_'.md5($source), function () use ($source) {
                return $this->markdownParser->transformMarkdown($source);
            });
        }
    }
}