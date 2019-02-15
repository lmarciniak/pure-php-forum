<form method="post" action="#">
    <input type="text" placeholder="login" name="login" />
        <br /> <br />
    <input type="password" placeholder="password" name="password" /> 
        <br /> <br />
    <input type="submit" value="Log in" /> 
        <br /> <br />
</form>
<?php echo isset($this->error) ? $this->error : ''; ?>