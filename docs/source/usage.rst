Usage
=====

XY Chart allows drawing charts that have X and Y axes.
Currently, bar and line charts are supported; additional chart types may be supported by Mermaid in the future.

The X-axis, if defined, can be either categories or values; the Y-axis is always a value range if defined;
both axes are optional with Mermaid calculating the ranges if they are not.

Example
-------

.. code-block:: php

    Mermaid::create(XyChart::class)
        ->withTitle('Sales Revenue')
        ->withXAxis('1999', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
        ->withYAxis('Revenue (in $)', 4000, 11000)
        ->addDataset(DatasetType::bar, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
        ->addDataset(DatasetType::line, [5000, 6000, 7500, 8200, 9500, 10500, 11000, 10200, 9200, 8500, 7000, 6000])
        ->render()
    ;
