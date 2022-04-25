<template>
    <div>
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Employee List</h3>
                    </div>
                </div>
                <div class="row mt-4">
                     <div class="col-12 col-sm-12">
                        <div v-if="success == true" class="alert alert-success alert-dismissible fade show" role="alert">
                            Employee <strong>Deleted Successfully !</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <input type="text" v-model="full_name" class="form-control" placeholder="Search By Name">
                    </div>
                    <div class="col-12 col-sm-3">
                        <input type="text" v-model="designation" class="form-control" placeholder="Search By Designation">
                    </div>
                    <div class="col-12 col-sm-3">
                        <input type="text" v-model="phone" class="form-control" placeholder="Search By Phone">
                    </div>
                    <div class="col-12 col-sm-3">
                        <button @click.prevent="searchEmployee()" class="btn btn-success pull-right">Search</button>
                    </div>
                </div>

                <div class="row mt-4">
                   <table v-if="showSearch==true" class="employee-list">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Loans</th>
                            <th>Salary</th>
                            <th>Joining Date</th>
                            <th>Address</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr v-for="(employee, i) in searchResult" :key="i">
                            <td>#{{employee.id}}</td>
                            <td>{{employee.full_name}}</td>
                            <td>{{employee.email}}</td>
                            <td>{{employee.phone}}</td>
                            <td>{{employee.designation}}</td>
                            <td>{{employee.loans}}</td>
                            <td>{{employee.salary}}</td>
                            <td>{{employee.joining_date}}</td>
                            <td>{{employee.address}}</td>
                            <td>{{employee.photo}}</td>
                            <td>{{employee.status}}</td>
                            <td>
                                <router-link :to="/update-employee/+`${employee.id}`"><i class="fa fa-edit text-primary"></i></router-link>
                                <i @click="showDeleteModal(employee, i)" class="fa fa-trash-o text-danger" data-toggle="modal" data-target="#deleteModal"></i>
                            </td>
                        </tr>
                    </table>
                    <table v-if="showSearch==false" class="employee-list">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Loans</th>
                            <th>Salary</th>
                            <th>Joining Date</th>
                            <th>Address</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tr v-for="(employee, i) in employee_list" :key="i">
                            <td>#{{employee.id}}</td>
                            <td>{{employee.full_name}}</td>
                            <td>{{employee.email}}</td>
                            <td>{{employee.phone}}</td>
                            <td>{{employee.designation}}</td>
                            <td>{{employee.loans}}</td>
                            <td>{{employee.salary}}</td>
                            <td>{{employee.joining_date}}</td>
                            <td>{{employee.address}}</td>
                            <td>{{employee.photo}}</td>
                            <td>{{employee.status}}</td>
                            <td>
                                <router-link :to="/update-employee/+`${employee.id}`"><i class="fa fa-edit text-primary"></i></router-link>
                                <i @click="showDeleteModal(employee, i)" class="fa fa-trash-o text-danger" data-toggle="modal" data-target="#deleteModal"></i>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalheadline" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalheadline">Delete Employee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete {{deletingItem.full_name}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                                <button @click="deleteEmployee" type="button" data-dismiss="modal" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button type="button" class="page-link" v-if="page != 1" @click="page--"> Previous </button>
                        </li>
                        <li class="page-item">
                            <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)" :key="pageNumber" @click="page = pageNumber"> {{pageNumber}} </button>
                        </li>
                        <li class="page-item">
                            <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> Next </button>
                        </li>
                    </ul>
                </nav>	 -->
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name : "employee-list",

    data() {
        return{
            employee_list : [],
            success : false,

            full_name : '',
            designation : '',
            phone : '',
            showSearch : false,
            searchResult : '',
            
            page : 1,
            perPage : 10,
            pages : [],

            deletingItem : {}
        }
    },

    methods : {
        searchEmployee() {
           fetch('employee/search?full_name='+this.full_name+'&&designation='+this.designation+'&&phone='+this.phone)
           .then(res => res.json())
           .then(res => {
               this.searchResult = res;
               this.full_name = '';
               this.designation = '';
               this.phone = '';
               this.showSearch = true;
           }).catch(err => {
               console.log(err)
           })
        },

        setPages() {
            let numberOfPages = Math.ceil(this.employee_list.length / this.perPage)
            for(let index=1; index >= numberOfPages; index++){
                this.pages.push(index)
            }
        },

        paginate (employee_list) {
			let page = this.page;
			let perPage = this.perPage;
			let from = (page * perPage) - perPage;
			let to = (page * perPage);
			return  employee_list.slice(from, to);
		},

        async deleteEmployee(){
            const deleteEmployee = await axios.post('/employee/delete-employee/'+this.deletingItem.id)
                                  .then(response => {
                                      this.employee_list.splice(this.i,1)
                                      this.success = true
                                  })
                                  .catch((error) => {
                                      alert(error.response)
                                      this.success = false
                                  })
        },

        showDeleteModal(employee, i) {
            this.deletingItem = employee
            this.i = i
        }
    },

    // computed: {
	// 	displayedList () {
	// 		return this.paginate(this.employee_list);
	// 	}
	// },

	// watch: {
	// 	employee_list () {
	// 		this.setPages();
	// 	}
	// },

    async created() {
        const res = await axios.get('/employees-list')
        if(res.status == 200){
            console.log(res.data)
           this.employee_list = res.data
        }else{
           console.log('something went wrong')
        }
    }
}
</script>

<style scoped>

h3{
    background: rgb(190, 190, 190);
    padding: 5px 10px 5px 10px;
}

.main-content{
    padding:10px;
}

.employees{
    margin-top: 30px;
}

.employee-list{
    width:100%;
}

button.page-link {
	display: inline-block;
}
button.page-link {
    font-size: 20px;
    color: #29b3ed;
    font-weight: 500;
}
.offset{
  width: 500px !important;
  margin: 20px auto;  
}

</style>