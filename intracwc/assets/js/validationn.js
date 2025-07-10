/*Declartion of base url for using AJAX functionality*/
    
$(document).ready(function(){//jquery Starts


/**************JS for User Login************/

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


/**************JS for Item************/

  $('#add_item').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        category:{
            required : true
        },
		
		subcategory:{
            required : true
        },
		
		itemtype:{
            required : true
        },

        itemname:{
            required : true
           
        },

        unit:{
            required : true
        },

        minqty:{
                  required : true
               },


        stockqty:{
                   required : true
                },

       
       },

    messages: {
       
        category:{
           required : "Please select category."
          
        },
		
		subcategory:{
            required : "Please select sub category."
        },
		
		itemtype:{
            required : "Please select item type."
        },

         itemname:{
            required : "Please enter item name."
        },

         unit:{
           required : "Please enter unit."
          
        },

         minqty:{
            required : "Please enter minimum quantity."
        },

        stockqty:{
           required : "Please enter stock quantity."

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


  $('#add_itemtype').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        item_type:{
            required : true
        },

        itemtype_description:{
            required : true
           
        }
       
       },

    messages: {
       
        item_type:{
           required : "Please enter item type"
          
        },

         itemtype_description:{
            required : "Please enter item type description"
        }

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 

/**************JS for Category************/

  $('#add_category').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        category_name:{
            required : true
        },

        category_shortname:{
            required : true
           
        },
       
       },

    messages: {
       
        category_name:{
            required : "Please enter category"
        },

        category_shortname:{
            required : "Please enter category shortname"
           
        }
      },
	  
		errorElement: "div",
		wrapper: "div",
		errorPlacement: function(error, element) {
		offset = element.offset();
		error.insertAfter(element)
		error.css('color','red');
		},
 
}); 

/**************JS for Category************/

  $('#add_subcategory').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
		
		category_name:{
            required : true
        },
		
        subcategory_name:{
            required : true
        },

        subcategory_shortname:{
            required : true
           
        },
       
       },

    messages: {
		
		category_name:{
            required : "Please select category"
        },
       
        subcategory_name:{
            required : "Please enter sub category"
        },

        subcategory_shortname:{
            required : "Please enter sub category shortname"
           
        }
      },
	  
		errorElement: "div",
		wrapper: "div",
		errorPlacement: function(error, element) {
		offset = element.offset();
		error.insertAfter(element)
		error.css('color','red');
		},
 
}); 


  /**************JS for Bill************/

  $('#entry_bill').validate({
    focusInvalid: false,
    ignore: "",
    rules: {

        billdate:{
            required : true
        },

        billno:{
            required : true
           
        },

        shopname:{
            required : true
        },

        address:{
                  required : true
               },

        totalamount:{
           required : true
        },

       
       },

    messages: {
       
        
        billdate:{
            required :"Please enter bill date."
        },

        billno:{
            required : "Please enter bill no."
           
        },

        shopname:{
            required : "Please enter name."
        },

        address:{
                  required : "Please enter address."
               },

        totalamount:{
           required : "Please enter total amount."
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



/**************JS for Add Complain************/

  $('#add_complain').validate({
    focusInvalid: false,
    ignore: "",
    rules: {

        category:{
            required : true
        },
        
        description:{
            required : true
        },
        
        building:{
           required : true
        },
        
        room:{
            required : true
        },

        empname:{
            required : true
           
        },
        
         designation:{
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
    
       },

    messages: {
        
        category:{
            required : "Please select category"
        },
        
        description:{
            required : "Please enter description"
        },
        
        mobile_no:{
            required : "Please enter mobile number",
            number   :  "Please enter number only"
        },
        
        landline_no:{
            required : "Please enter landline number",
            number   :  "Please enter number only"
        },
       
        building:{
           required : "Please select building"
          
        },
        
         room:{
           required : "Please select room no"
          
        },

         empname:{
            required : "Please enter name"
        },
        
         designation:{
            required : "Please select designation"
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



/**************JS for Vaidation abhinavg************/

  $('#add_building,#add_designation,#add_office,#add_room,#add_wing,#add_section,#add_employee,#add_user,#add_vendor,#add_vendoremployee,#add_organisation,#add_post,#add_designation,#add_contact,#edit_profile').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        building_name:{
            required : true
        },
		
		office_name:{
            required : true
        },
		
		office_description:{
            required : true
        },
        
        building_short_name:{
            required : true
        },

        designation_name:{
            required : true
        },

        designation_short_name:{
            required : true
        },

        rank:{
            required : true
        },

        ser_no:{
            required : true
        },

        room_name:{
            required : true
        },

        wing_name:{
            required : true
        },

        wing_short_name:{
            required : true
        },

        section_name:{
            required : true
        },

        section_short_name:{
            required : true
        },

        employee_code:{
            required : true
        },

        employee_name:{
            required : true
        },

        employee_post:{
            required : true
        },

        employee_designation:{
            required : true
        },

        employee_mobile:{
            required : true
        },

        employee_landline_no:{
            required : true
        },

        employee_email:{
            required : true
        },

        room_id:{
            required : true
        },

        employee_intercom:{
            required : true
        },

        'user_role[]':{
            required : true
        },

        user_name:{
            required : true
        },

        display_name:{
            required : true
        },

        contact_no:{
            required : true
        },

        email:{
            required : true
        },

       

        user_id:{
            required : true
        },

        password:{
            required : true
        },

        cnfrm_password:{
            required : true
        },

        company_name:{
            required : true
        },

        order_no:{
            required : true
        },

        address:{
            required : true
        },

        vendorlandline_no:{
            required : true
        },

        contact_valid_till:{
            required : true
        },

        complaint_type:{
            required : true
        },

        estimated_time:{
            required : true
        },

        vendor_id:{
            required : true
        },

        organisation_name:{
            required : true
        },
        post_name:{
            required : true
        },
        mobile_no:{
            required : true,
            number  : true
        },

        office_no:{
            required : true,
            number  : true
        },

        res_no:{
            required : true,
            number  : true
        },

        room_no:{
            required : true
        },

        extension_no:{
            required : true
        },

        fax_no:{
            required : true
        },

        office_address:{
            required : true
        },

        state:{
            required : true
        },

        city:{
            required : true
        },

        pincode:{
            required : true
        },

        service_type:{

            required : true
        },
   
       },

    messages: {
        
        building_name:{
            required : "Please enter building name"
        },
        
        building_short_name:{
            required : "Please enter building short name"
        },
		
		office_name:{
            required : "Please enter office name"
        },
		
		office_description:{
            required : "Please enter office description"
        },

        designation_name:{
            required : "Please enter designation name"
        },

        designation_short_name:{
            required : "Please enter designation short name"
        },

        rank:{
            required : "Please select rank"
        },

        ser_no:{
            required : "Please Enter Serial No"
        },

        room_name:{
            required : "Please enter room name"
        },

        wing_name:{
            required : "Please enter wing name"
        },

        wing_short_name:{
            required : "Please enter wing short name"
        },
        
        section_name:{
            required : "Please enter section name"
        },

        section_short_name:{
            required : "Please enter section short name"
        },

        employee_code:{
            required : "Please enter employee code"
        },

        employee_name:{
            required : "Please enter employee name"
        },

        employee_post:{
            required : "Please enter employeet post"
        },

        employee_designation:{
            required : "Please enter employee designation"
        },

        employee_mobile:{
            required : "Please enter employee mobile no."
        },

        employee_landline_no:{
            required : "Please enter employee landline  no."
        },

        employee_email:{
            required : "Please enter employee email"
        },

        room_id:{
            required : "Please select room"
        },

        employee_intercom:{
            required : "Please enter employee intercom"
        },

        'user_role[]':{
            required : "Please select role"
        },

        user_name:{
            required : "Please select name"
        },

        display_name:{
            required : "Please enter display name"
        },

        contact_no:{
            required : "Please enter contact no."
        },

        email:{
            required : "Please enter email"
        },

       

        user_id:{
            required : "Please enter user id"
        },

        password:{
            required : "Please enter password"
        },

        cnfrm_password:{
            required : "Please enter confirm password"
        },

         company_name:{
           required : "Please enter company name"
        },

        order_no:{
            required : "Please enter order no"
        },

        address:{
            required : "Please enter address"
        },

        vendorlandline_no:{
            required : "Please enter landline no."
        },

        contact_valid_till:{
            required : "Please enter contact valid till"
        },

        complaint_type:{
            required : "Please select category"
        },

        estimated_time:{
            required : "Please enter estimated time"
        },

         organisation_name:{
            required : "Please enter organisation name"
        },

        post_name:{
            required : "Please enter post name"
        },
        mobile_no:{
            required : "Please enter mobile number",
            number   :  "Please enter number only"
        },

        office_no:{
           required : "Please enter office number",
            number   :  "Please enter number only"
        },

        res_no:{
            required : "Please enter residence number",
            number   :  "Please enter number only"
        },

        room_no:{
            required : "Please enter room number",
        },

        extension_no:{
            required : "Please enter extension number",
        },

        fax_no:{
            required : "Please enter fax number",
        },

        office_address:{
            required : "Please enter office address",
        },

        state:{
            required : "Please select state",
        },

        city:{
            required : "Please select city",
        },

        pincode:{
            required : "Please enter pincode",
        },

        service_type:{

            required : "Please select service type",
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
