<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        h2 {
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>

        Laporan Booking ShoeWash

    </h2>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>No Booking</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($bookings as $booking)
                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $booking->booking_code }}</td>

                    <td>{{ $booking->customer_name }}</td>

                    <td>{{ $booking->phone }}</td>

                    <td>{{ $booking->service->name }}</td>

                    <td>{{ $booking->booking_date }}</td>

                    <td>{{ ucfirst($booking->status) }}</td>

                    <td>
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
