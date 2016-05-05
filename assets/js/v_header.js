$(document).ready(function() {
    
    $(document).on("click", "#submitLogin", function(){
        $.ajax({
            type        : 'POST',
            url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_login',
            data        : {username: $("#inputUsername3").val(),
                           password: $("#inputPassword3").val()},       //Value - value yang dilempar ke url yang ditunjuk
            success     : function(data)
                        {
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
    
    
    $(document).on("click", "#submitEditPass", function(){
        var passLama = $("#inputEditPasswordLama").val();
        var passBaru = $("#inputEditPasswordBaru").val();
        var passKonfirm = $("#inputKonfirmasiPasswordBaru").val();
        if(passBaru == passKonfirm)
        {
            $.ajax({
            type        : 'POST',
            url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_editPass',
            data        : {username: $("#inputEditUsername").val(),
                           passwordLama: passLama,
                           passwordBaru: passBaru},       //Value - value yang dilempar ke url yang ditunjuk
            success     : function(data)
                        {
                            if(data == 1)
                            {

                                $("#errorEditPass").html("");
                                location.reload();
                            }
                            else
                            {
                                $("#errorEditPass").html("Password Lama salah");
                            }
                        }
            });
        }
        else
        {
            $("#errorEditPass").html("Password Baru dan Konfirmasi Password Baru berbeda");
        }
        
    });
    
    $(document).on("keypress", "#inputKonfirmasiPasswordBaru, #inputEditPasswordLama, #inputEditPasswordBaru", function(e){
        if(e.keyCode == 13)
        {
            var passLama = $("#inputEditPasswordLama").val();
            var passBaru = $("#inputEditPasswordBaru").val();
            var passKonfirm = $("#inputKonfirmasiPasswordBaru").val();
            if(passBaru == passKonfirm)
            {
                $.ajax({
                type        : 'POST',
                url         : 'http://localhost/pendeta_universitas/index.php/c_beranda/do_editPass',
                data        : {username: $("#inputEditUsername").val(),
                               passwordLama: passLama,
                               passwordBaru: passBaru},       //Value - value yang dilempar ke url yang ditunjuk
                success     : function(data)
                            {
                                if(data == 1)
                                {

                                    $("#errorEditPass").html("");
                                    location.reload();
                                }
                                else
                                {
                                    $("#errorEditPass").html("Password Lama salah");
                                }
                            }
                });
            }
            else
            {
                $("#errorEditPass").html("Password Baru dan Konfirmasi Password Baru berbeda");
            }
        }
    });
                   
})