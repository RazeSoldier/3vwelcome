@extends('web::layouts.grids.8-4')

@section('title', '新手第一步')
@section('page_header', __('新手第一步'))

@section('left')
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bug"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">绑定的QQ号</span>
                    @if ($qq === null)
                        <form action="{{route('welcome.bindqq')}}" role="form" method="post">
                            {{csrf_field()}}
                            <label for="killMailUrl" class="control-label">你尚未绑定QQ，请在此输入QQ号
                                <input type="text" class="form-control" id="qq" name="qq" required />
                            </label>
                            <input type="submit" class="btn" value="绑定">
                        </form>
                    @else
                        <span class="info-box-number" id="qq">{{$qq}}</span>
                    @endif
                </div>
            </div>
            @if ($language !== 'cn')
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-bomb"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">切换为中文</span>
                        <form action="{{route('welcome.switch-lang')}}" role="form" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="lang" value="cn">
                            <input type="submit" class="btn" value="切换">
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(function () {
            $('#qq').on('click', function () {
                let td = $(this);
                let qq = td.text();
                let input = $("<input type='text' value='"+ qq + "' />");
                td.html(input);
                input.click(function () {
                    return false;
                });
                input.trigger("focus");
                input.blur(function () {
                    let newQQ = this.value;
                    if (newQQ !== qq) {
                        td.html(newQQ);
                        $.ajax({
                            url: '{{route('welcome.bindqq')}}',
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                'qq': newQQ,
                                'isAjax': 1
                            },
                        }).fail(function (response) {
                            if (response.status !== 200) {
                                alert('提交失败');
                            }
                        });
                    } else {
                        td.html(qq);
                    }
                });
            });
        });
    </script>
@endpush