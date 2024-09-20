<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('head')
    <link rel="stylesheet" href="{{ URL::asset('./css/edite_venue.css') }}">

    <title>Document</title>
</head>
<body>
    <div id='app'>
        <!-- Modal--->
        <div class="modal fade 	modal-xl" id="VenueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增場館</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" v-model="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhone" v-model="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">座標</label>

                        <div class="col">
                            <input type="text" class="form-control" placeholder="lat" aria-label="lat" v-model="lat">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="lng" aria-label="lng" v-model="lng">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">url</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" v-model="url">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click='addVenue()'>Confirm</button>
                </div>
                </div>
            </div>
            
        </div>
        <div class="modal fade 	modal-xl" id="EditeVenueModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">編輯場館</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" v-model="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhone" v-model="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">座標</label>

                        <div class="col">
                            <input type="text" class="form-control" placeholder="lat" aria-label="lat" v-model="lat">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="lng" aria-label="lng" v-model="lng">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">url</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" v-model="url">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click='hiddenEditeVenueModal()'>Close</button>
                    <button type="button" class="btn btn-primary" @click='updateVenue()'>Save changes</button>
                </div>
                </div>
            </div>
            
        </div>
        <div class="modal fade" id="deleteVenueModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">刪除確認</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    是否確定刪除@{{name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click=" deleteVenue()">Confrim</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal--->
        <div class='content'>
        @include('menu')
            <div class="contanier">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Action</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Lat</th>
                        <th scope="col">Lng</th>
                        <th scope="col">Url</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="venue in venues">
                            <td>
                                <svg @click=" showEditeVenueModal(venue.id,venue.name,venue.address,venue.lat,venue.lng,venue.url)"  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                                <svg @click="showdeleteVenueModal(venue.id,venue.name)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </td>
                            <td>@{{venue.name}}</td>
                            <td>@{{venue.address}}</td>
                            <td>@{{venue.lat}}</td>
                            <td>@{{venue.lng}}</td>
                            <td>@{{venue.url}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="fixed-bottom">
                <button type="button" class="btn btn-primary btn-lg" @click='showAddVenueModal()'>Add</button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    const app=Vue.createApp({
        data(){
            return{
                name:'',
                address:'',
                lat:'',
                lng:'',
                url:'',
                id:'',
                
                venues:[],

            }
        },
        created(){
            this.getVenue();
        },
        methods:{
            getVenue(){
                let _this=this;

                $.ajax({
                    type: 'get',
                    url: './api/venue', 
                    data: {
                       
                    },
                    success(data) {
                        
                        _this.venues=data;
                        console.log(_this.venues);
                    },
                    
                })
            },
            addVenue(){
                let _this=this;
                $.ajax({
                    type: 'post',
                    url: './api/venue', 
                    data: {
                        name:_this.name,
                        address:_this.address,
                        lat:_this.lat,
                        lng:_this.lng,
                        url:_this.url
                    },
                    success(data) {
                       
                        $('#VenueModal').modal('hide');
                        _this.getVenue();
                        _this.resetValue()
                    },
                    
                })
            },
            updateVenue(){
                let _this=this;
                $.ajax({
                    type: 'put',
                    url: './api/venue', 
                    data: {
                        id:_this.id,
                        name:_this.name,
                        address:_this.address,
                        lat:_this.lat,
                        lng:_this.lng,
                        url:_this.url
                    },
                    success(data) {
                       
                        $('#EditeVenueModal').modal('hide');
                        _this.getVenue();
                        _this.resetValue()
                    },
                    
                })
            },
            deleteVenue(){
                let _this=this;
                $.ajax({
                    type: 'delete',
                    url: './api/venue', 
                    data: {
                        id:_this.id,
                    },
                    success(data) {
                        _this.getVenue();
                        $('#deleteVenueModal').modal('hide');
                        _this.resetValue();
                    },
                    
                })
            },
            showAddVenueModal(){
                $('#VenueModal').modal('show');
            },
            showdeleteVenueModal(id,name){
                let _this=this;
                _this.id=id;
                _this.name=name;
                $('#deleteVenueModal').modal('show');
            },
            showEditeVenueModal(id,name,address,lat,lng,url){
                let _this=this;
                _this.id=id;
                _this.name=name;
                _this.address=address;
                _this.lat=lat;
                _this.lng=lng;
                _this.url=url;
                $('#EditeVenueModal').modal('show');
            },
            hiddenEditeVenueModal(){
                let _this=this;
                $('#EditeVenueModal').modal('hide');
                _this.resetValue();
            },
            resetValue(){
                let _this=this;
                _this.id='';
                _this.name='';
                _this.address='';
                _this.lat='';
                _this.lng='';
                _this.url='';
            }
        }
    }).mount('#app');
</script>