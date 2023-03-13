<!doctype html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report of Finestauction</title>

    <style>        
        body {
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        p {
            font-size: 12px
        }

        .header {
            height: 100px;
        }

        .logo {
            width: 250px;
            height: 50px;
            float: left;
            margin-top: 10px
        }

        .text {
            margin-top: -10px;
            float: right;
            text-align: right;
        }

        .invoice-number {
            color: #23448d;
            font-style: italic;
            font-weight: bold; 
            margin-top: -10px;
        }

        .auction-date {
            text-align: right
        }

        table { 
            border-collapse: collapse; 
            margin:50px auto;
            font-size: 8px
        }

        th { 
            background: #e2e2e2; 
            font-weight: bold; 
        }

        td, th { 
            padding: 10px; 
            border: 1px solid #7d7d7d; 
            text-align: left; 
        }

        .name {
            color: #23448d;
            font-weight: bold;
        }

        i {
            font-size: 8px;
        }

        .footer-note {
            float: left;
        }

        .footer-date {
            float: right;
        }
    </style>
</head>
 
<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="https://i.ibb.co/LR5YZCB/logo.png" alt="logo" border="0">
            <div class="text">
                <h4>ITEMS REPORT</h4>
                <p class="invoice-number">REP/{{date('Ymd', strtotime($current_time));}}/ITM/{{rand(1000, 9999)}}</p>
            </div>
        </div>
        <hr>
        <div class="client">
            <p class="auction-date">Report Date: {{date('d M Y', strtotime($current_time));}}</p>
            <p>Admin/Manager: {{ auth()->user()->name }}</p>
            <p>Email: {{ auth()->user()->email }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Start Price</th>
                    <th>Current Bid</th>
                    <th>Final Price</th>
                    <th>Item Created</th>
                    <th>Bid Ended</th>
                    <th>Bid Winner</th>
                    <th>Bid Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lots as $lot)
                <tr>
                    <td class="name" style="max-width: 500px">{{$lot->name}}</td>
                    <td>Rp{{number_format($lot->start_price)}}</td>
                    <td>Rp{{number_format(!is_null($ac = DB::table('bids')->where('lot_id',$lot->id)->orderBy('bid_price','DESC')->first()) ? $ac->bid_price : 0,0,',','.') }}</td>
                    <td>Rp{{number_format($lot->final_price)}}</td>
                    <td>{{date('d M Y, H:m', strtotime($lot->created_at));}}</td>
                    <td>{{date('d M Y, H:m', strtotime($lot->end_time));}}</td>
                    <td>
                        @if ($lot->user_id === NULL)
                            No one bid yet
                        @else
                            {{ $lot->user->name }}
                        @endif
                    </td>
                    <td>
                        @if ($lot->status === 0)
                            Ends
                        @else
                            On Progress
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                    <td colspan="7">Total Items</td>
                    <td>{{ DB::table('lots')->get()->count() }}</td>
            </tfoot>
          </table>
          <i class="footer-text">
            <p class="footer-notes" style="color: grey;">This report is valid and processed by computer
            <br>
            Please call <a style="color: #23448d; text-decoration: none;" href="asepmnv14@email.com?subject=Need%20help%20about%20Finestcarauction%20">Finestauction Care</a> if you need help.</p>
            <p style="color: grey;" class="footer-date">Last update: {{date('d M Y, H:m', strtotime($current_time));}}</p>
          </i>
    </div>
 
</body>
 
</html>