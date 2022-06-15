<template>
<div class="todoListContainer">
    <div class="heading">
        <h2 id="title">Add Weather To Database</h2>
        <add-item-form
        v-on:reloadlist="getList()"
         />
    </div>
    <!--list your items in the database-->
    <list-view :items="items"
    v-on:reloadlist="getList()"
    /><!--attach the items array to listview to pass as props, listen to reload list and if it changes then reload the list-->
</div>

</template>

<script>

import axios from "axios"
import addItemForm from "./addItemForm.vue"
import listView from "./listView.vue"

export default{
    
    components: {addItemForm, listView},
    data: function(){
        return{
            items:[]//where the items go when they are returned from the database
        }
    },
    methods:{
        getList(){
            axios.get('api/items')
            .then(response =>{
                this.items=response.data
                
            })
            .catch(error =>{
                console.log(error);
            })
        }
    },
       created(){
        this.getList();//options api, when the component is rendred we want to run the getList method
       
        }
 
    }
    

</script>

<style>
.todoListContainer{
    width:100%;
    margin:auto;
}

.heading{
    background: #e6e6e6;;
    padding:10px;
    font-size: 30px;
}

#title{
    text-align:center;
}
</style>