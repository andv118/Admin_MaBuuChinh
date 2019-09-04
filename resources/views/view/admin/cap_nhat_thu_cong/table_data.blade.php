
<?php dd($arrDtgm); ?>

<table class="table table-bordered table-responsive table-hover table-condensed" style="margin-top:20px;">
    <thead>
        <tr class="bg-primary">
            @if(isset($arrTinh))
            {{<th style="text-align: center;">ID</th>}}
            @else
            {{<th style="text-align: center;">STT</th>}}
            @endif
            <th style="text-align: center;">Tên</th>
            <th style="text-align: center;">Mã bưu chính</th>
            <th style="text-align: center;">Điện thoại</th>
            <th style="text-align: center;">Địa chỉ</th>
            <th style="text-align: center;">Email</th>
            <th style="text-align: center;">Website</th>
            <th style="text-align: center;">Ghi chú</th>
            <th style="text-align: center;">Hành Động</th>
        </tr>
    </thead>
    <tbody class="append-data">
        <?php
        $stt = 1;
        $arrData = array();
        if (isset($arrTinh)) {
            $arrData = $arrTinh;
            $routeEdit = "edit_tinh";
            $routeDelete = "delete_tinh";
        } elseif (isset($arrHuyen)) {
            $arrData = $arrHuyen;
            $routeEdit = "edit_huyen";
            $routeDelete = "delete_huyen";
        } elseif (isset($arrDtgm)) {
            $arrData = $arrDtgm;
            $routeEdit = "edit_huyen";
            $routeDelete = "delete_huyen";
        }
        ?>
        @foreach($arrData as $value)
        <tr>
            <td style="text-align:center;">{{$stt}}</td>
            <td style="text-align:center;">{{$value->ten}}</td>
            <td style="text-align:center;">{{$value->mbc}}</td>
            <td style="text-align:center;">{{$value->dienthoai}}</td>
            <td style="text-align:center;">{{$value->diachi}}</td>
            <td style="text-align:center;">{{$value->email}}</td>
            <td style="text-align:center;">{{$value->website}}</td>
            <td style="text-align:center;">{{$value->ghichu}}</td>
            <td style="text-align:center;">
                <a href="{{ route('admin.{{$routeEdit}}', $value->id )}}" class="btn btn-warning"> Sửa</a>
                <a href="{{ route('admin.{{$routeDelete}}', $value->id)}}" class="btn btn-danger" onclick="return confirmAction();"> Xóa</a>
            </td>
        </tr>
        {{$stt++}}
        @endforeach
    </tbody>
</table>
{{$arrData->links()}}