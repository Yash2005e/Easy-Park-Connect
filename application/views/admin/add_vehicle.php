<?php include('header.php');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 px-0" style="position:fixed">
            <div class="card border-0 shadow-sm">
                <div class="card-body m-0 p-0">
                    <?php include('sidebar.php');?>
                </div>
            </div>
        </div>
        <div class="col-8 offset-3 mt-5 mr-5">
            <?php include('notification.php');?>
            <div class="row">
                <div class="col-7">
                    <div class="card rounded-0 shadow-sm">
                        <div class="card-header">
                            <div class="h6 mb-0 card-title"><i class="fas fa-file-import"></i> &nbsp;Add Vehicle</div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="mt-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                        <label for="" class=" m-0 p-0 text-muted">Vehicle Number</label>
                                        <input type="text" class="form-control rounded-0 form-control-sm shadow-none" name="vehicle_number" required autofocus>
                                    </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="" class=" m-0 p-0 text-muted">Vehicle Type</label>
                                            <select name="vehicle_type" class="form-control rounded-0 form-control-sm shadow-none">
                                                <option value="" selected disabled>Select Vehicle Type</option>
                                                <?php foreach($parking_area_no as $p):?>
                                                <option value="<?=$p->vehicle_type;?>" <?php if($this->datawork->count_data('add_vehicle',['vehicle_type'=>$p->vehicle_type,'status'=>0])==$p->vehicle_limit){echo "disabled";}?>><?=$p->vehicle_type;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class=" m-0 p-0 text-muted">Parking Area Number</label>
                                    <select name="parking_area_number" class="form-control rounded-0 form-control-sm shadow-none">
                                        <option value="" selected disabled>Select Parking Area Number</option>
                                        <?php foreach($parking_area_no as $p):?>
                                        <option value="<?=$p->parking_area_no;?>" <?php if($this->datawork->count_data('add_vehicle',['vehicle_type'=>$p->vehicle_type,'status'=>0])==$p->vehicle_limit){echo "disabled";}?>><?=$p->parking_area_no;?> &#8594; <span>(<?=$p->vehicle_type;?>)</span></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class=" m-0 p-0 text-muted">Parking Charge</label>
                                    <select name="parking_charge" class="form-control rounded-0 form-control-sm shadow-none">
                                        <option value="" selected disabled>Select Parking Charge</option>
                                        <?php foreach($parking_area_no as $p):?>
                                        <option value="<?=$p->parking_charge;?>" <?php if($this->datawork->count_data('add_vehicle',['vehicle_type'=>$p->vehicle_type,'status'=>0])==$p->vehicle_limit){echo "disabled";}?>>₹<?=$p->parking_charge*10;?> &#8594; <span>(<?=$p->vehicle_type;?>)</span></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Add Vehicle" class="mt-4 btn btn-block bg-primary btn-sm rounded-0 text-white shadow-none">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card rounded-0 shadow-sm">
                        <div class="card-header">
                            <div class="card-title h6 mb-0"><b><i class="fab fa-staylinked fa-xs"></i>&nbsp; Vehicle Limitations</b></div>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <?php foreach ($category as $c):?>
                                <?php $test = $c->vehicle_limit - $this->datawork->count_data('add_vehicle',['vehicle_type'=>$c->vehicle_type,'status'=>0]); ?>
                                    <div class="list-group-item list-group-action">
                                        <div class="d-flex w-100 align-items-center">
                                            <div class="col-auto flex-shrink-1 flex-grow-1 text-truncate"><?= $c->vehicle_type;?> Limit:</div>
                                            <div class="col-auto flex-shrink-1 flex-grow-1 text-truncate text-right"><?php if($test==0){echo "<span class='badge badge-danger'>$test</span> "; } else {echo "<span class='badge badge-success'>$test</span> ";}; ?> out of <?=$c->vehicle_limit;?></div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="card rounded-0 shadow-none">
                        <div class="card-header">
                            <div class="card-title h6 mb-0"><b><i class="fab fa-staylinkfa-th-listed fa-xs"></i>&nbsp; Current Vehicles</b></div>
                        </div>
                        <div class="card-body">
                            <table class="table mt-4 table-bordered table-striped" id="vehicle-tbl">
                                <thead>
                                <tr>
                                    <th class='p-1 text-center'><b>#</b></th>
                                    <th class='p-1 text-center'><b>Vehicle Number</b></th>
                                    <th class='p-1 text-center'><b>Area Number</b></th>
                                    <th class='p-1 text-center'><b>Arrival Time</b></th>
                                    <th class='p-1 text-center'><b>Status</b></th>
                                    <th class='p-1 text-center'><b>Action</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($add_vehicle as $a):?>
                                    <tr>
                                        <td class="px-2 py-1 align-middle text-center" ><?=$a->id;?></td>
                                        <td class="px-2 py-1 align-middle" ><?=$a->vehicle_no;?></td>
                                        <td class="px-2 py-1 align-middle" ><?=$a->parking_area_no;?></td>
                                        <td class="px-2 py-1 align-middle" ><?=$a->arrival_time;?></td>
                                        <td class="px-2 py-1 align-middle text-center" ><?php if($a->status==0):?>
                                            <small class="text-white badge badge-primary badge-pill px-3 text-xs"><b>Parked</b></small>
                                            <?php else:?>
                                            <small class="text-white badge badge-success badge-pill px-3 text-xs"><b>Leaved</b></small>
                                        <?php endif;?></small></td>
                                        <td class="px-2 py-1 align-middle text-center"> 
                                            <button class="btn btn-light btn-sm border bg-light rounded-0 view_receipt" type="button" data-link="<?= base_url('admin/receipt/'.$a->id) ?>"><i class="fas fa-receipt fa-xs"></i> Receipt</button>                                    
                                        <?php // anchor_popup('admin/receipt/'.$a->id,'&nbsp; <i class="fas fa-eye fa-xs"></i> &nbsp;',['class'=>"btn btn-info btn-sm shadow-none"]);?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        
        var vehicle_tbl = $('#vehicle-tbl').dataTable({
            columnDefs:[
                { 'orderable':false, 'targets':[0,5]}
            ]
        })
        $('.view_receipt').click(function(){
            var nw = window.open($(this).attr('data-link'), '_blank', "width="+($(window).width() * .7)+",left="+($(window).width() * .15)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                    }, 300);
                }, 300);
        })
    })
</script>
<?php include('footer.php');?>
