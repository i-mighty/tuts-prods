function editProfile(user) {
    var par = $('#bio_p');
    var pane = $('#img_holder');
    var bio = par.text();
    par.replaceWith('<textarea class="input bio_t" id="bio_t" cols="300" name="bio_t" maxlength="240" minlength="0">'+bio+'</textarea>');
    $('#btn_edit').replaceWith('<button class="col-md-12 col-sm-12 main-button" id="btn_done" onclick="done('+user+')">Save Profile</button>\n')
    pane.append('<input type="file" name="newPic" id="newPic" class="hidden">');
    pane.addClass('editing');
    pane.append('<button class="btn" id="changePic" onclick="$(\'#newPic\').trigger(\'click\');">Change</button>')
    document.getElementById('newPic').addEventListener('change', picSelect, false);
}
function picSelect(evt) {
    var file = evt.target.files[0] ;// Filelist object
    // Only process image files.
    if (!file.type.match('image.*')) {
        alert("Error", "danger", "Please select an image file");
        return;
    }
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {
            //Render image for preview
            $('#pic').attr('src', e.target.result);
        };
    })(file);

    // Read in the image file as a data URL.
    reader.readAsDataURL(file);
}
function done(user) {
    loading("Saving profle", 100, 'warning');
    var form = new FormData();
    form.append('bio', $('#bio_t').val());
    console.log($('#bio_t').val());
    if(document.getElementById('newPic').value !== ""){
        form.append('pic', document.getElementById('newPic').files[0]);
    }
    form.append('_method', 'PUT');
    form.append('_token', $('meta[name="csrf_token"]').attr('content'));
    $.ajax({
       url : '../profile/'+user+'/edit',
        method : 'POST',
        data : form,
        processData: false,
        contentType: false,
        cache: false,
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if(data.success){
                alert("Saved!", "success", "Your profile was changed successfully");
                complete(data);
            }
        },
        error: function (data, textStatus, jqXHR) {
            alert("Error", "danger", "Could not save changes to your profile");
        }
    });
}
function complete(user) {
    $('#img_holder').removeClass('editing');
    $('#pic').attr('src', 'storage/'+user.avatar);
    $('#bio_t').replaceWith('<p id="bio_p">'+user.bio+'</p>');
    $('#newPic').remove();
    $('#changePic').remove();
    $('#btn_done').replaceWith('<button class="col-md-12 col-sm-12 main-button" id="btn_edit" onclick="editProfile('+user.id+')">Edit Profile</button>\n')
}
function change() {
    $('#img_holder')
}