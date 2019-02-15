<div id='secondary_nav'> 
    <a href="<?php echo HTTP_SERVER; ?>">Forum</a>
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
    <br /> <button> 
        <a href="<?php echo HTTP_SERVER . "forum/" . strtolower($this->title) . "/submit";?>"> Create new topic </a> </button>
<?php endif; ?>
<?php if (empty($this->topics)) : ?>
    <h1> There are no topics! </h1>
<?php endif; ?>
<?php foreach ($this->topics as $topic) : ?>
    <div class='topicList'>
        <h1> 
            <a href="<?php echo HTTP_SERVER . "forum/$this->title/" . $topic['id'] . "_" . $topic['topic_name'] ?>"> 
            <?php echo str_replace("_", " ", $topic['topic_name']); ?> </a>
        </h1>
        <h4>
            Author: <a href="<?php echo HTTP_SERVER . "user/" . $topic['user_name']?>"> 
            <?php echo $topic['user_name'];?></a>
        </h4>
        <h4>
            last active: <?php echo $topic['last_reply'];?>
        </h4>
    </div>
<?php endforeach; ?>