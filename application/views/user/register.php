<?php echo form_open('user/register')?>
    <?php echo validation_errors('<p style="color:red">', ''); ?>
    <table cellspacing="10" cellspacing="0" border="0">
    <tr>
    	<td>
    <label>First Name:</label></td>
    	<td>
        <?php echo form_input('firstname')?></td></tr>
    <tr>
    	<td>
    <label>Last Name:</label></td>
    	<td><?php echo form_input('lastname')?></td></tr>
    <tr>
    	<td>
    <label>Email:</label></td>
    	<td><?php echo form_input('email')?>
    </label></td></tr>
    <tr>
    	<td>
    <label>Password:</label></td>
    	<td><?php echo form_password('password')?>
    </label></td></tr>
    <tr>
    	<td>
    <label>Confirm Password:</label></td>
    	<td><?php echo form_password('password_conf')?>
    </label>
    </td></tr></table>
    <input type="submit" value="Register">
</form>