@extends('comment.admin_base')

@section('title','管理后台-小说评论列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说评论列表 <span>Subtitle goes here...</span></h2>
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
 <div class="row" id="comment">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-success mb30">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>评论小说</th>
                        <th>评论者</th>
                        <th>评论内容</th>
                        <th>状态</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                     				<tr v-for="comment in comment_list">
										<td>{comment.id}</td>
										<td>{comment.name}</td>
                    <td>{comment.username}</td>
                    <td>{comment.content}</td>
										<td>{comment.status == 1 ? "未审核" : "审核"}</td>
										<td>
                       <button class="btn btn-primary btn-sm" v-on:click="checkComment(comment.id)">审核</button>
											 <button class="btn btn-danger btn-sm" v-on:click="delRecord(comment.id)">删除</button>
										</td>
                   					</tr>
                     		
                    </tbody>
                </table>
                <ul class="pagination">

                    <li class="disabled" v-if="page == 1"><span>«</span></li>
                    <li v-else v-on:click="prevPage"><span>«</span></li>

                    <li v-for="num in total_page" v-on:click="current_page(num)">
                      <span v-if="page == num " style="color:#ff0000;">{num}</span>
                      <span v-else>{num}</span>
                    </li>

                    <!-- <li v-for="num in total_page" v-if="page == num "><a href="">{num}</a></li>
                    <li v-for="num in total_page" v-if="page != num "><a href="">{num}</a></li> -->

                    <li v-if="page == total_page" class="disabled"><span>»</span></li>
                    <li v-else v-on:click="nextPage"><span>»</span></li>
            </ul>
            </div>
        </div>
<script src="/js/vue.min.js"></script>
<script src="/js/app.js"></script>
<script>
    var comment = new Vue({
        el:"#comment",
        delimiters:['{','}'],
        data:{
          comment_list:[],
          page:1,   //当前页数
          total_page:0    //总页数
        },
        created:function(){
          this.getComment();
        },
       methods:{

      //获取评论列表
      getComment:function(){

        var that = this;
       
        $.ajax({
          url:"/admin/novel/comment/data",
          type:"get",
          data:{page:that.page},
          dataType:"json",
          success:function(res){
            if(res.code == 2000){
              that.comment_list = res.data.comment;
              that.page = res.data.current_page;
              that.total_page = res.data.total_page;
            }
          },
          error:function(res){

          }
        })
      },

      prevPage:function()
      {
        if(this.page == 1){
            alert("已经是第一页");
            return false;
        }

        this.page = this.page-1;
        this.getComment();
      },

      nextPage:function()
      {
        if(this.page == this.total_page){
          alert("已经是最后一页");
          return false;
        }

        this.page = this.page+1;
        this.getComment();
      },

       current_page:function(page){
          this.page = page;
          this.getComment();
        },

    checkComment:function(id){
      var that = this;

      $.ajax({
          url:"/admin/novel/comment/check/"+id,
          type:"get",
          data:{},
          dataType:"json",
          success:function(res){
            if(res.code == 2000){
             that.getComment();
            }
          },
          error:function(res){

          }

      })
    },
    delRecord:function(id){
      var that = this;

      $.ajax({
          url:"/admin/novel/comment/del/"+id,
          type:"get",
          data:{},
          dataType:"json",
          success:function(res){
            if(res.code == 2000){
             that.getComment();
            }
          },
          error:function(res){

          }

      })
    }
      
    }

   

    });
</script>
@endsection