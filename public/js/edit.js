function editCast(course, chapter, topic) {
    loadingicon($('#text-holder'));
    loadingicon($('#media-pane'));
    $.getJSON('../'+course+'/chapter/'+chapter+'/topic/'+topic, function (data) {
        $('#submit-course').css('display', 'block')
        $('#intro').remove()
        var link = 'http://127.0.0.1:8000/storage/'+data.media;
        if(data.text){
            $('#text-holder').html(data.text);// $.post(course+'/chapter/'+chapter, {"title": $('#chapter_'+chapter+'> input[@name=title]').val();} function (data) {
        }else{
            $('#text-holder').html('');
        }
        if(data.media){
            $('#media-pane').html('<video class="col-md-12 col-xs-12" poster="../storage/'+data.poster+'" src="'+link+'" controls></video>')
            $('#submit-course').before('<input type="file" id="newMedia" name="newMedia" class="hidden">\n');
            $('#media-pane').append('<div class="col-md-12 col-sm-12 col-xs-12">\n' +
                '<div class="btn-group col-md-12 col-sm-12 center-block">'+
                '  <button type="button" class="col-md-6 col-sm-5 col-xs-6 btn btn-default" onclick="$(\'#newMedia\').trigger(\'click\');">Change</button>\n' +
                '  <button type="button" class="col-md-6 col-sm-5 col-xs-6 btn btn-default" onclick="removeMedia('+course+','+chapter+','+topic+')">Delete</button>\n' +
                '</div>'+
                '</div>');
        }else {
            $('#media-pane').html('<button id="addNew" class="col-sm-12 col-md-12 col-xs-12 main-button" onclick="$(\'#newMedia\').trigger(\'click\');">Add media</button>');
            $('#submit-course').before('<input type="file" id="newMedia" name="newMedia" class="hidden">\n');
        }
        $('#thiscourse').bind('submit', [course, chapter, topic], function (evt) {
            evt.preventDefault();
            saveTopic(course, chapter, topic, evt);
        });
        $('#tmp-media').html('');
        document.getElementById('newMedia').addEventListener('change', handleFileSelect, false);
    });

}
function intro(course) {
    $('#submit-course').css('display', 'none');
    $('#intro').remove();
    $('#media-pane').html('');
    $.post('../'+course, {"_method": "PUT", '_token': $('meta[name="csrf_token"]').attr('content')}, function (data) {
        $('#text-holder').html(data.text);
    });
    $('#text-holder').after('<button id="intro" class="col-md-12 main-button" onclick="saveIntro('+course+')">Save Introduction</button>')
}
function saveIntro(course) {
    $.post('../'+course, {'_method' : "PUT", '_token': $('meta[name="csrf_token"]').attr('content'), 'desc':$('#text-holder').html()}, function (data) {
        console.log(data);
    })
}
function topicRename(course, chapter, topic) {
    if ($('#tp_'+topic+'tl').val() !== ""){
        loading('Updating topic please wait...', 100, 'info')
        $.post('../'+course+'/chapter/'+chapter+'/topic/'+topic,
            {"title": $('#tp_'+chapter+'tl').val(), "_method":"PUT", "_token": $('meta[name="csrf_token"]').attr('content'), "id": topic, "action":"rename"},
            function (data) {
                if(data.saved){
                    // console.log(data.title);
                    $('#tp_'+topic+'tl').attr('placeholder', data.title);
                    alert("Success", 'success', 'Topic renamed successfully');
                }
            });
    }else{
        alert('Warning', 'danger', 'Cannot rename to empty string');
    }
}
function chapterRename(course, chapter){
    if (($('#ch_'+chapter+'tl').val()) !== "") {
        loading('Please wait...', 100, 'info')
        $.post('../'+course+'/chapter/'+chapter,
            {"title": $('#ch_'+chapter+'tl').val(), "_method":"PUT", "_token": $('meta[name="csrf_token"]').attr('content'), "id": chapter, "action":"rename"},
            function (data) {
                if(data.saved){
                    // console.log(data.title);
                    $('#ch_'+chapter+'tl').attr('placeholder', data.title);
                    alert("Success", 'success', 'Chapter renamed successfully');
                }
            });
    }else{
        alert('Warning', 'danger', 'Cannot rename to empty string');
    }
}
function topicDelete(course, chapter, topic) {
    var parent = [course, chapter];
    confirmDelete('Topic', topic, 'text and media', parent, 'tp_');
}
function chapterDelete(course, chapter) {
    var parent = [course];
    confirmDelete('Chapter', chapter,'topics',parent, 'ch_');
}
function confirmDelete(type, id, children, parent, infix) {
    $('#myModal').html(
        '<div class="modal-dialog">\n' +
        '      <div class="modal-content">\n' +
        '         <div class="modal-header" align="center">\n' +
        '            <button type="button" class="close" data-dismiss="modal" \n' +
        '               aria-hidden="true">×\n' +
        '            </button>\n' +
        '            <h4 class="modal-title" id="myModalLabel">\n' +
        '               Confirm Action' +
        '            </h4>\n' +
        '         </div>\n' +
        '         <div class="modal-body" align="center">\n' +
        '            Confirm Deleting of this '+type.toLocaleLowerCase()+'?' +
        '            <br><br>Title:\n'+$('#'+infix+id+'tl').attr('placeholder') +
        '         <br><p style="font-size: 0.8em; float: right" class="text-danger">This will also delete all associated '+children+'</p>' +
        '         </div>\n' +
        '         <div class="modal-footer">\n' +
        '            <button type="button" class="btn btn-default" \n' +
        '               data-dismiss="modal">Cancel\n' +
        '            </button>\n' +
        '            <button id="md_cfm" onclick="deleteConfirmed('+parent.toString()+','+id+');console.log('+parent[0]+')" data-value="false" type="button" class="btn btn-primary">\n' +
        '               Confirm\n' +
        '            </button>\n' +
        '         </div>\n' +
        '      </div><!-- /.modal-content -->\n' +
        '   </div>')
    $('#myModal').modal('show');
}
function deleteConfirmed(par1, par2, par3, par4) {
    loading('Please wait...', 100, 'danger');
    par3 = par3 || null;
    if(par3 === null){
        var url = '../'+par1+'/chapter/'+par2; id = par2; infix = 'ch_'
        console.log(par1, par2);
    }else if(par3 !== null ){
        console.log(par1, par2, par3);
        if(par4 !== null)
        var url = '../'+par1+'/chapter/'+par2+'/topic/'+par3; id = par3; infix = 'tp_';
    }
    $.post(url, {"_method":"DELETE", "_token": $('meta[name="csrf_token"]').attr('content'), "id": id},
        function (data) {
            if(data.deleted){
                // console.log(data.title);
                $('#'+infix+id).remove();
                alert("Success", 'success', 'Chapter removed successfully');
            }
            console.log(data);
        });
}
function removeMedia(course, chapter, topic) {
    var parent = [course, chapter, topic];
    $('#myModal').html(
        '<div class="modal-dialog">\n' +
        '      <div class="modal-content">\n' +
        '         <div class="modal-header" align="center">\n' +
        '            <button type="button" class="close" data-dismiss="modal" \n' +
        '               aria-hidden="true">×\n' +
        '            </button>\n' +
        '            <h4 class="modal-title" id="myModalLabel">\n' +
        '               Confirm Action' +
        '            </h4>\n' +
        '         </div>\n' +
        '         <div class="modal-body" align="center">\n' +
        '            Confirm Deleting of this media ?\n' +
        '            <br><br>Topic title:\n'+$('#tp_'+topic+'tl').attr('placeholder') +
        '         </div>\n' +
        '         <div class="modal-footer">\n' +
        '            <button type="button" class="btn btn-default" \n' +
        '               data-dismiss="modal">Cancel\n' +
        '            </button>\n' +
        '            <button id="md_cfm" onclick="mediaDelete('+course+','+chapter+','+topic+');console.log('+parent[0]+')" data-value="false" type="button" class="btn btn-primary">\n' +
        '               Confirm\n' +
        '            </button>\n' +
        '         </div>\n' +
        '      </div><!-- /.modal-content -->\n' +
        '   </div>')
    $('#myModal').modal('show');
}
function mediaDelete(course, chapter, topic) {
    loading('Removing media file..', 100, 'danger')
    var url = '../'+course+'/chapter/'+chapter+'/topic/'+topic;
    $.post(url, {"_method":"DELETE", "_token": $('meta[name="csrf_token"]').attr('content'), "id": topic, "target":"media"},
        function (data) {
            // if(data.deleted){
            //     // console.log(data.title);
            //     $('#'+infix+id+'bx').attr('placeholder', data.title);
            //     alert("Success", 'success', 'Chapter removed successfully');
            // }
            console.log(data);
        });
}
function discardNew() {
    $('#tmp-media').html('');
    if($('#media-pane').html() == ""){
        $('#media-pane').html('<button id="addNew" class="col-sm-12 col-md-12 col-xs-12 main-button" onclick="$(\'#newMedia\').trigger(\'click\');">Add media</button>');
    }
    $('#newMedia').value = "";
}
function handleFileSelect(evt) {
    var file = evt.target.files[0] ;// Filelist object
    // Only process video files.
    if (!file.type.match('video.*')) {
       return;
    }
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            // Render video Pane.
            // $('#media-pane').remove($('.btn-'))
            $('#tmp-media').html();
            $('#addNew').remove()
            $('#tmp-media').html('<h3 class="text-center text-info">New Media</h3>'+
                '<video class="col-md-12 col-xs-12"src="'+e.target.result+' " title="'+theFile.name+'" controls></video>'+
                '<p class="center-block text-danger">This will replace the existing media file</p><span class="text-danger" style="float: right;"><button type="link" onclick="discardNew()" class="btn btn-secondary">Undo</button></span>'
            );

        };
    })(file);

    // Read in the image file as a data URL.
    reader.readAsDataURL(file);
}
function saveTopic(course, chapter, topic, event) {
    event.preventDefault();
    var tmp = $('#tmp-media');
    if (tmp.html() === ''){
        /*No new Media
        * Save text and fallback
        * @return none
        * */
        $.post('../'+course+'/chapter/'+chapter+'/topic/'+topic,
            {"text":$('#text-holder').html(), "_method":"PUT", "_token": $('meta[name="csrf_token"]').attr('content'), "id": topic, "action":"text"},
            function (data) {
                console.log(data);
            });
        console.log($('#text-holder').html());
    }else if (tmp.html() !==''){
        // $('#thiscourse').append('<input name="_token" value="'+$('meta[name="csrf_token"]').attr('content')+'"`>'+
        //                         '<input name="_method" value="PUT" hidden>'
        //                         );
        var form = new FormData();
        form.append('media', document.getElementById('newMedia').files[0]);
        console.log($('#text-holder').html())
        form.append('text', $('#text-holder').html());
        form.append('id', topic);
        form.append('_method', "PUT");
        form.append('action', "media");
        form.append('_token', $('meta[name="csrf_token"]').attr('content'));
        $.ajax({
            url: '../'+course+'/chapter/'+chapter+'/topic/'+topic,
            method : 'POST',
            data : form,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(data.success){
                    editCast(course, chapter, topic);
                }
            },
            error: function (data, textStatus, jqXHR) {
                    alert("Error", "danger", "Could not save topic");
            }
        })
    }
}

