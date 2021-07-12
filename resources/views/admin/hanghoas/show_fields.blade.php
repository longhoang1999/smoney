<div class="anh1">
    <img class="anh" src="{{asset('imghh/1.jpg')}}" alt="" stt="0">
    <img class="anh" src="{{asset('imghh/12.jpg')}}" alt="" style="display: none;" stt="1">
    <img class="anh" src="{{asset('imghh/13.jpg')}}" alt="" style="display: none;" stt="2">
    <img class="anh" src="{{asset('imghh/4.jpg')}}" alt="" style="display: none;" stt="3">
    <img class="anh" src="{{asset('imghh/5.jpg')}}" alt="" style="display: none;" stt="4">
    <a href="#" class="prev"><img src="{{asset('imghh/prev.png')}}" alt=""></a>
    <a href="#" class="next"><img src="{{asset('imghh/next.jpg')}}" alt=""></a>


</div>




<div class="bang">
<table class="bang1">
    <tr>
        <th><p>Mã hàng hóa</p></th>
        <td><p>{!! $hanghoa->id !!}</p></td>
    </tr>
    <tr>
        <th><p>Tên hàng hóa</p></th>
        <td><p>{!! $hanghoa->Tensp !!}</p></td>
    </tr>
    <tr>
        <th><p>Ngày nhập</p></th>
        <td><p>{!! $hanghoa->Ngaynhap !!}</p></td>
    </tr>
    <tr>
        <th><p>Thông tin</p></th>
        <td><p>{!! $hanghoa->Thongtin !!}</p></td>
    </tr>
    <tr>
        <th><p>Thời gian tạo</p></th>
        <td><p>{!! $hanghoa->created_at !!}</p></td>
    </tr>
    <tr>
        <th><p>Thời gian cập nhật</p></th>
        <td><p>{!! $hanghoa->updated_at !!}</p></td>
    </tr>
</table>
</div>





 <!-- //Id Field 
<div class="form-group">
    {!! Form::label('id', 'Mã hàng hóa:') !!}
    <p>{!! $hanghoa->id !!}</p>
    <hr>
</div>
 -->
