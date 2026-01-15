<?php

declare(strict_types=1);

namespace BeastBytes\Mermaid\XyChart;

use BeastBytes\Mermaid\CommentTrait;
use BeastBytes\Mermaid\Diagram;
use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\TitleTrait;
use InvalidArgumentException;
use Override;

final class XyChart extends Diagram
{
    use CommentTrait;
    use TitleTrait;

    private const string AXIS = '%s %s';
    private const string CATEGORIES = '[%s]';
    private const string EXCEPTION = '`$max` must be int if `$min` is int';
    private const string RANGE = '%d --> %d';
    private const string QUOTED = '"%s"';
    private const string TYPE = 'xychart';
    private const string X_AXIS = 'x-axis';
    private const string Y_AXIS = 'y-axis';

    private array $datasets = [];
    private Orientation $orientation = Orientation::horizontal;
    private string $xAxis = '';
    private string $yAxis = '';

    /**
     * @param DatasetType $type
     * @param list<float|int> $data
     * @return self
     */
    public function addDataset(DatasetType $type, array $data): self
    {
        $new = clone $this;
        $new->datasets[] = compact('type', 'data');
        return $new;
    }

    public function withOrientation(Orientation $orientation): self
    {
        $new = clone $this;
        $new->orientation = $orientation;
        return $new;
    }

    /**
     * @param ?string $title
     * @param list<string>|int|null $min Array of categories or minimum value
     * @param ?int $max Maximum value; only used if $min is int
     * @return self
     */
    public function withXAxis(?string $title = null, array|int|null $min = null, ?int $max = null): self
    {
        $axis = [];

        if (is_string($title)) {
            $axis[] = sprintf(self::QUOTED, $title);
        }

        if (is_array($min)) {
            array_walk($min, fn(string &$v) => $v = str_contains($v, ' ')
                ? sprintf(self::QUOTED, $v)
                : $v
            );
            $axis[] = sprintf(self::CATEGORIES, implode(', ', $min));
        } elseif (is_int($min)) {
            if (!is_int($max)) {
                throw new InvalidArgumentException(self::EXCEPTION);
            }

            $axis[] = sprintf(self::RANGE, $min, $max);
        }

        $new = clone $this;

        if ($axis !== []) {
            $new->xAxis = sprintf(self::AXIS, self::X_AXIS, implode(' ', $axis));
        }

        return $new;
    }

    /**
     * @param ?string $title
     * @param ?int $min
     * @param ?int $max
     * @return self
     */
    public function withYAxis(?string $title = null, ?int $min = null, ?int $max = null): self
    {
        $axis = [];

        if (is_string($title)) {
            $axis[] = sprintf(self::QUOTED, $title);
        }

        if (is_int($min)) {
            if (!is_int($max)) {
                throw new InvalidArgumentException(self::EXCEPTION);
            }

            $axis[] = sprintf(self::RANGE, $min, $max);
        }

        $new = clone $this;

        if ($axis !== []) {
            $new->yAxis = sprintf(self::AXIS, self::Y_AXIS, implode(' ', $axis));;
        }

        return $new;
    }

    #[Override]
    protected function renderDiagram(): string
    {
        $output = [];

        $output[] = $this->renderComment('');
        $output[] = self::TYPE . ' ' . $this->orientation->name;
        $output[] = $this->renderTitle(Mermaid::INDENTATION, self::QUOTE);

        foreach (['xAxis', 'yAxis'] as $axis) {
            if ($this->$axis !== '') {
                $output[] = Mermaid::INDENTATION . $this->$axis;
            }
        }

        foreach ($this->datasets as $dataset) {
            $output[] = Mermaid::INDENTATION
                . $dataset['type']->name
                . ' [' . implode(', ', $dataset['data']) . ']'
            ;
        }

        return implode("\n", array_filter($output, fn($v) => !empty($v)));
    }
}