<template>
    <div class="home">
        <!--<HeaderComponent :user="user"/>-->
        <MovieInfo :isAdmin="admin"
                   :comments="comments"
                   :data="data"/>
    </div>
</template>

<script>
    import HeaderComponent from '../components/HeaderComponent.vue'
    import MovieInfo from
        '../components/MovieInfo.vue'
    export default {
        props: ['data', 'comments', 'admin', 'user'],
        components: {
            HeaderComponent,
            MovieInfo
        }
    }
</script>
