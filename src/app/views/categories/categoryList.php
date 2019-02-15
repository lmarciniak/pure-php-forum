<?php foreach ($this->categories as $category) : ?>
    <div class='categoryList'>
        <h1> 
            <a href="<?php echo HTTP_SERVER . "forum/" . strtolower($category['name'])?>"> <?php echo $category['name'];?> </a> 
        </h1>      
    </div>
<?php endforeach; ?>