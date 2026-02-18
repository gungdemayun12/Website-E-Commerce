<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pembayaran #{{ $order->id + 1000 }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }

        .receipt {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4A3428;
            padding-bottom: 20px;
        }

        .company-info h1 {
            color: #4A3428;
            font-size: 24px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .company-info p {
            font-size: 13px;
            color: #666;
        }

       .logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
        }



        .receipt-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .receipt-title h2 {
            color: #4A3428;
            font-size: 20px;
            letter-spacing: 2px;
            font-weight: 800;
        }


        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 20px;
        }

        .info-box {
            flex: 1;
            font-size: 12px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 5px;
            color: #4A3428;
            border-bottom: 1px solid #eee;
            padding-bottom: 2px;
            font-weight: 700;
        }

        .right-info {
            text-align: right;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 20px;
        }

        thead {
            background: #4A3428;
            color: #ffffff;
        }

        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
        }

        th {
            text-align: left;
            text-transform: uppercase;
            font-weight: 600;
        }

        .center { text-align: center; }
        .right { text-align: right; }


        .summary-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .totals {
            width: 250px;
            font-size: 13px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .totals-row.grand-total {
            font-weight: 800;
            color: #4A3428;
            border-top: 2px solid #4A3428;
            margin-top: 10px;
            padding-top: 10px;
            font-size: 15px;
        }

        .balance {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            color: #27ae60;
            font-size: 14px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
            text-align: center;
            font-size: 12px;
            color: #888;
            font-style: italic;
        }

       
        @media print {
            body { background: #fff; padding: 0; }
            .receipt { 
                box-shadow: none; 
                border: none; 
                width: 100%; 
                max-width: 100%;
                padding: 10px;
            }
            @page { margin: 0.5cm; }
        }
    </style>
</head>
<body>

<div class="receipt">

    <div class="top-header">
        <div class="company-info">
            <h1>Toko Anjay</h1>
            <p>
                Jalan Mawar No. 8, Batubulan<br>
                WhatsApp: 082147331906<br>
                Email: infotokoanjay@email.com
            </p>
        </div>
       <div class="logo">
    <img src="{{ public_path('storage/logo ta.png') }}" 
     alt="Logo"
     style="width:100%; height:100%; object-fit:cover;">

</div>

    </div>

    <div class="receipt-title">
        <h2>RESI PENJUALAN</h2>
    </div>

    <div class="info-section">
        <div class="info-box">
            <strong>TAGIHAN KEPADA</strong>
            {{ $order->nama_pemesan }}<br>
            {{ $order->alamat }}<br>
            {{ $order->no_hp }}
        </div>

        <div class="info-box">
            <strong>DIKIRIM KE</strong>
            {{ $order->nama_pemesan }}<br>
            {{ $order->alamat }}
        </div>

        <div class="info-box right-info">
            <strong>NO. SALES:</strong> #{{ $order->id + 975 }}<br>
            <strong>TANGGAL:</strong> {{ date('d/m/Y', strtotime($order->created_at)) }}<br>
            <strong>METODE BAYAR:</strong> {{ strtoupper($order->metode_pembayaran) }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Aktivitas</th>
                <th>Deskripsi Produk</th>
                <th class="center">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr>
                <td>Pesanan</td>
                <td>
                    <strong>{{ $item->nama_produk }}</strong>
                    @if($item->ukuran)
                        <br><small>Ukuran: {{ $item->ukuran }}</small>
                    @endif
                </td>
                <td class="center">{{ $item->qty }}</td>
                <td class="right">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="right">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-container">
        <div class="totals">
            <div class="totals-row">
                <span>Subtotal</span>
                <span>Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
            <div class="totals-row">
                <span>Pajak (0%)</span>
                <span>Rp0</span>
            </div>
            <div class="totals-row grand-total">
                <span>TOTAL AKHIR</span>
                <span>Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        Terima kasih telah berbelanja di Toko Anjay!<br>
        Barang yang sudah dibeli tidak dapat ditukar kecuali ada perjanjian sebelumnya.
    </div>

</div>

</body>
</html>