    var myWidget = cloudinary.createUploadWidget({
        cloudName: 'ddtjltqkz', 
        uploadPreset: 'preset1',
        cropping: true, //add a cropping step
        croppingAspectRatio: 1,
        showSkipCropButton: false,
        // showAdvancedOptions: true,  //add advanced options (public_id and tag)
        sources: ["local", "url"], // restrict the upload sources to URL and local files
        multiple: false,
        }, (error, result) => { 
        if (!error && result && result.event === "success") { 
            console.log('Done! Here is the image info: ', result.info);
            console.log(result.info.secure_url);
            $.ajax({
                url: './php/change_pfp.php',
                method: 'POST',
                data: {"link": result.info.secure_url},
                success: function (data) {
                    $('.self_profile_img').attr('src', result.info.secure_url);
                },
                error: function(err)
                {
                    console.log(err);
                }
            });
        }
        else {
        console.log(error);
        }
        }
    )
    
    document.getElementById("pfp_upload_widget").addEventListener("click", function(){
        myWidget.open();
        }, false);