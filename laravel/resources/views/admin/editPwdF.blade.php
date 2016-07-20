<script>
    $(function(){
        var btn = $(".btn_confirm");
        btn.click(function(){
            $.ajax({
                url:'{{url("admin/editPwd?token=")}}{{$token}}',
                data:$("form").serialize(),
                method:'post',
                dataType:'json',
            })
            .done(function(res){
                if(res.status==0){
                    alert(res.msg)
                }else {
                    window.location.href="{{url("home/info?token=")}}{{$token}}"
                }
            })
            .fail(function(res){
                alert('网络出错，请重新请求或联系客服');
                console.dir(res);
            });
        });
    })
</script>