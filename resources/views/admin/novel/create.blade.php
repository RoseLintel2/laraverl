@extends("comment.admin_base")

@section("title","管理后台-小说章节添加")

	<!-- 页面顶部信息 -->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说章节添加 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
        
      </div>
    </div>
@endsection

@section("content")
    <div class="contentpanel">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div>

          <h4 class="panel-title">小说章节添加</h4>
          <p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.novel.store')}}" method="post" enctype="multipart/form-data">
            	{{csrf_field()}}
              
              <div class="form-group">
              <label class="col-sm-3 control-label">小说分类</label>
              <div class="col-sm-6">
                <select name="c_id" class="form-bordered" >
                  @if(!empty($category))
                    @foreach($category as $categorys)
                      <option value="{{$categorys['id']}}">{{$categorys['c_name']}}</option>
                    @endforeach 
                  @endif
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">小说作者</label>
              <div class="col-sm-6">
                <select name="a_id" class="form-bordered" >
                  @if(!empty($author))
                    @foreach($author as $authors)
                      <option value="{{$authors['id']}}">{{$authors['author_name']}}</option>
                    @endforeach 
                  @endif
                </select>
              </div>
            </div>


             <div class="form-group">
              <label class="col-sm-3 control-label">小说名称</label>
              <div class="col-sm-6">
                <input type="text" placeholder="小说标题" class="form-control" name="name"  />
              </div>
            </div>


             <div class="form-group">
              <label class="col-sm-3 control-label">小说封面</label>
              <div class="col-sm-6">
                <input type="file" placeholder="小说封面" class="form-control" name="image_url"  />
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-sm-3 control-label">小说标签</label>
              <div class="col-sm-6">
                <input type="text" placeholder="小说标签" class="form-control" name="tags"  />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label">小说状态</label>
              <div class="col-sm-6">
                 <div class="radio"><label><input type="radio" value="1" name="status" checked="">连载</label></div>
                 <div class="radio"><label><input type="radio"   value="2" name="status">完结</label></div>
               </div>
            </div>          
            
            <div class="form-group">
              <label class="col-sm-3 control-label">小说简介</label>
              <div class="col-sm-8">
                <textarea name="desc" style="border:none;" id="container" class="form-control"></textarea>
              </div>
            </div>


			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">添加小说</button>&nbsp;
				 
				</div>
			 </div>
			</div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->
        
       
	  </div>
	</div>
  <script src="/js/ueditor/ueditor.config.js"></script>
  <script src="/js/ueditor/ueditor.all.min.js"></script>
	<script> 

    var ue = UE.getEditor("container");
		
		$(".alert-danger").hide();
		$("#btn-save").click(function(){

			var name = $("input[name=name]").val();
			var url = $("input[name=url]").val();

			if(name==""||url==""){
				$('#error_msg').text("名字或者url不能为空");
				$(".alert-danger").toggle();
				return false;
			}
		});
		

	</script>
@endsection