<?php

use BeastBytes\Mermaid\XyChart\ChartType;
use BeastBytes\Mermaid\XyChart\XyChart;

test('chart', function () {
    $chart = (new XyChart())
        ->withTitle('Sales Revenue')
        ->withXAxis('', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
        ->withYAxis('Revenue (in $)', 4000, 11000)
        ->withDataset(ChartType::Bar, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
        ->addDataset(ChartType::Line, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
    ;

    expect($chart->render())
        ->toBe("<pre class=\"mermaid\">\n"
            . "xychart-beta\n"
            . "  title &quot;Sales Revenue&quot;\n"
            . "  x-axis [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec]\n"
            . "  y-axis &quot;Revenue (in $)&quot; 4000 --&gt; 11000\n"
            . "  bar [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000]\n"
            . "  line [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000]\n"
            . '</pre>'
    );
});
