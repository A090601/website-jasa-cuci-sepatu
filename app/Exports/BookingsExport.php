<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::select(
            'booking_code',
            'customer_name',
            'phone',
            'booking_date',
            'booking_time',
            'status',
            'total_price'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Booking',
            'Nama',
            'No HP',
            'Tanggal',
            'Jam',
            'Status',
            'Total'
        ];
    }
}
