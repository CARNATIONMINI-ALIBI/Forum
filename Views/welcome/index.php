<div id="loginRegisterField">
    <h2>Login if you are a member</h2>
    <h2>Register if you're not</h2>
</div>

<script>
    var loginRegisterField = document.getElementById('loginRegisterField');
    var loginButton = document.getElementById('loginButton');
    var registerButton = document.getElementById('registerButton');

    loginButton.addEventListener('click', function () {
        loginRegisterField.innerHTML = '<h2>Login</h2>' +
            '<label for="userLogin">Username</label>' +
            '<input type="text" id="userLogin"/>' +
            '<label for="passLogin">Password</label>' +
            '<input type="password" id="passLogin"/>' +
            '<button onclick="login();">Submit</button> ';
    });
    registerButton.addEventListener('click', function () {
        loginRegisterField.innerHTML = '<h2>Register</h2>' +
            '<label for="userRegister">Username</label>' +
            '<input type="text" id="userRegister"/>' +
            '<label for="passRegister">Password</label>' +
            '<input type="password" id="passRegister"/>' +
            '<label for="passRepeat">Repeat password</label>' +
            '<input type="password" id="passRepeat"/>' +
            '<button>Submit</button>';
    });


    function login() {
        $.post("<?=$this->url('users', 'login');?>", {
            username: $('#user').val(),
            password: $('#pass').val()
        }).done(function (response) {
            var json = $.parseJSON(response);
            if (json.success == 1) {
                window.location = "<?=$this->url('topics', 'all');?>";
            } else {
                $('#response').html('<h2 class="incorrect">' + 'Incorrect username or password' + '</h2>');
            }
        });
    }
</script>
<div id="response"></div>