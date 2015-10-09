$(document).ready(function(){
    var type = $('#select-type').val();
	//alert(type)
	if(type == 'text'){
		$('#div-isshow').hide();
	}else if(type == 'select'){
		$('#div-isshow').show();
	}	
	
	$('#select-type').change(function(){
		var type = $(this).val();
		if(type == 'text'){
			$('#div-isshow').hide();
		}else if(type == 'select'){
			$('#div-isshow').show();
		}
		//alert();
	});	
	
	//编辑 单击确定保存按钮
    $('#btn-add').click(function(){
		//alert('add');
		$('#html-add').slideDown();
    }); 

	//编辑 确定保存按钮
    $('a[fun="btn-edit"]').click(function(){
		//alert('编辑按钮按下');
		var gid = $(this).attr('gid');
		//alert(gid);
		
		//var _csrf = $('input[name="_csrf"]').val();
		
		var data = 'action=get&id=' + gid;
		$.ajax({ 
            type: "POST" ,
            url: "/ajax/cglobal", 
            data: data ,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(res){
				$("#html-add-title").html('修改全局数据');
				$("#html-add-box").empty();
				$('#html-add').slideDown();
            }
        });	
		//$('#html-add').slideDown();
    });  	

	$('#btn-save').click(function(){
		//alert('按下了保存按钮');
        var data = 'action=add&' + $('#form').serialize();
        //var data = 'action=add';
		$.ajax({ 
            type: "POST" ,
            url: "/ajax/cglobal", 
            data: data ,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            success: function(res){
                var res = eval("("+res+")");
                if(res.status == 1){
					alert('添加成功');
					window.location.reload();
                }else{
					alert(res.message);
                }
            }
        });		
	});
	
	//删除的方法 绑定外层方法
	$('#div-other').on('click','a[fun="btn-del-other"]',function(){
		//alert('删除');
		$(this).parent().next().remove();
		$(this).parent().remove();
	});	
	
	$('#btn-add-other').click(function(){
		//alert('增加');
		var num = 0;
		$('a[fun="btn-del-other"]').each(function(){
			num ++;
		});
		if(num >= 10){
			alert('选项不能超过10');
			return;
		}
		//alert(num);
		var html = '<div style="float:right">' +
						'<a fun="btn-del-other" href="javascript:;" class="btn btn-block btn-danger btn-sm">删除</a>' +
					'</div>' +
					'<input name="other[]" class="form-control input-sm" style="width:80%"  placeholder="请输入选项名称">';
		
		$('#div-other').append(html);
	});
	
});