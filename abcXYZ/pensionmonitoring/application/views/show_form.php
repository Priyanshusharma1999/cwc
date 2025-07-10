<html>
<head>
<title>Encryption In CodeIgniter</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="main">
<div id="show_form">
<h2>Encryption In CodeIgniter</h2>
<?php
echo form_open('Encryption/key_encoder');
echo "<div class='error_msg'>";
echo validation_errors();
echo "</div>";
echo form_label('Enter your Message');
$data = array(
'name' => 'key',
'placeholder' => 'Please Enter a Message'
);
echo form_input($data);
echo form_submit('submit', 'Encode');
echo form_close();
if (isset($decrypt_value) && $decrypt_value != NULL) {
echo form_fieldset('Decrypted Message', "class='result_decode'");
echo "<b>" . $decrypt_value . "</b>";
echo form_fieldset_close();
}
?>
</div>
</div>
<?php
if (isset($encrypt_value) && $encrypt_value != NULL) {
echo form_fieldset('Encrypted Message', "class='result_encode'");
echo "<b>" . $encrypt_value . "</b>";
echo form_fieldset_close();
echo "<div class='decode_form'>";
echo form_open('Encryption/key_decoder');
echo form_label('Decode Encrypted Message');
$data = array(
'name' => 'encrypt_key',
'value' => $encrypt_value
);
echo form_input($data);
echo form_submit('submit', 'Decode');
echo form_close();
echo "</div>";
}
?>
 

<style>
#main{
width:960px;
margin:50px auto;
font-family:raleway;
}
h2{
background-color: #FEFFED;
text-align:center;
border-radius: 10px 10px 0 0;
margin: -10px -40px;
padding: 30px;
}
hr{
border:0;
border-bottom:1px solid #ccc;
margin: 10px -40px;
margin-bottom: 30px;
}
#show_form{
width:300px;
float: left;
border-radius: 10px;
font-family:raleway;
border: 2px solid #ccc;
padding: 10px 40px 25px;
margin-top: 10px;
}
.result_encode{
position: absolute;
width: auto;
border-radius: 10px;
font-family: raleway;
border: 2px solid #ccc;
top: 400px;
padding: 30px;
word-wrap:break-word;
}
.result_decode{
position: absolute;
width: 500px;
border-radius: 10px;
font-family: raleway;
border: 2px solid #ccc;
top: 400px;
left: 302px;
padding: 30px;
word-wrap:break-word;
}
.decode_form{
position: absolute;
width: 300px;
float: right;
border-radius: 10px;
font-family: raleway;
border: 2px solid #ccc;
top: 540px;
left: 325px;
padding: 50px 40px 25px;
}
input[type=text]{
width:100%;
padding: 10px;
margin-top: 8px;
border: 1px solid #ccc;
padding-left: 5px;
font-size: 16px;
font-family:raleway;
background-color: #FEFFED;
}

input[type=submit]{
width: 100%;
background-color:#FFBC00;
color: white;
border: 2px solid #FFCB00;
padding: 10px;
font-size:20px;
cursor:pointer;
border-radius: 5px;
margin-bottom: 15px;
}
.error_msg{
color:red;
font-size: 16px;
}
</style>



