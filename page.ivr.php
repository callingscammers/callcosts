<?php 
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

/* $Id$ */
dbug('page',$_POST);
$get_vars = array(
				'action' 		=> '',
				'id'			=> '',
				'display'		=> ''
);
foreach ($get_vars as $k => $v) {
	$var[$k] = isset($_REQUEST[$k]) ? $_REQUEST[$k] : $v;
	$$k = $var[$k];//todo: legacy support, needs to GO!
}
if(!$astman){
	dbug(_("No Astman, Not loading IVR"));
	echo "<h1>"._("Connection Error")."</h1>";
	echo '<div class="well well-danger">';
	echo _("A connection to Asterisk Manager could not be made. This module requires Asterisk to be running and have proper credentials");
	echo '</div>';
}else{
	if (!$action && !$id) {
	?>
	<div class="container-fluid">
		<h1><?php echo _('IVR')?></h1>
		<div class = "display full-border">
			<div class="row">
				<div class="col-sm-9">
					<div class="fpbx-container">
						<div class="display full-border">
							<table id="ivrgrid" data-url="?display=ivr&action=getJSON&jdata=grid&quietmode=1" data-cache="false" data-height="299" data-toggle="table" class="table table-striped">
	    						<thead>
	 								<tr>
	        							<th data-field="name"><?php echo _("IVR Name")?></th>
	        							<th data-field="link" data-formatter="actionFormatter"><?php echo _("Actions")?></th>
	    							</tr>
	    						</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="col-sm-3 hidden-xs bootnav">
					<div class="list-group">
						<?php echo load_view(__DIR__.'/views/rnav.php')?>
					</div>
				</div>
			</div>
		</div>
	</div>

		


	<?php
	}else{
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		$id 	= isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

		echo load_view(__DIR__.'/views/form.php', array('request' => $_REQUEST));	
	}
}
