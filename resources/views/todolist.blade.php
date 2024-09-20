<!DOCTYPE html>
<html lang="en">
@include('head')
<link rel="stylesheet" href="{{ URL::asset('./css/style.css') }}">

<body>
 
    <div id="app">
      <div id="delete_list" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">刪除確認</h5>
            </div>
            <div class="modal-body">
              <p class="event-text">是否要刪除 @{{deleteListElement}}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="deleteList()">是</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">否</button>
            </div>
          </div>
        </div>
      </div>
      <div id="update_list" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">修改</h5>
            </div>
            <div class="modal-body">
              <p>    
                <input type="text" class="form-control" placeholder="input..." aria-label="Recipient's username with two button addons" v-model="updateListElement" >
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="updateList()">修改</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">取消</button>
            </div>
          </div>
        </div>
      </div>
      <div id="error_hint" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">錯誤提示</h5>
            </div>
            <div class="modal-body">
              <p>@{{error}}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >確認</button>
             
            </div>
          </div>
        </div>
      </div>
      <div class="todolist">
        <div class="input">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="input..." aria-label="Recipient's username with two button addons" v-model="list" >
            <button class="btn btn-outline-secondary" type="button" @click="addList">enter</button>
        
          </div>
        </div>
        <div class="list">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(array,index) in arrays">
                <th class="col-1">@{{index+1}}</th>
                <td class="event-name-col"><div class="event-name"><p class="event-text">@{{array.event}}</p></div></td>
                <td class="action-col">
                  <div class="action-btn">
                    <button type="button" class="btn btn-primary update-btn" @click="showUpdateModal(index)">修改</button>
                    <button type="button" class="btn btn-danger delete-btn" @click="showDeleteModal(index)">刪除</button>
                  </div>
                  
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
     
    </div>
</body>
</html>
<script>
     const app = Vue.createApp({ 
      data(){
        return{
          error:"",
          list:"",
          updateListElement:"",
          updateListIndex:0,
          deleteListIndex:0,
          deleteListElement:"",
          arrays:{},
        }
      },
      created(){
        let _this=this;
        _this.getListData();
      },
      methods:{
        showDeleteModal(index){
           let _this=this;
          _this.deleteListIndex=index;
          _this.deleteListElement=_this.arrays[index].event;
          $('#delete_list').modal('show');
        },
        showUpdateModal(index){
           let _this=this;
          _this.updateListIndex=index;
          _this.updateListElement=_this.arrays[index].event;
          $('#update_list').modal('show');
        },
        getListData(){
            let _this=this;
            $.ajax({
                type: 'get',
                url: './api/todolist', 
                data: {
                    
                },
                success(data) {
                   _this.arrays=JSON.parse(data);
                  
                },
                
            })
        },
        deleteList(){
            let _this=this;
            $.ajax({
                type: 'delete',
                url: './api/todolist', 
                data: {
                    number:_this.arrays[_this.deleteListIndex].number,
                },
                success(data) {
                   _this.arrays=JSON.parse(data);
                },
                
            })
        },
        updateList(){
          let _this=this;
          if(_this.updateListElement!=""){
            $.ajax({
                type: 'put',
                url: './api/todolist', 
                data: {
                    number:_this.arrays[_this.updateListIndex].number,
                    event:_this.updateListElement,
                },
                success(data) {
                   _this.arrays=JSON.parse(data);
                },
                
            })
          }
        },
        addList(){
          let _this=this;
          if(_this.list!=""){
            $.ajax({
                type: 'post',
                url: './api/todolist', 
                data: {
                    event:_this.list,
                },
                success(data) {
                   _this.arrays=JSON.parse(data);
                   _this.list="";
                },
                
            })
            
          }
          
        }
       
      }

     }).mount('#app')
</script>