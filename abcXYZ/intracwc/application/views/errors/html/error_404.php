<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>404 Page Not Found</title>

 <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">

<style type="text/css">

.error-box {background-color: #fff;border-radius: 5px;line-height: 1;margin: 0 auto;max-width: 475px;padding: 50px 30px 55px;text-align: center;width: 100%;}
.error-heading {font-size: 3.5em;font-weight: bold;}
.error-title {color: #2c2c2c;font-size: 22px;font-weight: normal;margin: 0 0 1.5rem;}
.error-wrapper {background-color: #fff;margin: 0;color: #4F5155;-moz-box-align: center;-moz-box-pack: center;align-items: center;display: flex;justify-content: center;height: 100%;}
.error-box h1 {font-size:150px;}
.error-box p {margin-bottom:30px;}
.error-box .btn {text-transform:uppercase;background-color: #1d6ad2;
    border: 1px solid #1d6ad2;color:#fff;}
</style>
</head>

<body>
    <div class="main-wrapper error-wrapper">
        <div class="error-box">
            <h1>404</h1>

            <h3><i class="fa fa-warning"></i> Oops! Page not found!</h3>

            <p>The page you requested was not found.</p>

            <a href="<?php echo base_url(); ?>" class="btn">Go to Main Page</a>
        </div>
    </div>
</body>

</html>