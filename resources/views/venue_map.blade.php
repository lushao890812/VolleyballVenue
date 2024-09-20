<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    @include('head')
    <link rel="stylesheet" href="{{ URL::asset('./css/map.css') }}">
    
    <title>Map</title>
</head>
<body>
    @include('menu')
    <div id='app'>
        
        <div id="map" class="map-div">

        </div>
        <div class='venue-div'>
            <table class="table">
                <thead>
                    <tr>
                       
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">報名網站</th>
                      
                    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="venue in venues">
                
                        <td @click="movePostition(venue.lat,venue.lng)">@{{venue.name}}</td>
                        <td>
                            <a :href="'https://www.google.com/maps/dir/?api=1&destination=' + venue.address" target="_blank">
                                @{{ venue.address }}
                            </a>
                        </td>
                        <td><a :href="venue.url"  target="_blank">報名</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
            
    </div>
  

</body>
</html>
<script>
    const app=Vue.createApp({
        data() {
            return {
                venues: [],
                marker: null,  // 新增 marker 到 data 中
                map: null      // 新增 map 到 data 中
            }
        },
        created(){
            this.getVenue();
           
        },
        mounted(){
            this.setMap() ;
        },
        methods: {
            getVenue(){
                let _this=this;

                $.ajax({
                    type: 'get',
                    url: './api/venue', 
                    data: {
                       
                    },
                    success(data) {
                        _this.venues = data;
                        _this.venues.forEach(function(venue) {
                            var marker = L.marker([venue.lat, venue.lng]).addTo(_this.map);
                            marker.bindTooltip(`<b>${venue.name}</b>`, { permanent: true, direction: 'top' }).openTooltip();
                            marker.on('click', function() {
                                _this.map.setView([venue.lat, venue.lng], 15); // 放大到指定縮放級別，例如15
                            });
                        });
                    },
                    
                })
            },
            setMap() {
                let _this = this;
                
                // 初始化地圖並存儲到 data 中
                _this.map = L.map('map').setView([24.942004, 121.18661], 13);

                // 添加 OpenStreetMap 圖層
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }).addTo(_this.map);      
            },
            showPosition(position) {
                let _this = this;
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                document.getElementById("status").textContent = "位置已成功抓取：" + lat + ", " + lng;

                // 如果已經有標記，則移動標記位置
                if (_this.marker) {
                    _this.marker.setLatLng([lat, lng]).update();
                } else {
                    // 否則在地圖上添加新標記
                    _this.marker = L.marker([lat, lng]).addTo(_this.map);
                }

                // 將地圖中心移到使用者位置
                _this.map.setView([lat, lng], 13);
                _this.marker.bindPopup("<b>您目前的位置</b>").openPopup();
            },
            movePostition(lat,lng){
                let _this = this;

                _this.map.setView([lat, lng], 13);
            }
        }

    }).mount('#app');
</script>
