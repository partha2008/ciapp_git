	<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
	?>
		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/scripts/jquery.min.js"></script>
		
		<!-- Custom JS File -->
		<script src="<?php echo base_url(); ?>assets/scripts/custom.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo base_url(); ?>assets/scripts/bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="<?php echo base_url(); ?>assets/scripts/metisMenu.min.js"></script>

		<!-- Custom Theme JavaScript -->
		<script src="<?php echo base_url(); ?>assets/scripts/sb-admin-2.js"></script>
		
		<!-- CK Editor -->
		<script src="<?php echo base_url(); ?>assets/lib/ckeditor/ckeditor.js"></script>
		
		<!-- jQuery UI JS FILE -->
		<script src="<?php echo base_url(); ?>assets/scripts/jquery-ui-1.12.1.js"></script>
		
		<script>
			$(function () {
				// Replace the <textarea id="term"> with a CKEditor
				// instance, using default configuration.
				if($("#term").length > 0){
					CKEDITOR.replace('term');
				}
				
				// jQuery Datepicker
				$('#created_date').datepicker({ dateFormat: 'mm-dd-yy' });
				$('#proofsent_date').datepicker({ dateFormat: 'mm-dd-yy' });
				$('#proofapproved_date').datepicker({ dateFormat: 'mm-dd-yy' });
				$('#mail_date').datepicker({ dateFormat: 'mm-dd-yy' });			
			});
		</script>

	</body>
	</html>