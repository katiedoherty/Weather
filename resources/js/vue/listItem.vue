<template>
<div>
 <button class="plusicon"><font-awesome-icon icon="plus"/></button>
 <span class='itemText'>{{"User: "+item.name}}<br />
 {{"Date Created: "+item.created_at}}</span><!--display the items name, span class puts a line through it. if completed apply the complted class by default its itemText-->
<button @click="removeItem()" class="trashcan"><font-awesome-icon icon="trash"/></button>
</div>

</template>

<script>
import axios from 'axios'

export default{

    props:['item'],//collects the item passed from listView
    
    methods:{
      
      removeItem(){
         axios.delete('api/item/'+this.item.id)
         .then(response=>{
            if(response.status==200){
               this.$emit('itemchanged');
            }
         })
         .catch(error =>
         {
            console.log(error)
         })
      }
    }
}
</script>
<style>
.completed{
   text-decoration:'line-through';
   color:#999999;
}

.itemText{
   width:100%;
   margin-left:20px;
   font-size: 20px;
}

.item{
   display:flex;
   justify-content: center;
   align-items: center;
}

.trashcan{
   background:#e6e6e6;
   border:none;
   color:red;
   outline: none;
    cursor: pointer;
    font-size: 30px;
}
.plusicon{
   background:#e6e6e6;
   border:none;
   color:black;
   outline: none;
   cursor: pointer;
   font-size: 30px;
}
</style>