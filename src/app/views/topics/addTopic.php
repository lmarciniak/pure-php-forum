<div id='secondary_nav'> 
     <a href="<?php echo HTTP_SERVER; ?>"> Forum </a> >
     <a href="<?php echo HTTP_SERVER . "forum/$this->category"; ?>"> <?php echo ucFirst($this->category); ?> </a>
</div>
<?php echo isset($this->msg) ? $this->msg : ''; ?>
<form action="#" method="POST">
    <input type="text" placeholder="topic name" name="topic_name" /> <br /> <br />
    <textarea name="body"> </textarea> <br /> <br />
    <input type="submit" value="submit" />
</form>

