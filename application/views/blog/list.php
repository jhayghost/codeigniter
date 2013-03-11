<h1>Blog List</h1>
<div id="body">
<table width="50%" align="center" border="0" style="" class="table" cellspacing="0" cellpadding="5">
  <tr>
    <th scope="col" width="40">ID</th>
    <th scope="col">Title</th>
    <th scope="col" width="150">Time</th>
    <th scope="col" width="100">Action</th>
  </tr>
  <?php
  $query = $this->m_blog->bloglist();
 if ($query->num_rows() > 0){
  foreach ($query->result() as $row)
		{
  ?>
    <tr>
    <td><?php echo $row->id?></td>
    <td><?php echo $row->title?></td>
    <td><?php echo date("M d, Y H:i:s",strtotime($row->datetime))?></td>
    <td><a href="<?php echo site_url("blog/edit/".$row->id)?>">Edit</a> | <a href="<?php echo site_url("blog/delete/".$row->id)?>">Delete</a> </td>
  </tr>
<?php 	} 
	}?>
</table>
<p>&nbsp;</p>
</div>