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
                        <th>小说名字</th>
                        <th>章节名称</th>
                        <th>排序</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($chapter))
                     			@foreach($chapter as  $chapters)
                     				<tr>
										<td>{{$chapters['id']}}</td>
										<td>{{$chapters['name']}}</td>
                    <td>{{$chapters['title']}}</td>
										<td>{{$chapters['sort']}}</td>
										<td>
											 <a href="{{ route('admin.chapter.del',['id'=>$chapters['id']] )}}" class="btn btn-sm btn-danger">删除</a>&nbsp;&nbsp;
                        <a href="{{ route('admin.chapter.edit',['id'=>$chapters['id']] )}}" class="btn btn-sm btn-success">编辑</a>
										</td>
                   					</tr>
                     		@endforeach
						@endif
                    </tbody>
                </table>
                {{$chapter->links()}}
            </div>
        </div>
<script src="/js/vue.min.js"></script>
<script>
</script>
@endsection