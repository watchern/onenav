<?php
//禁用错误报告
error_reporting(0);
$t=htmlspecialchars($_GET["t"]);
$q=htmlspecialchars($_POST["q"]);
if (empty($q)) {
}else{
  if ( $t =="google"){
    echo'<script>window.location.href="https://www.google.com.hk/search?hl=zh&q='.$q.'";</script>';
    
  }else{
    //默认百度
    echo'<script>window.location.href="//www.baidu.com/s?ie=utf-8&word='.$q.'";</script>';
  }
};
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-siteapp">
  <meta name="referrer" content="no-referrer" />
  <meta name="theme-color" content="#ffffff">
  <link rel="icon" href="templates/<?php echo $template; ?>/icon/280.png?v=1.0.1" sizes="280x280" />
  <link rel="apple-touch-icon-precomposed" href="templates/<?php echo $template; ?>/icon/280.png?v=1.0.1" />
  <meta name="msapplication-TileImage" content="templates/<?php echo $template; ?>/icon/280.png?v=1.0.1" />
  <?php
    if( empty( $theme_config->shortcut_icon ) ) {
  ?>
  <link rel="shortcut icon" href="templates/<?php echo $template; ?>/icon/32.png?v=1.0.1"/>
  <?php }else{ ?>
  <link rel="shortcut icon" href="<?php echo $theme_config->shortcut_icon; ?>"/>
  <?php } ?>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="full-screen" content="yes"><!--UC强制全屏-->
  <meta name="browsermode" content="application"><!--UC应用模式-->
  <meta name="x5-fullscreen" content="true"><!--QQ强制全屏-->
  <meta name="x5-page-mode" content="app"><!--QQ应用模式-->
  <title><?php echo $site['title']; ?> - <?php echo $site['subtitle']; ?></title>
  <meta name="keywords" content="<?php echo $site['keywords']; ?>" />
  <meta name="description" content="<?php echo $site['description']; ?>" />
  <link rel="stylesheet" href="static/font-awesome/4.7.0/css/font-awesome.css">
  <link href="templates/<?php echo $template; ?>/style.css?t=<?php echo date("ymdhi"); ?>" rel="stylesheet">
  <!-- <link href="templates/<?php echo $template; ?>/wea.css?t=<?php echo date("ymdhi"); ?>" rel="stylesheet"> -->
  <script src="static/js/jquery.min.js"></script>
  <script src = "static/js/holmes.js"></script>
  <!-- <script src="//at.alicdn.com/t/font_400990_j21lstb4wx.js"></script> -->
  <script src="templates/<?php echo $template; ?>/sou.js?t=<?php echo date("ymdhi"); ?>"></script>
  <!-- <script src="templates/<?php echo $template; ?>/wea.js?t=<?php echo date("ymdhi"); ?>"></script> -->
  <?php echo $site['custom_header']; ?>
</head>

<body>
  <!-- 随机bing背景start,如无需求可注释掉 -->
    <?php
      if( $theme_config->bing_wallpaper == 'on' ) {
    ?>
    <script>
    
    $.get("index.php?c=bing",function(data,status){
      //console.log(data.images[0].url);
      var bg_img = 'https://cn.bing.com' + data.images[0].url;
      bg_html = "<style> body{background:url('" + bg_img + "') no-repeat center/cover;}</style>";
      $("body").append(bg_html);
    });
    </script> 
    <?php } ?>
    <!-- 随机壁纸END -->
    <div id="menu"><i></i></div>
    <div class="list closed">
        <!-- 右上角搜索框 -->
        <div class="search">
          <input type="text" placeholder="请输入书签关键词">
          <i class="fa fa-search"></i>
        </div>
        <!-- 右上角搜索框END -->
        <ul>
          <!------>
          <!-- 遍历分类目录 -->
          <?php
            foreach ($categorys as $key => $category) {
              //获取链接列表
              $fid = $category['id'];
              $links = get_links($fid);
              
            
          ?>
          
            <li class="title"><i class="<?php echo $category['font_icon']; ?>"></i> <?php echo $category['name']; ?></li>
            <!-- 遍历链接 -->
            <?php foreach ($links as $link) {
              
            ?>
            <li class = "link"><a title = "<?php echo $link['description']; ?>" href="./index.php?c=click&id=<?php echo $link['id']; ?>" target="_blank">
                  <!-- 网站图标显示方式 -->
                  <?php if( $theme_config->favicon == "online") { ?>
                    <img style="margin-bottom:-3px;padding-left:6px" src="https://favicon.rss.ink/v1/<?php echo base64($link['url']); ?>" alt="HUAN" width="16" height="16">
                  <?php }else{ ?>
                    <img style="margin-bottom:-3px;padding-left:6px" src="./index.php?c=ico&text=<?php echo $link['title']; ?>" alt="" width="16" height="16" />
                  <?php } ?>
                  <!-- 网站图标显示方式END -->
              <?php echo $link['title']; ?></a>
            </li>
            <!-- 遍历链接END -->
         <?php } } ?>
         <!-- 遍历分类目录END -->
        </ul>
    </div>
    <!-- 天气插件 -->
    <!-- <div class="mywth" style="width: 200px;">
    <div id="he-plugin-simple"></div>
<script>
WIDGET = {
  "CONFIG": {
    "modules": "01234",
    "background": "5",
    "tmpColor": "FFFFFF",
    "tmpSize": "16",
    "cityColor": "FFFFFF",
    "citySize": "16",
    "aqiColor": "FFFFFF",
    "aqiSize": "16",
    "weatherIconSize": "24",
    "alertIconSize": "18",
    "padding": "10px 10px 10px 10px",
    "shadow": "0",
    "language": "auto",
    "fixed": "false",
    "vertical": "top",
    "horizontal": "left",
    "key": "xxxx"
  }
}
</script>
<script src="https://widget.qweather.net/simple/static/js/he-simple-common.js?v=2.0"></script>
</div> -->
<!-- 天气插件END -->
    <div id="content">
        <div class="con">
            <!-- logo -->
            <?php if( empty( $site['logo'] ) ) {
              $logo_url = 'templates/'.$template.'/icon/logo3.svg';
            }else{
              $logo_url = $site['logo'];
            } ?>
            <div class="shlogo" style="background: url(<?php echo $logo_url; ?>) no-repeat center/cover;"></div>
            <!-- logo end -->
            
            <div class="sou">
                <form action="" method="post" target="_self">
                   <?php 
                   if ( $t == "google" ){
                    $search_logo = 'templates/'.$template.'/icon/g.svg';
                    echo "<div class='lg' style='background: url($search_logo) no-repeat center/cover;' onclick = 'change_search(\"baidu\");'></div>";
                    
                   }else{
                    $search_logo = 'templates/'.$template.'/icon/baidu.svg';
                     echo"<div class='lg' style='background: url($search_logo) no-repeat center/cover;' onclick = 'change_search(\"google\");'></div>";
                   }

                    ?>
                    <!--input class="t" type="text" value="" name="t" hidden-->
                    <input class="wd" type="text" placeholder="请输入搜索内容" name="q" x-webkit-speech lang="zh-CN" autocomplete="off">
                    <button><svg class="icon" style=" width: 21px; height: 21px; opacity: 0.5;" aria-hidden="true"><use xlink:href="#icon-sousuo"></use></svg></button>
                </form>
                <div id="word"></div>
            </div>
        </div>
        <div class="foot" style="height: 40px;">
          <!-- <a href="https://blog.5iux.cn/" style="color: #777;">博客</a> | 
          <a href="https://hao.5iux.cn/" style="color: #777;">设计导航</a> | 
          <a href="https://dyartstyle.com/" style="color: #777;">设计资讯</a> | 
          <a href="https://wat.dyartstyle.com/" style="color: #777;">吾爱淘</a> | 
          <a href="https://github.com/5iux/sou/" style="color: #777;">Github</a><br> -->
          <!-- 底部版权 -->
          <?php if(empty( $site['custom_footer'] )) { ?>
          © <?php echo date("Y") ?> Powered by <a target="_blank" href="https://github.com/helloxz/onenav" title="简约导航/书签管理器" rel="nofollow">OneNav</a>.The theme author is <a href="https://blog.5iux.cn/">5iux</a> 
          <?php }else{
            echo $site['custom_footer'];
          } ?>
          | <a href="./index.php?c=admin" title = "OneNav后台管理" rel = "nofollow" target = "_blank">admin</a>
        </div>
          <!-- 底部版权END -->
    </div>
<!--
作者:D.Young
主页：https://blog.5iux.cn/
github：https://github.com/5iux/sou
日期：2020-11-23
版权所有，请勿删除
-->
</body>
</html>