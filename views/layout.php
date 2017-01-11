<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hackify</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <link rel=stylesheet href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">
</head>
<body>


<?php require_once('_require/nav.php') ?>
<?php require_once('_require/user_bar.php') ?>

<div class="container-fluid mb-4">
    <?php require_once('./routes.php') ?>
</div>

<?php include_once('_require/footer.php') ?>

</body>
</html>