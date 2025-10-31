
<?php if(!empty($this->session->flashdata('success'))): ?>
    <div class="alert alert-success mx-2 mb-3 rounded-0">
        <div class="d-flex w-100">
            <div class="col-11"><?= $this->session->flashdata('success') ?></div>
            <div class="col-1 text-right">
                <button class="close" type="button"><i class="fa fa-xs fa-times"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if(!empty($this->session->flashdata('error'))): ?>
    <div class="alert alert-danger mx-2 my-3 rounded-0">
        <div class="d-flex w-100">
            <div class="col-11"><?= $this->session->flashdata('error') ?></div>
            <div class="col-1 text-right">
                <button class="close" type="button"><i class="fa fa-xs fa-times"></i></button>
            </div>
        </div>
    </div>
<?php endif; ?>