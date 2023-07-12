document.addEventListener('DOMContentLoaded', () => {
    initForm();
    emailInputIsTyping();

    function emailInputIsTyping(){
        const form = document.querySelector('.ajax-form');
        const formEmailInput = form.querySelector('input[name="email"]')
        const formSubmitButton = form.querySelector('input[type="submit"]')

        formEmailInput.addEventListener('input', (event) => {
            formSubmitButton.classList.remove('hidden');
        })
    }



    function initForm(){
        const form = document.querySelector('.ajax-form');
        const formSubmitButton = form.querySelector('input[type="submit"]')

        form.addEventListener('submit', async (event) => {
            event.preventDefault();


            const data = new FormData(form);

            $email = data.get('email')

            console.log(validateEmail($email));

            if (validateEmail($email) != null) {
                const response = await fetch('/add', {
                    method: 'post',
                    body: data
                })

                $responseJson = await response.json();

                if ($responseJson.error) {
                    formSubmitButton.classList.add('hidden')
                } else {
                    alert('Форма отправлена')
                }
            } else {
                alert('Неверный формат почты')
            }

        })
    }



    const validateEmail = (email) => {
        return String(email)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
    };
});