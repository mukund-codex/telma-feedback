<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<link href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript">
 function loadDateDiv() {
    
      if(document.getElementById("sendsmsnowtest").checked == true) {
      		$("#datedivshow").toggle();
      		document.getElementById("sendnowlink").disabled = false;
      } else {
      	$("#datedivshow").toggle();
      	document.getElementById("sendnowlink").disabled = true;
      }
    
  	
   }
</script> 
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2><?= $pg_title ?></h2>
			</div>

			<div class="body">
				<?php echo form_open("$controller/save",array('id'=>'save-form')); ?>				

				<label for="city_id">Therapy Name<span class="required">*</span></label>
				<div class="form-group">
                    <div class="form-line">
					<select name="therapy_id" class="form-control" data-placeholder="Select Therapy" id="therapy_id">
						<option value="">Select Therapy</option>
						<?php foreach($therapies as $therapy) { ?>
							<option value="<?php echo $therapy->therapy_id; ?>"><?php echo $therapy->therapy_name; ?></option>
						<?php } ?>
					</select>
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
						<textarea  name="message" placeholder="Write Here..." onkeydown="limitTextOnKeyUpDown(this.form.message,this.form.countdown,128);" onkeyup='limitTextOnKeyUpDown(this.form.message,this.form.countdown,128);' class="form-control" ></textarea>
		        		You have <input readonly type="text" name="countdown" size="3" value="128"> chars left<br/>	
					</div>
						Message + To opt out, call on 09513666968
				</div>

				

                <input type="button" id="sendnowlink" class="btn btn-primary m-t-15 waves-effect" value="Send SMS" disabled onclick="DoFunc();" />
                <input type="submit" id="testclk" class="btn btn-success m-t-15 waves-effect" value="Schedule SMS" />
                <a href="<?php echo base_url("$controller/lists?c=$timestamp") ?>" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
     $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1


    });

     function limitTextOnKeyUpDown(limitField, limitCount, limitNum) {
     	console.log(limitField);
      if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
      } else {
        limitCount.value = limitNum - limitField.value.length;
      }
    }

    function DoFunc()
	{
	    if (confirm('Are you sure you want to send SMS now?'))
	    {
	        document.getElementById("testclk").click();
	    } else {
	    	document.getElementById("sendsmsnowtest").checked = false;
	    	$("#datedivshow").toggle();
	    	document.getElementById("sendnowlink").disabled = true;
	    }
	}

   function chk_send_now() {
   		dialog.confirm({
	        message: 'Do you really want to submit the form?',
	        confirm: function() {
	            console.log('yes');
	        },
	        cancel: function() {
	        	console.log('no');
	        }
	    });
   }
</script> 