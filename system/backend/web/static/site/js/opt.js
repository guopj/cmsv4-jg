$(document).ready(function(){
    $('#site-pc_domain').on('change',function(){
        var domain = $(this).val();
        var arr = domain.split('/');
        arr[0] += '/static';

        $('#site-pc_url').val('http://'+domain+'/');
        $('#site-pc_static').val('http://'+arr.join('/')+'/');
        $('#site-pc_pub_path').val('');
        $('#site-pc_temp_path').val('');
    });

    $('#site-m_domain').on('change',function(){
        var domain = $(this).val();
        var arr = domain.split('/');
        var arr = domain.split('/');
        arr[0] += '/static';

        $('#site-m_url').val('http://'+domain+'/');
        $('#site-m_static').val('http://'+arr.join('/')+'/');
        $('#site-m_pub_path').val('');
        $('#site-m_temp_path').val('');
    });

    $('input[type="radio"][name="Site[is_test]"]').on('change',function(){
        $('#site-pc_pub_path').val('');
        $('#site-pc_temp_path').val('');
        $('#site-m_pub_path').val('');
        $('#site-m_temp_path').val('');
    });
});