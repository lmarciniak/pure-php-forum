<div id='secondary_nav'> 
    <a href="<?php echo HTTP_SERVER; ?>">Forum</a> >
    <a href="<?php echo HTTP_SERVER . "forum/$this->category"; ?>"> <?php echo ucFirst($this->category);?></a>
</div>
    <div id="pagination">
        <?php if (!empty($this->pagination)) : ?>
            <?php foreach ($this->pagination as $key => $value) : ?>
                <button> <a href='<?php echo $value; ?>'> <?php echo $key; ?> </a> </button>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
    if ($this->accessUser) : ?>
        <a href="<?php echo $_SERVER['REDIRECT_URL'] . "/addPost"; ?>">Answer</a>
    <?php endif; ?>

<?php if (!empty($this->topicInfo)) : ?>
    <h1> <?php echo $this->title; ?> </h1>
    <div class="post">
        <h1> <a href="<?php echo HTTP_SERVER . "user/" . $this->topicInfo['owner'];?>"> 
            <?php echo $this->topicInfo['owner']; ?> </a> 
        </h1>
        <h4> <?php echo $this->topicInfo['created_at']; ?> </h4>
        <p> <?php echo $this->topicInfo['body']; ?> </p>
        <?php if ($this->accessAdmin) : ?>
            <button class='del' id="topic" ajaxurl='<?php echo HTTP_SERVER . "delete/topic/" . $this->topicInfo['id']; ?>'> DELETE TOPIC </button>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (!empty($this->posts)) : ?>
    <?php foreach ($this->posts as $post) : ?>
        <div class="post">
            <h1> <a href="<?php echo HTTP_SERVER . "user/" . $post['owner'] ?>"> 
                <?php echo $post['owner']; ?> </a> 
            </h1>
            <h4> <?php echo $post['created_at']; ?> </h4>
            <p> <?php echo $post['body']; ?> </p>
            <?php if ($this->accessAdmin) : ?>
                <button class='del' ajaxurl='<?php echo HTTP_SERVER . "delete/post/" . $post['id']; ?>'> DELETE </button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h1> <?php echo "There are no posts!"; ?> </h1>
<?php endif; ?>