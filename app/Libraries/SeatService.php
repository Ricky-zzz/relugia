<?php

namespace App\Libraries;

use App\Models\SeatModel;
use App\Models\AircraftModel;
use Exception;

class SeatService
{
    protected $seatModel;
    protected $aircraftModel;

    public function __construct()
    {
        $this->seatModel = new SeatModel();
        $this->aircraftModel = new AircraftModel();
    }

    /**
     * Generate seats for a schedule (based on aircraft config)
     */
    public function generateSeats(int $fid, int $aircraftId): bool
    {
        $aircraft = $this->aircraftModel->find($aircraftId);
        if (!$aircraft) {
            throw new Exception("Aircraft not found.");
        }

        $totalRows = (int) $aircraft['row_nums'];
        $clusters = explode('-', $aircraft['col_sizes']);
        $columnsTotal = array_sum($clusters);

        $seatData = [];
        $ticketCounter = 1;

        $classLayout = [
            'first' => (int) $aircraft['first_class'],
            'business' => (int) $aircraft['business_class'],
            'economy' => (int) $aircraft['economy_class'],
        ];

        $letters = [];
        for ($i = 0; $i < $columnsTotal; $i++) {
            $letters[] = chr(ord('A') + $i);
        }

        $rowNumber = 1;

        foreach ($classLayout as $class => $seatCount) {
            $rowsNeeded = ceil($seatCount / $columnsTotal);

            for ($r = 0; $r < $rowsNeeded; $r++) {
                foreach ($letters as $colLetter) {

                    $seatIndex = count($seatDataForClass ?? []);
                    if ($seatIndex >= $seatCount)
                        break;

                    $seatName = $colLetter . $rowNumber;
                    $classLetter = strtoupper($class[0]);

                    $ticketNo = str_pad($ticketCounter, 4, '0', STR_PAD_LEFT)
                        . '-' . $seatName
                        . '-' . $classLetter;

                    $seatData[] = [
                        'fid' => $fid,
                        'ticket_no' => $ticketNo,
                        'seat_name' => $seatName,
                        'class' => $class,
                        'status' => 'available',
                    ];

                    $ticketCounter++;
                }
                $rowNumber++;
            }
        }

        return $this->seatModel->insertBatch($seatData);
    }


    /**
     * Delete seats for a schedule
     */
    public function deleteSeatsBySchedule(int $fid): bool
    {
        return $this->seatModel->where('fid', $fid)->delete();
    }
}
