<template>
    <div class="home-content">
        <div class="row">
            <div class="navbar">
                Русские артхаус фильмы:
            </div>
        </div>
        <div class="row">
            <div class="content-list"
                 v-for="movie in data">
                <MovieCart :admin="admin"
                           :cart="movie"/>
            </div>
            <div class="content-new btn btn-primary"
                 v-if="admin"
                 type="button" data-toggle="modal" data-target="#exampleModal">
                Добавить
            </div>
        </div>

        <!--Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">Добавить новый фильм</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/cart"
                              class="needs-validation"
                              method="post">
                            <input type="hidden" name="_token"
                                   :value="getToken()">
                            <label for="nameInput">Название:</label>
                            <input class="form-control"
                                   name="name"
                                   required
                                   id="nameInput">
                            <div class="form-group">
                                <label for="yearInput">Год:</label>
                                <input type="number"
                                       name="year"
                                       required
                                       id="yearInput"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dirInput">Режиссёр:</label>
                                <input type="text"
                                       id="dirInput"
                                       required
                                       name="dir"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lengthInput">Продолжительность:</label>
                                <input type="number"
                                       id="lengthInput"
                                       name="time"
                                       required
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="posterInput">Адрес постера:</label>
                                <input type="text"
                                       id="posterInput"
                                       name="img"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="backgroundInput">Адрес бекграйнда:</label>
                                <input type="text"
                                       id="backgroundInput"
                                       name="background_img"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="videoInput">Адрес видео:</label>
                                <input type="text"
                                       id="videoInput"
                                       name="video_path"
                                       required
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kinopoisk">Айди кинопоиска</label>
                                <input id="kinopoisk"
                                       name="kinopoisk_id"
                                       required
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="deskInput">
                                    Описание:</label>
                                <textarea rows="3"
                                          id="deskInput"
                                          name="desk"
                                          class="form-control"></textarea>
                            </div>
                            <button type="button"
                                    class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit"
                                    class="btn btn-primary">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MovieCart from '../components/MovieCart.vue'
    import col from '../data/movies.json'

    export default {
        data: function () {
          return {
              moviesList: null
          }
        },
        props: ['data', 'admin'],
        components: {
            MovieCart
        },
        methods: {
            getToken () {
                let token;
                const els = document.getElementsByTagName('meta')
                for (let i in els) {
                    if (els[i].name === 'csrf-token') {
                        token = els[i].content
                    }
                }
                return token
            },
        }
    }
</script>

<style scoped>
    .content-list > div {
        margin-left: 15px;
    }
    .content-new {
        display: flex;
        padding: 0 25px;
        align-content: center;
        align-items: center;
        color: white;
        margin-left: 15px;
        height: 180px;
        background-color: black;
        opacity: 0.7;
        cursor: pointer;
    }
</style>