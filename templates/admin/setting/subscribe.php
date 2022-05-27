<!-- 站点设置 -->
<!-- 主题设置 -->
<?php require_once(dirname(__DIR__).'/header.php'); ?>
<?php include_once(dirname(__DIR__).'/left.php'); ?>
<div class="layui-body">
<!-- 内容主体区域 -->
<div class="layui-row content-body place-holder" style="padding-bottom: 3em;">
    <!-- 说明提示框 -->
    <div class="layui-col-lg12">
      <div class="setting-msg">
        <ol>
            <li>您可以前往：<a href="https://dwz.ovh/69h9q" rel = "nofollow" target = "_blank" title = "购买订阅服务">https://dwz.ovh/69h9q</a> 购买订阅服务，订阅后可以：</li>
            <li>1. 享受一键更新OneNav</li>
            <li>2. 可在线更新和下载主题（尚未实现）</li>
            <li>3. 可享受一对一售后服务</li>
            <li>4. 可帮助OneNav持续发展，让OneNav变得更加美好</li>
        </ol>
      </div>
    </div>
    <!-- 说明提示框END -->
    <!-- 订阅表格 -->
    <div class="layui-col-lg6">
    <form class="layui-form layui-form-pane" action="">

        <div class="layui-form-item">
            <label class="layui-form-label">订单号</label>
            <div class="layui-input-block">
                <input type="text" name="order_id" value = "<?php echo $subscribe['order_id']; ?>" required  lay-verify="required" autocomplete="off" placeholder="请输入订单号" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">订阅邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="email" value = "<?php echo $subscribe['email']; ?>" required lay-verify="required|email" autocomplete="off" placeholder="订阅邮箱" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" style = "display:none;">
            <label class="layui-form-label">域名</label>
            <div class="layui-input-block">
                <input type="text" name="domain" value = "<?php echo $_SERVER['HTTP_HOST']; ?>" autocomplete="off" placeholder="网站域名" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">到期时间</label>
            <div class="layui-input-block">
            <input type="text" name="end_time" readonly="readonly" value = "<?php echo date("Y-m-d",$subscribe['end_time']); ?>" autocomplete="off" placeholder="订阅到期时间" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="set_subscribe">保存设置</button>
        </div>

    </form>
    </div>
    <!-- 订阅表格END -->
    <hr>
    <div class="layui-col-lg12">
        <!-- <h3>更新</h3> -->
        <form class="layui-form layui-form-pane" action="">

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">当前版本</label>
                    <div class="layui-input-inline">
                        <input type="text" readonly = "readonly" id = "current_version" name="current_version" value = "<?php echo $current_version; ?>" required  lay-verify="required" autocomplete="off" placeholder="当前版本" class="layui-input">
                    </div>
                    <label class="layui-form-label">可用版本</label>
                    <div class="layui-input-inline">
                        <input type="text" readonly = "readonly" name="new_version" id = "new_version" value = "" required  lay-verify="required" autocomplete="off" placeholder="可用版本" class="layui-input">
                    </div>
                </div>
            </div>
            

        </form>
        <div class="layui-input-inline">
            <button class="layui-btn" lay-submit="" onclick = "update_main()">立即更新</button>
        </div>
        <!-- 更新进度条 -->
        <div id="progress">
            <div class="layui-progress layui-progress-big" lay-filter="update_progress" lay-showPercent="true">
                <div class="layui-progress-bar layui-bg-blue" lay-percent="0%"></div>
            </div>
            <div id="msg" style = "margin-top:1em;"></div>
        </div>
        <!-- 更新进度条END -->
    </div>
</div>
</div>


<?php include_once(dirname(__DIR__).'/footer.php'); ?>

<script>
    
    //获取可更新版本
    function available_version() {
        var current_version = $("#current_version").val();
        $.get("http://down.onenav.top/v1/get_version.php",{version:current_version},function(data,status){
            $("#new_version").val(data);
        });
    }
    available_version();
    //立即更新按钮
    function update_main() {
        var current_version = $("#current_version").val();
        var new_version = $("#new_version").val();
        //如果当前版本和最新版本相同，则不能更新
        if (current_version == new_version) {
            layer.msg("已经是最新版本，无需更新！",{icon:5});
        }
        //否则可以更新
        else {
            update_status("1%","准备更新...");
            //第一步检查更新信息
            $.get("/index.php?c=api&method=check_subscribe",function(data,status){
                update_status("10%","正在验证订阅信息...");
                if( data.code == 200 ) {
                    update_status("20%","订阅信息验证通过...");
                    //取得必要的变量
                    var email = data.data.email;
                    var domain = data.data.domain;
                    var key = data.data.key;
                    var value = data.data.value;
                    //下载更新程序
                    $.get("/index.php?c=api&method=up_updater",function(data,status) {
                        update_status("30%","正在检查更新程序...");
                        if( data.code == 200 ) {
                            //继续往下执行
                            update_status("40%","更新程序准备完成...");
                            //准备下载升级包
                            update_status("50%","准备下载升级包...");
                            $.get("/update.php",{version:new_version,key:key,value:value,type:'main'},function(data,stauts){
                                update_status("70%","升级包下载完毕，正在校验版本...");
                                if( data.code == 200 ) {
                                    //校验新版本
                                    $.get("/index.php?c=api&method=check_version",{version:new_version},function(data,status){
                                        if(data.code == 200) {
                                            update_status("100%","更新完成！");
                                        }
                                        else {
                                            layer.msg(data.msg,{icon:5,time: 0});
                                        }
                                    });
                                }
                                else{
                                    layer.msg(data.msg,{icon:5,time: 0});
                                }
                            });
                        }
                        else {
                            layer.msg(data.msg,{icon:5,time: 0});
                        }
                    });
                }
                else{
                    layer.msg(data.msg,{icon:5,time: 0});
                }
            });
        }
    }
    //进度和更新提示函数
    function update_status(progress,msg) {
        layui.use('element', function(){
            var element = layui.element;
            $("#progress").show();
            element.progress('update_progress', progress);
            $("#msg").text(msg);
        });
        
    }
</script>