<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin - <?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/stylesheets/style.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <button class="profile--avatar" id="toggleProfile">
                <img src="<?php echo base_url(); ?>assets/images/img_avatar.png">
            </button>
            <div class="profile--form">
                <h1>SELAMAT DATANG</h1>
                <div class="profile--fileds">
                    <form action="<?php echo base_url(); ?>index.php/loginMe" method="post">
                        <div class="field">
                            <label for="fieldUsername" class="label">Username</label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="field">
                            <label for="fieldPassword" class="label">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="profile--footer">
                            <button class="btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById('toggleProfile').addEventListener('click', function() {
            [].map.call(document.querySelectorAll('.profile'), function(el) {
                el.classList.toggle('profile--open');
            });
        });

        <?php
        if ($this->session->flashdata('error')) {
            echo "messagebox('" . $this->session->flashdata('error') . "')";
        }
        ?>
    </script>
</body>

</html>