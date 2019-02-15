        </div>
    </div>
<div id="footer"></div>
<?php if ((isset($this->js))) 
    foreach ($this->js as $js) : ?>
        <script type='text/javascript' src="<?php echo DIR_SCRIPT . "$js"?>"> </script>
<?php endforeach; ?>
</body>
</html>