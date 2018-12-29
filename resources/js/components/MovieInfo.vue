<template>
    <div class="container" >
        <div class="bg-white content">
            <div class="row">
                <div class="content-background"
                     ref="background"
                     :style="getBackground"
                ></div>
                <button v-if="isAdmin"
                        ref="modalTrigger"
                        class="btn btn-light content-edit"
                        data-toggle="modal" data-target="#exampleModal"
                        @click="isEditable =!
                        isEditable">Редактировать
                </button>
                <div class="content-img-wrapper">
                    <img :src=data.img alt="">
                </div>
                <table class="table col-md-6">
                    <tr>
                        <td>Название:</td>
                        <td>{{data.name || '-'}}</td>
                    </tr>
                    <tr>
                        <td>Год:</td>
                        <td>{{data.year || '-'}}</td>
                    </tr>
                    <tr>
                        <td>Режиссёр:</td>
                        <td>{{data.dir || '-'}}</td>
                    </tr>
                    <tr>
                        <td>Продолжительность:</td>
                        <td>{{data.time || '-'}}</td>
                    </tr>
                    <tr v-if="this.rating.kinopoisk
                 || this.rating.imbd">
                        <td>Рейтинг:</td>
                        <td><a :href="this.kinopoisk_url +  this.data.kinopoisk_id">
                            Кинопоиск:</a>
                            {{rating.kinopoisk}}</td>
                        <td>iMbd: {{rating.imbd}}</td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="movie-description"
                     v-if="data.desk">
                    <span>
                        {{data.desk}}
                    </span>
                </div>
            </div>
        </div>
        <div class="movie-video"
             style="padding: 30px 0"
             v-if="this.data.video_path">
            <div class="col-md-6">
                <video width="560"
                       controls="controls"
                       height="315">
                    <source :src="this.data.video_path" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="movie-comments"
             style="padding: 1rem 0 0 1rem">
            Комментарии:
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active"
                       @click="commentsType = 'anonim'">
                    <input type="radio"
                           value="anonim">
                    Анонимный
                </label>
                <label @click="commentsType = 'public'"
                       class="btn btn-secondary">
                    <input type="radio"
                           value="public">
                    Для пидаров
                </label>
            </div>
            <div class="movie-comments__content">
                <AnonimCommentsComponent
                        :movieId="this.data.id"
                        :comments="comments"
                        v-show="commentsType
                        === 'anonim'"
                />
                <DusqusCommentsComponent
                        v-if="commentsType ===
                        'public'"/>
            </div>
        </div>
        <!-- Modal -->
        <ModalComponent>
            <template slot="name">Редактировать</template>
            <template slot="modal-body">
                <form :action="`/cart/${this.data.id}`"
                              method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token"
                                   :value="getToken()">
                            <label for="nameInput">Название:</label>
                            <input class="form-control"
                                   :value=this.data.name
                                   name="name"
                                   id="nameInput"
                                   placeholder="Название">
                            <div class="form-group">
                                <label for="yearInput">Год:</label>
                                <input type="number"
                                       name="year"
                                       id="yearInput"
                                       :value="this.data.year"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dirInput">Режиссёр:</label>
                                <input type="text"
                                       id="dirInput"
                                       name="dir"
                                       :value="this.data.dir"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lengthInput">Продолжительность:</label>
                                <input type="number"
                                       id="lengthInput"
                                       name="time"
                                       :value="this.data.time"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="posterInput">Адрес постера:</label>
                                <input type="text"
                                       id="posterInput"
                                       name="img"
                                       :value="this.data.img"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="backgroundInput">Адрес бекграйнда:</label>
                                <input type="text"
                                       id="backgroundInput"
                                       name="background_img"
                                       :value="this.data.background_img"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="videoInput">Адрес видео:</label>
                                <input type="text"
                                       id="videoInput"
                                       name="video_path"
                                       :value="this.data.video_path"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kinoInput">Кинопоиск айди:</label>
                                <input type="text"
                                       id="kinoInput"
                                       name="kinopoisk_id"
                                       :value="this.data.kinopoisk_id"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="deskInput">
                                    Описание:</label>
                                <textarea rows="3"
                                          id="deskInput"
                                          name="desk"
                                          :value="this.data.desk"
                                          class="form-control"></textarea>
                            </div>
                            <button type="button"
                                    class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit"
                                    class="btn btn-primary">Сохранить</button>
                        </form>
            </template>
        </ModalComponent>
    </div>
</template>

<script>
    import DusqusCommentsComponent from './DusqusCommentsComponent.vue'
    import AnonimCommentsComponent from  './AnonimCommentsComponent.vue'
    import ModalComponent from './ModalComponent.vue'
    export default {
        props: ['data', 'comments', 'isAdmin'],
        components: {
            DusqusCommentsComponent,
            AnonimCommentsComponent,
            ModalComponent
        },
        data: () => {
            return {
                isEditable: false,
                kinopoisk_url: 'https://www.kinopoisk.ru/film/',
                rating: {
                    kinopoisk: '',
                    imbd: ''
                },
                commentsType: 'anonim'
            }
        },
        mounted () {
            this.getRating();
            let formData = new FormData();
            formData.append('name', 'Зеленый пидар');
            formData.append('_token', this.getToken());
            formData.append('_method', 'PUT');

            axios.post('/cart/1', formData);
        },
        computed: {
            getBackground () {
                let img = this.data.background_img;
                this.isImageAdressValid(img).catch(() => {
                    const newBackground = 'https://image.krasview.ru/video/5ce95dc6c477436/870_2.jpg';
                    this.$refs['background'].style.background  = `rgba(0, 0, 0, 1) url(${newBackground}) no-repeat`
                });
                if (img) {
                    return {
                        background:
                            `rgba(0, 0, 0, 1) url(${this.data.background_img})`,
                        backgroundRepeat: 'no-repeat',
                        backgroundSize: 'cover',

                    }
                }
            }
        },
        methods: {
            isImageAdressValid (src) {
                const newImage = document.createElement('img');
                newImage.style.visibility = 'hidden';
                newImage.src = src;
                return new Promise(function
                    (resolve, reject) {
                    newImage.onload = function () {
                        resolve()
                    };
                    newImage.onerror = function () {
                        reject ()
                    };
                });
            },
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
            getRating () {
                const id = this.data.kinopoisk_id;
                const url = `https://rating.kinopoisk.ru/${id}.xml`;
                if (id) {
                    axios.get(url).then(response => {
                        if (response.data) {
                            let parser = new DOMParser();
                            var doc = parser.parseFromString(response.data, "application/xml");
                            const el_kp =
                                doc.getElementsByTagName('kp_rating')[0];
                            const el_imdb =
                                doc.getElementsByTagName('imdb_rating')[0];
                            this.rating.kinopoisk = el_kp && el_kp.innerHTML ? el_kp.innerHTML : '';
                            this.rating.imbd = el_imdb && el_imdb.innerHTML ? el_imdb.innerHTML : '';
                        }
                    })
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .container {
        position: relative;
    }

    .content-edit {
        position: absolute;
        top: 0;
        right: 0;
    }
    img {
        width: 200px;
        height: 270px;
    }
    .container > .content {
        position: relative;
        padding: 30px;
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        .content-background {
            top: 0;
            left: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.1;
        }
    }

    .content-img-wrapper {
        margin-right: 40px;
        z-index: 1;
    }

    .movie-description {
        padding: 20px 80px;
    }
    .movie-video {
        display: flex;
        align-items: center;
        flex-direction: column;
        background-color: #f8fafc;
    }

    .movie-comments__content {
        padding: 20px 0;
    }

    .modal-body .form-group {
        justify-content: flex-start;
        align-items: flex-start;
    }

    .movie-comments {
        background-color: #f8fafc;
    }
</style>