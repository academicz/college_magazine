<template>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Moderator</h3>
                </div>

                <!--Block Styled Form -->
                <!--===================================================-->
                <form @submit.prevent="postData" @keyup="clearError">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" v-model="form.name">
                                    <small class="text-danger" v-if="has('name')">
                                        {{ getError('name') }}
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control" v-model="form.email">
                                    <small class="text-danger" v-if="has('email')">
                                        {{ getError('email') }}
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Mobile Number</label>
                                    <input type="text" class="form-control" v-model="form.phone">
                                    <small class="text-danger" v-if="has('phone')">
                                        {{ getError('phone') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
                <!--===================================================-->
                <!--End Block Styled Form -->

            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Existing moderators</h3>
                </div>

                <div class="panel-body">
                    <div class="pages" v-if="total>0">
                        {{ (currentPage * pagination) - pagination + 1}} to {{ total > pagination ? (currentPage * pagination) > total ? total : (currentPage * pagination) : total
                        }} out of {{ total }} entries
                    </div>
                    <div v-else-if="!initialLoad" class="pages">No Result</div>
                    <div v-else class="pages">Loading...</div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Sl no</th>
                            <th class="col-sm-2">Name</th>
                            <th class="col-sm-2">Email</th>
                            <th class="col-sm-2">Phone</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="moderators.length" v-for="(moderator,index) in moderators">
                            <td>{{ (currentPage * pagination) - pagination + index + 1}}</td>
                            <td> {{ moderator.name }}</td>
                            <td> {{ moderator.email }}</td>
                            <td> {{ moderator.phone }}</td>
                            <td class="text-center" @click="deleteFaculty(index)"><i class="fa fa-trash delete"></i>
                            </td>
                        </tr>
                        <tr v-if="initialLoad">
                            <td class="text-center" colspan="7"><i class="fa fa-cog fa-spin fa-2x"></i></td>
                        </tr>
                        <tr v-if="!moderators.length && !initialLoad">
                            <td class="text-center" colspan="7">No Data Available</td>
                        </tr>
                        </tbody>
                    </table>
                    <!--Pagination-->
                    <ul class="pager pager-rounded" v-if="nextPageUrl !== null || previousPageUrl !== null">
                        <li :class="previousPageUrl === null?'disabled':''"><a href=""
                                                                               @click.prevent="paginate(false,{fun:getModerators})"><i
                                class="demo-psi-arrow-left"></i> Previous</a></li>
                        <li :class="nextPageUrl === null?'disabled':''"><a href=""
                                                                           @click.prevent="paginate(true,{fun:getModerators})">Next <i
                                class="demo-psi-arrow-right"></i></a></li>
                    </ul>
                    <!--End Pagination-->
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import Axios from '../../AxiosClient.js';
    import {pagination} from '../mixins/paginationMixin.js';

    export default {
        mixins: [pagination],
        data() {
            return {
                axios: new Axios(),
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    departmentId: ''
                },
                errors: {},
                departments: [],
                moderators: [],
                initialLoad: true,
                total: 0,
            }
        },
        methods: {
            postData() {
                this.axios.submit('post', 'admin/postModerators', this.form)
                    .then(data => {
                        if (data.status) {
                            this.flashNotification('Success', data.message, 'success');
                            this.clearForm();
                            this.getModerators('admin/getModerators');
                        }
                    })
                    .catch(error => {
                        this.errors = error.errors;
                    });
            },
            has(field) {
                if (this.errors[field]) {
                    return true;
                } else {
                    return Object.keys(this.errors).length > 0;
                }
            },
            getError(field) {
                if (this.errors[field]) {
                    return this.errors[field][0];
                }
            },
            clearError() {
                this.errors = {};
            },
            flashNotification(title, message, type,) {
                swal({ // confirmation
                    title: title,
                    text: message,
                    type: type,
                })
            },
            clearForm() {
                for (let item in this.form) {
                    this.form[item] = '';
                }
            },
            getModerators(url) {
                this.axios.submit('get', url)
                    .then(data => {
                        this.moderators = data.moderators.data;
                        this.initialLoad = false;
                        this.nextPageUrl = data.moderators.next_page_url;
                        this.previousPageUrl = data.moderators.prev_page_url;
                        this.currentPage = data.moderators.current_page;
                        this.total = data.moderators.total;
                        this.pagination = data.moderators.per_page;
                    })
                    .catch(error => {

                    });
            },
            deleteFaculty(index) {
                swal({ // confirmation
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.submit('get', 'admin/deleteFaculty', {'id': this.moderators[index].id})
                            .then(({status, message}) => {
                                if (status) {
                                    this.moderators.splice(index, 1);
                                    this.flashNotification('Success!', message, 'success');
                                    this.pagination--;
                                    this.total--;
                                } else {
                                    this.flashNotification('Oops!', message, 'error');
                                }
                            })
                            .catch(error => {

                            });
                    }
                });
            }
        },
        created(e) {
            this.getModerators('admin/getModerators');
        }
    }
</script>
<style scoped>
    .delete {
        cursor: pointer;
    }

    .pages {
        margin: 0 0 15px 0;
    }
</style>