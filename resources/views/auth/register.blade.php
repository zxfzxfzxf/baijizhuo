@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">名字</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="用户名唯一英文或数字组合" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">手机号</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="手机为11位数字" value="{{ old('mobile') }}" >

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <div>
                        <label class="col-md-4 control-label">手机验证码</label>
                        <div class="col-md-6">
                            <input class="form-control" placeholder="6位验证码" id="validatecode" type="text">

                        <input class="code" onclick='duanxin()' value="获取验证码" type="button" id="btnSendCode">
                        <p><br/></p>
                            <script>
                                var InterValObj; //timer变量，控制时间  
                                var count = 10; //间隔函数，1秒执行  
                                var curCount;  //当前剩余秒数 
                                curCount = count;
                                function validatemobile(mobile)
                                {
                                    if(mobile.length==0)
                                    {
                                        alert('请输入手机号码！');
                                        document.form1.mobile.focus();
                                        return false;
                                    }
                                    if(mobile.length!=11)
                                    {
                                        alert('请输入有效的手机号码！');
                                        document.form1.mobile.focus();
                                        return false;
                                    }

                                    var myreg = /^((17|13|15|18)+\d{9})$/;
                                    if(!myreg.test(mobile))
                                    {
                                        alert('请输入有效的手机号码！');
                                        document.form1.mobile.focus();
                                        return false;
                                    }
                                }
                                function duanxin(){
                                    //获取手机ID


                                    //设置button效果，开始计时  
                                    $("#btnSendCode").attr("disabled", "true");
                                    $("#btnSendCode").val("重新发送验证码" + curCount);
                                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次   
                                    var iphone = document.getElementById("mobile").value;
                                    validatemobile(iphone);//调用上边的方法验证手机号码的正确性  
                                    var mobile=$("#mobile").val();
                                    $.ajax({
                                        url:'registers',
                                        data:{'mobile':mobile},
                                        type:"POST",
                                        dataType:"Json",
                                        success:function(msg){
                                            if(msg['stat']=='100'){
                                                alert('短信发送成功了');
                                            }else{
                                                alert('短信发送失败了');
                                            }
                                        }
                                    });
                                }

                                function SetRemainTime() {
                                    if (curCount == 0) {
                                        window.clearInterval(InterValObj);//停止计时器  
                                        $("#btnSendCode").removeAttr("disabled");//启用按钮  
                                        $("#btnSendCode").val("重新发送验证码");
                                         curCount=10;


                                    }
                                    else {
                                        curCount--;
                                        $("#btnSendCode").val("重新发送验证码" + curCount);
                                    }
                                }
                            </script>


                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="密码至少为6位">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">确认密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="与上述一致">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


