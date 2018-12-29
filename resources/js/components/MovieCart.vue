<template>
    <div class="cart"
         v-if="!isDeleted"
         @click="routeToCart"
         @mouseover="showInfo = true"
         @mouseleave="showInfo = false">
        <img class="cart-image"
             @error="this.onImageError"
             :src= cart.img />
        <transition name="fade">
            <div class="cart-info" v-if="showInfo">
                <div>
                    <p>{{cart.name}}</p>
                </div>
                <span>{{cart.year || '-'}}</span>
                <button v-if="admin"
                        @click.stop="deleteItem">
                    Delete</button>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                showInfo: false,
                isDeleted: false
            }
        },
        props: ['cart', 'admin'],
        methods: {
            routeToCart () {
                window.location = `/cart/${this.cart.id}`
            },
            onImageError ($ev) {
                $ev.target.src = 'https://coubsecure-s.akamaihd.net/get/b30/p/coub/simple/cw_timeline_pic/7a3148e32b4/76f3076e529410a2b3cfd/med_1410759943_1388861484_image.jpg'
                $ev.target.style.filter = 'grayscale(90%)'
            },
            deleteItem () {
                let request =
                    axios.delete('/cart/' + this.cart.id);
                request.then(() => {
                    this.isDeleted = true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .cart {
        position: relative;
        display: block;
        width: 140px;
        height: 180px;
        cursor: pointer;
        color: white;
    }

    .cart-image {
        display: flex;
        width: 100%;
        height: 100%;
    }

    .cart-info {
        position: absolute;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-between;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        color: white;
        background: rgba(230, 21, 35, 0.8);
        p {
            font-size: 17px;
            line-height: 17px;
        }
        & > div {
            height: 100%;
            padding: 0 5px;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        span {
            padding-bottom: 5px;
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }
</style>