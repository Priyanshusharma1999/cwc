/*Declartion of base url for using AJAX functionality*/
    
$(document).ready(function(){//jquery Starts

$.validator.addMethod("pwcheck", function(value) {

	//var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,70}$/;
	return /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,70}$/.test(value)
   /*return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[A-Z]/.test(value)
       && /[a-z]/.test(value) // has a lowercase letter
       
       && /\d/.test(value) // has a digit*/
}, 'Please enter password in format consits of one upper case,one lower case,one digit, one special character.');

/**************JS for Admin Login************/

  $('#user_login').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        email:{
            required : true
        },

        password:{
            required : true
           
        },

        CaptchaInput:{
            required : true,
           // number  : true,
            maxlength: 5
        },
       
       },

    messages: {
       
        password:{
           required : "Please enter password"
          
        },

         email:{
            required : "Please enter username or email"
        },

        CaptchaInput:{
            number   :  "Please enter number only",
            maxlength: "Please do not enter more than 5 digits",
            required : "Please enter captcha"
        },

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 


/**************JS for Add User************/

  $('#add_users').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        email:{
            required : true
        },
        
        role:{
            required : true
        },
        
        full_name:{
           required : true
        },
        
        mobile_no:{
            required : true,
            number  : true
        },

        password:{
            required : true
            //pwcheck : true
           
        },

         con_password:{
           required : true
           // pwcheck : true
          
        },
    
         user_name:{
            required : true
        },
        
        applicant_pic:{
            
            //accept: "image/jpeg, image/pjpeg"
            
            
        },
       
       },

    messages: {
        
        role:{
            required : "Please select role"
        },
        
        full_name:{
            required : "Please enter full name"
        },
        
        mobile_no:{
            required : "Please enter mobile number",
            number   :  "Please enter number only"
        },
       
        password:{
           required : "Please enter password"
          
        },
        
         con_password:{
           required : "Please enter confirm password"
          
        },

         email:{
            required : "Please enter email"
        },
        
         user_name:{
            required : "Please enter username"
        },
        
        applicant_pic:{
            
           // accept: "Only image type jpg/png/jpeg is allowed",
            // required : "Please enter image"
            
        },
        
      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 

/**********JS for edit users*******/

  $('#edit_users').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        email:{
            required : true
        },
        
        role:{
            required : true
        },
        
        full_name:{
           required : true
        },
        
        mobile_no:{
            required : true,
            number  : true
        },
    
         user_name:{
            required : true
        },
     
       
       },

    messages: {
        
        role:{
            required : "Please select role"
        },
        
        full_name:{
            required : "Please enter full name"
        },
        
        mobile_no:{
            required : "Please enter mobile number",
            number   :  "Please enter number only"
        },
       
         email:{
            required : "Please enter email"
        },
        
         user_name:{
            required : "Please enter username"
        },
       
        
      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 

/**************JS for Add Contact************/

  $('#add_contact').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        email:{
            required : true
        },
        
        name:{
            required : true
        },
        
        designation:{
           required : true
        },
        
        office_name:{
            required : true
        },

        office_address:{
            required : true
           
        },
        
        mobile_no:{
            required : true,
            number  : true
        },

         landline_no:{
            required : true,
            number  : true
        },
    
        division_name:{
            //required : true
        },
       },

    messages: {
        
        name:{
            required : "Please enter name"
        },
        
        designation:{
            required : "Please enter designation"
        },
        
        mobile_no:{
            required : "Please enter mobile number",
            number   :  "Please enter number only"
        },
        
        landline_no:{
            required : "Please enter landline number",
            number   :  "Please enter number only"
        },
       
        office_name:{
           required : "Please enter office name"
          
        },
        
         office_address:{
           required : "Please enter office address"
          
        },

         email:{
            required : "Please enter email"
        },
        
         division_name:{
            required : "Please select division"
        },

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 



/******************************************************************/

  $('#send_message').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        to_mail:{
            required : true
        },

        subject:{
            required : true
           
        },

       message:{
               
               required : true
        },

        attach_file:{

            accept: "jep | jpeg| csv| pdf| exel",
            filesize : 20480,
        },
       
       },

    messages: {
       
        to_mail:{
           required : "Please enter email"
          
        },

         subject:{
            required : "Please enter subject"
        },

         message:{
               
               required : "Please enter message"
        },

        attach_file:{

            accept: "Only jpeg, Png, jpeg, pdf, csv files are allowed.",
            filesize : "You can upload max filesize of 20 mb.",
        },

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 


/**************JS for history form admin*******/

    $('#search_form_history').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        organisation_name:{
            required : true
        },

        select_date:{
            required : true
        },

        
       
       },

    messages: {
       
        organisation_name:{
           required : "Please select organisation"
          
        },

         select_date:{
            required : "Please select date"
        },


         

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
});



});//jquery Ends
