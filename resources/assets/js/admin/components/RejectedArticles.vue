<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Rejected Articles</h3>
                </div>

                <modal name="article" resizable="true" adaptive="true" width="70%" height="auto" scrollable="true">
                    <div class="modal-header">
                        <button type="button" @click="$modal.hide('article')" class="close">&times;</button>
                        <h4 class="modal-title">Article</h4>
                    </div>
                    <div class="modal-body">
                        <h3 class="h3">{{ articleTitle }}</h3>
                        <div class="img-div img-responsive">
                            <img :src="articleImage" alt="">
                        </div>
                        <div v-html="story"></div>
                        <div class="actions">
                            <button class="btn btn-success" @click="approve(currentArticle)">Approve</button>
                        </div>
                    </div>
                </modal>
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
                            <th class="col-sm-5">Title</th>
                            <th class="col-sm-3">Category</th>
                            <th class="col-sm-3">Reason to reject</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="articles.length" v-for="(article,index) in articles" @click="showArticle(index)">
                            <td>{{ (currentPage * pagination) - pagination + index + 1}}</td>
                            <td> {{ article.title }}</td>
                            <td> {{ article.article_category.category_name }}</td>
                            <td> {{ article.why_reject }}</td>
                        </tr>
                        <tr v-if="initialLoad">
                            <td class="text-center" colspan="4"><i class="fa fa-cog fa-spin fa-2x"></i></td>
                        </tr>
                        <tr v-if="!articles.length && !initialLoad">
                            <td class="text-center" colspan="6">No Approved Articles Available</td>
                        </tr>
                        </tbody>
                    </table>
                    <!--Pagination-->
                    <ul class="pager pager-rounded" v-if="nextPageUrl !== null || previousPageUrl !== null">
                        <li :class="previousPageUrl === null?'disabled':''"><a href=""
                                                                               @click.prevent="paginate(false,{fun:getArticles})"><i
                                class="demo-psi-arrow-left"></i> Previous</a></li>
                        <li :class="nextPageUrl === null?'disabled':''"><a href=""
                                                                           @click.prevent="paginate(true,{fun:getArticles})">Next <i
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
                departments: [],
                articles: [],
                initialLoad: true,
                total: 0,
                articleTitle: '',
                articleImage: '',
                story: '',
                currentArticle: '',
            }
        },
        methods: {

            flashNotification(title, message, type,) {
                swal({ // confirmation
                    title: title,
                    text: message,
                    type: type,
                })
            },
            getArticles(url) {
                this.axios.submit('get', url)
                    .then(({articles}) => {
                        this.articles = articles.data;
                        this.initialLoad = false;
                        this.nextPageUrl = articles.next_page_url;
                        this.previousPageUrl = articles.prev_page_url;
                        this.currentPage = articles.current_page;
                        this.total = articles.total;
                        this.pagination = articles.per_page;
                    })
                    .catch(error => {

                    });
            },
            showArticle(index) {
                this.articleTitle = this.articles[index].title;
                this.articleImage = 'http://localhost/magazine/public/' + this.articles[index].cover_image;
                this.story = this.articles[index].story;
                this.currentArticle = index;
                this.$modal.show('article');
            },
            approve(index) {
                this.axios.submit('get', 'admin/moderator/approveArticle', {'id': this.articles[index].id})
                    .then(({status, message}) => {
                        this.$modal.hide('article');
                        if (status) {
                            this.articles.splice(index, 1);
                            this.flashNotification('Success!', message, 'success');
                            this.pagination--;
                            this.total--;
                        } else {
                            this.flashNotification('Oops!', message, 'error');
                        }
                    })
                    .catch(error => {

                    });
            },
        },
        created(e) {
            this.getArticles('admin/moderator/getRejectedArticles');
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

    tr {
        cursor: pointer;
    }

    .img-div {
        text-align: center;
    }

    .img-div img {
        max-width: 800px;
        margin: 25px 0 25px 0;
    }

    .h3 {
        text-align: center;
        margin: 0 auto !important;
    }

    .actions {
        padding: 15px;
        text-align: center;
    }
</style>