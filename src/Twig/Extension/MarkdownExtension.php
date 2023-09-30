<?php

namespace App\Twig\Extension;

use App\Service\MarkdownHelper;
use App\Twig\Runtime\MarkdownExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MarkdownExtension extends AbstractExtension
{

    /**
     * @var MarkdownHelper
     */
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('parce_markdown', [$this, 'parseMarkdown'],['is_safe' => ['html']]),
        ];
    }

    public function parseMarkdown($value)
    {
        return $this->markdownHelper->parce($value);
    }
}
