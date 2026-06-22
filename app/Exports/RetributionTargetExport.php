<?php

namespace App\Exports;

use App\Models\Retribution;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RetributionTargetExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, WithColumnWidths, WithEvents
{
    protected $year;

    /**
     * Create a new export instance.
     *
     * @param int|null $year
     */
    public function __construct($year = null)
    {
        $this->year = $year;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Retribution::query();

        // Apply year filter if provided
        if ($this->year) {
            $query->whereRaw("SUBSTRING(month, 1, 4) = ?", [$this->year]);
        }

        return $query->orderBy('month', 'desc');
    }

    /**
     * @param Retribution $retribution
     * @return array
     */
    public function map($retribution): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            date('F Y', strtotime($retribution->month . '-01')),
            $retribution->target,
            $retribution->total,
            $retribution->total >= $retribution->target ? 'Tercapai' : 'Belum Tercapai',
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $periodText = $this->year ? 'Period: Year ' . $this->year : 'Period: All Data';

        return [
            [
                'DATA PENCAPAIAN RETRIBUSI'
            ],
            [
                $periodText
            ],
            [],
            [
                'No',
                'Bulan',
                'Target',
                'Total',
                'Status'
            ]
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Pencapaian Retribusi';
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (title)
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            // Style the second row (period info)
            2 => [
                'font' => ['italic' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
            // Style the header row
            4 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2EFDA']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,  // No
            'B' => 25, // Bulan
            'C' => 20, // Target
            'D' => 20, // Total
            'E' => 25, // Status
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Merge cells A1:E1 for the title
                $sheet->mergeCells('A1:E1');

                // Merge cells A2:E2 for the period information
                $sheet->mergeCells('A2:E2');
            },
        ];
    }
}