<?php
$this->m_user->getUser();

echo "<p>Name: ".$this->m_user->data->firstname.' '. $this->m_user->data->lastname."</p>";
echo "<p>Email: ".$this->m_user->data->email."</p>";
echo "<p>Last Login: ".date("M d, Y H:i:s",strtotime($this->m_user->data->lastlogin))."</p>";
echo "<p>Registered: ". date("M d, Y H:i:s",strtotime($this->m_user->data->datetime))."</p>";
?>
