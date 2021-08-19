<style>
  form.dropzone{
    min-height: 4px;
    line-height: 4px;
  }
</style>
<div class="main-top">
  <div class="main-top-title">
    Một số giấy tờ khác (nếu có)
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền một số tùy chọn có thể làm tăng khả năng vay thành công của bạn.</p>
      <p class="text-info">
        <span>+ Nếu bạn có bất kì chứng chỉ nào, bạn có thể điền vào đây</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Nếu bạn có các giấy tờ như giấy khám sức khỏe, chứng nhận đã tham gia các cuộc thi, chứng nhận tham gia NCKH,... có thể điền vào để tăng khả năng vay thành công</span>
  <!-- giấy tờ 1 -->
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Giấy khám sức khỏe</div>
    <form action="{{ route('student.upFilePoint') }}" method="post" id="DropzoneImg" class="dropzone" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="dz-message" data-dz-message>
        <i class="fas fa-folder-open"></i>
        <br><br>
        <p class="text-primary">Kéo thả file của bạn vào đây!</p>
      </div>
          <div class="fallback">
              <input name="file" type="file" multiple />
          </div>
    </form>
    <div class="container-fuild block-show-img mt-3">
      <div class="row">
        <!-- append here -->
      </div>
    </div>
    <!-- /question -->
  </div>

  <!-- giấy tờ 2 -->
  <div class="block-question">
    <!--question  -->
    <div class="question question-two mt-2">Giấy chứng nhận tham gia NCKH</div>
    <form action="{{ route('student.upFilePoint') }}" method="post" id="DropzoneImg_2" class="dropzone" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="dz-message" data-dz-message>
        <i class="fas fa-folder-open"></i>
        <br><br>
        <p class="text-primary">Kéo thả file của bạn vào đây!</p>
      </div>
          <div class="fallback">
              <input name="file" type="file" multiple />
          </div>
    </form>
    <div class="container-fuild block-show-img_2 mt-3">
      <div class="row">
        <!-- append here -->
      </div>
    </div>
    <!-- /question -->
  </div>

  <!-- giấy tờ 3 -->
  <div class="block-question block-hidden-three block-hidden">
    <!--question  -->
    <div class="question question-two mt-2 mb-2">
      Giấy tờ khác: 
      <input type="text" class="title-ortherpage title-ortherpage-3" placeholder="Nhập tên giấy tờ">
    </div>
    <form action="{{ route('student.upFilePoint') }}" method="post" id="DropzoneImg_3" class="dropzone" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="dz-message" data-dz-message>
        <i class="fas fa-folder-open"></i>
        <br><br>
        <p class="text-primary">Kéo thả file của bạn vào đây!</p>
      </div>
          <div class="fallback">
              <input name="file" type="file" multiple />
          </div>
    </form>
    <div class="container-fuild block-show-img_3 mt-3">
      <div class="row">
        <!-- append here -->
      </div>
    </div>
    <!-- /question -->
  </div>


  <!-- giấy tờ 4 -->
  <div class="block-question block-hidden-four block-hidden">
    <!--question  -->
    <div class="question question-two mt-2 mb-2">
      Giấy tờ khác: 
      <input type="text" class="title-ortherpage title-ortherpage-4" placeholder="Nhập tên giấy tờ">
    </div>
    <form action="{{ route('student.upFilePoint') }}" method="post" id="DropzoneImg_4" class="dropzone" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="dz-message" data-dz-message>
        <i class="fas fa-folder-open"></i>
        <br><br>
        <p class="text-primary">Kéo thả file của bạn vào đây!</p>
      </div>
          <div class="fallback">
              <input name="file" type="file" multiple />
          </div>
    </form>
    <div class="container-fuild block-show-img_4 mt-3">
      <div class="row">
        <!-- append here -->
      </div>
    </div>
    <!-- /question -->
  </div>


<!-- giấy tờ 5 -->
  <div class="block-question block-hidden-five block-hidden">
    <!--question  -->
    <div class="question question-two mt-2 mb-2">
      Giấy tờ khác: 
      <input type="text" class="title-ortherpage title-ortherpage-5" placeholder="Nhập tên giấy tờ">
    </div>
    <form action="{{ route('student.upFilePoint') }}" method="post" id="DropzoneImg_5" class="dropzone" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="dz-message" data-dz-message>
        <i class="fas fa-folder-open"></i>
        <br><br>
        <p class="text-primary">Kéo thả file của bạn vào đây!</p>
      </div>
          <div class="fallback">
              <input name="file" type="file" multiple />
          </div>
    </form>
    <div class="container-fuild block-show-img_5 mt-3">
      <div class="row">
        <!-- append here -->
      </div>
    </div>
    <!-- /question -->
  </div>



  <div class="block-btn-add">
    <button class="btn btn-sm btn-info mt-3">Thêm một giấy tờ khác</button>
  </div>
</div>


  <hr>
  <div class="main-bottom">
    <div class="btn-back main-bottom-item">
      Quay lại
      <i class="fas fa-long-arrow-alt-left"></i>
    </div>
    <div class="btn-next main-bottom-item">
      Tiếp theo
      <i class="fas fa-long-arrow-alt-right"></i>
    </div>
  </div>
</div>


<script type="text/javascript">
  var imgAr = [], imgAr_2 = [], imgAr_3 = [], imgAr_4 = [], imgAr_5 = [];
  $.getScript( "{{ asset('dropzone/js/dropzone.js') }}", function() {
    console.log( "Load was performed." );
  });
  setTimeout(function() {
    // giấy tờ 1
    var myDropzone = new Dropzone("#DropzoneImg",{
      acceptedFiles:'.jpeg,.jpg,.png',
      maxFiles: 10,
      success: function(file, response){
        imgAr.push(response['url']);
      },
      queuecomplete: function() {
        $(".block-show-img .row").empty();
        $(".block-show-img .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
        imgAr.forEach(function(item, index) {
          let urlImg = `{{ url('/') }}/${item}`;
          $(".block-show-img .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
        })
        Dropzone.forElement('#DropzoneImg').removeAllFiles(true);
      }
    });
    // giấy tờ 2
    var myDropzone_2 = new Dropzone("#DropzoneImg_2",{
      acceptedFiles:'.jpeg,.jpg,.png',
      maxFiles: 10,
      success: function(file, response){
        imgAr_2.push(response['url']);
      },
      queuecomplete: function() {
        $(".block-show-img_2 .row").empty();
        $(".block-show-img_2 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
        imgAr_2.forEach(function(item, index) {
          let urlImg = `{{ url('/') }}/${item}`;
          $(".block-show-img_2 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
        })
        Dropzone.forElement('#DropzoneImg_2').removeAllFiles(true);
      }
    });

    // giấy tờ 3
    var myDropzone_3 = new Dropzone("#DropzoneImg_3",{
      acceptedFiles:'.jpeg,.jpg,.png',
      maxFiles: 10,
      success: function(file, response){
        imgAr_3.push(response['url']);
      },
      queuecomplete: function() {
        $(".block-show-img_3 .row").empty();
        $(".block-show-img_3 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
        imgAr_3.forEach(function(item, index) {
          let urlImg = `{{ url('/') }}/${item}`;
          $(".block-show-img_3 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
        })
        Dropzone.forElement('#DropzoneImg_3').removeAllFiles(true);
      }
    });

    // giấy tờ 4
    var myDropzone_4 = new Dropzone("#DropzoneImg_4",{
      acceptedFiles:'.jpeg,.jpg,.png',
      maxFiles: 10,
      success: function(file, response){
        imgAr_4.push(response['url']);
      },
      queuecomplete: function() {
        $(".block-show-img_4 .row").empty();
        $(".block-show-img_4 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
        imgAr_4.forEach(function(item, index) {
          let urlImg = `{{ url('/') }}/${item}`;
          $(".block-show-img_4 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
        })
        Dropzone.forElement('#DropzoneImg_4').removeAllFiles(true);
      }
    });

    // giấy tờ 5
    var myDropzone_5 = new Dropzone("#DropzoneImg_5",{
      acceptedFiles:'.jpeg,.jpg,.png',
      maxFiles: 10,
      success: function(file, response){
        imgAr_5.push(response['url']);
      },
      queuecomplete: function() {
        $(".block-show-img_5 .row").empty();
        $(".block-show-img_5 .row").append(`<span class="col-md-12 main-top-title-detail">Các file ảnh đã upload lên</span>`);
        imgAr_5.forEach(function(item, index) {
          let urlImg = `{{ url('/') }}/${item}`;
          $(".block-show-img_5 .row").append(`<div class="col-md-4 mt-3 item-show-img" data-value="${item}"><a data-fancybox="gallery" href="${urlImg}"><img class="img-fluid" src="${urlImg}" alt=""></a><div class="delete-icon" title="Xóa ảnh"><i class="fas fa-times"></i></div></div>`);
        })
        Dropzone.forElement('#DropzoneImg_5').removeAllFiles(true);
      }
    });


  },200)





  // delete btn
  $(".block-show-img .row").on('click','.delete-icon',function() {
    let blockDelete = $(this).parent(".item-show-img");
    let valueImgAr = blockDelete.data('value');  

    var index = imgAr.indexOf(valueImgAr);
    if (index !== -1) {
      imgAr.splice(index, 1);
    }
  
    $.ajax({
        url:"{!! route('student.deleteImgPoint') !!}",
        method: "GET",
        data:{"value": valueImgAr},
        success:function(data)
        {
          if(data['status'] == 'delete success'){
            blockDelete.remove();
            if($(".block-show-img .row").find(".item-show-img").length == 0){
              $(".block-show-img .row").empty();
            }
          }
        }
    });
  })
  $(".block-show-img_2 .row").on('click','.delete-icon',function() {
    let blockDelete = $(this).parent(".item-show-img");
    let valueImgAr = blockDelete.data('value');  

    var index = imgAr_2.indexOf(valueImgAr);
    if (index !== -1) {
      imgAr_2.splice(index, 1);
    }
  
    $.ajax({
        url:"{!! route('student.deleteImgPoint') !!}",
        method: "GET",
        data:{"value": valueImgAr},
        success:function(data)
        {
          if(data['status'] == 'delete success'){
            blockDelete.remove();
            if($(".block-show-img_2 .row").find(".item-show-img").length == 0){
              $(".block-show-img_2 .row").empty();
            }
          }
        }
    });
  })

  $(".block-show-img_3 .row").on('click','.delete-icon',function() {
    let blockDelete = $(this).parent(".item-show-img");
    let valueImgAr = blockDelete.data('value');  

    var index = imgAr_3.indexOf(valueImgAr);
    if (index !== -1) {
      imgAr_3.splice(index, 1);
    }
  
    $.ajax({
        url:"{!! route('student.deleteImgPoint') !!}",
        method: "GET",
        data:{"value": valueImgAr},
        success:function(data)
        {
          if(data['status'] == 'delete success'){
            blockDelete.remove();
            if($(".block-show-img_3 .row").find(".item-show-img").length == 0){
              $(".block-show-img_3 .row").empty();
            }
          }
        }
    });
  })

  $(".block-show-img_4 .row").on('click','.delete-icon',function() {
    let blockDelete = $(this).parent(".item-show-img");
    let valueImgAr = blockDelete.data('value');  

    var index = imgAr_4.indexOf(valueImgAr);
    if (index !== -1) {
      imgAr_4.splice(index, 1);
    }
  
    $.ajax({
        url:"{!! route('student.deleteImgPoint') !!}",
        method: "GET",
        data:{"value": valueImgAr},
        success:function(data)
        {
          if(data['status'] == 'delete success'){
            blockDelete.remove();
            if($(".block-show-img_4 .row").find(".item-show-img").length == 0){
              $(".block-show-img_4 .row").empty();
            }
          }
        }
    });
  })

  $(".block-show-img_5 .row").on('click','.delete-icon',function() {
    let blockDelete = $(this).parent(".item-show-img");
    let valueImgAr = blockDelete.data('value');  

    var index = imgAr_5.indexOf(valueImgAr);
    if (index !== -1) {
      imgAr_5.splice(index, 1);
    }
  
    $.ajax({
        url:"{!! route('student.deleteImgPoint') !!}",
        method: "GET",
        data:{"value": valueImgAr},
        success:function(data)
        {
          if(data['status'] == 'delete success'){
            blockDelete.remove();
            if($(".block-show-img_5 .row").find(".item-show-img").length == 0){
              $(".block-show-img_5 .row").empty();
            }
          }
        }
    });
  })

  $(".block-btn-add button").click(function() {
    if($(".block-hidden-three").hasClass("block-hidden")){
      $(".block-hidden-three").removeClass("block-hidden");
    }else if($(".block-hidden-four").hasClass("block-hidden")){
      $(".block-hidden-four").removeClass("block-hidden");
    }else if($(".block-hidden-five").hasClass("block-hidden")){
      $(".block-hidden-five").removeClass("block-hidden");
      $(this).remove();
    }
  })


  $(".btn-next").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": ""},
        data:{
            "page": "tag1",
            "pagepresent" : "otherpage1",
            "data" : createObject()
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
  function createObject(){
    let pageObject = [];
    if(imgAr.length > 0){
      let pageObjectItem = {
        title: 'giấy khám sức khỏe',
        arrayImg: imgAr
      }
      pageObject.push(pageObjectItem);
    }
    if(imgAr_2.length > 0){
      let pageObjectItem = {
        title: 'giấy chứng nhận NCKH',
        arrayImg: imgAr_2
      }
      pageObject.push(pageObjectItem);
    }
    if(imgAr_3.length > 0){
      let pageObjectItem = {
        title: $(".title-ortherpage-3").val(),
        arrayImg: imgAr_3
      }
      pageObject.push(pageObjectItem);
    }
    if(imgAr_4.length > 0){
      let pageObjectItem = {
        title: $(".title-ortherpage-4").val(),
        arrayImg: imgAr_4
      }
      pageObject.push(pageObjectItem);
    }
    if(imgAr_5.length > 0){
      let pageObjectItem = {
        title: $(".title-ortherpage-5").val(),
        arrayImg: imgAr_5
      }
      pageObject.push(pageObjectItem);
    }

    var objectToSave = {
      maHS: maHS,
      pageObject: pageObject,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "option4"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
    
  
</script>