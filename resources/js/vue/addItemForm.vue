<template>
<div class="addItem">
  <input type="text" v-model="weather.name" placeholder="Username"/>
  <input type="text"  v-model="item.location" placeholder="Location"/>
  <input type="date"  v-model="item.beginning" />
  <input type="date"  v-model="item.ending"/>
  <font-awesome-icon
  @click="getData();"
  icon="plus-square"
  :class="[weather.name && item.location && (item.beginning || item.ending)? 'active':'inactive', 'plus']"/>

</div>


</template>

<script>
import axios from 'axios';

export default{
     emits: ["reloadlist"],
    data: function()
{
    return{
        item:{
            location:"",
            beginning:'',
            ending:'',
            
            
        },
        weather:{
            weather:"",
            name:""
        }
        
    }
},


    methods:{
        addItem(){
            if(this.weather.name==''&& this.weather.weather==''){
                return;//if the items name is empty return nothing.
            }
            axios.post('api/item/store', {
                weather:this.weather//whatever the item name is we want to send it over and call it item
            })
            .then(response =>{
                if(response.status==201){
                    console.log(response)
                    this.$emit('reloadlist');
                }
            })
            .catch(error =>{
                console.log(error);
            })
    },
     getData(){
            
            axios.get(`https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${this.item.location}/${this.item.beginning}/${this.item.ending}?key=R7EWZKQEAMWH2FPWNJ5U4EL7J`)
            .then(response =>{
                for(var i =0; i<response.data.days.length; i++){
                    this.weather.weather="Date Time: "+response.data.days[i].datetime+ '\n'+ "Conditions: "+response.data.days[i].conditions
                + '\n'+ "Description: "+response.data.days[i].description+"\n"+"Sunrise: "+response.data.days[i].sunrise+"\n" +"Sunset: "+response.data.days[i].sunset+"\n" +"Temp Max: "+response.data.days[i].tempmax+"\n"
                +"Dew: "+response.data.days[i].dew+"\n" + "Humidity: "+response.data.days[i].humidity+"\n" +"Pressure: "+response.data.days[i].pressure+"\n"+"Wind Speed: "+response.data.days[i].windspeed +"\n"
                +"Visibility: "+response.data.days[i].visibility
                console.log(response.data);
                this.addItem();
                }
                
                
            }).catch(error =>{
                console.log(error);
            })
            
            
          
        }    
        }
            }
</script>
<style scoped>
.addItem{
    display:flex;
    justify-content:center;
    align-items:center;
}

input{
    background:#f7f7f7;
    border:0;
    outline:none;
    padding:5px;
    margin-right:10px;
    width:100%;
}

.plus{
    font-size:40px;
    cursor: pointer;
}
.active{
    color: #00ce25;
}
.inactive{
    color:#999999;
}
.css-fix {
  white-space: pre-wrap; /* or pre-line */
  font-size: 30px;
}
input{
    height:30px;
}
</style>