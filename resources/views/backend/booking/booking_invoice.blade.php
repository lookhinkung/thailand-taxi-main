<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css"> 
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong>Thailand Taxi</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Thailand Taxi services
               Email:srisomsak.tinn@gmail.com <br>
               Mob: 0624393017 <br>
               53 M6, Haad Chao Samran Road,Tumbol Nong Plub, Muang Petchaburi <br>
              
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background:white; padding:2px;"></table>

  <table width="100%" style="background: #F7F7F7; padding:0 5px;" class="font">
    <thead class="table-light">
        <tr>
            <th style="text-align: center;">Car Type</th>
            <th style="text-align: center;">Check In / Out Date</th>
            <th style="text-align: center;">Pick up Time</th>
            <th style="text-align: center;">Total Passenger</th>
            <th style="text-align: center;">Total Days</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center;">{{ $editData->car->type->name }}</td>
            <td style="text-align: center;">
                <span class="badge bg-primary">{{ $editData->check_in }}</span>
                <br>
                <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span>
            </td>
            <td style="text-align: center;">{{ $editData->pick_time }}</td>
            <td style="text-align: center;">{{ $editData->persion }}</td>
            <td style="text-align: center;">{{ $editData->total_night }}</td>
        </tr>
    </tbody>
</table>

  <br/>
 


   
 
  <table class="table test_table" style="float:right; border:none">
                        
 </table>


  <div class="thanks mt-3">
    <p>Thanks For Your Booking..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>