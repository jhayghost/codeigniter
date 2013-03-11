<?php
if($status == '1') {?>
Successfully activated.  <a href="<?php echo site_url('user/login')?>">Log in now!</a><?php
}else{?>
Unable to activate
<?php }?>