<?php

namespace AnourValar\Office\Sheets;

class SchemaMapper
{
    /**
     * @var array
     */
    protected array $payload = [
        'data' => [], //[ 1 => ['A' => 'foo'], '2' => ['B' => 'bar'] ]

        'rows' => [], //[ ['action' => 'add', 'row' => 1], ['action' => 'delete', 'row' => 2] ]

        'copy_style' => [], //[ ['from' => 'A1', 'to' => 'A2'] ]

        'merge_cells' => [], //[ 'A1:B1', 'C1:D1']

        'copy_width' => [], //[ ['from' => 'B', 'to' => 'C'] ]

        'copy_cell_format' => [], //[ ['from' => 'A1', 'to' => 'A2'] ]
    ];

    /**
     * @return array
     */
    public function toArray(): array
    {
        ksort($this->payload['data']);

        ksort($this->payload['copy_style'], SORT_NATURAL);
        $this->payload['copy_style'] = array_values($this->payload['copy_style']);

        sort($this->payload['copy_width']);

        ksort($this->payload['copy_cell_format'], SORT_NATURAL);
        $this->payload['copy_cell_format'] = array_values($this->payload['copy_cell_format']);

        return $this->payload;
    }

    /**
     * @param int $row
     * @param string $column
     * @param mixed $value
     * @return self
     */
    public function addData(int $row, string $column, mixed $value): self
    {
        $this->payload['data'][$row][$column] = $value;

        return $this;
    }

    /**
     * @param int $rowBefore
     * @return self
     */
    public function addRow(int $rowBefore): self
    {
        $this->payload['rows'][] = ['action' => 'add', 'row' => $rowBefore];

        return $this;
    }

    /**
     * @param int $row
     * @return self
     */
    public function deleteRow(int $row): self
    {
        $this->payload['rows'][] = ['action' => 'delete', 'row' => $row];

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     * @return self
     */
    public function copyStyle(string $from, string $to): self
    {
        $this->payload['copy_style'][$from.$to] = ['from' => $from, 'to' => $to];

        return $this;
    }

    /**
     * @param string $ceilRange
     * @return self
     */
    public function mergeCells(string $ceilRange): self
    {
        $this->payload['merge_cells'][] = $ceilRange;

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     * @return self
     */
    public function copyWidth(string $from, string $to): self
    {
        $this->payload['copy_width'][$from . $to] = ['from' => $from, 'to' => $to];

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     * @return self
     */
    public function copyCellFormat(string $from, string $to): self
    {
        $this->payload['copy_cell_format'][$from.$to] = ['from' => $from, 'to' => $to];

        return $this;
    }
}
