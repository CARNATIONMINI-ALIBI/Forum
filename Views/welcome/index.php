<div id="login">
    <label for="userLogin">Username</label>
    <input type="text" id="userLogin"/>
    <label for="passLogin">Password</label>
    <input type="password" id="passLogin"/>
    <button>Submit</button>
</div>
<div id="register">
    <label for="userRegister">Username</label>
    <input type="text" id="userRegister"/>
    <label for="passRegister">Password</label>
    <input type="password" id="passRegister"/>
    <label for="passRepeat">Repeat password</label>
    <input type="password" id="passRepeat"/>
    <button>Submit</button>
</div>

<script>
    
function login() {
    $.post( "<?=$this->url('users', 'login');?>", { 
        username: $('#user').val(), 
        password: $('#pass').val()
    }).done(function( response ) {
        var json = $.parseJSON(response);
        if (json.success == 1) {
            window.location = "<?=$this->url('topics', 'all');?>";
        } else {
            $('#response').html("<h1>" +  json.msg  + "</h1>");
        }
    });
}
</script>
<a href="#" onclick="login()">Login</a>
<div id="response"></div>