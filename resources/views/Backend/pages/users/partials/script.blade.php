 <script>
     // initialize id of password field and confirm password field
     const my_password = document.querySelector('#password');
     const my_confirm_password = document.querySelector('#confirm_password');

     function togglePassView(thisItem) {

         //  here we check conditionally that which field will be toggle based on different class name
         if (thisItem.classList.contains('togglePassword')) {
             // input type check for password
             const type = my_password
                 .getAttribute('type') === 'password' ?
                 'text' : 'password';

             //change password attribute
             my_password.setAttribute('type', type);

             //  Toggle the class name with(fa-eye-slash) to change class after click
             $(thisItem).toggleClass('fa-eye-slash');
         }

         //  here we check conditionally that which field will be toggle based on different class name
         if (thisItem.classList.contains('toggleConfirmPassword')) {
             // input type check for confirm password
             const type = my_confirm_password
                 .getAttribute('type') === 'password' ?
                 'text' : 'password';

             //change password attribute
             my_confirm_password.setAttribute('type', type);

             //  Toggle the class name with(fa-eye-slash) to change class after click
             $(thisItem).toggleClass('fa-eye-slash');
         }
     }


     //jquery multi select code 
     $(function() {
         $('select[multiple].active.3col').multiselect({
             columns: 3,
             placeholder: 'Select States',
             search: true,
             searchOptions: {
                 'default': 'Search States'
             },
             selectAll: true
         });
     });
 </script>
