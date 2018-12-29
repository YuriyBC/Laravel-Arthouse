<template>
    <div class="row">
        <nav class="navbar navbar-dark bg-dark col-md-12">
            <a class="navbar-brand"
               href="/">Русский Артхаус
            </a>
            <a href="/logout" v-if="user">Выйти</a>
            <a href="/login" v-if="!user">Вход</a>
        </nav>
    </div>

</template>

<script>
    export default {
        name: 'HeaderComponent',
        props: ['user']
    }
</script>
