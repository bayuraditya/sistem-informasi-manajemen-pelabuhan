<?php

namespace App\Exports;

use App\Models\Passenger;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RetributionPassengerExport implements FromQuery, WithHeadings, WithMapping, WithStyles, WithTitle, WithColumnWidths, WithEvents
{
    protected $month;
    protected $year;

    /**
     * Create a new export instance.
     *
     * @param int|null $month
     * @param int|null $year
     */
    public function __construct($month = null, $year = null)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Passenger::query()
            ->with([
                'ship.arrivalRoute',
                'ship.departureRoute',
                'retributionUser'
            ]);

        // Apply year filter if provided
        if ($this->year) {
            $query->whereYear('date', '=', $this->year);

            // Apply month filter only if both month and year are provided
            if ($this->month) {
                $query->whereMonth('date', '=', $this->month);
            }
        }

        return $query->orderBy('date', 'desc');
    }

    /**
     * @param Passenger $passenger
     * @return array
     */
    public function map($passenger): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            date('d F Y', strtotime($passenger->date)),
            $passenger->ship->name ?? '-',
            $passenger->ship->departureRoute->route ?? '-',
            $passenger->ship->departure_time ?? '-',
            $passenger->departure_passenger ?? 0,
            $passenger->departure_passenger_retribution ?? 0,
            $passenger->retribution ?? 0,
            $passenger->retribution_status == 'lunas' ? 'Lunas' : 'Belum Lunas',
            $passenger->ship->arrivalRoute->route ?? '-',
            $passenger->ship->arrival_time ?? '-',
            $passenger->arrival_passenger ?? 0,
            $passenger->retributionUser->name ?? '-',
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $periodText = 'Period: All Data';

        if ($this->year) {
            if ($this->month) {
                // Both month and year provided
                $periodText = 'Period: ' . date('F Y', mktime(0, 0, 0, $this->month, 1, $this->year));
            } else {
                // Only year provided
                $periodText = 'Period: Year ' . $this->year;
            }
        }

        return [
            [
                'KELOLA RETRIBUSI'
            ],
            [
                $periodText
            ],
            [],
            [
                'No',
                'Date',
                'Ship',
                'Departure Route',
                'Departure Time',
                'Departure Passenger',
                'Departure Passenger Retribution',
                'Retribution',
                'Retribution Status',
                'Arrival Route',
                'Arrival Time',
                'Arrival Passenger',
                'Penginput Retribusi'
            ]
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Kelola Retribusi';
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
            'B' => 20, // Date
            'C' => 25, // Ship
            'D' => 25, // Departure Route
            'E' => 18, // Departure Time
            'F' => 22, // Departure Passenger
            'G' => 28, // Departure Passenger Retribution
            'H' => 15, // Retribution
            'I' => 20, // Retribution Status
            'J' => 25, // Arrival Route
            'K' => 18, // Arrival Time
            'L' => 20, // Arrival Passenger
            'M' => 25, // Penginput Retribusi
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

                // Merge cells A1:M1 for the title
                $sheet->mergeCells('A1:M1');

                // Merge cells A2:M2 for the period information
                $sheet->mergeCells('A2:M2');
            },
        ];
    }
}