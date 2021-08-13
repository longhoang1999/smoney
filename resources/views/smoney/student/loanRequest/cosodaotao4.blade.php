<div class="main-top">
  <div class="main-top-title">Thông tin về cơ sở đào tạo của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin về các trường đại học, cao đẳng,... mà bạn đang theo học</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two ">Thành tích học tập của bạn</div>
    <span class="main-top-title-detail required-icon">Tải lên file bảng điểm của bạn</span>

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


<!-- <script type="text/javascript" src="{{ asset('dropzone/js/dropzone.js') }}" ></script> -->
<script type="text/javascript">
  var imgAr = [];
  $.getScript( "{{ asset('dropzone/js/dropzone.js') }}", function() {
    console.log( "Load was performed." );
  });
  setTimeout(function() {
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
  },200);
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

  $(".btn-next").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{
            "page": "vieclam1",
            "pagepresent" : "cosodaotao4",
            "data" : createObject()
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })  
  function createObject(){
    var numberSchool = $(".number-school").val();
    var objectToSave = {
      maHS: maHS,
      universityID: `{{ $uniID }}`,
      imgPointAr: imgAr,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "cosodaotao3"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })

  $(".timeline-two").removeClass("active");
  if(!$(".timeline-two").hasClass("done")){
    $(".timeline-two").addClass("done");
  }
  $(".timeline-three").removeClass("done");
  if(!$(".timeline-three").hasClass("active")){
    $(".timeline-three").addClass("active");
  }
  $(".timeline-four").removeClass("active");
  $(".timeline-four").removeClass("done");
</script>