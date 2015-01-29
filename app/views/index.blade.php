<div align="center"><h1>New Product</h1></div>
<div align="center">
{{Form::open(array('url' => 'upload', 'files' => true))}}
	{{Form::file('image')}}
	{{Form::submit('upload')}}
{{Form::close()}}
</div>

<!--
<div>
<form name="fileUpform" method="post" enctype="multipart/form-data" > 
    이미지 선택 : <input type="file" name="fileName"/>
    <button><a href="javascript:fileCheck();" title="등록">등록</a></button>
</form>
</div>
-->
<?php

$users = DB::table('products')->orderBy('title','DESC')->get();
foreach ($users as $user){
?>
<span style="margin-left:55px">
<img src="/img/<?=$user->title?>" style="margin-top:50px">
</span>
<?
}
?>
<script>
//업로드 파일 체크
function fileCheck()
{
    if(document.fileUpform.fileName.value < 1) 
    {
        alert("선택된 이미지가 없습니다.");
        return;
    }
       
    var filePath    = document.fileUpform.fileName.value;
    var idx         = filePath.lastIndexOf(".")+1;  //확장자 제외한 경로+파일명
    var idx2        = filePath.lastIndexOf("\\")+1; //파일경로를 제외한 파일명+확장자
    var extension = (filePath.substr(idx, filePath.length)).toLowerCase();  //확장자명
    //파일명.확장자
    var fileNameCheck = filePath.substring(idx2, filePath.length).toLowerCase();
       
    if (fileNameCheck.length != 0) //파일명+확장자 길이가 0이 아니라면(즉,파일이 선택되었다면)
    {
        if( extension == 'gif' || extension == 'jpg' || extension == 'png' )
        {
            for(i=0;i <fileNameCheck.length; i++)
            {
                var chk = fileNameCheck.charCodeAt(i);
                if (chk > 128) 
                {
                    alert('선택한 이미지 : [' + fileNameCheck + ']' + '\n'
                                                + '파일명이 한글로 된 이미지 첨부 불가');
                    return;
                }
            }
               
            //위 조건 모두 이상없으면 submit
            document.fileUpform.submit();
        }
        else
        {
            alert("jpg / png / gif 파일만 올릴수 있습니다.");
            return;  
        }
    }
    else
    {
        alert("선택된 이미지가 없습니다.");
    }
}
</script>