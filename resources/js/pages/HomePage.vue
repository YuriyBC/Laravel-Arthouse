<template>
    <div class="home">
        <!--<HeaderComponent :user="user"></HeaderComponent>-->
        <HomeContent :admin="admin"
                     :data="this.data"></HomeContent>
    </div>
</template>

<script>
    import HeaderComponent from '../components/HeaderComponent.vue'
    import HomeContent from '../components/HomeContent.vue'
    export default {
        props: ['data', 'user', 'admin'],
        components: {
            HeaderComponent,
            HomeContent
        },
    }
</script>
