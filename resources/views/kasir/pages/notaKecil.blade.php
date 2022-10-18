<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>

    <?php
    $style = '
                                          <style>
                                              * {
                                                  font-family: "consolas", sans-serif;
                                              }
                                              p {
                                                  display: block;
                                                  margin: 3px;
                                                  font-size: 10pt;
                                              }
                                              table td {
                                                  font-size: 9pt;
                                              }
                                              .text-center {
                                                  text-align: center;
                                              }
                                              .text-right {
                                                  text-align: right;
                                              }

                                              @media print {
                                                  @page {
                                                      margin: 0;
                                                      size: 75mm
                                          ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                                            html, body {
                                                width: 70mm;
                                            }
                                            .btn-print {
                                                display: none;
                                            }
                                        }
                                    </style>
                                    ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <a href="/kasir" class="btn-print"
        style="position: absolute; right: 1rem; top: rem; background:green; color:white; text-decoration:none; margin-top:3rem; padding:2px;">Transaksi
        Baru</a>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">Smega Mart</h3>
        {{-- <p>Purbalingga</p> --}}
    </div>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ $detail->No_Faktur_Jual }}</p>
    <p class="text-center">===================================</p>

    <br>
    <table width="100%" style="border: 0;">
        @foreach ($barang as $brg)
            <tr>
                <td colspan="3">{{ $brg->namaBarang }}</td>
            </tr>
            <tr>
                <td>{{ $brg->jmlhJual }} x {{ number_format($brg->hrgJual) }}</td>
                <td></td>
                <td class="text-right">{{ number_format($brg->jmlhJual * $brg->hrgJual) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ number_format($detail->Total) }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ $totalItem }}</td>
        </tr>
        <tr>
            <td>Diskon:</td>
            <td class="text-right">0</td>
        </tr>
        <tr>
            <td>Total Bayar:</td>
            <td class="text-right">{{ number_format($detail->Total) }}</td>
        </tr>
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ number_format($detail->Bayar) }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ number_format($detail->Bayar - $detail->Total) }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
    </script>
</body>

</html>
