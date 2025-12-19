<?php

namespace App\Libraries;

use App\Models\SeatModel;
use App\Models\AircraftModel;
use App\Models\FlightScheduleModel;
use Exception;

class SeatService
{
    protected $seatModel;
    protected $aircraftModel;
    protected $flightscheduleModel;

    public function __construct()
    {
        $this->seatModel = new SeatModel();
        $this->aircraftModel = new AircraftModel();
        $this->flightscheduleModel = new FlightScheduleModel();
    }

    /**
     * Generate seats for a schedule (based on aircraft config)
     */
    public function generateSeats(int $fid, int $aircraftId): bool
    {
        $schedule = $this->flightscheduleModel->find($fid);
        $aircraft = $this->aircraftModel->find($aircraftId);
        if (!$aircraft) {
            throw new Exception("Aircraft not found.");
        }

        $first_class_price = $schedule['first_price'];
        $business_class_price = $schedule['business_price'];
        $economy_class_price = $schedule['economy_price'];


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

        $windowColumns = [$letters[0], end($letters)];

        $rowNumber = 1;

        foreach ($classLayout as $class => $seatCount) {
            $rowsNeeded = ceil($seatCount / $columnsTotal);
            $generatedCount = 0;

            for ($r = 0; $r < $rowsNeeded; $r++) {
                foreach ($letters as $colLetter) {

                    if ($generatedCount >= $seatCount) break;

                    $seatName = $colLetter . $rowNumber;
                    $classLetter = strtoupper($class[0]);

                    if ($class === 'first') {
                        $basePrice = $first_class_price;
                    } elseif ($class === 'business') {
                        $basePrice = $business_class_price;
                    } else {
                        $basePrice = $economy_class_price;
                    }

                    $seatPrice = in_array($colLetter, $windowColumns)
                        ? $basePrice * 1.4
                        : $basePrice;

                    $ticketNo = $schedule['carrier_code']
                        . '-' . str_pad($ticketCounter, 3, '0', STR_PAD_LEFT)
                        . '-' . $seatName
                        . '-' . $classLetter;

                    $seatData[] = [
                        'fid'        => $fid,
                        'ticket_no'  => $ticketNo,
                        'seat_name'  => $seatName,
                        'class'      => $class,
                        'status'     => 'available',
                        'seat_price' => $seatPrice,
                    ];

                    $ticketCounter++;
                    $generatedCount++;
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
