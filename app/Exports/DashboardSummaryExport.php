<?php

namespace App\Exports;

use App\Models\Passenger;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DashboardSummaryExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnFormatting
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function title(): string
    {
        return 'Summary';
    }

    public function headings(): array
    {
        return [
            ['STATISTIK OPERASIONAL PELABUHAN'],
            ['Periode: ' . $this->getPeriodText()],
            [],
            ['Statistik', 'Nilai'],
        ];
    }

    public function collection()
    {
        // Build query based on period type
        $query = Passenger::query();

        if ($this->filters['period_type'] == 'monthly') {
            $month = $this->filters['month'];
            $query->where('date', 'like', $month . '%');
        } elseif ($this->filters['period_type'] == 'yearly') {
            $year = $this->filters['year'];
            $query->whereYear('date', $year);
        }

        // Calculate statistics
        $totalShipsDeparture = (clone $query)->where('departure_passenger', '>', 0)->count();
        $totalShipsArrival = (clone $query)->where('arrival_passenger', '>', 0)->count();
        $totalPassengersDeparture = (clone $query)->sum('departure_passenger');
        $totalPassengersArrival = (clone $query)->sum('arrival_passenger');

        // Calculate date range for averages
        $oldestDate = (clone $query)->min('date');
        $newestDate = (clone $query)->max('date');

        if ($oldestDate && $newestDate) {
            $oldestTimestamp = strtotime($oldestDate);
            $newestTimestamp = strtotime($newestDate);
            $dateDifference = (($newestTimestamp - $oldestTimestamp) / 86400) + 1;

            $averageShipsDeparture = $dateDifference > 0 ? number_format($totalShipsDeparture / $dateDifference, 2) : 0;
            $averageShipsArrival = $dateDifference > 0 ? number_format($totalShipsArrival / $dateDifference, 2) : 0;
            $averagePassengersDeparture = $dateDifference > 0 ? number_format($totalPassengersDeparture / $dateDifference, 2) : 0;
            $averagePassengersArrival = $dateDifference > 0 ? number_format($totalPassengersArrival / $dateDifference, 2) : 0;
        } else {
            $averageShipsDeparture = 0;
            $averageShipsArrival = 0;
            $averagePassengersDeparture = 0;
            $averagePassengersArrival = 0;
        }

        $data = [
            ['Total Kapal Keberangkatan', $totalShipsDeparture],
            ['Total Kapal Kedatangan', $totalShipsArrival],
            ['Total Penumpang Naik', $totalPassengersDeparture],
            ['Total Penumpang Turun', $totalPassengersArrival],
            [],
            ['Rata-rata Kapal Naik/Hari', $averageShipsDeparture],
            ['Rata-rata Kapal Turun/Hari', $averageShipsArrival],
            ['Rata-rata Penumpang Naik/Hari', $averagePassengersDeparture],
            ['Rata-rata Penumpang Turun/Hari', $averagePassengersArrival],
        ];

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
