<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDT - Purchase Order</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            /* margin-top: 7rem; */
            padding: 6.2rem 2rem 0 2rem;
            font-family: DejaVu Sans, sans-serif;
            background-image: url("image/bgpo.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .bg-body {
            background-image: url("{{ public_path('logo/edt.png') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            height: 1000px;
            opacity: 20%;
            /* atau 'cover' jika ingin penuh */
        }

        .content {
            padding: 40px;
        }

        small {
            font-size: 12px !important;
        }

        .po .tr td {
            padding: 0 0 0 5px;
            font-weight: bold;
        }

        .po .trd td {
            text-align: top;
            height: 350px;
            vertical-align: top;
            padding: 0 0 3px 5px;
        }

        .po tr .tc {
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- <div class="bg-body">
    </div> --}}

    <table style="width: 100%; margin-bottom:1rem;">
        <tr>
            <td width="50%">
                <img src="{{ public_path('logo/edt.png') }}" alt="" width="175">
            </td>
            <td align="left" width="50%" style="vertical-align: top;">
                <h4 style="margin-bottom: 0;  margin-top: 0;">Purchase Order : {{ $po->order_code }}</h4>
                <small>Project Location : {{ $po->project->project_location }}</small><br>
                <small>Planned of delivery : {{ $po->project->planned_date }}</small>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 2rem; margin:0;">
        <tr>
            <td><small>From</small></td>
            <td></td>
            <td><small>To</small></td>
        </tr>
        <tr>
            <td width="50%" style="background-color: #E8E8E8; padding:10px;">
                <table>
                    <tr>
                        <td><b>{{ $company->name }}</b></td>
                    </tr>
                    <tr>
                        <td><small>{{ $company->address }}</small></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><small>Email : {{ $company->email }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Web : {{ $company->website }}</small></td>
                    </tr>
                </table>
            </td>
            <td></td>
            <td width="50%"
                style="vertical-align: top; background-color:#F9F8F8; padding:10px; border: 1px solid black;">
                <table>
                    <tr>
                        <td><b>{{ $po->project->thirdParty->name }}</b></td>
                    </tr>
                    <tr>
                        <td><small>{{ $po->project->thirdParty->address }}</small></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="table">
        @php
            $statusColor = match ($po->status) {
                'Order To Process' => 'color: #FF0000;', // Bright red
                'Waiting for Delivery' => 'color: #FFA500;', // Pure orange
                'Delivery' => 'color: #0000FF;', // Pure blue  
                'Success' => 'color: #008000;', // Pure green
                default => 'color: #000000;', // Pure black
            };
        @endphp

        <small style="{{ $statusColor }}" class="status-label">{{ $po->status }}</small>
        {{-- <small> Amount in Indonesia Rupiah currency</small> --}}
        <table class="po" border="1" cellspacing="0" width="100%"
            style="font-size: 12px; width: 100%; border-collapse: collapse;">
            <thead>
                <tr class="tr">
                    <th style="width: 50%;">Description</th>
                    <th style="width: 10%;">Sales Tax</th>
                    <th style="width: 18%;">Price</th>
                    <th style="width: 5%;">Qty</th>
                    <th style="width: 17%;">Total (excl. tax)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itemOrders as $itemOrder)
                <tr class="trd">
                    <td>{{ $itemOrder->name }}</td>
                    <td class="tc">Rp {{ number_format($itemOrder->sales_tax, 0, ',', '.') }}</td>
                    <td class="tc">Rp {{ number_format($itemOrder->price, 0, ',', '.') }}</td>
                    <td class="tc">{{ $itemOrder->qty }}</td>
                    <td class="tc">Rp {{ number_format($itemOrder->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                {{-- <tr class="trd" style="max-height: 500px !important;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
            </tbody>
        </table>
        <table class="po" cellspacing="0" width="100%"
            style="font-size: 12px; width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 25%;"></th>
                    <th style="width: 25%;"></th>
                    <th style="width: 25%;"></th>
                    <th style="width: 25%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>Payment Terms:</b></td>
                    <td> {{ $po->payment_terms }}</td>
                    <td><b>Total: </b></td>
                    <td style="text-align: right; padding-right: 5px;"> Rp {{ number_format($po->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>Total Tax :</b></td>
                    <td style="text-align: right; padding-right: 5px;"> Rp {{ number_format(($po->sales_tax / 100) * $po->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><b>Payment Type:</b></td>
                    <td> {{ $po->payment_type }}</td>
                    <td><b>Total (inc. tax) :</b></td>
                    <td style="background-color: #E8E8E8; text-align: right; padding-right: 5px;"> Rp {{ number_format(($po->price + ($po->price * $po->sales_tax / 100)), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ttd" style="margin-top: 50px;">
        <table>
            <tr>
                <td style="text-align: top; height: 100px; vertical-align: top;"><small>Hormat Kami,</small></td>
            </tr>
            <tr>
                <td style="line-height: 15px;">
                    <small>{{ $company->owner }}</small>
                </td>
            </tr>
            <tr>
                <td style="line-height: 7px;"><small>{{ $company->name }} .... { No Signature Required, generated by System }</small></td>
            </tr>
        </table>
    </div>

    <div class="footer" style="margin-top: 60px; width: 45%; color: white; line-height: 0.9;">
        {{-- <small>{{ $company->name }}</small><br> --}}
        <small>{{ $company->specialist }}</small><br>
        <small>{{ $company->address }}</small><br>
    </div>
</body>

</html>
