<h1>Blog Form</h1>
<div id="body">
<?php echo form_open('blog/'.( ( count( $this->m_blog->data ) > 0 )? 'edit/'.$this->m_blog->data->id : 'create') )?>
    <?php echo validation_errors('<p style="color:red">', ''); ?>
    <label>Title:<br />
        <?php echo form_input('title',$this->m_blog->getFieldData("title"))?>
    </label><br>
    <label>Author :<br />
        <?php echo form_input('author',$this->m_blog->getFieldData("author"))?>
    </label><br>
    <label>Body:<br />
        <?php echo form_textarea('body',$this->m_blog->getFieldData("body"))?>
    </label><br>
    <input type="submit" value="Submit">
</form>
</div>