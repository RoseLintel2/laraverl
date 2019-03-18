@extends('comment.admin_base')

@section('title','管理后台-小说列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说列表 <span>Subtitle goes here...</span></h2>
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
                        <th>作者名称</th>
                        <th>作者描述</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($author))
                     			@foreach($author as  $authors)
                     				<tr>
										<td>{{$authors['id']}}</td>
										<td>{{$authors['author_name']}}</td>
										<td>{{$authors['author_desc']}}</td>
										<td>
											<a href="{{ route('admin.author.del',['id'=>$authors['id']])}}" class="btn btn-sm btn-danger">删除</a>
										</td>
                   					</tr>
                     		@endforeach
						@endif
                    </tbody>
                </table>
                {{$author->links()}}
            </div>
        </div>
<script src="/js/vue.min.js"></script>
<script>
</script>
@endsection