<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Parking Management System - Receipt</title>
    <link rel="icon" href="<?=base_url('assets/images/ico.png');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css');?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <style>
        html, body{
            min-height:none;
        } 
    </style>
</head>
<body class="" style="font-family: Quicksand;">
    
    <div class="container my-5">
        <h2 class="h6 text-muted"><i class="fas fa-receipt"></i>&nbsp; Receipt</h2>
        <hr>
        <?php foreach($receipt as $r):?>
        <table class="table mt-4 table-bordered table-stripped">
            <tr>
                <th><b>Serial No. : </b></th>
                <td><b><?=$r->id;?></b></td>
            </tr>
            <tr>
                <th><b>Vehicle Number : </b></th>
                <td><b><?=$r->vehicle_no;?></b></td>
            </tr>
            <tr>
                <th><b>Vehicle Type : </b></th>
                <td><b><?=$r->vehicle_type;?></b></td>
            </tr>
            <tr>
                <th><b>Parking Area Number : </b></th>
                <td><b><?=$r->parking_area_no;?></b></td>
            </tr>
            <tr>
                <th><b>Parking Charge : </b></th>
                <td style="color:green"><b><i class="fas fa-dollar-sign"></i>&nbsp;<?= number_format($r->parking_charge, 2);?></b></td>
            </tr>
            <tr>
                <th><b>Arrival Time : </b></th>
                <td><b><?=$r->arrival_time;?></b></td>
            </tr>
        </table>
        <?php endforeach;?>
    </div>
</body>
</html>