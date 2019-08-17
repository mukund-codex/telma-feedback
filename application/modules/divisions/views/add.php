<?php echo form_open("divisions/save",array('class'=>'save-form')); ?>
<label class="form-label">Division Name<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="text" id="division_name" name="division_name" class="form-control" autocomplete="off" placeholder="Division Name">
    </div>
</div>

<label class="form-label">Sender Id<span class="required">*</span></label>
<div class="form-group">
    <div class="form-line">
        <input type="tel" id="sender_id" name="sender_id" class="form-control" autocomplete="off" placeholder="Sender ID." maxlength="10">
    </div>
</div>

<button type="submit" class="btn btn-primary m-t-15 waves-effect">
    <i class="material-icons">save</i>
    <span>Save</span>
</button>

<a href="<?php echo base_url("divisions/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">
    <i class="material-icons">reply_all</i>	
    <span>Cancel</span>
</a>
<?php echo form_close(); ?>

<?php echo $this->load->view('template/popup/popup-box') ?>