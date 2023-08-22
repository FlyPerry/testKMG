// я бы это написал на Jquery, но увы и ах, нельзя использовать стороние библиотеки
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("register-form");
    const registerButton = document.getElementById("register-button");
    const messageBox = document.getElementById("registration-message");

    // Тригер по нажатию на кнопку регистрации
    registerButton.addEventListener("click", function () {
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        // Указываем кто обрабатывает форму
        xhr.open("POST", "register.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        form.style.display = "none";
                        messageBox.style.display = "block";
                        messageBox.textContent = "Успешная регистрация!";
                    } else {
                        messageBox.style.display = "block";
                        messageBox.textContent = response.message;
                    }
                }
            }
        };
        xhr.send(formData);
    });
});
