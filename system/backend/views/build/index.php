<section class="content-header">
    <h1>
        站点生成
        <small>注意! 在该页面进行生成操作后，所有修改都会刷新至线上静态文件，请谨慎操作。 </small>
    </h1>
</section>
<section class="content">

    <div class="progress">
        <div id="div-progress" class="progress-bar progress-bar-primary progress-bar-striped" style="width: 00%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar">
            <!--<span class="sr-only">40% Complete (success)</span>-->
        </div>
    </div>
    <div>
        <button id="btn-build" class="btn btn-danger btn-lg">一键生成</button>
    </div>
    
    <br/>
    <div class="">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">生成结果</h3>
            </div>
            <div id="div-show" class="box-body">
                <!--
                <p class="lead">一键生成开始...</p>
                
                
                <p class="text-green">Text green to emphasize success</p>
                <p class="text-aqua">Text aqua to emphasize info</p>
                <p class="text-light-blue">Text light blue to emphasize info (2)</p>
                <p class="text-red">Text red to emphasize danger</p>
                <p class="text-yellow">Text yellow to emphasize warning</p>
                <p class="text-muted">Text muted to emphasize general</p>
                -->
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" >
$(document).ready(function(){
    //编辑 单击确定保存按钮
    $("#btn-build").click(function(){
        //$('#div-progress').attr("style","width: 30%"); 
        //alert('GGGG');
        var html = '<p class="text-light-blue">站点开始生成.....</p>';
        $('#div-show').append(html);
        var data =  "";
        $.ajax({ 
            type: "POST" ,
            url: "/build/node", 
            data: data ,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(res){
                var res = eval("("+res+")");
                if(res.status == 1){
                    $('#div-progress').attr("style","width: 30%"); 
                    var html = '<p class="text-light-blue">' + res.message + '</p>';
                    $('#div-show').append(html);
                }else{
                }
            }
        });         
 
        $.ajax({ 
            type: "POST" ,
            url: "/build/article", 
            data: data ,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(res){
                var res = eval("("+res+")");
                if(res.status == 1){
                    $('#div-progress').attr("style","width: 60%"); 
                    var html = '<p class="text-light-blue">' + res.message + '</p>';
                    $('#div-show').append(html);
                }else{
                }
            }
        });     



    });   

});
</script>

