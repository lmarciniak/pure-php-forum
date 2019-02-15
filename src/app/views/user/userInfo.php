<?php if (isset($this->userInfo)) : ?>
    <div id="userInfo"> 
        <h1> <?php echo $this->userInfo['name']; ?> </h1>
        <h3> has account for: <?php echo $this->userInfo['diff']; ?></h3>
    </div>
<?php endif;?>