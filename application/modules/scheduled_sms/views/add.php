<div class="body">
	<?php echo form_open("$controller/save",array('class'=>'save-form')); ?>				

	<label for="division">Division <span class="required">*</span></label>
	<div class="form-group">
		<div class="form-group">
			<select name="division_id" class="form-control" data-placeholder="Select Division" id="division_id">
				<option value="">Select Division</option>
			</select>
		</div>
	</div>

	<label for="article">Article </label>
	<div class="form-group">
		<div class="form-group">
			<select name="article_id" class="form-control" data-placeholder="Select Article" id="article_id">
				<option value="">Select Article</option>
			</select>
		</div>
	</div>

	<div id="article-div" style="display:none;">
		<label class="form-label">Article Link</label>
		<div class="form-group">
			<div class="form-line">
				<input type="text" class="form-control" name="article_link" id="article_link" value="" readonly style="cursor:not-allowed;">
			</div>
		</div>
	</div>
	
	<!-- Default unchecked -->
	<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" value="1" name="sendsmsnowtest" id="sendsmsnowtest" onclick="loadDateDiv();">
		<label class="custom-control-label" for="sendsmsnowtest">Send SMS Now</label>
	</div>	
	

	<div id="datedivshow" style="display:blocked;">
	<label for="city_id">Send Date Time<span class="required">*</span></label>
	<div class="form-group">
		<div class="form-line">
			<div class="input-group date form_datetime col-md-5" data-date="" data-date-format="dd MM yyyy HH:ii p" data-link-field="dtp_input1" >
				<input class="form-control" size="16" name="sms_date" type="text" value="" readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
			</div>
		</div>
	</div>
	</div>				
	
	<label class="form-label">Message</label>
	<div class="form-group">
		<div class="form-line">
			<textarea  name="message" placeholder="Write Here..." onkeydown="limitTextOnKeyUpDown(this.form.message,this.form.countdown,1000);" onkeyup='limitTextOnKeyUpDown(this.form.message,this.form.countdown,1000);' class="form-control" ></textarea>
			You have <input readonly type="text" name="countdown" size="3" value="1000"> chars left<br/>	
		</div>
	</div>

	

	<input type="button" id="sendnowlink" class="btn btn-primary m-t-15 waves-effect" value="Send SMS" disabled onclick="DoFunc();" />
	<input type="submit" id="testclk" class="btn btn-success m-t-15 waves-effect" value="Schedule SMS" />
	<a href="<?php echo base_url("$controller/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
	<?php echo form_close(); ?>
</div>