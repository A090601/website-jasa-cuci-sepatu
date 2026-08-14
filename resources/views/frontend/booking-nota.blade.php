<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Nota {{ $booking->booking_code }}</title>

    <style>
        @page {
            margin: 25px 30px 45px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 3px 0;
            color: #666;
        }

        .line {
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 4px 0;
            vertical-align: top;
        }

        .label {
            width: 35%;
            font-weight: bold;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        .documentation-title {
            text-align: center;
            font-size: 12px;
            margin: 8px 0 8px 0;
        }

        .photo-table td {
            width: 50%;
            text-align: center;
            padding: 3px;
        }

        .photo {
            width: 145px;
            height: 145px;
            object-fit: cover;
        }

        .footer {
            position: fixed;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            color: #777;
            font-size: 9px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h1>ShoeWash</h1>

        <p>Nota Booking Cuci Sepatu</p>

        <p>
            {{ $booking->booking_code }}
        </p>
    </div>

    <div class="line"></div>

    {{-- DETAIL BOOKING --}}
    <table>

        <tr>
            <td class="label">Nama Pelanggan</td>
            <td>{{ $booking->customer_name }}</td>
        </tr>

        <tr>
            <td class="label">No. WhatsApp</td>
            <td>{{ $booking->phone }}</td>
        </tr>

        <tr>
            <td class="label">Tanggal</td>
            <td>
                {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Jam</td>
            <td>{{ $booking->booking_time }}</td>
        </tr>

        <tr>
            <td class="label">Layanan</td>
            <td>{{ $booking->service->name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Paket</td>
            <td>{{ $booking->price->package_name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Harga Satuan</td>
            <td>
                Rp {{ number_format($booking->price->price ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td class="label">Jumlah Sepatu</td>
            <td>{{ $booking->quantity }} Sepatu</td>
        </tr>

        <tr>
            <td class="label">Status</td>
            <td>
                @if ($booking->status === 'pending')
                    Pending
                @elseif ($booking->status === 'process')
                    Diproses
                @else
                    Selesai
                @endif
            </td>
        </tr>

    </table>

    <div class="line"></div>

    {{-- TOTAL --}}
    <table>
        <tr>
            <td class="label total">
                TOTAL
            </td>

            <td class="total">
                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    {{-- CATATAN --}}
    @if ($booking->note)
        <div class="line"></div>

        <p style="margin: 5px 0;">
            <strong>Catatan:</strong><br>
            {{ $booking->note }}
        </p>
    @endif

    {{-- FOTO --}}
    @if ($booking->shoe_photo || $booking->after_photo)

        <div class="line"></div>

        <div class="documentation-title">
            <strong>Dokumentasi Sepatu</strong>
        </div>

        <table class="photo-table">

            <tr>

                @if ($booking->shoe_photo)
                    <td>
                        <strong>Sebelum Dicuci</strong>

                        <br><br>

                        <img src="{{ public_path('storage/' . $booking->shoe_photo) }}" class="photo">
                    </td>
                @endif

                @if ($booking->after_photo)
                    <td>
                        <strong>Sesudah Dicuci</strong>

                        <br><br>

                        <img src="{{ public_path('storage/' . $booking->after_photo) }}" class="photo">
                    </td>
                @endif

            </tr>

        </table>

    @endif

    {{-- FOOTER --}}
    <div class="footer">
        Terima kasih telah menggunakan layanan ShoeWash.
        &nbsp; | &nbsp;
        Nota ini dibuat secara otomatis oleh sistem.
    </div>

</body>

</html>
