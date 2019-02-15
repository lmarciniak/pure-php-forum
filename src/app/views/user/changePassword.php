<div id="msg"> 
<?php if (isset($this->msg)) : ?>
    <?php foreach ($this->msg as $msg) : ?>
        <p> <?php echo $msg; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<form action="#" method="post">
    <input type="password" name="old_password" id="old_password" placeholder="current password" /> 
        <br /> <br />
    <input type="password" name="new_password" id="new_password" placeholder="new password" /> 
        <br /> <br />
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password" /> 
        <br /> <br />
    <input type="submit" value="Change password" />
</form>