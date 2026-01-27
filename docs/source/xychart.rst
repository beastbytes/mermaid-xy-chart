XyChart Class
=============

.. php:class:: XyChart

    Represents an XY Chart

    .. php:method:: render(array $attributes)

        Render the Mermaid code enclosed in a <pre> tag

        :param array $attributes: HTML attributes for the enclosing <pre> tag
        :returns: Mermaid code enclosed in a <pre> tag
        :rtype: string

    .. php:method:: addDataset(DatasetType $type, array $data)

        Add a dataset

        :param DatasetType $type: The dataset type
        :param array $data: The dataset
        :returns: A new instance of ``XyChart`` with the dataset
        :rtype: XyChart

    .. php:method:: render(array $attributes = [])

        Renders the diagram

        :param array $attributes: HTML attributes for the <pre> tag as name=>value pairs

            .. note:: The *mermaid* class is added

        :returns: Mermaid diagram code in a <pre> tag
        :rtype: string

    .. php:method:: withTitle(string $title)

        Set the chart title

        :param string $title: The title
        :returns: A new instance of ``XyChart`` with the title
        :rtype: XyChart

    .. php:method:: withOrientation(Orientation $orientation)

        Set the chart orientation

        The default chart orientation is :php:case:`Orientation::vertical`

        :param Orientation $orientation: The chart orientation
        :returns: A new instance of ``XyChart`` with the orientation set
        :rtype: XyChart

    .. php:method:: withXAxis(?string $title = null, array|int|null $min = null, ?int $max = null)

        Define the chart X-axis

        :param ?string $title: The X-axis title
        :param array|int|null $min: Array of categories or minimum value
        :param ?int $max: Maximum value; only used if $min is int
        :returns: A new instance of ``XyChart`` with the X-axis defined
        :rtype: XyChart

    .. php:method:: withYAxis(?string $title = null, ?int $min = null, ?int $max = null)

        Define the chart Y-axis

        :param ?string $title: The Y-axis title
        :param ?int $min: Minimum value
        :param ?int $max: Maximum value
        :returns: A new instance of ``XyChart`` with the Y-axis defined
        :rtype: XyChart
