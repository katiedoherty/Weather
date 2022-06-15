<template>
<div>
    <div class="updatebox">
    <h3>Click on weather data to update</h3>
<input type="text" v-model="updateweather.weather" class="update" />
    <button @click="update()">Update</button>
</div>
    <div v-for="(item, index) in items" :key="index" @click="moreInfo(item)"><!--for loop for items recieved-->
    <list-item
    :item="item"
    class="item"
    v-on:itemchanged="$emit('reloadlist')"/><!--passing each individual item to our list item, it also has an event listener
    emit means if an item changed reload the list for us.-->
    <div v-if="item.id==id" class="dropdown">
    <p id="weatherdata" class="css-fix">{{weather}}</p>
    
    </div>
</div >

</div>
</template>

<script>
import listItem from "./listItem"
export default{
   
        data: function()
{
    return{
        
      weather:"",
      info:false,
      id:"",
      updateweather:{
        weather:""
      }
      
    
    }
},

    props:['items'], //coming from our app.vue file
    components:{
        listItem
    },
    methods:{
        moreInfo(item){
           
            if(this.info==false){
                this.info=true
                this.id=item.id;
                 axios.get('api/item/'+item.id)
            .then(response=>{
            if(response.status==200){
               this.weather=response.data.weather;
               
               
            }})
            .catch(error =>
         {
            console.log(error)
         })
            }
            else if(this.info==true&&item.id==this.id){
                this.info=false
                this.weather=""
                this.id="";
            }
            else if(this.info==true&&item.id!=this.id){
                this.info=true
                this.id=item.id;
                 axios.get('api/item/'+item.id)
            .then(response=>{
            if(response.status==200){
               this.weather=response.data.weather;
               
               
            }})
            .catch(error =>
         {
            console.log(error)
         })
            }
           
        },
        update(){
            axios.put('api/item/'+this.id, {
                
            weather:this.updateweather
            
         })
         .then(response =>{
            if(response.status==200){
               this.weather=this.updateweather.weather
            
               
            }
         })
         .catch(error =>{
            console.log(error);
         })
        }
    }
}
</script>
<style>
.item{
    background:#e6e6e6;
    padding:5px;
    margin-top:5px;
    cursor: pointer;
}
.css-fix {
  white-space: pre-wrap; /* or pre-line */
  font-size: 30px;
  text-align: center;
 
}
.dropdown{
 background-color: #e6e6e6;
 margin-top: 0;
 padding-top: 0;
}
.update{
    width:50%;
    height:50px;
   

}
.updatebox{
    margin-top: 10px;
    border: none;
    padding:40px;
    text-align: center;
}

.updatebox button{
    margin-top: 10px;
    margin-left: 10px;
    cursor: pointer;
    background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>