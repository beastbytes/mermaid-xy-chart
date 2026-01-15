<?php

declare(strict_types=1);

use BeastBytes\Mermaid\Mermaid;
use BeastBytes\Mermaid\XyChart\DatasetType;
use BeastBytes\Mermaid\XyChart\XyChart;

test('chart', function () {
    expect(Mermaid::create(XyChart::class)
        ->withTitle('Sales Revenue')
        ->withXAxis(null, ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec (12)'])
        ->withYAxis('Revenue (in $)', 4000, 11000)
        ->addDataset(DatasetType::bar, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
        ->addDataset(DatasetType::line, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
        ->render()
    )
        ->toBe(<<<EXPECTED
<pre class="mermaid">
xychart horizontal
  title &quot;Sales Revenue&quot;
  x-axis [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, &quot;Dec (12)&quot;]
  y-axis &quot;Revenue (in $)&quot; 4000 --&gt; 11000
  bar [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000]
  line [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000]
</pre>
EXPECTED
    );
});