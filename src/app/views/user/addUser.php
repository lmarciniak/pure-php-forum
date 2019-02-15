<?php echo isset($this->msg) ? $this->msg : ''; ?>
<form action="#" method="post">
    <input type="text" name="login" placeholder="username" value='<?php echo isset($this->login) ? $this->login : '' ?>'/> 
        <br />
        <?php echo isset($this->error['login']) ? $this->error['login'] : '' ?>
        <br /> <br />
    <input type="password" name="password1" placeholder="password" /> 
        <br /> 
        <?php echo isset($this->error['password']) ? $this->error['password'] : '' ?>
        <br /> <br /> 
    <input type="password" name="password2" placeholder="repeat password" /> 
        <br /> <br />
    <input type="submit" value="Sign Up!"/> <br /> <br />  
</form>