<template>
	<div class="modal" :class="openmodal">
	  <div class="modal-background"></div>
	  <div class="modal-card">
	    <header class="modal-card-head">
	      <p class="modal-card-title">Add New User</p>
	      <button class="delete" aria-label="close" @click='close'></button>
	    </header>
	    <section class="modal-card-body">
	      	<div class="field">
	      	  <label class="label">Name</label>
			  <div class="control">
			  	<!-- is-danger class work when there is an error -->
			    <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model="list.name">
			  </div>
			  <small v-if="errors.name" class="has-text-danger">{{ errors.name[0]}}</small>
			</div>
			<div class="field">
	      	  <label class="label">Phone</label>
			  <div class="control">
			    <input class="input" :class="{'is-danger':errors.phone}" type="number" placeholder="Phone Number" v-model="list.phone">
			  </div>
			  <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0]}}</small>
			</div>
			<div class="field">
	      	  <label class="label">E-mail</label>
			  <div class="control">
			    <input class="input" :class="{'is-danger':errors.email}" type="email" placeholder="Email" v-model="list.email">
			  </div>
			</div>
			<small v-if="errors.email" class="has-text-danger">{{ errors.email[0]}}</small>
			<div class="field">
	      	  <label class="label">Age</label>
			  <div class="control">
			    <input class="input" :class="{'is-danger':errors.age}" type="number" placeholder="your Age" v-model="list.age">
			  </div>
			  <small v-if="errors.age" class="has-text-danger">{{ errors.age[0]}}</small>
			</div>
	    </section>
	    <footer class="modal-card-foot">
	      <button class="button is-success" @click='save'>Save</button>
	      <button class="button" @click='close'>Cancel</button>
	    </footer>
	  </div>
	</div>
</template>
<script>
	export default {
		props:['openmodal'],
		data(){
			return {
				list:{
					name:'',
					phone:'',
					email:'',
					age:'',
				},
				errors:{}
			}
		},
		methods:{
			close(){
				this.$emit('closeRequest');
			},
			save(){
				axios.post('/phonebook',this.$data.list).then((response)=>
				{
					this.close()
					//add to home the new inserted list
					this.$parent.lists.push(response.data)
					this.$parent.lists.sort(function(a,b){
						if(a.name>b.name){
							return 1;
						}
						else if(a.name< b.name){
							return -1;
						}
					})
					this.list=""
				})
				.catch((error) => this.errors = error.response.data.errors)
			}
		},
	}
</script>