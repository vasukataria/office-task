<template>
	<div>
<div class="container">
	<div id="members">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					<h2>Admin pannel
					<button class="btn btn-primary pull-right" @click="showAddModal = true"><span class="glyphicon glyphicon-plus"></span> Add data</button>
					</h2>
				</div>
			</div>

			<div class="alert alert-danger text-center" v-if="errorMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
			</div>
			
			<div class="alert alert-success text-center" v-if="successMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-ok"></span> {{ successMessage }}
			</div>

			<table class="table table-bordered table-striped">
				<thead>
					<th>Button Name</th>
					<th>Title</th>
					<th>Desc</th>
					<th>Action</th>
				</thead>
				<tbody>
					<tr v-for="video in videos"  v-bind:key="video.id">
						<td>{{ video.buttonName }}</td>
						<td>{{ video.title }}</td>
						<td>{{ video.desc }}</td>
						<td>
							<button class="btn btn-success" @click="showEditModal = true; selectMember(video);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(video);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

						</td>
					</tr>
				</tbody>
			</table>
		</div>
<!-- Add Modal -->
<div class="myModal" v-if="showAddModal">
	<div class="modalContainer">
		<div class="modalHeader">
			<span class="headerTitle">Add New Member</span>
			<button class="closeBtn pull-right" @click="showAddModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>Button Name:</label>
				<input type="text" class="form-control" v-model="newMember.buttonName" name="class">
			</div>
			<div class="form-group">
				<label>Title:</label>
				<input type="ChildTitle" class="form-control" v-model="newMember.title" name = "title">
			</div>
			<div class="form-group">
				<label>Desc:</label>
				<input type="text" class="form-control" v-model="newMember.desc" name = "desc">
			</div>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" @click="showAddModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-primary" @click="showAddModal = false; saveMember();"><span class="glyphicon glyphicon-floppy-disk" type="submit" name="submit"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Modal -->
<div class="myModal" v-if="showEditModal">
	<div class="modalContainer">
		<div class="editHeader">
			<span class="headerTitle">Edit Member</span>
			<button class="closeEditBtn pull-right" @click="showEditModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>Button Name:</label>
				<input type="text" class="form-control" v-model="clickVideo.buttonName">
			</div>
			<div class="form-group">
				<label>Title:</label>
				<input type="text" class="form-control" v-model="clickVideo.title">
			</div>
            <div class="form-group">
                <label>Desc:</label>
                <input type="text" class="form-control" v-model="clickVideo.desc">
            </div>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" @click="showEditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-success" @click="showEditModal = false; updateMember();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="myModal" v-if="showDeleteModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerTitle">Delete Member</span>
			<button class="closeDelBtn pull-right" @click="showDeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">Are you sure you want to Delete</h5>
			<h2 class="text-center">{{clickVideo.buttonName}} {{clickVideo.title}} {{clickVideo.desc}}</h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" @click="showDeleteModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-danger" @click="showDeleteModal = false; deleteMember(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</div>

</template>
<script>
import axios from 'axios'
//import Adminheader from '@/components/Adminheader.vue'
export default{
	name: 'Admin',
	components:{
		//Adminheader
	},
	data(){
		return{
		showAddModal: false,
		showEditModal: false,
		showDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		videos: [],
		newMember: {buttonName: '', title: '', desc:''},
		clickVideo: {}
	}
},

	mounted(){
		this.getAllMembers();
	},

	methods:{
		getAllMembers: function(){
			var self = this;
			axios.get('http://localhost/officetask/database/action.php')
				.then(function(response){
					//console.log(response);
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.videos = response.data;
					}
				});
		},

		saveMember: function(){
			//console.log(app.newMember);
			var self = this;
            //debugger;		
			axios.post('http://localhost/officetask/database/action.php?crud=create', this.newMember)
				.then(function(response){
					console.log(response);
					self.newMember = {buttonName: '', title: '', desc:''};
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.successMessage = response.data;
						self.getAllMembers();
					}
				});
		},

		updateMember(){
			var self = this;
			var memForm = self.toFormData(self.clickVideo);
			axios.post('http://localhost/officetask/database/action.php?crud=update', memForm)
				.then(function(response){
					console.log(response);
					self.clickVideo = {};
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.successMessage = response.data;
						self.getAllMembers();
					}
				});
		},

		deleteMember(){
			var self = this;
			var memForm = self.toFormData(self.clickVideo);
			axios.post('http://localhost/officetask/database/about.php?crud=delete', memForm)
				.then(function(response){
					//console.log(response);
					self.clickVideo = {};
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.successMessage = response.data;
						self.getAllMembers();
					}
				});
		},

		selectMember(video){
			this.clickVideo = video;
		},

		toFormData: function(obj){
			var form_data = new FormData();
            for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function(){
			this.errorMessage = '';
			this.successMessage = '';
		}

	}
}
</script>
<style>
.myModal{
	position:fixed;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background: rgba(0, 0, 0, 0.4);
}

.modalContainer{
	width: 555px;
	background: #FFFFFF;
	margin:auto;
	margin-top:50px;
}

.modalHeader{
	padding:10px;
	background: #008CBA;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.editHeader{
	padding:10px;
	background: #4CAF50;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.deleteHeader{
	padding:10px;
	background: #f44336;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.modalBody{
	padding:40px;
}

.modalFooter{
	height:36px;
}

.footerBtn{
	margin-right:10px;
	margin-top:-9px;
}

.closeBtn{
	background: #008CBA;
	color: #FFFFFF;
	border:none;
}

.closeEditBtn{
	background: #4CAF50;
	color: #FFFFFF;
	border:none;
}

.closeDelBtn{
	background: #f44336;
	color: #FFFFFF;
	border:none;

}
@import'~bootstrap/dist/css/bootstrap.css'
</style>