
document.addEventListener('DOMContentLoaded',function(){
    const registerForm  =document.getElementById('register-form');

    if(registerForm){
        registerForm.addEventListener('submit', function(event){
            event.preventDefault();

            // get form values
            const name = form.querySelector('input[name="name"]').value;
            const email = form.querySelector('input[name="email"]').value;
            const password = form.querySelector('input[name="password"]').value;
        })

        
    }



})