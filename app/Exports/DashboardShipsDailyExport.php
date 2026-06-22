<?php

namespace App\Exports;

use App\Models\Passenger;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DashboardShipsDailyExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnFormatting
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function title(): string
    {
        return 'Kapal Harian';
    }

    public function headings(): array
    {
        return [
            ['DATA KAPAL HARIAN'],
            ['Periode: ' . $this->getPeriodText()],
            [],
            ['Tanggal', 'Kapal Naik', 'Kapal Turun'],
        ];
    }

    public function collection()
    {
        $data = [];

        if ($this->filters['period_type'] == 'monthly') {
            // Export 31 days for selected month
            $month = $this->filters['month'];

            for ($i = 1; $i <= 31; $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $date = $month . '-' . $day;

                $departureShips = Passenger::where('date', '=', $date)
                    ->where('departure_passenger', '>', 0)
                    ->count();

                $arrivalShips = Passenger::where('date', '=', $date)
                    ->where('arrival_passenger', '>', 0)
                    ->count();

                $data[] = [
                    $date,
                    $departureShips,
                    $arrivalShips,
                ];
            }
        } elseif ($this->filters['period_type'] == 'yearly') {
            // Export monthly summary for selected year
            $year = $this->filters['year'];

            for ($month = 1; $month <= 12; $month++) {
                $monthName = date('F', mktime(0, 0, 0, $month, 1, $year));

                // Count ships for this month
                $departureShips = Passenger::whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->where('departure_passenger', '>', 0)
                    ->count();

                $arrivalShips = Passenger::whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->where('arrival_passenger', '>', 0)
                    ->count();

                $data[] = [
                    $monthName . ' ' . $year,
                    $departureShips,
                    $arrivalShips,
                ];
            }
        }

        return collect($data);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('A2:C2');
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:C2')->getAlignment()->setHorizontal('center');

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
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
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
