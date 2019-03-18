@extends('comment.admin_base')

@section('title','管理后台-小说章节列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说章节列表 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </div>
@endsection

@section("content")
{{csrf_field()}}
 <div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-success mb30">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>小说封面</th>
                        <th>小说名称</th>
                        <th>小说分类</th>
                        <th>小说作者</th>
                        <th>小说状态</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($novel))
                     			@foreach($novel as  $novels)
                     				<tr>
										<td>{{$novels['id']}}</td>
										<td><img src="{{$novels['image_url']}}" alt="" style="border:red 1px solid;width:60px;"></td>
										<td>{{$novels['name']}}</td>
										<td>{{$novels['c_name']}}</td>
										<td>{{$novels['author_name']}}</td>
										<td>{{$novel['status'] == 1 ? "连载" : "完结"}}</td>
										<td>
											<a href="{{ route('admin.novel.del',['id'=>$novels['id']] )}}" class="btn btn-sm btn-danger">删除</a>&nbsp;&nbsp;
                      <a href="{{ route('admin.chapter.create',['id'=>$novels['id']] )}}" class="btn btn-sm btn-danger">章节添加</a>&nbsp;&nbsp;
                      <a href="{{ route('admin.chapter.list',['id'=>$novels['id']] )}}" class="btn btn-sm btn-danger">查看章节</a>&nbsp;&nbsp;
											<a href="{{ route('admin.novel.edit',['id'=>$novels['id']] )}}" class="btn btn-sm btn-success">编辑</a>
										</td>
                   					</tr>
                     		@endforeach
						@endif
                    </tbody>
                </table>
                {{$novel->links()}}
            </div>
        </div>
<script src="/js/vue.min.js"></script>
<script>
</script>
@endsection