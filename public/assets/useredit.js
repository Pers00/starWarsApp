 var btn = document.querySelector('#userupdatebtn');
 var pass1 = document.querySelector('#oldpassword');
 var pass2 = document.querySelector('#password');
 var pass3 = document.querySelector('#password-confirm');

 btn.addEventListener('click', function(event) {
     if (pass1.value != '' || pass2.value != '' || pass3.value != '') {
         pass1.setAttribute('required', true);
         pass2.setAttribute('required', true);
         pass3.setAttribute('required', true);

         if (pass2.value != pass3.value) {
             event.preventDefault();
         }
     }
     else {
         pass1.removeAttribute('required');
         pass2.removeAttribute('required');
         pass3.removeAttribute('required');
     }
 });
 