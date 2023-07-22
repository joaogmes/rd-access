const Login = {
    init: () => {
        console.log("Login started");

        var loginSection = $("section.login-section");

        loginSection.off('click', '.loginAction').on('click', '.loginAction', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var login = $(`input[name="login"]`).val();
            var password = $(`input[name="password"]`).val();

            if(login && password){
                Login.postLogin(login, password);
            }else{
                Login.showError("empty");
            }

            return false;
        });
    },
    showError: (error) => {
        var title, message;
        switch (error) {
            case "empty":
                title = "Campos em branco!";
                message = "Informe corretamente seu login e senha."
                break;
        
            case "wrong":
                title = "Acesso negado!";
                message = "Seu login ou senha estão incorretos, verifique os dados e tente novamente.";
        }
        $("#feedbackModalLabel").html(title);
        $("#feedbackModal .modal-body").find("p").html(message);
        
        $("#feedbackModal").modal('show');
    },
    postLogin: (login, password) => {
        var loginData = { login: login, password: password };
        $.post("./login", JSON.stringify(loginData), function (data, status) {
            if(data){
                window.location.href="./manager";
            }else{
                Login.showError("wrong");
            }
        });
    }
}

Login.init();