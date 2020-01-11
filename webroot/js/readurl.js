// functions
function readURL(input,$default=null) {
    if(window.$==undefined)return;
    $=window.$;
    if($default==null)$default="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+N/wHwAFBgKAjYGKKgAAAABJRU5ErkJggg==";
    $('.img-preview-label').attr('style',"display:none;");
    $('.upload-msg').attr('style',"display:none;");
    $('.img-preview')
    .attr('style',"max-height:300px;height:300px;width:300px;max-width:300px;")
    .attr('src',$default);
    $('.video-preview').attr('style',"display:none;");
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      $('#inputfilebtn').removeAttr("disabled")
      const name=input.files[0].name;
      const pixext=['png','jpeg','jpg','jpe','gif'];
      const vidext=['mkv','mp4','flv','webm','ogg'];
      const extension= name.substring(name.lastIndexOf('.')+1);
      // console.log(input.files[0],"name="+name,"extension="+extension);
      reader.onload = function (e) {
        $('.img-preview')
            .attr('src', e.target.result)
            .width(150)
            .attr('style',"max-height:300px;height:300px;")
            .height(200);
      };

      if(pixext.find(function(e){return e===extension.toLowerCase()})){
        reader.readAsDataURL(input.files[0]);
      }
      else if(vidext.find(function(e){return e===extension.toLowerCase()})){
        var fileUrl= window.URL.createObjectURL(input.files[0]);
        $('.video-preview')
          .attr('src', fileUrl)
          .width(150)
          .attr('style',"display:initial;")
          .height(200)
          $('.video-preview').parent().load();
      }
      else{
        $('.video-preview')
         .attr('style',"display:none;");
        $('.img-preview-label')
          .attr('style',"display:initial;color:red;")
          .text("file format not supported");
        $('.img-preview')
          .attr('style',"max-height:300px;height:300px;")
          .attr('src',$default)
          $('#inputfilebtn').attr("disabled","true")
      }

    }else{
        $('.img-preview-label')
            .attr('style',"display:initial;")
            .text("Choose a file");
        $('.img-preview')
        .attr('style',"max-height:300px;height:300px;width:300px;max-width:300px;")
        .attr('src',$default)
    }
    $('.upload-msg').text('')
}

