<template>
    <div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <h6>Update {{singleEmployee.full_name}} 's Info</h6>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 col-sm-12">
                    <div v-if="success == true" class="alert alert-success alert-dismissible fade show" role="alert">
                        Employee Info <strong>Updated Successfully !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group mt-2">
                        <label for="">Full Name <span :class="['text-danger']">*</span></label>
                        <input v-model="singleEmployee.full_name" type="text" class="form-control">
                        <span v-if="allerrors.full_name" :class="['text-danger']">{{ allerrors.full_name[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Phone <span :class="['text-danger']">*</span></label>
                        <input v-model="singleEmployee.phone" type="text" class="form-control">
                        <span v-if="allerrors.phone" :class="['text-danger']">{{ allerrors.phone[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Loans</label>
                        <input v-model="singleEmployee.loans" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Joining Date</label>
                        <input v-model="singleEmployee.joining_date" type="date" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Photo</label>
                        <br>
                        <img :src="`uploads/${singleEmployee.photo}`" :height="50" :width="50"/>
                        <input type="file" accept="image/*" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group mt-2">
                        <label for="">Email <span :class="['text-danger']">*</span></label>
                        <input v-model="singleEmployee.email" type="text" class="form-control">
                        <span v-if="allerrors.email" :class="['text-danger']">{{ allerrors.email[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Designation <span :class="['text-danger']">*</span></label>
                        <input v-model="singleEmployee.designation" type="text" class="form-control">
                        <span v-if="allerrors.designation" :class="['text-danger']">{{ allerrors.designation[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Salary</label>
                        <input v-model="singleEmployee.salary" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Address</label>
                        <input v-model="singleEmployee.address" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Status <span :class="['text-danger']">*</span></label>
                        <select v-model="singleEmployee.status" name="status" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Released</option>
                        </select>
                        <span v-if="allerrors.status" :class="['text-danger']">{{ allerrors.status[0] }}</span>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button @click="updateEmployee" class="btn btn-success">Update Employee</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    name : 'singleEmployee',

    data() {
        return {
           employees : [],
           allerrors : [],
           success : false
        }
    },

    methods : {
        async updateEmployee() {
            const updateData = await axios.post('/employee/update/'+this.$route.params.id, this.singleEmployee)
                               .then(response => {
                                   this.allerrors = [],
                                   this.success = true
                               })
                               .catch((error)=> {
                                   this.allerrors = error.response.data.errors
                                   this.success = false
                               })
        },
    },

    mounted() {
       this.$store.dispatch('getEmployeeById', this.$route.params.id)
    },

    computed : {
        singleEmployee() {
            return this.$store.getters.getSingleEmployee
        }
    }
}
</script>

<style scoped>
h6{
    background: rgb(190, 190, 190);
    padding: 15px 10px 15px 10px;
}
</style>