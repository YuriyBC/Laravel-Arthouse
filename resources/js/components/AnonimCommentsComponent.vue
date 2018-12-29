<template>
    <div class="comments-list">
        <ul class="list-group">
            <li class="comment list-group-item"
                v-for="comment in data">
                <span>{{
                    formatDate(comment.created_at)}},
                {{comment.username}}</span>
                <span>{{comment.comment}}</span>
            </li>
            <li class="comment-edit list-group-item">
                <div class="form-group">
                    <input type="name"
                           class="form-control input-name"
                           v-model="userName"
                           placeholder="Имя"
                           aria-describedby="emailHelp">
                    <input type="email"
                           class="form-control"
                           v-model="userComment"
                           id="exampleInputEmail1"
                           aria-describedby="emailHelp">
                    <button type="submit"
                            @click="addComment"
                            class="btn btn-primary">Добавить</button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    const defaultUsername = 'Анон'
    export default {
        mounted () {
            this.data = this.comments
        },
        data () {
          return {
              data: [],
              userName: defaultUsername,
              userComment: ''
          }
        },
        props: ['comments', 'movieId'],
        methods: {
            formatDate (date) {
                if (date.replace) {
                    let str = date.replace(/-/g, '/');
                    return str.replace(' ', '\n')
                }
            },
            addComment () {
                const data = {
                    comment: this.userComment,
                    movie_id: this.movieId,
                    username: this.userName,
                    created_at: new Date().getTime()
                };
                axios({
                    method: 'post',
                    url: '/comment',
                    data: data
                }).then((response) => {
                    this.data.push(response.data[0]);
                    this.userName =
                        defaultUsername;
                    this.userComment = ''
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .comment {
        display: flex;
        flex-direction: column;
        span:first-child {
            font-weight: bold;
            margin-right: 20px;
        }
    }
    .comments-list button {
        margin-top: 15px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .input-name {
        height: 25px;
        margin-bottom: 10px;
    }
    span {
        word-break:break-all
    }
</style>