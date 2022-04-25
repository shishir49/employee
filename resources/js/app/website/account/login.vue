<template>
    <div>
        <div class="container mt-4">

            <div class="row">
                <div class="col-12">
                    <h4>Add New Employee {{currentUser.name}}</h4>
                </div>
            </div>

            <div class="row mt-4">

                <div class="col-12 col-sm-12">
                    <div v-if="success == true" class="alert alert-success alert-dismissible fade show" role="alert">
                        Employee <strong>Added Successfully !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mt-2">
                        <label for="">Full Name <span :class="['text-danger']">*</span></label>
                        <input v-model="data.full_name" type="text" class="form-control">
                        <span v-if="allerrors.full_name" :class="['text-danger']">{{ allerrors.full_name[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Phone <span :class="['text-danger']">*</span></label>
                        <input v-model="data.phone" type="text" class="form-control">
                        <span v-if="allerrors.phone" :class="['text-danger']">{{ allerrors.phone[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Loans</label>
                        <input v-model="data.loans" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Joining Date</label>
                        <input v-model="data.joining_date" type="date" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Photo</label>
                        <br>
                        <img :src="`uploads/${data.photo}`" :height="50" :width="50"/>
                        <input type="file" accept="image/*" class="form-control">
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group mt-2">
                        <label for="">Email <span :class="['text-danger']">*</span></label>
                        <input v-model="data.email" type="text" class="form-control">
                        <span v-if="allerrors.email" :class="['text-danger']">{{ allerrors.email[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Designation <span :class="['text-danger']">*</span></label>
                        <input v-model="data.designation" type="text" class="form-control">
                        <span v-if="allerrors.designation" :class="['text-danger']">{{ allerrors.designation[0] }}</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Salary</label>
                        <input v-model="data.salary" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Address</label>
                        <input v-model="data.address" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Status <span :class="['text-danger']">*</span></label>
                        <select v-model="data.status" name="status" id="" class="form-control" placeholder="choose">
                            <option value="1">Active</option>
                            <option value="2">Released</option>
                        </select>
                        <span v-if="allerrors.status" :class="['text-danger']">{{ allerrors.status[0] }}</span>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <button @click="addEmployee" class="btn btn-success">Add Employee</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapState } from 'vuex'

export default {
    data() {
        return {
           allerrors : [],
           success : false,
           data: {
               full_name : "",
               email : "",
               phone : "",
               designation : "",
               loans : "",
               salary : "",
               joining_date : "",
               address : "",
               status : "",
               photo : ""
           }
        }
    },

    methods : {
        async addEmployee() {
            this.data.photo = `uploads/${this.data.photo}`;
            alert(this.data.photo)
            const addData = await axios.post('employee/add', this.data)
                            .then(response => {
                                this.allerrors = [],
                                this.success = true,
                                this.full_name = ''
                            })
                            .catch((error) => {
                                this.allerrors = error.response.data.errors
                                this.success = false
                            })
        }
    },

    computed : {
        ...mapState(['currentUser'])
    }
}
</script>

<style scoped>
h4{
    background: rgb(190, 190, 190);
    padding: 5px 10px 5px 10px;
}
</style>