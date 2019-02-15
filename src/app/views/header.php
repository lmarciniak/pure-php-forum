<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo !empty($this->title) ? $this->title : ''; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo DIR_STYLE;?>main.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
<a href=<?php echo HTTP_SERVER;?>> HOMEPAGE </a> <br />
<?php if ($this->accessUser) : ?>
    <a href="<?php echo HTTP_SERVER . "user"; ?>"> <?php echo $this->userName; ?> </a> <br />
    <a href="<?php echo HTTP_SERVER . "logout"; ?>"> LOGOUT </a>
<?php else : ?>
    <a href="<?php echo HTTP_SERVER . "login"; ?>"> LOGIN </a> <br />
    <a href="<?php echo HTTP_SERVER . "signUp"; ?>"> CREATE ACCOUNT </a>
<?php endif; ?>
</div>
    <div id="container">
        <div id="content">