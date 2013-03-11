<table width="400" class="table2" align="center" border="0" cellpadding="5">
  <tr>
    <th align="left"><h3>Log-In</h3></th>
  </tr>
  <tr>
    <td>
	<?php echo form_open('user/login')?> <?php echo validation_errors('<p style="color:red">', '</p>'); ?>
    
	<table width="400" border="0" cellpadding="5">
	  
      <?php if ($login_error):?>
      <tr><td style="color:red" colspan="2">Invalid Username or Password</td></tr>
      <?php endif; ?>
      <tr>
      	<td>Email:</td><td><?php echo form_input('email')?></td>
      </tr>
      <tr>
      	<td>Password:</td><td><?php echo form_password('password')?></td>
      </tr>
      </table>
      <p>
        <input type="submit" value="Login" name='submits'>
        | <?php echo anchor("user/register", "Register")?> </p>
      </form></td>
  </tr>
</table>
