@extends("layout.main")
@section("content")
    <div class="col-sm-8 blog-main">
        <div class="form-group">
            <label>标题</label>
            <input name="title" type="text" class="form-control" placeholder="这里是标题">
        </div>
        <div class="form-group">
            <label>内容</label>
            <div id="div1" class="toolbar">
            </div>
            <div style="padding: 5px 0; color: #ccc"></div>
            <div id="div2" class="text" name="content"  class="form-control"> <!--可使用 min-height 实现编辑区域自动增加高度-->
            </div>
        </div>
        <button type="submit" class="btn btn-default" id="btn">提交</button>

    </div>
@endsection
