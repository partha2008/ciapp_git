<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<?php echo $head;?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">
						<?php if($this->session->userdata('login_error') == 'true'){?>
						<div class='alert alert-danger alert-dismissable'>Incorrect Username/Password. Please try again!</div>
						<?php }  $this->session->unset_userdata('login_error'); ?>
						<form action="<?php echo site_url('admin/user/process_login');?>" method="POST" role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $footer;?>	