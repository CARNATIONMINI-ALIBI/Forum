<input type="text" id="user"/>
<input type="text" id="pass"/>

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