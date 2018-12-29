<template>
    <div class="faggot">
        <div class="faggot-container">
            <div class="progress">
                <div :class="[this.progressValue
            !== 100 ? 'progress-bar-striped':
            'bg-success']"
                     class="progress-bar
                        progress-bar-animated"
                     role="progressbar"
                     aria-valuenow="75"
                     ref="progressBar"
                     aria-valuemin="0"
                     aria-valuemax="100"
                     :style="`width: ${this.progressValue}%`">
                </div>
            </div>
            <p class="saving"
               v-if="currentMessage &&
               progressValue !== 100">
                {{ currentMessage }}
                <span>.</span><span>.</span><span>.</span>
            </p>
            <p v-if=" progressValue === 100">
                {{ sucessMessage }}
            </p>
        </div>

        <div
                :class="{'pyro': progressValue === 100}">
            <div class="before"></div>
            <div class="after"></div>
        </div>
    </div>
</template>

<script>


    export default {
        data: () => {
            return {
                progressValue: 0,
                messages: [
                    'Сбор данных о пользователе',
                    'Чтение переписки',
                    'Анализ кеша вебкамеры',
                    'Просмотр истории загрузок',
                    'Анализ данных'
                ],
                sucessMessage:
                    'Поздравляю, вы пидар',
                currentMessage: ''
            }
        },
        mounted () {
            const totalProgressValue = 100;
            const stepMessagesChange =
                totalProgressValue /
                this.messages.length + 1;
            const step = 50;
            let i = 0;
            let interval = setInterval(() => {
                if (this.progressValue %
                    stepMessagesChange === 1) {
                    this.currentMessage =
                        this.messages[i]
                    i++
                }
               this.progressValue++;
                if (this.progressValue === totalProgressValue) {
                   clearInterval(interval)
                }
            }, step)
        }
    }
</script>

<style lang="scss" scoped>
    .faggot {
        width: 100%;
        display: flex;
        justify-content: center;
        padding-top: 200px;
        color: white;
        p {
            color: white;
        }
    }

    .progress {
        width: 800px;
    }

    .progress {
        background-color: #babcbf;
    }

    .faggot-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        p {
            padding-top: 10px;
            font-size: 20px;
        }
    }

    @keyframes blink {
        /**
         * At the start of the animation the dot
         * has an opacity of .2
         */
        0% {
            opacity: .2;
        }
        /**
         * At 20% the dot is fully visible and
         * then fades out slowly
         */
        20% {
            opacity: 1;
        }
        /**
         * Until it reaches an opacity of .2 and
         * the animation can start again
         */
        100% {
            opacity: .2;
        }
    }

    .saving span {
        /**
         * Use the blink animation, which is defined above
         */
        animation-name: blink;
        /**
         * The animation should take 1.4 seconds
         */
        animation-duration: 1.4s;
        /**
         * It will repeat itself forever
         */
        animation-iteration-count: infinite;
        /**
         * This makes sure that the starting style (opacity: .2)
         * of the animation is applied before the animation starts.
         * Otherwise we would see a short flash or would have
         * to set the default styling of the dots to the same
         * as the animation. Same applies for the ending styles.
         */
        animation-fill-mode: both;
    }

    .saving span:nth-child(2) {
        /**
         * Starts the animation of the third dot
         * with a delay of .2s, otherwise all dots
         * would animate at the same time
         */
        animation-delay: .2s;
    }

    .saving span:nth-child(3) {
        /**
         * Starts the animation of the third dot
         * with a delay of .4s, otherwise all dots
         * would animate at the same time
         */
        animation-delay: .4s;
    }


    $particles: 70;
    $width: 900;
    $height: 900;

    .pyro {
        position: absolute;
        top: 300px;
    }

    // Create the explosion...
    $box-shadow: ();
    $box-shadow2: ();
    @for $i from 0 through $particles {
        $box-shadow: $box-shadow,
        random($width)-$width / 2 + px
        random($height)-$height / 1.2 + px
        hsl(random(360), 100, 50);
        $box-shadow2: $box-shadow2, 0 0 #fff
    }
    @mixin keyframes ($animationName) {
        @-webkit-keyframes #{$animationName} {
            @content;
        }

        @-moz-keyframes #{$animationName} {
            @content;
        }

        @-o-keyframes #{$animationName} {
            @content;
        }

        @-ms-keyframes #{$animationName} {
            @content;
        }

        @keyframes #{$animationName} {
            @content;
        }
    }

    @mixin animation-delay ($settings) {
        -moz-animation-delay: $settings;
        -webkit-animation-delay: $settings;
        -o-animation-delay: $settings;
        -ms-animation-delay: $settings;
        animation-delay: $settings;
    }

    @mixin animation-duration ($settings) {
        -moz-animation-duration: $settings;
        -webkit-animation-duration: $settings;
        -o-animation-duration: $settings;
        -ms-animation-duration: $settings;
        animation-duration: $settings;
    }

    @mixin animation ($settings) {
        -moz-animation: $settings;
        -webkit-animation: $settings;
        -o-animation: $settings;
        -ms-animation: $settings;
        animation: $settings;
    }

    @mixin transform ($settings) {
        transform: $settings;
        -moz-transform: $settings;
        -webkit-transform: $settings;
        -o-transform: $settings;
        -ms-transform: $settings;
    }


    .pyro > .before, .pyro > .after {
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        @include animation-delay((2s));
        box-shadow: $box-shadow2;
        @include animation((1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards));
    }

    .pyro > .after {
        @include animation-delay((1.25s, 1.25s, 1.25s));
        @include animation-duration((1.25s, 1.25s, 6.25s));
    }

    @include keyframes(bang) {
        to {
            box-shadow:$box-shadow;
        }
    }

    @include keyframes(gravity)  {
        to {
            @include transform(translateY(200px));
            opacity: 0;
        }
    }

    @include keyframes(position) {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

</style>