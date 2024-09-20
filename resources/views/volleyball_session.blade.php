<!DOCTYPE html>
<html lang="en">
@include('head')
<link rel="stylesheet" href="{{ URL::asset('./css/volleyball_session.css') }}">
<body>
    <div id='app'>

        <div class="calendar">
            <div class="header">
                <button @click="prevMonth">&lt;</button>
                <span>@{{ currentMonth+1}} @{{ currentYear }}</span>
                <button @click="nextMonth">&gt;</button>
            </div>
            <div class="weekdays">
                <div v-for="day in weekdays" :key="day" class="weekday">@{{ day }}</div>
            </div>
            <div class="days">
                <div
                    v-for="(day, index) in daysInMonth"
                    :key="index"
                    :class="{ today: DayIndex(currentYear,currentMonth+1,day) ,isactive: isActive(currentYear,currentMonth+1,day) }"
                    class="day"
                >
                
                <div v-if="isActive(currentYear,currentMonth+1,day)" @click="setDate(currentYear,currentMonth+1,day)">@{{ day }}</div>
                <div v-else>@{{day}}</div>
                </div>
              
            </div>
        </div>
        <div v-for="(data, index) in all_data"  :key="index">
        <div v-for="session in data.sessions" :key="session.start_time" class="card mb-3" v-if="compareDate(data.date)">
                    <div class="card-header">
                        <strong></strong>@{{ session.start_time}} 
                        <strong>~</strong>@{{ session.end_time }} 
                      
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li v-for="supplier in session.suppliers" :key="supplier.supplier" class="list-group-item">
                                <strong>狀態:</strong>@{{ supplier.approved!=supplier.maxApproved  ? '可報名' : '滿' }}<br>
                                <strong>場地:</strong>
                                    <a v-if="supplier.supplier === 'hibi'" href="https://hibi.acesports.tw/session" target="_blank"> @{{ supplier.supplier }}</a>
                                    <a v-else-if="supplier.supplier === 'playone'" href="https://playone.acesports.tw/login" target="_blank"> @{{ supplier.supplier }}</a>   
                                <br>
                                <strong></strong> @{{ supplier.type }}<br>
                                <strong>報名人數:</strong> @{{ supplier.approved }} / @{{ supplier.maxApproved }}
                            </li>
                        </ul>
                    </div>
                </div>
           
        </div>
        
    </div>
</body>
</html>
<script >

 const app=Vue.createApp({
    data(){
        return{
            all_data:{},
            date: new Date(),
            weekdays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            day_string:''
        }
    },
    computed: {
        currentYear() {
            return this.date.getFullYear();
        },
        currentMonth() {
            return this.date.getMonth();
        },
        daysInMonth() {
            const year = this.date.getFullYear();
            const month = this.date.getMonth();
            const numDays = new Date(year, month + 1, 0).getDate();
            const startDay = new Date(year, month, 1).getDay();
            const days = Array.from({ length: startDay }, () => "");
            for (let i = 1; i <= numDays; i++) {
                days.push(i);
            }
            return days;
        }
    },
    created(){
        let _this=this;
        _this.getData();
        console.log(_this.all_data);
       _this.setDate(_this.date.getFullYear(),(_this.date.getMonth()+1),_this.date.getDate());
    },
    methods:{
        compareDate(data_date){
            if(data_date===this.day_string){
                return true;
            }
           return false;

        },
        setDate(year,month,day){
            this.day_string=year+'-'+month.toString().padStart(2, '0')+'-'+day.toString().padStart(2, '0');
        
        },
        prevMonth() {
            this.date.setMonth(this.date.getMonth() - 1);
            this.date = new Date(this.date);
        },
        nextMonth() {
            this.date.setMonth(this.date.getMonth() + 1);
            this.date = new Date(this.date);
        },
        DayIndex(year,month,day) {
            day_string_buffer=year+'-'+month.toString().padStart(2, '0')+'-'+day.toString().padStart(2, '0');
            if(this.day_string===day_string_buffer){
                return true;
            }
            else{
                return false;
            }
        },
        isActive(year,month,day){
            let _this=this;
            day_string_buffer=year+'-'+month.toString().padStart(2, '0')+'-'+day.toString().padStart(2, '0');
            console.log(day_string_buffer);
            for(index=0;index<=14;index++){
                if(day_string_buffer===_this.all_data[index]['date']) 
                {
                    return true;
                }
            }
            return false;
        },
        getData(){
            let _this=this;
            $.ajax({
                type: 'get',
                url: './api/volleyball_session', 
                data: {
                   
                },
                success(data) {
                  _this.all_data=JSON.parse(data);
                  console.log(_this.all_data);
                  _this.isActive();
                },
                
            })
        }
    }
 }).mount('#app')  
</script>