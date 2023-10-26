<?php include('./includes/header.php'); ?>
<?php session_start(); ?>
<div class="mainContainer">
    <div class="leftPage">
        <h1 class="leftTitle">Práctica</h1>
        <?php include('./includes/login.php'); ?>
    </div>
    <div class="rightPage">
        <h1 class="rightTitle">Profesional II</h1>
        <?php include('./includes/register.php'); ?>
    </div>
</div>
<!-- <script src="../assets/js/form-validation.js"></script> -->
<?php include('./includes/footer.php'); ?>