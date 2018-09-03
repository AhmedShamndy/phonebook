<template>
	<div style="margin-top:50px;">
		<nav class="panel column is-offset-2 is-8">
		  <p class="panel-heading">
		    <strong>All Clients</strong>
		    <button class="button is-link is-outlined is-pulled-right" @click="openAdd">
		      Add New
		    </button>
		    <span class="is-pulled-right" v-if="loading">
		    	<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
		    </span>
		  </p>
		  <div class="panel-block">
		    <p class="control has-icons-left">
		      <input v-model="searchQuery" class="input is-small" type="text" placeholder="search">
		      <span class="icon is-small is-left">
		        <i class="fa fa-search" aria-hidden="true"></i>
		      </span>
		    </p>
		  </div>
		  <a class="panel-block" v-for="item,key in temp">
			<span class="column is-9">
			    {{item.name}}
			</span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-danger fa fa-trash" aria-hidden="true" @click="del(key,item.id)"></i>
		    </span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-info fa fa-edit" aria-hidden="true" @click="openUpdate(key)"></i>
		    </span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
		    </span>
		  </a>
		</nav>
		<Add :openmodal='addActive' @closeRequest='close'></Add>
		<Show :openmodal='showActive' @closeRequest='close'></Show>
		<Update :openmodal='updateActive' @closeRequest='close'></Update>
	</div>
</template>
<script>
	//import for the components
	let Add = require('./Add.vue');
	let Show = require('./Show.vue');
	let Update = require('./Update.vue');
	export default {
		components:{Add,Show,Update},
		data(){
			return {
				addActive:'',
				showActive:'',
				updateActive:'',
				lists:{},
				errors:{},
				loading:false,
				searchQuery:'',
				temp:'',
			}
		},
		watch:{
			searchQuery(){
				if(this.searchQuery.length > 0)
				{
					this.temp = this.lists.filter((item)=>{
						return Object.keys(item).some((key)=>{
							let string = String(item[key])
							return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
						})
					});
				}else {
					// this is if no data on the input field
					this.temp = this.lists;
				}
			}
		},
		// mounted like computed
		mounted(){
			// this is an ajax request
			axios.post('/getData')
				 .then((response) => this.lists = this.temp =  response.data)
				 .catch((error) => this.errors = error.response.data.errors)
		},
		methods:{
			openAdd(){
				this.addActive='is-active';
			},
			openShow(key){
				this.$children[1].list = this.temp[key];
				this.showActive='is-active';
			},
			openUpdate(key){
				this.$children[2].list = this.temp[key];
				this.updateActive='is-active';
			},
			del(key,id){
				// `${key} ${id}` this is the way to print a key
				if(confirm("Are You Sure ?")){
					this.loading = !this.loading;
					axios.delete(`/phonebook/${id}`)
					 //delete the item from the list 
					 .then((response) =>{ 
					 	this.lists.splice(key,1);
					 	this.loading = !this.loading;
					 	})
					 .catch((error) => this.errors = error.response.data.errors)
				}
			},
			close(){
				this.addActive = this.showActive = this.updateActive = '';
			},
		}
	}
</script>