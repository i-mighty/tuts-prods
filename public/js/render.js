function cast(course, chapter, topic) {// casts topic content to center pane
    $.getJSON(course+'/chapter/'+chapter+'/topic/'+topic, function (data) {
        link = 'http://127.0.0.1:8000/storage/'+data.media;
        $('#text-holder').html('<p>'+data.text.replace('\r\n\r\n','</p><p>')+'</p>');// $.post(course+'/chapter/'+chapter, {"title": $('#chapter_'+chapter+'> input[@name=title]').val();} function (data) {
        //
        // });
        $('#media-pane').html('<video class="col-md-12 col-xs-12" poster="../storage/'+data.poster+'" src="../storage/'+data.media+'" controls></video>')
    });

}
function alert(strong, type, text) {
    $('.alerter').html('<div class="alert alert-'+type+' fade in" align="center"><a href="" class="close" data-dismiss="alert">\n'+'&times;\n'+'</a>\n'+'<strong>'+strong+'! </strong>'+text+'</div>');
}
function loading(text, prog, style) {
    $('.alerter').html('<div class="progress progress-striped active">\n' +
        '   <div class="progress-bar progress-bar-'+style+'" role="progressbar" \n' +
        '      aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" \n' +
        '      style="width: '+prog+'%;">\n' +
        '      <span class="sr-only">40% Complete</span>\n' +
        '      <span class="text-'+style+'">'+text+'</span> '+
        '   </div>\n' +
        '</div>');
}
function loadingicon(target){
    target.html('<div class="ld ld-hourglass ld-spin center-block" style="font-size:64px;color:orangered;"></div>');
}
