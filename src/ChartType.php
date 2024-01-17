<?php
/**
 * @copyright Copyright © 2024 BeastBytes - All rights reserved
 * @license BSD 3-Clause
 */

declare(strict_types=1);

namespace BeastBytes\Mermaid\XyChart;

enum ChartType: string
{
    case Bar = 'bar';
    case Line = 'line';
}
