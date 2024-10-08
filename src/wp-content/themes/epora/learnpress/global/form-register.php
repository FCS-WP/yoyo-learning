<?php
/**
 * Template for displaying global login form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/form-register.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<div class="learn-press-form-register learn-press-form">

	<h3><?php echo esc_html_x( 'Register', 'register-heading', 'epora' ); ?></h3>

	<?php do_action( 'learn-press/before-form-register' ); ?>

	<form name="learn-press-register" method="post" action="">

		<ul class="form-fields">

			<?php do_action( 'learn-press/before-form-register-fields' ); ?>

			<li class="form-field">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'epora' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_email" name="reg_email" type="text" placeholder="<?php esc_attr_e( 'Email', 'epora' ); ?>" autocomplete="email" value="<?php echo ( ! empty( $_POST['reg_email'] ) ) ? esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_email'] ) ) : ''; ?>">
			</li>
			<li class="form-field">
				<label for="reg_username"><?php esc_html_e( 'Username', 'epora' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_username" name="reg_username" type="text" placeholder="<?php esc_attr_e( 'Username', 'epora' ); ?>" autocomplete="username" value="<?php echo ( ! empty( $_POST['reg_username'] ) ) ? esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_username'] ) ) : ''; ?>">
			</li>
			<li class="form-field">
				<label for="reg_password"><?php esc_html_e( 'Password', 'epora' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password" name="reg_password" type="password" placeholder="<?php esc_attr_e( 'Password', 'epora' ); ?>" autocomplete="new-password">
			</li>
			<li class="form-field">
				<label for="reg_password2"><?php esc_html_e( 'Confirm Password', 'epora' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password2" name="reg_password2" type="password" placeholder="<?php esc_attr_e( 'Password', 'epora' ); ?>" autocomplete="off">
			</li>

			<?php do_action( 'learn-press/after-form-register-fields' ); ?>
		</ul>

		<?php do_action( 'register_form' ); ?>

		<p>
			<?php wp_nonce_field( 'learn-press-register', 'learn-press-register-nonce' ); ?>
			<button type="submit"><?php esc_html_e( 'Register', 'epora' ); ?></button>
		</p>

	</form>

	<?php do_action( 'learn-press/after-form-register' ); ?>

</div>
