<section id="loginRegisterField">
    <h2>Login if you are a member</h2>
    <h2>Register if you're not</h2>
</section>

<script>
    var loginRegisterField = $('#loginRegisterField');
    var loginButton = $('#loginButton');
    var registerButton = $('#registerButton');

    loginButton.click(function () {
        loginRegisterField.html('<h2>Login</h2>' +
            '<label for="userLogin">Username</label>' +
            '<input type="text" id="userLogin"/>' +
            '<label for="passLogin">Password</label>' +
            '<input type="password" id="passLogin"/>' +
            '<button onclick="login();">Submit</button>');
            $('#response').html('');

    });
    registerButton.click(function () {

        loginRegisterField.html('<h2>Register</h2>' +
            '<label for="userRegister">Username</label>' +
            '<input type="text" id="userRegister"/>' +
            '<label for="passRegister">Password</label>' +
            '<input type="password" id="passRegister"/>' +
            '<label for="passRepeat">Repeat password</label>' +
            '<input type="password" id="passRepeat"/>' +
            '<button>Submit</button>');
        $('#response').html('');
    });


    function login() {
        $.post("<?=$this->url('users', 'login');?>", {
            username: $('#userLogin').val(),
            password: $('#passLogin').val()
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