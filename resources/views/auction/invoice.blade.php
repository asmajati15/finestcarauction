<!doctype html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice of {{$lots->name}}</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .header {
            width: 250px;
            height: 50px;
        }
        .logo {
            width: 100%;
            height: 100%;
        }
        table { 
            border-collapse: collapse; 
            margin:50px auto;
            font-size: 12px
        }

        th { 
            background: #bdbdbd; 
            font-weight: bold; 
        }

        td, th { 
            padding: 10px; 
            border: 1px solid #aaaaaa; 
            text-align: left; 
        }
    </style>
</head>
 
<body>
    <div class="container">
        <div class="header">
            <img class="logo" src="https://i.ibb.co/LR5YZCB/logo.png" alt="logo" border="0">
        </div>
        <table>
            <thead>
              <tr>
                <th>Item Name</th>
                <th>QTY</th>
                <th>Final Price</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                <td style="max-width: 500px">{{$lots->name}}</td>
                <td>1</td>
                <td>Rp{{number_format($lots->final_price)}}</td>
                </tr>
            </tbody>
          </table>
          <i>
            This invoice is valid and processed by computer
            <br>
            Please call <a href="">Finestcarauction Care</a> if you need help.
          </i>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
 
</html>