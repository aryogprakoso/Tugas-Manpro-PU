$(document).ready(function() {
    
    $(document).on("click", "#submitLogin", function(){
        $.ajax({
            type        : 'POST',
            url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_login',
            data        : {username: $("#inputUsername3").val(),
                           password: $("#inputPassword3").val()},       //Value - value yang dilempar ke url yang ditunjuk
            success     : function(data)
                        {
                            data = parseInt(data);
                            if(data == 1)
                            {

                                $("#errorLogin").html("");
                                location.reload();
                            }
                            else
                            {
                                $("#errorLogin").html(data);
                            }
                        }
        });
    });
    
    $(document).on("keypress", "#inputUsername3, #inputPassword3", function(e){
        if(e.keyCode == 13)
        {
            $.ajax({
                type        : 'POST',
                url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_login',
                data        : {username: $("#inputUsername3").val(),
                               password: $("#inputPassword3").val()},       //Value - value yang dilempar ke url yang ditunjuk
                success     : function(data)
                            {
                                data = parseInt(data);
                                if(data == 1)
                                {

                                    $("#errorLogin").html("");
                                    location.reload();
                                }
                                else
                                {
                                    $("#errorLogin").html("Username / Password Salah");
                                }
                            }
            });
        }
    });
    
    $(document).on("click", "#submitLogin", function(){
        $.ajax({
            type        : 'POST',
            url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_login',
            data        : {username: $("#inputUsername3").val(),
                           password: $("#inputPassword3").val()},       //Value - value yang dilempar ke url yang ditunjuk
            success     : function(data)
                        {
                            data = parseInt(data);
                            if(data == 1)
                            {

                                $("#errorLogin").html("");
                                location.reload();
                            }
                            else
                            {
                                $("#errorLogin").html(data);
                            }
                        }
        });
    });
    
    $(document).on("keypress", "#inputUsername, #inputPassword3", function(e){
        if(e.keyCode == 13)
        {
            $.ajax({
                type        : 'POST',
                url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_editPass',
                data        : {username: $("#inputUsername3").val(),
                               password: $("#inputPassword3").val()},       //Value - value yang dilempar ke url yang ditunjuk
                success     : function(data)
                            {
                                data = parseInt(data);
                                if(data == 1)
                                {

                                    $("#errorLogin").html("");
                                    location.reload();
                                }
                                else
                                {
                                    $("#errorLogin").html("Username / Password Salah");
                                }
                            }
            });
        }
    });
                   
})