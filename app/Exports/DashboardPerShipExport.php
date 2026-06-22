<?php

namespace App\Exports;

use App\Models\Ship;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DashboardPerShipExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnFormatting
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function title(): string
    {
        return 'Per Kapal';
    }

    public function headings(): array
    {
        return [
            ['DATA PENUMPANG PER KAPAL'],
            ['Periode: ' . $this->getPeriodText()],
            [],
            ['Nama Kapal', 'Total Penumpang'],
        ];
    }

    public function collection()
    {
        // Build query based on period type
        $query = Ship::leftJoin('passengers', 'ships.id', '=', 'passengers.ship_id')
            ->select('ships.name as ship_name', DB::raw('SUM(passengers.departure_passenger + passengers.arrival_passenger) AS total_passenger'))
            ->groupBy('ships.id', 'ships.name');

        if ($this->filters['period_type'] == 'monthly') {
            $month = $this->filters['month'];
            $query->where('passengers.date', 'like', $month . '%');
        } elseif ($this->filters['period_type'] == 'yearly') {
            $year = $this->filters['year'];
            $query->whereYear('passengers.date', $year);
        }

        $ships = $query->get();

        $data = [];
        foreach ($ships as $ship) {
            $data[] = [
                $ship->ship_name,
                $ship->total_passenger ?? 0,
            ];
        }

        return collect($data);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:B1');
        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:B2')->getAlignment()->setHorizontal('center');

        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'center'],
            ],
            2 => [
                'font' => ['italic' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
            4 => [
                'font' => ['bold' => true],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E6F2FF']],
            ],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    private function getPeriodText()
    {
        if ($this->filters['period_type'] == 'monthly') {
            $monthName = date('F Y', strtotime($this->filters['month'] . '-01'));
            return $monthName;
        } else {
            return 'Tahun ' . $this->filters['year'];
        }
    }
}
