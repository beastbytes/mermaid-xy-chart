<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\XyChart;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\TitleTrait;

final class XyChart
{
    use CommentTrait;
    use TitleTrait;

    private const TYPE = 'xychart-beta';

    private array $datasets = [];
    private string $xAxis = '';
    private string $yAxis = '';

    public function __construct(
        private readonly Orientation $orientation = Orientation::Horizontal
    )
    {
    }

    public function addDataset(ChartType $type, array $data): self
    {
        $new = clone $this;
        $new->datasets[] = compact('type', 'data');
        return $new;
    }

    public function withDataset(ChartType $type, array $data): self
    {
        $new = clone $this;
        $new->datasets = [compact('type', 'data')];
        return $new;
    }

    /**
     * @param string $title
     * @param array|int|null $min Array of categories or minimum value
     * @param ?int $max Maximum value; only used if $min is int
     * @return self
     */
    public function withXAxis(string $title = '', array|int|null $min = null, ?int $max = null): self
    {
        $axis = [];

        if ($title !== '') {
            $axis[] = '"' . $title . '"';
        }

        if ($min !== null) {
            if (is_int($min)) {
                $axis[] = (string)$min . ' --> ' . (string)$max;
            } else {
                $axis[] = '[' . implode(', ', $min) . ']';
            }
        }

        if ($axis !== []) {
            array_unshift($axis, 'x-axis');
        }

        $new = clone $this;
        $new->xAxis = implode(' ', $axis);
        return $new;
    }

    /**
     * @param string $title
     * @param ?int $min
     * @param ?int $max
     * @return self
     */
    public function withYAxis(string $title = '', ?int $min = null, ?int $max = null): self
    {
        $axis = [];

        if ($title !== '') {
            $axis[] = '"' . $title . '"';
        }

        if ($min !== null) {
            $axis[] = (string)$min . ' --> ' . (string)$max;
        }

        if ($axis !== []) {
            array_unshift($axis, 'y-axis');
        }

        $new = clone $this;
        $new->yAxis = implode(' ', $axis);
        return $new;
    }

    public function render(): string
    {
        $output = [];

        $this->renderComment('', $output);

        $output[] = self::TYPE;

        if ($this->title !== '') {
            $output[] = Mermaid::INDENTATION . 'title "' . $this->title . '"';
        }

        foreach (['xAxis', 'yAxis'] as $axis) {
            if ($this->$axis !== '') {
                $output[] = Mermaid::INDENTATION . $this->$axis;
            }
        }

        foreach ($this->datasets as $dataset) {
            $output[] = Mermaid::INDENTATION
                . $dataset['type']->value
                . ' [' . implode(', ', $dataset['data']) . ']'
            ;
        }

        return Mermaid::render($output);
    }
}
