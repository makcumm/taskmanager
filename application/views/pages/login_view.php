<?php
/**
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="container">
	<section id="global">
		<div class="span4 offset4" style="padding: 25px 0;">
			<h1>Войдите пожалуйста</h1>
			<?php if ( @$error ) : ?><div class="alert alert-error"><?php echo $error; ?></div><?php endif; ?>
			<?php if ( @$success ) : ?><div class="alert alert-success"><?php echo $success; ?></div><?php endif; ?>
			<?php
			echo form_open( 'login/sign_in' );
				echo form_fieldset();
			?>
					<?php
						$email_conf = array(
							'name' => 'email',
							'placeholder' => 'Войти с помощью Email'
						);
						echo form_input( $email_conf );

						$pass_conf = array(
							'name' => 'password',
							'placeholder' => 'Пароль'
						);
						echo form_password( $pass_conf );
					?> <br />
					<?php  ?><br />
					<?php echo form_submit( 'submit', 'Войти' ); ?>
					<?//php echo anchor( 'login/signup', 'Создать пользователя' ); ?>

			<?php
				echo form_fieldset_close();
			echo form_close();
			?>
		</div>
	</section>
</div>
