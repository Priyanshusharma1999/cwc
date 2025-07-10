/*Declartion of base url for using AJAX functionality*/

    

$(document).ready(function(){//jquery Starts


$.validator.addMethod(
    "maxfilesize",
    function (value, element) {
        if (this.optional(element) || ! element.files || ! element.files[0]) {
            return true;
        } else {
            return element.files[0].size <= 1024 * 1024 * 2;
        }
    },
    'File size can not exceed 2MB.'
);
/**************JS for Admin Login************/



  $('#admin_new_login,#applicannnt_logginn').validate({

    focusInvalid: false,

    ignore: "",

    rules: {

        user:{

            required : true

        },



        email:{

            required : true

        },



        password:{

            required : true

           

        },



        CaptchaInput:{

            required : true,

            maxlength: 5

        },

       

       },



    messages: {



        user:{

            required : "Please enter username"    

        },



        password:{

           required : "Please enter password"

          

        },



         email:{

            required : "Please enter email"

        },



        CaptchaInput:{

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



  /**************JS for Add Region************/



  $('#add_regionn,#add_circlee,#add_postt,#add_jobbss,#add_circullar').validate({

    focusInvalid: false,

    ignore: "",

    rules: {

        region_name:{

            required : true

        },



        circle_name:{

            required : true

        },



        post_name:{

            required : true

        },



        password:{

          required : true

          

        },



        post_code:{

            required : true

        },



        user_type:{

            required : true

        },



        user_name:{

            required : true

        },



        email:{

            required : true

        },



        contact_no:{

            required : true

        },



        refrence_no:{

            required : true

        },



        job_title:{

            required : true

        },



        total_vacancy:{

            required : true

        },



        post_name_code:{

            required : true

        },



        job_status:{

            required : true

        },



        start_date:{

            required : true

        },



        end_date:{

            required : true

        },



        circular_title:{

            required : true

        },



        circular_pdf:{

            required : true,
            maxfilesize: true,
            accept:"pdf"

        },

        user_pic:{

           // required : true,
            maxfilesize: true

        },

        

        user_id:{

            required : true

        },

       },



    messages: {



        region_name:{

            required : "Please enter region name."    

        },



        circle_name:{

             required : "Please enter circle name."    

        },



        post_name:{

            required : "Please enter post name." 

        },



        post_code:{

             required : "Please enter post code." 

        },



        password:{

          required : "Please enter password." 

          

        },



        user_type:{

            required : "Please enter user type."  

        },



        user_name:{

            required : "Please enter user name."  

        },



        email:{

           required : "Please enter email."  

        },



        contact_no:{

            required : "Please enter contact no."  

        },



         refrence_no:{

           required : "Please enter refrence no."

        },



        job_title:{

            required : "Please enter job title."

        },



        total_vacancy:{

            required : "Please enter total vacancy."

        },



        post_name_code:{

            required : "Please enter post name and code."

        },



        job_status:{

            required : "Please select job status."

        },



        start_date:{

            required : "Please enter start date."

        },



        end_date:{

            required : "Please enter end date."

        },



        circular_title:{

            required : "Please enter circulat title."

        },



        circular_pdf:{

            required : "Please enter circular pdf.",
            accept: "Please select only pdf files"

        },



        user_id:{

           required : "Please enter userid."

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



  /***********JS for applicant registeration**********/



   $('#applicannnt_register').validate({

    focusInvalid: false,

    ignore: "",

    rules: {

        applicant_name:{

            required : true

        },



        email:{

            required : true

        },

        check_terms_condn:{

            required : true

        },



        mobile_no:{

            required : true

        },



        gender:{

            required : true

        },



        dob:{

            required : true

        },



        password:{

            required : true

        },



        CaptchaInput:{

            required : true,
          

            maxlength: 5

        },



       

       },



    messages: {



        applicant_name:{

            required : "Please enter applicant name"    

        },



        email:{

            required : "Please enter email"    

        },



        mobile_no:{

            required : "Please enter mobile no."

        },

         check_terms_condn:{

            required : "Please check terms & conditions."

        },

        gender:{

            required : "Please enter gender"

        },



        dob:{

            required : "Please enter date of birth"

        },



        password:{

            required : "Please enter password"

        },



         CaptchaInput:{

            required : "Please enter captcha input",

            maxlength: "Please don't enter more than 5 number"

        },



      



      },

            errorElement: "div",

            wrapper: "div",

            errorPlacement: function(error, element) {

            offset = element.offset();

            error.insertAfter(element)

            error.css('color','red');

            },

 

}); //ends function

      /*otp verify*/


   $('#otp_form').validate({

    focusInvalid: false,

    ignore: "",

    rules: {

        otp:{

            required : true

        },
       },



    messages: {



        otp:{

            required : "Please enter otp"    

        },



        
      },

            errorElement: "div",

            wrapper: "div",

            errorPlacement: function(error, element) {

            offset = element.offset();

            error.insertAfter(element)

            error.css('color','red');

            },

 

}); //ends function





});//jquery Ends

