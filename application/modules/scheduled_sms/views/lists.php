<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					ACTION
				</h2>
				<button type="button" class="header-dropdown m-r--5 btn btn-primary waves-effect clear-all">SHOW ALL</button>
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-2">
						<label for="from_date">Select Start Date: </label>
					</div>
					<div class="col-md-4">
						<input type="text" name="from_date" id="from_date" class="form-control" readonly="readonly" value="" autocomplete="off">
					</div>
					
					<div class="col-md-2">
						<label for="to_date">Select End Date: </label>
					</div>
					<div class="col-md-4">
						<input type="text" name="to_date" id="to_date" class="form-control" readonly="readonly" value="" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					<?= $pg_title ?>
				</h2>
				<ul class="header-dropdown m-r--5">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="material-icons">more_vert</i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li><a href="<?php echo base_url("$download_url") ?>" id="export" title="Export">Export</a></li>
							<li><a href="<?php echo base_url('scheduledsms/add') ?>" id="add_sms_balance" title="Add SMS Balance">Add Schedule SMS Data</a></li>
							<!-- <li><a href="<?php echo base_url('sms/addSmsBalance') ?>" id="add_sms_balance" title="Add SMS Balance">Add SMS Balance</a></li> -->
						</ul>
					</li>
				</ul>
			</div>
			<div class="body table-responsive">
				<?php echo form_open("$controller/remove",array('id'=>'frm_delete', 'name'=>'frm_delete')); ?>
					<table class="table table-striped table-condensed">
						<thead>
							<tr>
								<th>
									<input type="checkbox" name="" id="checkall" class="chk-col-<?= $active_theme; ?> filled-in">
									<label for="checkall" style="margin:0; vertical-align:bottom"></label>
								</th>
								
								<?php foreach ($columns as $headers) { ?>
								<th class="font-bold"><?= $headers ?></th>
								<?php } ?>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php include_once 'results.php'; ?>
						</tbody>
					</table>
					<a class="btn btn-danger deleteAction" href="#" data-type="ajax-loader"><i class="material-icons">remove_circle</i> <span>Delete</span></a>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<!-- #END# Basic Table -->

<div class="modal fade in" id="uploadbox" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<?php echo form_open("$controller/uploadcsv",array('id'=>'uploadForm', 'name'=>'frm_delete')); ?>

            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Upload CSV File</h4>
            </div>

            <div class="modal-body">
            	<div class="row" style="margin-bottom: 25px">
                	<div class="col-sm-3"><b>CSV columns: </b></div>
                	<div class="col-sm-9"><?php //echo implode('<span class="seperator"> | </span>', $csv_fields) ?></div>
                </div>
				
				<div class="form-group form-float">
					<div class="form-line focused">
						<input type="file" name="csvfile" class="form-control textfield" />
					</div>
				</div>

				<div id="show_msg" class="show_msg" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="upload-btn" class="btn btn-link waves-effect">Upload</button>
                <button type="button" class="btn btn-link waves-effect reset-upload" data-dismiss="modal">CLOSE</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
	var listing_url = "<?php echo $listing_url ?>";
	var download_url = "<?php echo $download_url ?>";

	
</script>